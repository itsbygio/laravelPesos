<?php

namespace App\Http\Livewire\Catalogo;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Catego;
use App\Models\Categoria;
use Livewire\WithPagination;

class Catalogo extends Component
{
    use WithPagination;

    public $keyWord = "";
    protected $paginationTheme = 'bootstrap';
    public $npagination = '8';
    public $CartShop;
    public $total_cart;
    public $id_categoria = null;
    public $cantidades;
    protected $listeners = [
        'GetKeyword' => 'GetKeyword',
        'addCart' => 'addCart'
    ];


    public function render()
    {
        //  $this->CartShop = json_decode( $this->CartShop);
        $data=[];
        $keyWord = '%' . $this->keyWord . '%';
        if(isset($this->id_categoria)){
            $data=[
                'productos' => Producto::Where('id_categoria', '=', $this->id_categoria)
                ->paginate($this->npagination),
                'categorias' => Categoria::all()
            ];
        }
        if(isset($this->keyWord)){
            $data=[
                'productos' => Producto::Where('titulo', 'LIKE', $keyWord)
                ->paginate($this->npagination),
                'categorias' => Categoria::all()
            ];
        }
        
       
            return view('livewire.catalogo.catalogo', $data);
          
    

     
    }
    public function GetKeyword($data)
    {
        $this->id_categoria= null;
        $this->keyWord =$data;

    }
    public function resetAll(){
        $this->id_categoria= null;
        $this->keyWord ="";
    }
    public function searchcategorias($id_categoria)
    {
        $this->keyWord = null;
        $this->id_categoria = $id_categoria;
    }
    public function addCart()
    {
        $data['CartShop'] = $this->CartShop;
        $data['total_cart'] = $this->total_cart;
        $data['cantidades'] = $this->cantidades;
        $this->emit('GetDataCart', $data);
    }
}
