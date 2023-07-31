<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class Seatch extends Component
{
    public $keyWord;
    
    public function render()
    {
        $this->emit('GetKeyword', $this->keyWord);

        return view('livewire.menu.seatch');

    }
}
