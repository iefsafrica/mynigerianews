<?php

namespace App\Livewire;

use Livewire\Component;

class PostComponent extends Component
{
    public $subCategories,$categories;
    public function mount($subCategories, $categories) {
        $this->subCategories = $subCategories;
        $this->categories = $categories;
    }

    public function placeholder()
    {
        return view('livewire_lazy_load.listing-skeleton-selector');
    }

    public function render()
    {
        return view('livewire.post-component');
    }
}
