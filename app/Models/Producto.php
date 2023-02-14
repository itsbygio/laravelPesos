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
        'descripcion',
        'referencias',
        'precio',
        'ext',
        'size_image',
        'created_at',
        'updated_at',
    ];
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria','id_categoria','id');
    }
}
