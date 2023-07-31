<?php

namespace App\Http\Livewire\Catalogo;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $keyWord = "";
    protected $paginationTheme = 'bootstrap';
    public $npagination = '8';
    public $CartShop;
    public $total_cart;
    public $id_categoria = null;
    public $category;
    public $ruta_relativa;
    public $cantidades;
    protected $listeners = [
        'GetKeyword' => 'GetKeyword',
        'addCart' => 'addCart'
    ];
    
    public function __construct()
    {
        $this->ruta_relativa = trim($_SERVER['REQUEST_URI'], '/');
        $this->category=  Categoria::where('titulo', $this->ruta_relativa)->first();
    }


    public function render()
    {
        //  $this->CartShop = json_decode( $this->CartShop);
            if (isset($this->category)){
                $data = [];
                $keyWord = '%' . $this->keyWord . '%';
                $productos = Producto::where('titulo','LIKE',$keyWord)->where('id_categoria',$this->category->id);
                $data = [
                    'productos' => $productos->paginate($this->npagination),
                    'categorias' => Categoria::all(),
                ];
                 
                return view('livewire.catalogo.categorias', $data);
            }
            abort("404");
           
     
       
    }
    public function GetKeyword($data)
    {
        $this->id_categoria = null;
        $this->keyWord = $data;
    }
    public function resetAll()
    {
        $this->id_categoria = null;
        $this->keyWord = "";
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
