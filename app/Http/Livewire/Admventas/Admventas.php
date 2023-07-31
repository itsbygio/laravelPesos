<?php

namespace App\Http\Livewire\Admventas;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Venta;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
class Admventas extends Component
{
    use WithPagination;
    public $npagination='10';
    protected $paginationTheme = 'bootstrap';
    public $keyWord;
    public $sku;
    public $precio;
    public $id_producto;
    public $titulo;
    public $id_categoria;
    public $categoria;
    public $size_image;
    public $stock;
    public $codigo;
    public $cant;
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public $productos_seleccionados = [];
    public $cantidad_Vendida = [];

    public function render()
    
    {
          $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.admventas.admventas',[

            'ventas' => Venta::Where('codigo', 'LIKE', $keyWord)
                    ->orWhere('cant', 'LIKE', $keyWord)
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->npagination),
                    'productos' => Producto::all(),
                    'categorias' => Categoria::all(),
                
        ]);
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
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function store(){
       
        $this->emit('store');
        $productos_vendidos = [];
        foreach ($this->productos_seleccionados as $id_producto) {
            $cantidad_vendida = $this->cantidades_vendidas[$id_producto] ?? 0;
            if ($cantidad_vendida > 0) {
                $producto = Producto::find($id_producto);
                $productos_vendidos[] = [
                    'id_producto' => $id_producto,
                    'precio' => $producto->precio,
                    'cantidad_vendida' => $cantidad_vendida,
                    'precio' => $producto->precio,
                    'subtotal' => $cantidad_vendida * $producto->precio
                ];
            }
        }

        Venta::create([
            'cant'=> $productos_vendidos
        ]);
       
    }

 public function hola(){
    dd("hola");
 }
}
