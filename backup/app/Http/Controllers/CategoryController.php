<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Navigation;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends AppBaseController
{
    /**
     * @var CategoryRepository
     */
    private $CategoryRepository;

    /**
     * CategoryRepository constructor.
     */
    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $language = Language::all()->pluck('name', 'id')->sort();

        return view('categories.index', compact('language'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    public function store(CreateCategoriesRequest $request): JsonResponse
    {
        $input = $request->all();

        $this->CategoryRepository->create($input);

        return $this->sendSuccess(__('messages.placeholder.category_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): JsonResponse
    {
        $data['category'] = $category;
        $data['post_count'] = $category->posts()->count();

        return $this->sendResponse($data, __('messages.placeholder.category_retrieve_successfully'));
    }

    public function update(UpdateCategoriesRequest $request, Category $category): JsonResponse
    {
        $input = $request->all();

        $this->CategoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.placeholder.category_updated_successfully'));
    }

    public function destroy(Category $category): JsonResponse
    {
        $id = $category->id;
        if ($category->subCategories()->count() > 0 || $category->posts()->count() > 0) {
            return $this->sendError(__('messages.placeholder.this_category_is_in_use'));
        }

        $category->navigation()->delete();
        Navigation::whereNavigationableType(SubCategory::class)->whereParentId($id)->delete();
        $category->delete();

        return $this->sendSuccess(__('messages.placeholder.category_deleted_successfully'));
    }
}
