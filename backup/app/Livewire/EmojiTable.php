<?php

namespace App\Livewire;

use App\Models\Emoji;
use App\Livewire\LivewireTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EmojiTable extends LivewireTableComponent
{
    // //public $search = '';

    protected $model = Emoji::class;
    public $orderBy = 'desc';  // default

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public string $tableName = 'emoji';

    // // public string $pageName = 'emoji';
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');
    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton-no-button');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.emoji.emoji'), 'emoji')
            ->format(function ($value) {
                    return html_entity_decode($value);
                }),
            Column::make(__('messages.status'), 'status')
            ->view('emojis.components.status')
                ->sortable(),
           Column::make(__('messages.common.action'), 'id')
           ->hideIf('id'),

        ];
    }

//     public function query()
//     {
//         return Emoji::query();
//     }

//     public function rowView(): string
//     {
//         return 'livewire-tables.rows.emoji_table';
//     }

//     public function render()
//     {
//         return view('livewire-tables::' . config('livewire-tables.theme') . '.datatable')
//             ->with([
//                 'columns' => $this->columns(),
//                 'rowView' => $this->rowView(),
//                 'filtersView' => $this->filtersView(),
//                 'customFilters' => $this->filters(),
//                 'rows' => $this->rows,
//                 'modalsView' => $this->modalsView(),
//                 'bulkActions' => $this->bulkActions,
//                 //                'componentName' => 'emojis.add-button',
//             ]);
//     }

}
