<?php

namespace App\Http\Resources\Panel\Admin;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminCollection extends ResourceCollection
{
	/**
	 * Transform the resource collection into an array.
	 *
	 * @return array<int|string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'data' => $this->collection,
			'paginate' => new PaginationResource($this),
		];

		return parent::toArray($request);
	}
}
