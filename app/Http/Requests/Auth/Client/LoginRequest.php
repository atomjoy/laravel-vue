<?php

namespace App\Http\Requests\Auth\Client;

use App\Events\LoginUser;
use App\Events\LoginUserError;
use App\Exceptions\JsonException;
use App\Mail\Auth\Client\F2aMail;
use App\Models\Auth\Client\F2acode;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class LoginRequest extends FormRequest
{
	protected $stopOnFirstFailure = true;

	public function authorize()
	{
		return true; // Allow all
	}

	public function rules()
	{
		$email = 'email:rfc,dns';
		if (env('APP_DEBUG') == true) {
			$email = 'email';
		}

		return [
			'email' => ['required', $email, 'max:191'],
			'password' => 'required|min:11|max:50',
			'remember_me' => 'sometimes|boolean'
		];
	}

	public function failedValidation(Validator $validator)
	{
		throw new ValidationException($validator, response()->json([
			'message' => $validator->errors()->first()
		], 422));
	}

	function prepareForValidation()
	{
		// $this->merge(
		// 	collect(request()->json()->all())->only(['email', 'password', 'remember_me'])->toArray()
		// );
	}

	/**
	 * Attempt to authenticate the request's credentials.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function authenticate(): void
	{
		$this->ensureIsNotRateLimited();

		if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember_me'))) {
			RateLimiter::hit(
				$this->throttleKey(),
				config('default.ratelimit_login_time', 300)
			);

			LoginUserError::dispatch($this->only('email'));

			throw new JsonException(__('login.failed'), 422);
		} else {
			LoginUser::dispatch(Auth::guard('web')->user());
		}

		if (empty(Auth::user()->email_verified_at)) {
			throw new JsonException(__('login.unverified'), 422);
		}

		RateLimiter::clear($this->throttleKey());
	}

	/**
	 * 2FA Authentication
	 */
	public function f2a()
	{
		$hash = Str::uuid();
		$code = random_int(123123, 999999);

		if (Auth::user()->f2a == 1) {
			$user = Auth::user();

			if (app()->runningUnitTests()) {
				$hash = 'test-hash-f2a-123';
				$code = 888777;
			}

			try {
				Mail::to($user)
					->locale(app()->getLocale())
					->send(new F2aMail($user, $code));
			} catch (\Throwable $e) {
				Auth::logout();
				throw new JsonException(__("login.f2a_email_error"), 422);
			}

			F2acode::create([
				'user_id' => Auth::id(),
				'code' => $code,
				'hash' => $hash
			]);

			Auth::logout();

			return $hash;
		}
	}

	public function ensureIsNotRateLimited(): void
	{
		if (!RateLimiter::tooManyAttempts($this->throttleKey(), config('default.ratelimit_login_count', 5))) {
			return;
		}

		event(new Lockout($this));

		$seconds = RateLimiter::availableIn($this->throttleKey());

		if (app()->runningUnitTests()) {
			$seconds = 60;
		}

		throw new JsonException(__('login.throttle', [
			'seconds' => $seconds,
			'minutes' => ceil($seconds / 60),
		]), 422);
	}

	public function throttleKey(): string
	{
		return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
	}
}
