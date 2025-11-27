<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder;

class CashPaymentTable extends LivewireTableComponent
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
                ->view('cash_payment.components.user_name')
                ->sortable()
                ->searchable(function (Builder $query, $value) {
                    return $query->whereHas('user', function ($q) use ($value) {
                        $q->where('first_name', 'like', '%' . $value . '%');
                    });
                }),
            Column::make(__('messages.subscription.plan_name'), "plan_id")
                ->searchable()
                ->view('cash_payment.components.plan_name')
                ->sortable(),
            Column::make("Transaction id", "transaction_id")
                ->hideIf('transaction_id')
                ->sortable(),
            Column::make(__('messages.subscription.plan_price'), "plan_amount")
                ->searchable()
                ->view('cash_payment.components.plan_amount')
                ->sortable(),
            Column::make(__('messages.subscription.payable_amount'), "payable_amount")
                ->searchable()
                ->view('cash_payment.components.payable_amount')
                ->sortable(),
            Column::make("Plan frequency", "plan_frequency")
                ->hideIf('plan_frequency')
                ->sortable(),
            Column::make(__('messages.subscription.start_date'), "starts_at")
                ->searchable()
                ->view('cash_payment.components.start_date')
                ->sortable(),
            Column::make(__('messages.subscription.end_date'), "ends_at")
                ->searchable()
                ->view('cash_payment.components.end_date')
                ->sortable(),
            Column::make(__('messages.attachment'), 'id')
                ->searchable()
                ->view('cash_payment.components.attachment'),
            Column::make("Trial ends at", "trial_ends_at")
                ->hideIf('trial_ends_at')
                ->sortable(),
            Column::make("No of post", "no_of_post")
                ->hideIf('no_of_post')
                ->sortable(),
            Column::make(__('messages.notes'), "notes")
                ->searchable()
                ->view('cash_payment.components.notes')
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->searchable()
                ->view('cash_payment.components.payment_status')
                ->sortable(),
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
