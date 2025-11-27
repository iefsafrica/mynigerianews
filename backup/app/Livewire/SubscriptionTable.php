<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Subscription;

class SubscriptionTable extends LivewireTableComponent
{
    protected $model = Subscription::class;
    public $showButtonOnHeader = false;


    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        $this->setColumnSelectStatus(false);
    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton-no-button');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.user.full_name'), "user_id")
                ->view('subscription.components.user_name')
                ->sortable()
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                }),
            Column::make(__('messages.user_name'), 'user.last_name')
                ->hideIf(1),
            Column::make(__('messages.subscription.plan_name'), "plan_id")
                ->view('subscription.components.plan_name')
                ->sortable()
                ->searchable(),
            Column::make("Transaction id", "transaction_id")
                ->hideIf('transaction_id')
                ->sortable(),
            Column::make("Plan amount", "plan_amount")
                ->hideIf('plan_amount')
                ->sortable(),
            Column::make("Payable amount", "payable_amount")
                ->hideIf('payable_amount')
                ->sortable(),
            Column::make("Plan frequency", "plan_frequency")
                ->hideIf('plan_frequency')
                ->sortable(),
            Column::make(__('messages.subscription.start_date'), "starts_at")
                ->view('subscription.components.start_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.subscription.end_date'), "ends_at")
                ->view('subscription.components.end_date')
                ->sortable()
                ->searchable(),
            Column::make("Trial ends at", "trial_ends_at")
                ->hideIf('trial_ends_at')
                ->sortable(),
            Column::make("No of post", "no_of_post")
                ->hideIf('no_of_post')
                ->sortable(),
            Column::make("Notes", "notes")
                ->hideIf('notes')
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->view('subscription.components.status')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'),'id')
                ->view('subscription.components.action'),
            Column::make("Payment type", "payment_type")
                ->hideIf('payment_type')
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
