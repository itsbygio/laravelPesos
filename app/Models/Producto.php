<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table='productos';
 
     protected $fillable = [
        'id',
        'sku',
        'id_categoria',
        'titulo',
        'stock',
        'referencias',
        'precio',
        'ext',
        'size_image',
        'uri_producto',
        'created_at',
        'updated_at',
    ];
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria','id_categoria','id');
    }
   
    
    
}
