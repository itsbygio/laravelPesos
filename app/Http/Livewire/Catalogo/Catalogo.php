<?php

namespace App\Http\Livewire\Catalogo;

use Livewire\Component;
use App\Models\Producto;

class Catalogo extends Component
{
    public function render()
    {
        return view('livewire.catalogo.catalogo',[
            'productos'=>Producto::all()
        ]);
    }
}
