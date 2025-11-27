<?php

namespace App\Livewire;

use App\Models\Gallery;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class GalleryTable extends LivewireTableComponent
{
    protected $model = Gallery::class;
    public $showButtonOnHeader = true;

    public $buttonComponent = 'gallery.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        $this->setColumnSelectStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'width' => '10% ',
                ];
            }
            return [];
        });
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
            Column::make(__('messages.post.image'), 'title')
                ->searchable()
                ->view('gallery.components.gallary_image'),
            Column::make(__('messages.common.title'), "title")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->searchable()
                ->view('gallery.components.language')
                ->sortable(),
            Column::make(__('messages.gallery.album'), "album_id")
                ->searchable()
                ->view('gallery.components.album')
                ->sortable(),
            Column::make(__('messages.post.category'), "category_id")
                ->searchable()
                ->view('gallery.components.post_category')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
            ->view('gallery.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
}
