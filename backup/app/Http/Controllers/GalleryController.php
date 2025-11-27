<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class GalleryController extends AppBaseController
{
    /** @var GalleryRepository */
    public $galleryRepository;

    public function __construct(GalleryRepository $galleryRepo)
    {
        $this->galleryRepository = $galleryRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('gallery.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $albums = Album::pluck('name', 'id')->toArray();
        $categories = AlbumCategory::pluck('name', 'id')->toArray();

        return view('gallery.create', compact('albums', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateGalleryRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->galleryRepository->store($input);

        Flash::success(__('messages.placeholder.gallery_image_created_successfully'));

        return redirect(route('gallery-images.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit($id): \Illuminate\View\View
    {
        $gallery = Gallery::whereId($id)->firstorFail();

        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateGalleryRequest $request, $id): RedirectResponse
    {
        $input = $request->all();

        $this->galleryRepository->updateGallery($input, $id);

        Flash::success(__('messages.placeholder.gallery_image_updated_successfully'));

        return redirect(route('gallery-images.index'));
    }

    /**
     * @return mixed
     */
    public function destroy($id)
    {
        $image = Gallery::whereId($id)->delete();

        return $this->sendSuccess(__('messages.placeholder.gallery_image_deleted_successfully'));
    }

    /**
     * @return mixed
     */
    public function getAlbums(Request $request)
    {
        $langId = $request->get('langId');
        $albums = getAlbums($langId);

        return $this->sendResponse($albums, __('messages.placeholder.albums_retrieved_successfully'));
    }

    /**
     * @return mixed
     */
    public function getCategory(Request $request)
    {
        $albumId = $request->get('albumId');
        $langId = $request->get('langId');
        $categories = getAlbumCategory($albumId, $langId);

        return $this->sendResponse($categories, __('messages.placeholder.albums_retrieved_successfully'));
    }
}
