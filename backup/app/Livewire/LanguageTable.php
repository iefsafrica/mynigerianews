<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Language;

class LanguageTable extends LivewireTableComponent
{
    protected $model = Language::class;
    public $showButtonOnHeader = true;

    public $buttonComponent = 'languages.components.add-button';

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
            Column::make(__('messages.language.iso_code'), "iso_code")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.language.front_language'), "front_language_status")
                ->searchable()
                ->view('languages.components.language_status')
                ->sortable(),
            Column::make(__('messages.language.translation'),'id')
                ->view('languages.components.translation'),
            Column::make(__('messages.common.action'), 'id')
                ->view('languages.components.action'),
            Column::make("Created at", "created_at")
                ->hideIf('created_at')
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf('updated_at')
                ->sortable(),
        ];
    }

    public function updateLanguageStatus($postId)
    {
        $language = Language::findOrFail($postId);
        if ($language->iso_code === 'en') {
         // English language should always have front_language_status as true
         $language->update(['front_language_status' => true]);
         $message = __('messages.english_is_default');
         $this->dispatch('error', $message);
         return;
     }
        $language->update([
            'front_language_status' => !$language->front_language_status,
        ]);
        $message = $language->front_language_status ? __('messages.placeholder.language_added_to_front_successfully') : __('messages.placeholder.language_removed_from_front_successfully');

        $this->dispatch('success', $message);
    }
}
