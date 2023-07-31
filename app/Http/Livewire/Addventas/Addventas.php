<?php

namespace App\Http\Livewire\Addventas;



use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Venta;
use Livewire\Component;
use App\Models\Producto;
use Barryvdh\DomPDF\PDF;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class Addventas extends Component
{
    use WithPagination;
    public $npagination='10';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render' => 'render'];
    public $sort = 'id';
    public $direction = 'desc';
    public $codigo;
    public $id_venta;
    public $id_producto;
    public $cant;
    public $keyWord;
    public $precio;
    public $titulo;
    public $ids_venta=array();
    public $id_categoria;
    public $stock;
    public $total;
    public $ventaId;
    public $productos_seleccionados = [];
    public $total_venta;
    public $cantidad_vendida = [];
    public $editingVenta = null;
    public $ventaSeleccionada;
    public $productosVendidos =[];
    
    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        $ventas = Venta::where('codigo', 'LIKE', $keyWord)
        ->orWhere('cant', 'LIKE', $keyWord)
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->npagination);

        $ventas = $ventas->map(function ($venta) {
            $productos_vendidos = json_decode($venta->cant, true);
            usort($productos_vendidos, function ($a, $b) {
                return $a['id_producto'] <=> $b['id_producto'];
            });
            $venta->productos_vendidos = $productos_vendidos;
            return $venta;
        });
        return view('livewire.addventas.addventas', [
         

            'ventas' => Venta::Where('codigo', 'LIKE', $keyWord)
                    ->orWhere('cant', 'LIKE', $keyWord)
                    ->orderBy($this->sort, $this->direction)
                    ->paginate($this->npagination),
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
                    'categorias' => Categoria::all(),
                    
                
        ]);
        $ventas = $ventas->map(function ($venta) {
            $productos_vendidos = json_decode($venta->cant, true);
            usort($productos_vendidos, function ($a, $b) {
                return $a['id_producto'] <=> $b['id_producto'];
                return $a['titulo'] <=> $b['titulo'];
                return $a['cantidad_vendida'] <=> $b['cantidad_vendida'];
                return $a['precio'] <=> $b['precio'];
                return $a['total'] <=> $b['total'];

            });
            $venta->productos_vendidos = $productos_vendidos;
            return $venta;
        });
    
         
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
    public function rules()
{
    return [
        'productos_seleccionados' => 'required|array',
        'cantidad_vendida' => 'required|array',
        'productos_seleccionados.*' => 'exists:productos,id',
        'cantidad_vendida.*' => 'integer|min:1',
    ];
}

public function store()
{
    $this->validate();
    $productos_seleccionados = $this->productos_seleccionados;
    $cantidad_vendida = $this->cantidad_vendida;
    $productos = Producto::whereIn('id', $productos_seleccionados)->get();
    $total_venta = 0;
    $productos_vendidos = [];
    $ventaExitosa = true; // Variable para rastrear si la venta se realizó correctamente

    foreach ($productos as $producto) {
        $cantidad = $cantidad_vendida[$producto->id] ?? 0;
        if ($cantidad > 0) {
            if ($cantidad <= $producto->stock) {
                $producto->stock -= $cantidad;
                $producto->save();

                $total_producto = $cantidad * $producto->precio;
                $total_venta += $total_producto;

                $productos_vendidos[] = [
                    'id_producto' => $producto->id,
                    'precio' => $producto->precio,
                    'titulo' => $producto->titulo,
                    'cantidad_vendida' => $cantidad,
                    'total' => $total_producto,
                ];
            } else {
                $ventaExitosa = false; // La venta no se puede realizar completamente
                $this->emit('errorVenta');
            }
        }
    }
    if ($ventaExitosa) {
        Venta::create([
            'cant' => json_encode($productos_vendidos, true),
            'total' => $total_venta,
            'codigo' => Str::random(10)
        ]);

        $this->productos_seleccionados = [];
        $this->cantidad_vendida = [];
        $this->total_venta = $total_venta;

        $this->emit('storeventa');
    }
}


    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        if (!$venta) {
            return redirect()->back()->with('error', 'La venta no existe.');
        }
    
        $productos_vendidos = json_decode($venta->cant, true);
        if (!$productos_vendidos) {
            $productos_vendidos = [];
        }
    
        $this->id_venta = $id;
        $this->editingVenta = $venta;
    
        // Restablecer las variables a un estado inicial
        $this->productos_seleccionados = [];
        $this->cantidad_vendida = [];
    
        // Verificar si $productos_vendidos no es nulo ni vacío antes de iterar sobre él
        if (!empty($productos_vendidos)) {
            foreach ($productos_vendidos as $producto_vendido) {
                $this->productos_seleccionados[] = $producto_vendido['id_producto'];
                $this->cantidad_vendida[$producto_vendido['id_producto']] = $producto_vendido['cantidad_vendida'];
            }
        }
    }
   
    public function update()
{
    if ($this->editingVenta) {
        $this->validate([
            'productos_seleccionados' => 'required|array',
            'cantidad_vendida' => 'required|array',
            'productos_seleccionados.*' => 'exists:productos,id',
            'cantidad_vendida.*' => 'integer|min:1',
        ]);

        // Obtener los productos vendidos actuales antes de cualquier modificación
        $productos_vendidos_actual = json_decode($this->editingVenta->cant, true);

        // Verificar si no hay cambios en la edición
        if ($productos_vendidos_actual === $this->getProductosVendidosSeleccionados()) {
            // No hay cambios, no se realiza ninguna acción
            return;
        }

        // Obtener productos nuevos y validar el stock
        $productos_vendidos_nuevos = $this->getProductosVendidosSeleccionados();
        $validacion_exitosa = true;

        foreach ($productos_vendidos_nuevos as $producto_vendido) {
            $producto = Producto::find($producto_vendido['id_producto']);
            $cantidad_existente = $this->getCantidadExistente($productos_vendidos_actual, $producto_vendido['id_producto']);
            $stock_disponible = $producto->stock + $cantidad_existente;

            if ($producto_vendido['cantidad_vendida'] > $stock_disponible) {
                $validacion_exitosa = false;
                break;
            }
        }

        if (!$validacion_exitosa) {
            $this->emit('errorVenta');
            return;
        }

        // Restaurar stock de productos vendidos anteriores
        foreach ($productos_vendidos_actual as $producto_vendido) {
            $producto = Producto::find($producto_vendido['id_producto']);
            $producto->stock += $producto_vendido['cantidad_vendida'];
            $producto->save();
        }

        // Actualizar los productos vendidos nuevos y stock
        foreach ($productos_vendidos_nuevos as $producto_vendido) {
            $producto = Producto::find($producto_vendido['id_producto']);
            $producto->stock -= $producto_vendido['cantidad_vendida'];
            $producto->save();
        }

        // Actualizar los productos vendidos de la venta
        $productos_vendidos_actualizados = [];
        foreach ($productos_vendidos_nuevos as $producto_vendido) {
            $producto = Producto::find($producto_vendido['id_producto']);
            $producto_vendido['titulo'] = $producto->titulo;
            $producto_vendido['precio'] = $producto->precio;
            $producto_vendido['total'] = $producto_vendido['cantidad_vendida'] * $producto->precio;
            $productos_vendidos_actualizados[] = $producto_vendido;
        }

        $this->editingVenta->cant = json_encode($productos_vendidos_actualizados);

        // Calcular el nuevo total de la venta
        $total_venta_nuevo = 0;
        foreach ($productos_vendidos_actualizados as $producto_vendido) {
            $total_venta_nuevo += $producto_vendido['total'];
        }

        // Actualizar el total de la venta
        $this->editingVenta->total = $total_venta_nuevo;

        $this->editingVenta->save();

        // Limpiar los campos de edición
        $this->productos_seleccionados = [];
        $this->cantidad_vendida = [];

        $this->emit('update');
    }
}

    private function getCantidadExistente($productos_vendidos_actual, $id_producto)
    {
        foreach ($productos_vendidos_actual as $producto_vendido) {
            if ($producto_vendido['id_producto'] == $id_producto) {
                return $producto_vendido['cantidad_vendida'];
            }
        }
    
        return 0;
    }
    private function getProductoVendidoActual($productos_vendidos_actual, $id_producto)
    {
        foreach ($productos_vendidos_actual as &$producto_vendido) {
            if ($producto_vendido['id_producto'] == $id_producto) {
                return $producto_vendido;
            }
        }
    
        return null;
    }
    
    private function getProductosVendidosSeleccionados()
    {
        $productos_vendidos = [];
        foreach ($this->productos_seleccionados as $id_producto) {
            $cantidad = $this->cantidad_vendida[$id_producto] ?? 0;
            if ($cantidad > 0) {
                $productos_vendidos[] = [
                    'id_producto' => $id_producto,
                    'cantidad_vendida' => $cantidad,
                    
                ];
            }
        }
        return $productos_vendidos;
    }    
    
    public function destroy()
  {
    
            Venta::where('id', $this->id_venta)->delete();
            $this->emit('delete');
        
        
  }
  public function ChangeId($id)
  {
      $this->id_venta = $id;
  }

  public function checkbox($id)
  {


      $clave = array_search($id, $this->id_venta);
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
  public function showVenta($id)
  {
      $venta = Venta::findOrFail($id);
  
      if ($venta) {
        
          $this->productosVendidos = json_decode($venta->cant, true);
          $this->ventaId = $venta->id; 
          $this->total = $venta->total;
          $this->codigo = $venta->codigo;
          
      } else {
          // Manejar el caso cuando no se encuentra la venta
      }
  }
  
  public function generarFacturaPdf($id)
  {
      $options =new Options();
      $options->set('isRemoteEnabled',TRUE);
      $dompdf = new Dompdf($options);
  
      // Obtener los datos de la venta
      $venta = Venta::findOrFail($id);
      $codigo = $venta->codigo;
      $productosVendidos = json_decode($venta->cant, true);
      $total = 0;
      foreach ($productosVendidos as $producto) {
          $total += $producto['total'];
        
      }
      // Generar contenido HTML del PDF
      $html = '<html><body>';
      $html .= '<img src="https://scontent.fbga1-4.fna.fbcdn.net/v/t39.30808-6/348464933_633824211983825_3100278064668542508_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHf9spTcxNq6TbSL3WWZIfMKT5iac84kUwpPmJpzziRTETUeiCYvUwJKPWS3q_ARaeAz6hPvj5k4Vm6xlpBAD1D&_nc_ohc=Tg5Cn68BwtMAX9Y2YTd&_nc_ht=scontent.fbga1-4.fna&oh=00_AfDXXPnoG9KXWz2Q9kkyJ3sDint8rgTPare8uQHKKdt8Eg&oe=646CAE58" width="400" height="200">';
      $html .= '<h1>Sercolf</h1>';
      $html .= '<h3>Factura:'.$codigo.'</h3>';
      $html .= '<h4>Nit:109219466</h4>';
      $html .= '<h4>Direccion: Vereda Laureles via principal</h4>';
      $html .= '<p></p>';
      
      // Mostrar los datos de los productos vendidos en la tabla
      $html .= '<table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-bottom: 20px;">';
      $html .= '<thead>';
      $html .= '<tr>';
      $html .= '<th style="border-bottom: 2px solid #dee2e6; padding: 10px; background-color: #f8f9fa; text-align: left;">Producto</th>';
      $html .= '<th style="border-bottom: 2px solid #dee2e6; padding: 10px; background-color: #f8f9fa; text-align: left;">Cantidad</th>';
      $html .= '<th style="border-bottom: 2px solid #dee2e6; padding: 10px; background-color: #f8f9fa; text-align: left;">Precio unitario</th>';
      $html .= '<th style="border-bottom: 2px solid #dee2e6; padding: 10px; background-color: #f8f9fa; text-align: left;">Total</th>';
      $html .= '</tr>';
      $html .= '</thead>';
      $html .= '<tbody>';
      foreach ($productosVendidos as $producto) {
          $html .= '<tr>';
          $html .= '<td style="border-bottom: 1px solid #dee2e6; padding: 10px;">'. $producto['titulo'] . '</td>';
          $html .= '<td style="border-bottom: 1px solid #dee2e6; padding: 10px;">'. $producto['cantidad_vendida'] . '</td>';
          $html .= '<td style="border-bottom: 1px solid #dee2e6; padding: 10px;">'. number_format($producto['precio'], 0, '.')  . '</td>';
          $html .= '<td style="border-bottom: 1px solid #dee2e6; padding: 10px;">'. number_format($producto['precio'], 0, '.')  . '</td>';
          $html .= '</tr>';
      }
      $html .= '</tbody>';
      $html .= '<tfoot>';
      $html .= '<tr>';
      $html .= '<td></td><td></td>';
      $html .= '<td style="font-weight: bold; text-align: right;">Total:</td>';
      $html .= '<td style="border-top: 2px solid #dee2e6; padding: 10px; font-weight: bold;">'.number_format($total, 0, '.') .'</td>';
      $html .= '</tr>';
      $html .= '</tfoot>';
      $html .= '</table>';
      
      $html .= '</body></html>';
  
      // Cargar el contenido HTML en Dompdf
      $dompdf->loadHtml($html);
  
      // Renderizar el PDF
      $dompdf->render();
  
      // Generar el archivo PDF y guardarlo en una ubicación específica
      $nombreArchivo = 'factura '.$codigo.'.pdf';
      $rutaArchivo = public_path('pdf/' . $nombreArchivo);
      file_put_contents($rutaArchivo, $dompdf->output());
  
      // Descargar el archivo PDF
      return response()->download($rutaArchivo);
  }
  
  
 
public function getVentaSeleccionada()
{
    return $this->ventaSeleccionada;
}
  
 

}
