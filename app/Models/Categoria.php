<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    protected $fillable = [
        'id',
        'titulo',
        'created_at',
        'updated_at',
    ];
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'id_categoria', 'id');
    }
}
