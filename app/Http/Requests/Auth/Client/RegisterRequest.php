<?php

namespace App\Http\Requests\Auth\Client;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
			'name' => [
				'required',
				'min:3',
				'max:50'
			],
			'email' => [
				'required',
				$email,
				'max:161',
				Rule::unique('users')
				// Rule::unique('users')->whereNull('deleted_at')
			],
			'password' => [
				'required',
				Password::min(11)->letters()->mixedCase()->numbers()->symbols(),
				'confirmed',
				'max:50',
			],
			'password_confirmation' => 'required'
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
		// 	collect(request()->json()->all())->only(['name', 'email', 'password', 'password_confirmation'])->toArray()
		// );
	}
}
