<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $languages = Language::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('album.index', compact('languages'));
    }

    /**
     * @return mixed
     */
    public function store(CreateAlbumRequest $request)
    {
        $input = $request->all();

        Album::create($input);

        return $this->sendSuccess(__('messages.placeholder.album_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album): JsonResponse
    {
        return $this->sendResponse($album, __('messages.placeholder.album_retrieve_successfully'));
    }

    /**
     * @return mixed
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $input = $request->all();
        $album->update($input);

        return $this->sendSuccess(__('messages.placeholder.album_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album): JsonResponse
    {
        $gallery = $album->gallery()->count();
        $subAlbum = $album->albumCategory()->count();
        if (! empty($gallery || $subAlbum)) {
            return $this->sendError(__('messages.placeholder.this_album_is_in_use'));
        }
        $album->delete();

        return $this->sendSuccess(__('messages.placeholder.album_deleted_successfully'));
    }
}
