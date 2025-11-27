<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubcategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\SubCategory;
use App\Repositories\SubCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends AppBaseController
{
    /**
     * @var SubCategoryRepository
     */
    private $SubCategoryRepository;

    /**
     * CategoryRepository constructor.
     */
    public function __construct(SubCategoryRepository $SubCategoryRepository)
    {
        $this->SubCategoryRepository = $SubCategoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $category = Category::all()->pluck('name', 'id')->sort();

        return view('sub_category.index', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubcategoryRequest $request): JsonResponse
    {
        $input = $request->all();

        $this->SubCategoryRepository->create($input);

        return $this->sendSuccess(__('messages.placeholder.sub_categories_saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory): JsonResponse
    {
        return $this->sendResponse($subCategory, __('messages.placeholder.sub_category_retrieved_successfully'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory): JsonResponse
    {
        $input = $request->all();

        $this->SubCategoryRepository->update($input, $subCategory);

        return $this->sendSuccess(__('messages.placeholder.sub_category_updated_successfully'));
    }

    public function destroy(SubCategory $subCategory): JsonResponse
    {
        if ($subCategory->post()->count() > 0) {
            return $this->sendError(__('messages.placeholder.this_sub_category_is_in_use'));
        }
        $parentId = $subCategory->parent_category_id;
        $subCategory->navigation()->delete();

        $subsNavigation = Navigation::whereNavigationableType(SubCategory::class)
            ->whereParentId($parentId)->orderBy('order_id')->get();
        foreach ($subsNavigation as $key => $navigation) {
            $navigation->update([
                'order_id' => $key + 1,
            ]);
        }

        $subCategory->delete();

        return $this->sendSuccess(__('messages.placeholder.sub_category_delete_successfully'));
    }
}
