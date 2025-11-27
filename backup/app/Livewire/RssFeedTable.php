<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RssFeed;

class RssFeedTable extends LivewireTableComponent
{
    protected $model = RssFeed::class;

    protected $listeners = [
        'refresh' => '$refresh', 'filterPostType', 'filterCategory', 'filterLangId', 'filterSubCategory', 'resetPage',
        'deleteSelected',
    ];

    public $showButtonOnHeader = true;

    public $buttonComponent = 'rss_feed.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        $this->setColumnSelectStatus(false);
    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton');
    }
    
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.rss_feed.feed_name'), "feed_name")
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                  return \Illuminate\Support\Str::limit($value, 32, '...');
              }),
            Column::make(__('messages.rss_feed.feed_url'), "feed_url")
                ->view('rss_feed.components.feed_url')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.rss_feed.post_import'), "no_post")
                ->view('rss_feed.components.no_post')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.languages'), "language_id")
                ->view('rss_feed.components.language')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.post.category'), "category_id")
                ->view('rss_feed.components.category_name')
                ->searchable()
                ->sortable(),
            Column::make("Subcategory id", "subcategory_id")
                ->hideIf('subcategory_id')
                ->sortable(),
            // Column::make("Images", "images")
            //     ->sortable(),
            // Column::make("Generate keywords", "generate_keywords")
            //     ->sortable(),
            Column::make("show btn", "show_btn")
                ->hideIf('show_btn')
                ->sortable(),
            Column::make("Post draft", "post_draft")
                ->hideIf('post_draft')
                ->sortable(),
            // Column::make("Show btn text", "show_btn_text")
            //     ->sortable(),
            Column::make(__('messages.common.created_by'), "user_id")
                ->view('rss_feed.components.user_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.rss_feed.auto_update'), "auto_update")
                ->view('rss_feed.components.auto_update')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('rss_feed.components.action'),
            Column::make("Tags", "tags")
                ->hideIf('tags')
                ->sortable(),
            Column::make("Scheduled delete post time", "scheduled_delete_post_time")
                ->hideIf('scheduled_delete_post_time')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
}
