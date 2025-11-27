<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SubCategory;

class SubCategoryTable extends LivewireTableComponent
{
    protected $model = SubCategory::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'sub_category.components.add-button';

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
            Column::make(__('messages.menu.parent_menu'), "parent_category_id")
                ->searchable()
                ->view('sub_category.components.category_name')
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->searchable()
                ->view('sub_category.components.language')
                ->sortable(),
            Column::make(__('messages.menu.show_in_menu'), "show_in_menu")
                ->view('sub_category.components.show_menu')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
            ->view('sub_category.components.action'),
            Column::make("Slug", "slug")
                ->hideIf('slug')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }

    public function updateShowInMenu($showInMenu, $id)
    {
        $updatedShowInMenu = ($showInMenu) ? 0 : 1;
        $category = SubCategory::findOrFail($id);
        $category->update(['show_in_menu' => $updatedShowInMenu]);

        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.show_in_menu_updated_successfully'));
    }
}
