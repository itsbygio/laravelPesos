<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use Illuminate\Http\Request;

class productid extends Controller
{
    public function index($titulo)
    {
        $producto = Producto::where('uri_producto', '=', $titulo)->first();
        if (isset($producto)) {

            return view('livewire.productid.index', [
                'producto' => $producto
            ]);
        }
        return redirect('/');

    }
}
