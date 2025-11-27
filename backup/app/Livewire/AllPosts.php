<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Http\Request;

class AllPosts extends SearchableComponent
{
    // //public $search = '';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public $paginationTheme = 'bootstrap';
    public array $numberOfPaginatorsRendered = [];

    // public string $pageName = 'all-posts';

    public function render(Request $request)
    {
        $this->search = $request->search;

        $allPosts = $this->allPosts();

        if(getCurrentTheme() == 1){
        return view('livewire.all-posts-tailwind', compact('allPosts'));
        }
        return view('livewire.all-posts', compact('allPosts'));
    }

    public function allPosts()
    {
        $allPosts = Post::with('user', 'category', 'postVideo')->where('visibility', Post::VISIBILITY_ACTIVE);
        if (!empty($this->search)) {
            $allPosts->where(function ($query) {
                $query->orWhereHas('category', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('subCategory', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('title', 'like', '%' . $this->search . '%')
                    ->orWhere('tags', 'like', '%' . $this->search . '%');
            })->withCount('comment');
        } else {
            $allPosts->withCount('comment');
        }

        return $allPosts->orderBy('created_at', 'desc')->paginate(10);
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
