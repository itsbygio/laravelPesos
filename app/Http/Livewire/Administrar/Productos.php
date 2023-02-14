<?php

namespace App\Http\Livewire\Administrar;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;

class Productos extends Component
{
    use WithPagination;
    public $npagination;
    protected $paginationTheme = 'bootstrap';
    public $keyWord;
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public function render()
    {


        $keyWord = '%' . $this->keyWord . '%';

        return view(
            'livewire.administrar.productos',
            [
                'productos' => Producto::Where('sku', 'LIKE', $keyWord)
                    ->orWhere('titulo', 'LIKE', $keyWord)
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->npagination),
                'categorias' => Categoria::all()
            ]
        );
    }
    public function change()
    {
        $this->emit('render');
    }
    public function order($sort)
    {

        
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction ='desc';
            }
        } else {
            $this->sort =$sort;
            $this->direction = 'asc';

        }
          
    }
}
