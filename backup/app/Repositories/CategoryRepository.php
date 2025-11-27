<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Navigation;

/**
 * Class UserRepository
 */
class CategoryRepository extends BaseRepository
{
    public $fieldSearchable = [
        'name',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Category::class;
    }

    public function create($input): bool
    {
        $input['show_in_menu'] = (isset($input['show_in_menu'])) ? Category::SHOW_MENU_ACTIVE : Category::SHOW_MENU_DEACTIVE;
        $input['show_in_home_page'] = (isset($input['show_in_home_page'])) ? Category::SHOW_MENU_HOME_ACTIVE : Category::SHOW_MENU_HOME_DEACTIVE;

        $category = Category::create($input);
        if (isset($input['category_image']) && !empty($input['category_image'])) {
         $category->addMedia($input['category_image'])->toMediaCollection(Category::CATEGORY_IMAGE,config('app.media_disc'));
     }

        $navigationOrder = Navigation::whereNull('parent_id')->count() + 1;
        Navigation::create([
            'navigationable_type' => Category::class,
            'navigationable_id' => $category['id'],
            'order_id' => $navigationOrder,
        ]);

        return true;
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($input, $id)
    {
        $category = Category::findOrFail($id);
        $input['show_in_menu'] = isset($input['show_in_menu']);
        $input['show_in_home_page'] = isset($input['show_in_home_page']);
        $category->update($input);
        if (isset($input['category_image']) && !empty($input['category_image'])) {
         $category->clearMediaCollection(Category::CATEGORY_IMAGE);
         $category->addMedia($input['category_image'])->toMediaCollection(Category::CATEGORY_IMAGE);
     }

        return true;
    }
}
