<?php

namespace App\Http\Resources\Panel\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleMediaResource extends JsonResource
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
		$admin = Admin::find($this->admin_id);
		$admin->current_article_id = $this->id;

		return [
			'id' => $this->id,
			'title' => $this->title,
			'path' => $this->path,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
			'admin_id' => $this->admin_id,
			'author' => new ArticleMediaAuthorResource($admin),
		];
	}
}
