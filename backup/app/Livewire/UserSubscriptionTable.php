<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subscription;

class UserSubscriptionTable extends LivewireTableComponent
{
    protected $model = Subscription::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf('id')
                ->sortable(),
            Column::make("User id", "user_id")
                ->hideIf('user_id')
                ->sortable(),
            Column::make("Plan Id", "plan_id")
                ->hideIf('plan_id')
                ->sortable(),
            Column::make(__('messages.plans.plan_name'), "plan.name")
                ->searchable()
                ->sortable(),
            Column::make("Transaction id", "transaction_id")
                ->hideIf('transaction_id')
                ->sortable(),
            Column::make(__('messages.subscription.amount'), 'plan_amount')
                ->searchable()
                ->sortable()
                ->view('user_subscription.component.plan_amount'),
            Column::make(__('messages.subscription.subscribed_date'), 'starts_at')
                ->searchable()
                ->sortable()
                ->view('user_subscription.component.subscribe_date'),
            Column::make(__('messages.subscription.expired_date'), 'ends_at')
                ->searchable()
                ->sortable()
                ->view('user_subscription.component.expired_plan_date'),
            Column::make(__('messages.status'), 'status')
                ->sortable()
                ->view('user_subscription.component.status'),
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
        return Subscription::with(['plan'])->where('user_id', getLogInUserId())->latest();
    }
}
