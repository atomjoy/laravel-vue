<?php

namespace App\Http\Requests\Panel\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
		return [
			'file' => [
				'required',
				Rule::file()->types(['webp', 'jpeg', 'jpg', 'png', 'gif'])
					->max(config('default.max_upload_size_mb', 5) * 1024),
				Rule::dimensions()
					->minWidth(config('default.avatar_min_pixels', 10))
					->minHeight(config('default.avatar_min_pixels', 10)),
				Rule::dimensions()
					->maxWidth(config('default.avatar_max_pixels', 8000))
					->maxHeight(config('default.avatar_max_pixels', 8000)),
			],
			'name' => 'sometimes|min:1|max:50',
			'f2a' => 'required|numeric',
		];
	}

	function prepareForValidation()
	{
		// $this->merge([]);
	}
}
