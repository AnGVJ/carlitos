<?php

namespace App\Http\Controllers;

use App\Models\ReporteExcel;
use Illuminate\Http\Request;

class ReporteExcelController extends Controller
{
    public function index()
    {
        // Obtener todos los datos de la tabla reportesexcel
        $reportes = ReporteExcel::all();

        // Enviar los datos a la vista
        return view('reportesexcel', compact('reportes'));
    }
}
