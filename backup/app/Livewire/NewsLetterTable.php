<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subscriber;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BulkMail;
use App\Exports\SubscriberExport;
use Livewire\Livewire;

class NewsLetterTable extends LivewireTableComponent
{
    protected $model = Subscriber::class;
    public int $filterCount = 0;
    public $showButtonOnHeader = true;
    public $buttonComponent = 'news_letter.components.add_button';
    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'sendBulkMail'];
    public function mount()
    {
        $this->filterCount = 0; // Initialize the property
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('created_at', 'desc');

        $this->setColumnSelectStatus(false);

    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton-tow-button');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.emails.email'), "email")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->searchable()
                ->view('news_letter.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }
    public function bulkActions(): array
    {
        // Figure out what actions the admin gets
        return [
            'exportSelected' => __('Export'),
            'bulkMail' => __('Send Mail'),
        ];
    }

    public function exportSelected()
    {
        if (!empty($this->selected)) {
          $data =  Subscriber::whereIn('id', $this->selected)->get();
            $Contact = [];
            foreach ($data as $user) {
                $users = [
                    'email' => $user->email,
                ];
                $Contact[] = $users;
            }
            krsort($Contact);
            $this->clearSelected();
            return Excel::download(new SubscriberExport($Contact), 'Subscriber.csv');
        }
        else{
           $message = __('messages.mails.select_mail');
           $this->dispatch('error', $message);
        }
    }
    public function bulkMail()
    {
        if (!empty($this->selected)) {
            if (count($this->selected)) {
              $data =  Subscriber::whereIn('id', $this->selected)->get()->pluck('email')->toArray();
                $this->dispatch('sendMail', $data);

            } else {
                $message = __('messages.mails.you_can_not_send_more_than_5_mails');
                $this->dispatch('error', $message);
            }
        }
         else {
            $message = __('messages.mails.select_mail');
            $this->dispatch('error', $message);
        }
    }

// public function resetAll()
// {
//     // Reset any properties or data that need to be reset to their initial state
//     $this->selected = [];
//     $this->reset();
// }
    public function sendBulkMail($emailIdArray, $Mail, $mailSubject)
    {
        foreach ($emailIdArray as $email) {
            BulkMail::create([
                'email' => $email,
                'body' => $Mail,
                'subject' => $mailSubject,
            ]);
        }
         $this->clearSelected();
         $this->dispatch('emailSent');

        $this->dispatch('sendMailClose', true);
        $message = __('messages.placeholder.email_send_successfully');
        $this->dispatch('success', $message);
    }
    //news-letter header bulk select with rows bulk
   public function updatedSelected():void
  {
    $this->selectAll = count($this->selected) === Subscriber::count();
  }
}
