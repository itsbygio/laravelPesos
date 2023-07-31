<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function SaveProducts(Request $request)
    {

    }

    public function SaveProduct(Request $request)
    {

        $archivo = $request->file('file');
        $ext = '.' . $archivo->extension();
        Producto::where('id', $request->id_producto)->update(
            [
                'ext' => $ext,
                'size_image' => $archivo->getSize()

            ]
        );
        //    mkdir(public_path('private/productos/' . $request->id_producto), 0700);
        $archivo->move(public_path('storage/productos'), $request->id_producto . $ext);
    }
    public function UpdateImagesGallery(Request $request)
    {
        $parts = explode(".", $request->name);
        $name = $parts[0];
        
        $gallery = public_path('storage/productos/' . $request->id_producto . '/' . $request->name);
        if (file_exists($gallery)) {
            unlink($gallery);
        }
        if(Gallery::where('id', $name)->count()>0){
             Gallery::where('id', $name)->delete();
             return Gallery::where('id_producto', $request->id_producto)->get();
        }
    }
}
