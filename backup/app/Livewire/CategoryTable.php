<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends LivewireTableComponent
{
    protected $model = Category::class;
    protected $listeners = [
         'refresh' => '$refresh'];
    public $showButtonOnHeader = true;

    public $buttonComponent = 'categories.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setColumnSelectStatus(false);
        // ->setDebugEnabled();
        $this->setQueryStringStatus(false);
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
            ->view('categories.components.profile')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->searchable()
                ->view('categories.components.language')
                ->sortable(),
            Column::make(__('messages.common.count'),'posts_count')
                ->label(fn($row) => $row->posts_count)
                ->sortable(fn(Builder $query, string $direction) => $query->orderBy('posts_count', $direction))
                ->format(function ($value, $row, Column $column) {
                    return $row->posts_count;
                }),
            Column::make(__('messages.category.show_menu'), "show_in_menu")
                ->view('categories.components.show_menu')
                // ->hideIf('show_in')
                ->sortable(),
            Column::make(__('messages.category.show_home'), "show_in_home_page")
                ->view('categories.components.show_home')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('categories.components.action'),
            Column::make("Slug", "slug")
                ->hideIf('id')
                ->sortable(),
            Column::make("Color", "color")
                ->hideIf('id')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
    public function builder(): Builder
    {
        return Category::withCount('posts');
    }

    public function updateShowInMenu($showInMenu, $id)
    {
        $updatedShowInMenu = ($showInMenu) ? 0 : 1;
        $category = Category::findOrFail($id);
        $category->update(['show_in_menu' => $updatedShowInMenu]);

        $this->resetPage();

        $this->dispatch('success', __('messages.placeholder.show_in_menu_updated_successfully'));
    }

    public function updateShowInHome($showInHome, $id)
    {
        $updatedShowInHome = ($showInHome) ? 0 : 1;
        $category = Category::find($id);
        $category->update(['show_in_home_page' => $updatedShowInHome]);

        $this->resetPage();

        $this->dispatch('success', __('messages.placeholder.show_in_home_updated_successfully'));
    }
}
