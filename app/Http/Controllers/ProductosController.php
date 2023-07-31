<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Gallery;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductosController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view(
            'productos.index',
            ['categorias' => categoria::all()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear', [
            'categorias' => Categoria::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'titulo' => ['required','unique:productos'],
            'precio' => 'numeric',
            'sku' => ['alpha_num', 'unique:productos'],


        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }


        $producto = Producto::create(
            [
                'titulo' => $request->titulo,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'id_categoria' => $request->id_categoria,
                'sku' => $request->sku,
                'uri_producto'=>str_replace(' ', '-',$request->titulo),
                'ext' => NULL
            ]
        );

        return response($producto);
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = producto::findOrfail($id);
        // $gallery= scandir(public_path('private/productos/'.$id));
        //unset($gallery[0],$gallery[1]);
        return [
            'categoria' => $producto->categoria,
            'producto' => $producto,
           
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => ['required',Rule::unique('productos')->ignore($request->titulo,'titulo')],
            'precio' => 'numeric',
            'sku' => ['alpha_num', Rule::unique('productos')->ignore($request->sku,'sku')],
            'stock' => 'numeric',


        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
            
        //Producto::where('id', $request->id)->update($request->all());
        $producto = Producto::findOrfail($request->id);
        $producto->uri_producto= str_replace(' ', '-',$request->titulo);

        $producto->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $producto = Producto::findOrfail($id);

        $file_product = public_path('storage/productos/' . $producto->id . $producto->ext);
        $gallery = public_path('storage/productos/' . $producto->id);

        if (file_exists($gallery)) {
            $this->DeleteDirectory($gallery);
        }

        if (file_exists($file_product)) {
            unlink($file_product);
        }

        $producto->delete();
    }

    public function DeleteDirectory($gallery)
    {
        $files = glob($gallery . '/*'); //obtenemos todos los nombres de los ficheros
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file); //elimino el fichero
        }
        rmdir($gallery);
    }
}
