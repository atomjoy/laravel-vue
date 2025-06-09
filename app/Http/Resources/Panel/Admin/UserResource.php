<?php

namespace App\Http\Resources\Panel\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'avatar' => $this->avatar,
			'location' => $this->location,
			'mobile' => $this->mobile,
			'mobile_prefix' => $this->mobile_prefix,
			'bio' => $this->bio,
			'f2a' => $this->f2a,
			'address_country' => $this->address_country,
			'address_state' => $this->address_state,
			'address_city' => $this->address_city,
			'address_postal' => $this->address_postal,
			'address_line1' => $this->address_line1,
			'address_line2' => $this->address_line2,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}
}
