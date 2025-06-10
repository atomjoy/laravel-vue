<?php

namespace App\Http\Requests\Panel\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends FormRequest
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
		$email = 'email:rfc,dns';
		if (env('APP_DEBUG') == true) {
			$email = 'email';
		}

		return [
			'name' => 'required|min:1|max:50',
			'email' => [
				'required',
				$email,
				'max:161',
				Rule::unique('users')
				// Rule::unique('users')->whereNull('deleted_at')
			],
			'f2a' => 'required|numeric',
			'file' => [
				'sometimes',
				Rule::file()->types(['webp', 'jpeg', 'jpg', 'png', 'gif'])
					->max(config('default.max_upload_size_mb', 5) * 1024),
				Rule::dimensions()
					->minWidth(config('default.avatar_min_pixels', 10))
					->minHeight(config('default.avatar_min_pixels', 10)),
				Rule::dimensions()
					->maxWidth(config('default.avatar_max_pixels', 5000))
					->maxHeight(config('default.avatar_max_pixels', 5000)),
			],
		];
	}

	function prepareForValidation()
	{
		// $this->merge([]);
	}
}
