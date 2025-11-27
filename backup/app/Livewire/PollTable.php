<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Poll;

class PollTable extends LivewireTableComponent
{
    protected $model = Poll::class;
    public $showButtonOnHeader = true;

    public $buttonComponent = 'polls.components.add-button';

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
            Column::make(__('messages.poll.question'), "question")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.language'), "lang_id")
                ->view('polls.components.language')
                ->searchable()
                ->sortable(),
            Column::make("Option1", "option1")
                ->hideIf('option1')
                ->sortable(),
            Column::make("Option2", "option2")
                ->hideIf('option2')
                ->sortable(),
            Column::make("Option3", "option3")
                ->hideIf('option3')
                ->sortable(),
            Column::make("Option4", "option4")
                ->hideIf('option4')
                ->sortable(),
            Column::make("Option5", "option5")
                ->hideIf('option5')
                ->sortable(),
            Column::make("Option6", "option6")
                ->hideIf('option6')
                ->sortable(),
            Column::make("Option7", "option7")
                ->hideIf('option7')
                ->sortable(),
            Column::make("Option8", "option8")
                ->hideIf('option8')
                ->sortable(),
            Column::make("Option9", "option9")
                ->hideIf('option9')
                ->sortable(),
            Column::make("Option10", "option10")
                ->hideIf('option10')
                ->sortable(),
            Column::make(__('messages.status'), "status")
                ->view('polls.components.status')
                ->sortable(),
            Column::make(__('messages.common.result'), 'id')
                ->view('polls.components.result'),
            Column::make(__('messages.common.action'), 'id')
                ->view('polls.components.action'),
            Column::make("Vote permission", "vote_permission")
                ->hideIf('vote_permission')
                ->sortable(),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }

    public function updateStatus($status, $id)
    {
        $updatedStatus = ($status) ? 0 : 1;
        $poll = Poll::findOrFail($id);
        $poll->update(['status' => $updatedStatus]);

        $this->resetPage();
        $this->dispatch('success', __('messages.placeholder.status_updated_successfully'));
    }
}
