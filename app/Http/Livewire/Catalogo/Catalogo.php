<?php

namespace App\Http\Livewire\Catalogo;

use Livewire\Component;
use App\Models\Producto;

class Catalogo extends Component
{
    public $keyWord;
    protected $paginationTheme = 'bootstrap';
    public $npagination;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return view('livewire.catalogo.catalogo', [
            'productos' => Producto::Where('precio', 'LIKE', $keyWord)
                ->orWhere('titulo', 'LIKE', $keyWord)
                ->paginate($this->npagination),

        ]);
    }
    public function addcart(){

    }
}
