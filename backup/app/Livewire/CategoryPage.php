<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryPage extends SearchableComponent
{
    public $slug;

    public $subName;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public $paginationTheme = 'bootstrap';

    // public string $pageName = 'category-page';
    public array $numberOfPaginatorsRendered = [];

    /**
     * @var mixed
     */
    private $subCategory;

    public function mount($slug = null, $subName = null)
    {
        $this->slug = $slug;
        $this->subName = $subName;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $categoryPosts = $this->postsData();
        if(getCurrentTheme() == 1){
        return view('livewire.category-page-tailwind', compact('categoryPosts'));
        }
        return view('livewire.category-page', compact('categoryPosts'));
    }

    public function postsData(): LengthAwarePaginator
    {
        $this->setQuery($this->getQuery()->with(['category', 'postArticle', 'postGalleries', 'postSortLists.media', 'postSortLists', 'media', 'user'])->where('visibility', Post::VISIBILITY_ACTIVE)->orderByDesc('created_at'));

        $categoryId = (!empty(Category::where('slug', $this->slug)->first())) ? Category::where('slug', $this->slug)
            ->first()->id : null;
        $this->getQuery()->where('category_id', $categoryId);

        if (!empty($this->subName)) {
            $sub = SubCategory::where('slug', $this->subName)->first();
            $subId = (!empty($sub)) ? $sub->id : null;
            $this->getQuery()->where('sub_category_id', $subId);
        }

        return $this->paginate();
    }

    public function model()
    {
        return Post::class;
    }

    public function searchableFields()
    {
        return ['category_id'];
    }
}
