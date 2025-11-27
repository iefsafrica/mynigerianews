<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Page;

class PageTable extends LivewireTableComponent
{
    protected $model = Page::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'page.components.add-button';

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
            Column::make(__('messages.common.name'), "name")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.title'), "title")
                ->searchable()
                ->sortable(),
            Column::make("Slug", "slug")
                ->hideIf('slug')
                ->sortable(),
            Column::make("Meta title", "meta_title")
                ->hideIf('meta_title')
                ->sortable(),
            Column::make("Meta description", "meta_description")
                ->hideIf('meta_description')
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->view('page.components.language')
                ->sortable()
                ->searchable(),
            Column::make("Show title", "show_title")
                ->hideIf('show_title')
                ->sortable(),
            Column::make("Show right column", "show_right_column")
                ->hideIf('show_right_column')
                ->sortable(),
            Column::make("Permission", "permission")
                ->hideIf('permission')
                ->sortable(),
            Column::make("Location", "location")
                ->hideIf('location')
                ->sortable(),
            Column::make(__('messages.page.visibility'), "visibility")
                ->view('page.components.visibility')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('page.components.action'),
            Column::make("Show breadcrumb", "show_breadcrumb")
                ->hideIf('show_breadcrumb')
                ->sortable(),
            Column::make("Content", "content")
                ->hideIf('content')
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
