<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Models\Panel\ArticleMedia;
use App\Exceptions\JsonException;
use App\Http\Requests\Panel\Admin\StoreArticleMediaRequest;
use App\Http\Requests\Panel\Admin\UpdateArticleMediaRequest;
use App\Http\Resources\Panel\Admin\ArticleMediaCollection;
use App\Http\Resources\Panel\Admin\ArticleMediaResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleMediaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', ArticleMedia::class);

		$perpage = request()->integer('perpage', default: 5);

		$q = ArticleMedia::query()->latest('id');

		if (request()->filled('search')) {
			$q->searchTitle(request()->input('search'));
		}

		if (request()->filled('search')) {
			$q->searchAdmin(request()->input('search'));
		}

		return new ArticleMediaCollection($q->paginate($perpage));

		// return new ArticleMediaCollection(ArticleMedia::latest('id')->paginate($perpage));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreArticleMediaRequest $request)
	{
		Gate::authorize('create', ArticleMedia::class);

		$admin = Auth::guard('admin')->user();

		$valid = $request->validated();

		$valid['admin_id'] = $admin->id;

		$articlemedia = ArticleMedia::create($valid);

		$this->upload($articlemedia);

		return response()->json([
			'message' => 'Created',
			'data' => $articlemedia,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ArticleMedia $articlemedia)
	{
		Gate::authorize('view', $articlemedia);

		return $articlemedia;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(ArticleMedia $articlemedia)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateArticleMediaRequest $request, ArticleMedia $articlemedia)
	{
		Gate::authorize('update', $articlemedia);

		$articlemedia->update($request->validated());

		$this->upload($articlemedia);

		return response()->json([
			'message' => 'Updated',
			'data' => $articlemedia,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ArticleMedia $articlemedia)
	{
		Gate::authorize('delete', $articlemedia);

		try {
			if (Storage::exists($articlemedia->path)) {
				Storage::delete($articlemedia->path);
			}
		} catch (\Throwable $e) {
			report($e);
		}

		$articlemedia->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Upload articlemedia image
	 *
	 * @param ArticleMedia $articlemedia
	 * @return void
	 */
	function upload($articlemedia)
	{
		try {
			if (request()->file('file')) {
				$path = 'media/image/' . $articlemedia->id . '.webp';

				$image = (new ImageManager(new Driver()))
					->read(request()->file('file'))
					->toWebp();

				Storage::put($path, (string) $image);

				$articlemedia->path = $path;
				$articlemedia->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}
	}

	/**
	 * Remove articlemedia image
	 *
	 * @param ArticleMedia $articlemedia
	 * @return void
	 */
	function remove(ArticleMedia $articlemedia)
	{
		Gate::authorize('update', $articlemedia);

		try {
			if (Storage::exists($articlemedia->path)) {
				Storage::delete($articlemedia->path);
				$articlemedia->path = null;
				$articlemedia->save();
			}

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}
}
