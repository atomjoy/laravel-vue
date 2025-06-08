<?php

namespace App\Http\Requests\Panel\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriberRequest extends FormRequest
{
	/**
	 * Show only first error message.
	 *
	 * @var boolean
	 */
	protected $stopOnFirstFailure = true;

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$subscriber = $this->route('subscriber');

		$email = 'email:rfc,dns';
		if (env('APP_DEBUG') == true) {
			$email = 'email';
		}

		return [
			'email' => ['sometimes', $email, 'max:191', 'unique:subscribers,email,' . $subscriber->id],
			'name' => 'sometimes|max:100',
			'is_approved' => 'sometimes|numeric',
		];
	}

	function prepareForValidation()
	{
		$val = 0;

		if ($this->is_approved == 1) {
			$val = 1;
		}

		$this->merge([
			'is_approved' => $val,
		]);
	}
}
