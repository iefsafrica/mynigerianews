<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Menu;

class MenuTable extends LivewireTableComponent
{
    protected $model = Menu::class;
    public $showButtonOnHeader = true;

    public $buttonComponent = 'menu.components.add-button';


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
            Column::make(__('messages.common.title'), "title")
                ->sortable()
                ->searchable(),
            Column::make("Link", "link")
                ->hideIf('link')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.menu.parent_menu'), "parent_menu_id")
                ->view('menu.components.parent_title')
                ->sortable(),
            Column::make("Order", "order")
                ->hideIf('order')
                ->sortable(),
            Column::make(__('messages.menu.show_in_menu'), "show_in_menu")
                ->view('menu.components.show_menu')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('menu.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }

    public function updateShowInMenu($MenuId)
    {
//         $updatedShowInMenu = ($MenuId) ? 0 : 1;
        $menu = Menu::findOrFail($MenuId);
        $menu->update(['show_in_menu' => !$menu->show_in_menu]);
        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.show_in_menu_updated_successfully'));
    }
}
