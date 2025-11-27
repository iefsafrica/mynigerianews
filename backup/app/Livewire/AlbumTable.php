<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Album;

class AlbumTable extends LivewireTableComponent
{
    protected $model = Album::class;
    protected $listeners = ['refresh' => '$refresh'];
    public $showButtonOnHeader = true;

    public $buttonComponent = 'album.components.add-button';

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
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.count'), "name")
                ->view('album.components.count_image')
                ->searchable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->view('album.components.language')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), "id")
                ->view('album.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
}
