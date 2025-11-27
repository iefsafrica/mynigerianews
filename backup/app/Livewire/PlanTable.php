<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Plan;

class PlanTable extends LivewireTableComponent
{
    protected $model = Plan::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'plan.components.add-button';

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
            Column::make("Currency id", "currency_id")
                ->searchable()
                ->hideIf('currency_id')
                ->sortable(),
            Column::make(__('messages.plans.price'), "price")
                ->searchable()
                ->view('plan.components.currency')
                ->sortable(),
            Column::make(__('messages.plans.frequency'), "frequency")
                ->searchable()
                ->view('plan.components.frequency')
                ->sortable(),
            Column::make(__('messages.language.is_default'), "is_default")
                ->searchable()
                ->view('plan.components.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->searchable()
                ->view('plan.components.action'),
            Column::make("Trial days", "trial_days")
                ->hideIf('trial_days')
                ->sortable(),
            Column::make("Post count", "post_count")
                ->hideIf('post_count')
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
