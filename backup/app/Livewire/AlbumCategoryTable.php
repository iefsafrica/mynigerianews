<?php

namespace App\Livewire;


use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AlbumCategory;

class AlbumCategoryTable extends LivewireTableComponent
{
    protected $model = AlbumCategory::class;
    protected $listeners = ['refresh' => '$refresh'];

    public $showButtonOnHeader = true;

    public $buttonComponent = 'album_category.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');
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
                ->sortable()
                ->searchable()
                ->view('album_category.components.name'),
            Column::make(__('messages.gallery.album'), "album_id")
                ->view('album_category.components.album')
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->view('album_category.components.language')
                ->sortable(),
            Column::make(__('messages.common.action'),'id')
            ->view('album_category.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
}
