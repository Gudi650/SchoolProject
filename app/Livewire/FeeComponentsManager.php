<?php

namespace App\Livewire;

use Livewire\Component;

class FeeComponentsManager extends Component
{
    public $type = 'all'; // 'all' or 'specific'
    public $components = [];
    private $counter = 0;

    public function mount($type = 'all')
    {
        $this->type = $type;
        $this->components = [];
    }

    public function addComponent()
    {
        $this->components[] = [
            'id' => $this->counter++,
            'name' => '',
            'amount' => ''
        ];
    }

    public function removeComponent($id)
    {
        $this->components = array_filter($this->components, fn($comp) => $comp['id'] !== $id);
        $this->components = array_values($this->components);
    }

    public function render()
    {
        return view('livewire.fee-components-manager');
    }
}
