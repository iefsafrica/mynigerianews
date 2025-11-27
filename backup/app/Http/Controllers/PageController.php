<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\ImageUploadReuest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Models\User;
use App\Repositories\PageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageController extends AppBaseController
{
    /** @var pagefRepository */
    private $PageRepository;

    public function __construct(PageRepository $PageRepository)
    {
        $this->PageRepository = $PageRepository;
    }

    /**
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('page.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $images = getLogInUser()->getMedia(User::NEWS_IMAGE);
        $imageUrls = [];
        foreach ($images as $image) {
            $imageUrls[] = $image->getFullUrl();
        }

        return view('page.create', compact('imageUrls'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePageRequest $request): RedirectResponse
    {
        $input = $request->all();

        $this->PageRepository->store($input);

        Flash::success(__('messages.placeholder.page_created_successfully'));

        return redirect(route('pages.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function show($id)
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Page $page): \Illuminate\View\View
    {
        return view('page.edit', compact('page'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $this->PageRepository->update($request->all(), $page->id);

        Flash::success(__('messages.placeholder.page_updated_successfully'));

        return redirect(route('pages.index'));
    }

    /**
     * @return mixed
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return $this->sendSuccess(__('messages.placeholder.page_deleted_successfully'));
    }

    public function visibility(Request $request): JsonResponse
    {
        $page = Page::find($request->data);

        $page->visibility = ($page->visibility == 0) ? '1' : '0';

        $page->save();

        return $this->sendSuccess(__('messages.placeholder.visibility_updated_successfully'));
    }

    public function imgUpload(ImageUploadReuest $request)
    {
        $input = $request->all();
        $user = getLogInUser();

        $imageCheck = Media::where('collection_name', User::NEWS_IMAGE)->where('file_name',
            $input['image']->getClientOriginalName())->exists();

        if (! $imageCheck) {
            if ((! empty($input['image']))) {
                $media = $user->addMedia($input['image'])->toMediaCollection(User::NEWS_IMAGE);
            }
            $data['url'] = $media->getFullUrl();
            $data['mediaId'] = $media->id;

            return $this->sendResponse($data, __('messages.placeholder.image_upload_successfully'));
        } else {
            return $this->sendError(__('messages.placeholder.already_image_exist'));
        }
    }

    public function imageGet(): JsonResponse
    {
        /** @var User $user */
        $user = getLogInUser();
        $images = $user->getMedia(User::NEWS_IMAGE);
        $data = [];
        foreach ($images as $index => $image) {
            $data[$index]['imageUrls'] = $image->getFullUrl();
            $data[$index]['id'] = $image->id;
        }

        return $this->sendResponse($data, __('messages.placeholder.img_retrieved'));
    }

    public function imageDelete($id): JsonResponse
    {
        $media = Media::whereId($id)->firstorFail();
        $media->delete();

        return $this->sendResponse($media, __('messages.placeholder.image_delete_successfully'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function showPageSlug($pageSlug)
    {
        $page = Page::whereVisibility(1)->whereSlug($pageSlug)->first();
        if (empty($page)) {
            return redirect(route('front.home'));
        }
        if(getCurrentTheme() == 1){
        return view('theme1.page-slug', compact('page'));
        }
        return view('front_new.page-slug', compact('page'));
    }
}
