<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('seguimiento', compact('proyecto'));
    }

}
