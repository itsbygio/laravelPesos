<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'codigo',
        'id_categoria',
        'id_producto',
        'cant',
        'total',
        'created_at',
        'updated_at',
    ];
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria','id_categoria','id');
    }
    public function producto(){
        return $this->belongsTo('App\Models\Producto','id_producto','id');
    }
 
}
