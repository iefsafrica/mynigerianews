<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PopularTagPage extends SearchableComponent
{
    public $tagName;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public $paginationTheme = 'bootstrap';
    public array $numberOfPaginatorsRendered = [];

    public function render()
    {
        $popularTag = $this->postsData();

        if(getCurrentTheme() == 1){
        return view('livewire.popular-tag-page-tailwind', compact('popularTag'));
        }
        return view('livewire.popular-tag-page', compact('popularTag'));
    }

    public function postsData(): LengthAwarePaginator
    {
        $this->setQuery($this->getQuery()->with([
            'language', 'category', 'postArticle', 'postGalleries', 'postSortLists.media', 'postSortLists', 'media', 'user',
        ])->where('visibility', Post::VISIBILITY_ACTIVE)->withCount('comment')->where('tags', 'like', '%'.$this->tagName.'%')->orderBy('created_at', 'desc'));

        return $this->paginate();
    }

    public function model()
    {
        return Post::class;
    }

    public function searchableFields()
    {
        return [];
    }
}
