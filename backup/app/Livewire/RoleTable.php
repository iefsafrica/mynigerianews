<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RoleTable extends LivewireTableComponent
{
    // protected $model = Role::class;
    public $showButtonOnHeader = true;

    public $buttonComponent = 'roles.components.add-button';

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
            Column::make(__('messages.common.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.count'))
                // ->view('roles.components.user_count')
                // ->sortable()
                // ->searchable(),
                ->label(fn($row) => $row->users->count())
                ->sortable(fn(Builder $query, string $direction) => $query->withCount('users')->orderBy('users_count', $direction))
                ->format(function ($value, $row, Column $column) {
                    return $row->users->count();
                }),
            Column::make(__('messages.role.permissions'), 'id')
                ->view('roles.components.permission')
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('roles.components.action'),
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
        return Role::query();
    }
}
