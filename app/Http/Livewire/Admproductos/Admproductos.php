<?php

namespace App\Http\Livewire\Admproductos;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\ProductosExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Admproductos extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $npagination='10';
    protected $paginationTheme = 'bootstrap';
    public $id_producto;
    public $keyWord;
    public $sku;
    public $precio;
    public $uri_producto;
    public $titulo;
    public $id_categoria;
    public $categoria;
    public $size_image;
    public $stock;
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public $ids=array();
    public $producto;
    public $urlImagen;
   
    public function render()
    {
        if( Auth::user()->rol=='SuperAdmin' || Auth::user()->rol=='Admin'){
            
      
        $keyWord = '%' . $this->keyWord . '%';
     
        return view('livewire.admproductos.admproductos',[

            'productos' => Producto::Where('sku', 'LIKE', $keyWord)
                    ->orWhere('titulo', 'LIKE', $keyWord)
                    ->orWhere('stock', 'LIKE', $keyWord)
                    ->orWhere('precio', 'LIKE', $keyWord)
                    ->orWhere('id_categoria', 'LIKE', $keyWord)
                    ->orWhere('created_at', 'LIKE', $keyWord)
                    ->orWhere('updated_at', 'LIKE', $keyWord)
                    ->orWhere('size_image', 'LIKE', $keyWord)
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->npagination),
                'categorias' => Categoria::all()
        ]);
      }

      else {
        // El usuario autenticado no tiene permiso para acceder a la lista de usuarios.
        abort(403);
    }
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

        $validatedData = $this->validate([

            'sku'=>'required',
            'id_categoria'=>'required',
            'titulo'=>'required',
            'stock'=>'required',
            'precio'=>'required',
            'size_image'=>'required|image|max:1024'
        ]);
        $filename = $this->size_image->getClientOriginalName();
        $this->size_image->storePubliclyAs('productos', $filename, 'public');
        $validatedData['size_image'] = '' . $filename;
        Producto::create($validatedData);
        $this->resetInput();
        $this->emit('store');
    }
    public function edit($id)
{
    
    $this->id_producto=$id;
    $producto = Producto::find($id);
    if (!$producto) {
        abort(404);
    }
    $this->sku= $producto->sku;
    $this->id_categoria= $producto->id_categoria;
    $this->titulo= $producto->titulo;
    $this->stock= $producto->stock;
    $this->precio= $producto->precio;
    if ($producto->size_image) {
        $this->size_image = $producto->size_image;
        $this->urlImagen = asset('productos/' . $this->size_image);
    }
    $this->ChangeId($id);
}
public function editImage($id){
    $producto = Producto::find($id);
    if ($producto->size_image) {
        $this->size_image = $producto->size_image;
        $this->urlImagen = asset('productos/' . $this->size_image);
    }
    $this->ChangeId($id);
}

  public function update(){

    $validatedData= $this->validate([

        'sku'=>'required',
        'id_categoria'=>'required',
        'titulo'=>'required',
        'stock'=>'required',
        'precio'=>'required',
       
    ]);
  
    Producto::where('id',  $this->id_producto)->update($validatedData);
    
    $this->emit('update');
  }
  public function updateImage(){

    $validatedData= $this->validate([
        'size_image'=>'required|image|max:1024'
    ]);
    $filename = $this->size_image->getClientOriginalName();
    $this->size_image->storePubliclyAs('productos', $filename, 'public');
       $validatedData['size_image'] = '' . $filename;
       Producto::where('id',  $this->id_producto)->update($validatedData);
       $this->emit('updateImage');
     
  }
  public function getThumbnail($filename)
{
    return '/storage/thumbnails/' . $filename;
}
  public function resetInput()
  {
      $this->sku = null;
      $this->id_categoria = null;
      $this->titulo = null;
      $this->stock = null;
      $this->precio = null;
      $this->titulo = null;
      $this->titulo = null;
      $this->size_image = null;
  }
  public function cancel()
  {

      $this->resetInput();
  }
  public function destroy($option = '')
  {
    
    if ($option == "MultipleDelete") {
        Producto::destroy($this->ids);
        $this->ids = array();
        $this->emit('MultipleDelete');
    } else {
        Producto::destroy($this->id_producto);
        $this->emit('delete');
        $clave = array_search($this->id_producto, $this->ids);
        if ($clave !== false) {
            unset($this->ids[$clave]);
        }
    } 
        
        
  }
  public function ChangeId($id)
  {
      $this->id_producto = $id;
  }
  public function checkbox($id)
  {


      $clave = array_search($id, $this->id_producto);
      if ($clave !== false) {
          unset($this->id[$clave]);
      } else {
          array_push($this->id, $id);
      }
      $this->StatusButtonTrash();
  }
  public function StatusButtonTrash()
  {
      if (count($this->id) > 0) {
          $this->emit('VisibilityMultipleButtonTrash', true);
      } else {
          $this->emit('VisibilityMultipleButtonTrash', false);
      }
  }
  public function exportToExcel()
  {
      return Excel::download(new ProductosExport, 'productos.xlsx');
  }

}
