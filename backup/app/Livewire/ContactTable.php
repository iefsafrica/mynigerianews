<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ContactTable extends LivewireTableComponent
{
    protected $model = Contact::class;
    protected $listeners = ['refresh' => '$refresh', 'resetPage'];
    public $buttonComponent = 'contact.components.export';
    public $filters = [];
    public array $selected = [];
    public function bulkActions(): array
    {
        // Figure out what actions the admin gets
        return [
            'exportSelected' => __('Export'),
        ];
    }
    public $showButtonOnHeader = true;
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
            Column::make(__('messages.user.full_name'), "name")
                ->searchable()
                ->searchable()
                ->sortable(),
            Column::make(__('messages.emails.email'), "email")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.phone'), "phone")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('contact.components.action'),
            Column::make("Message", "message")
                ->hideIf('message')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
    public function exportSelected()
    {
        if (!empty($this->selected)) {
          $data = Contact::whereIn('id', $this->selected)->get();
            $Contact = [];
            foreach ($data as $user) {
                $users = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ];
                $Contact[] = $users;
            }
            $this->selected = [];
            $this->resetSelectAll();
            return Excel::download(new ContactExport($Contact), 'Contact.csv');
        }

        $message = __('messages.post.select_contact');

        $this->dispatch('error', $message);
    }
    public function updatedSelected():void
    {
        $this->selectAll = count($this->selected) === Contact::count();
    }
    public function resetSelectAll()
    {
        $this->selectAll = false;
    }

}
