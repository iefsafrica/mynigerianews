<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FrontUserTable extends SearchableComponent
{
    public $user;

    public $user_data;

    public $followers;

    public $following;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public $paginationTheme = 'bootstrap';

    public $numberOfPaginatorsRendered;

    /**
     * @var mixed
     */
    public function mount($user = null, $user_data = null, $followers = null, $following = null)
    {

        $this->user = $user;
        $this->user_data = $user_data;
        $this->followers = $followers;
        $this->following = $following;
    }

    /**
     * @return  Application|Factory|View
     */
    public function render()
    {
        $posts = $this->postsData();

        return view('livewire.front-user-tailwind', compact('posts'));
        return view('livewire.front-user', compact('posts'));
    }

    public function postsData(): LengthAwarePaginator
    {
        $this->getQuery()->where('created_by', $this->user)->whereVisibility(Post::VISIBILITY_ACTIVE);

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
