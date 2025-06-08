<?php

namespace App\Http\Requests\Panel\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
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
		$email = 'email:rfc,dns';
		if (env('APP_DEBUG') == true) {
			$email = 'email';
		}

		return [
			'note' => 'required|max:5000',
			// 'firstname' => 'required|max:100',
			// 'lastname' => 'required|max:100',
			// 'email' => ['required', $email, 'max:191'],
			// 'mobile' => 'required|max:100',
			// 'subject' => 'required|max:255',
			// 'message' => 'required|max:5000',
			// 'file' => [
			// 	'sometimes',
			// 	Rule::file()->types(['pdf', 'doc', 'docx'])->max(10 * 1024),
			// ]
		];
	}
}
