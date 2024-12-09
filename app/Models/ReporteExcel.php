<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteExcel extends Model
{
    use HasFactory;

    protected $table = 'reportesexcel';

    protected $fillable = [
        'nombre',
        'fechadecreacion',
        'numeroexcel',
    ];
}
