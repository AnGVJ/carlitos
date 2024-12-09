<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Aquí puedes pasar cualquier dato que necesites a la vista
        return view('dashboard');
    }
}
