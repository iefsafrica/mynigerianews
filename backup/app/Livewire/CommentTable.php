<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class CommentTable extends LivewireTableComponent
{
    protected $model = Comment::class;

    public $showButtonOnHeader = false;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        $this->setColumnSelectStatus(false);

    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton-no-button');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.post.posts'), 'posts.title')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Post::select('title')->whereColumn('id', 'post_id'), $direction);
                })->searchable()
                ->view('comment.components.post_title'),
            Column::make("Name", "name")
                ->hideIf('name')
                ->sortable(),
            Column::make(__('messages.emails.email'), "email")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.comment.comment'), "comment")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->view('comment.components.status')
                ->sortable(),
            Column::make(__('messages.common.action'),'id')
                ->view('comment.components.action'),
            Column::make("Post id", "post_id")
                ->hideIf('post_id')
                ->sortable(),
            Column::make("User id", "user_id")
                ->hideIf('user_id')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
    public function updateStatus($status, $id)
    {
        $commentStatus = ($status == 1) ? '0' : '1';
        $status = Comment::findOrFail($id);
        $status->update(['status' => $commentStatus]);
        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.status_updated_successfully'));
    }
}
