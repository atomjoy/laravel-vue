<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccountRequest extends FormRequest
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
		return Auth::guard('admin')->check(); // Allow logged
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => ['required', 'min:3', 'max:50'],
			'location' => 'sometimes|max:50',
			'bio' => 'sometimes|max:255',
			'mobile_prefix' => 'sometimes|numeric',
			'mobile' => 'sometimes|numeric',
			'allow_email' => 'required|numeric',
			'allow_sms' => 'required|numeric',
			'address_line1' => 'sometimes|max:50|nullable',
			'address_line2' => 'sometimes|max:50|nullable',
			'address_city' => 'sometimes|max:50|nullable',
			'address_country' => 'sometimes|max:50|nullable',
			'address_state' => 'sometimes|max:50|nullable',
			'address_postal' => 'sometimes|max:50|nullable',
		];
	}

	/**
	 * Prepare inputs for validation.
	 *
	 * @return void
	 */
	protected function prepareForValidation()
	{
		$this->merge([
			'allow_email' => (int) ($this->allow_email == 1),
			'allow_sms' => (int) ($this->allow_sms == 1),
		]);
	}
}
