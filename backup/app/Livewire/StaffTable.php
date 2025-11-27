<?php

namespace App\Livewire;

use App\Models\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StaffTable extends LivewireTableComponent
{
    protected $model = User::class;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'staffs.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        // $this->setColumnSelectStatus(false);
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
            Column::make(__('messages.user.full_name'), "first_name")
                ->view('staffs.components.profile_img')
                ->sortable()
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                }),
            Column::make(__('messages.subscription.current_plan'), 'subscription.plan.name')
                ->view('staffs.components.plan_name')
                ->searchable(),
            Column::make(__('messages.staff.username'), "username")
                ->view('staffs.components.user_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.staff.role'), 'id')
                ->view('staffs.components.role')
                ->searchable()
                ->sortable(),
            Column::make("Last name", "last_name")
                ->hideIf('contact')
                ->sortable(),
            Column::make("Email", "email")
                ->hideIf('email')
                ->sortable(),
            Column::make("Contact", "contact")
                ->hideIf('contact')
                ->sortable(),
            Column::make("Dob", "dob")
                ->hideIf('dob')
                ->sortable(),
            Column::make("Gender", "gender")
                ->hideIf('gender')
                ->sortable(),
            Column::make(__('messages.staff.email_verified'), "email_verified_at")
                ->view('staffs.components.email_verify')
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->view('staffs.components.status')
                ->sortable(),
            Column::make("Language", "language")
                ->hideIf('language')
                ->sortable(),
            Column::make("Dark mode", "dark_mode")
                ->hideIf('dark_mode')
                ->sortable(),
            Column::make("Blood group", "blood_group")
                ->hideIf('blood_group')
                ->sortable(),
            Column::make("Type", "type")
                ->hideIf('type')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('staffs.components.action'),
            Column::make("About us", "about_us")
                ->hideIf('about_us')
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
        // return User::with('roles', 'subscription.plan')->where('type', User::STAFF);
        return User::with('roles', 'subscription.plan')
               ->where('type', User::STAFF)
               ->distinct('users.id');
    }

    public function updateStatus($status, $id)
    {
        $updateStatus = ($status) ? 0 : 1;
        $staff = User::findOrFail($id);
        $staff->update(['status' => $updateStatus]);
        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.status_updated_successfully'));
    }

    public function emailVerified($id)
    {
        $staff = User::findOrFail($id);
        $staff->update(['email_verified_at' => Carbon::now()]);
        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.status_updated_successfully'));
    }
}
