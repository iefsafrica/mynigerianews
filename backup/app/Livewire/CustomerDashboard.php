<?php

namespace App\Livewire;

use Livewire\Component;

class CustomerDashboard extends Component
{
    public $posts,$postsDraft;
    public function mount($posts, $postsDraft) {
        $this->posts = $posts;
        $this->postsDraft = $postsDraft;
    }
    public function placeholder()
    {
        return view('livewire_lazy_load.admin_dashboard');
    }
    public function render()
    {
        return view('livewire.customer-dashboard');
    }
}
