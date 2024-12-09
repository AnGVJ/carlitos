<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Proyecto;  // Importa el modelo Proyecto si es necesario

class PlanificacionController extends Controller
{
    /**
     * Exportar la tabla de planificación a PDF.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportarPDF(Request $request)
    {
        // Supongamos que $proyectoSeleccionado es el proyecto actual que deseas mostrar
        $proyectoSeleccionado = Proyecto::find($request->proyecto);  // o como necesites obtener el proyecto
        $materialesPorSemana = $this->obtenerMaterialesPorSemana($proyectoSeleccionado);  // Método que retorna los materiales por semana

        // Genera el PDF utilizando la vista
        $pdf = Pdf::loadView('materiales.tabla_dinamica', compact('proyectoSeleccionado', 'materialesPorSemana'));

        // Devuelve el PDF como descarga
        return $pdf->download('planificacion_materiales.pdf');
    }

    private function obtenerMaterialesPorSemana($proyecto)
    {
        // Asegúrate de que estás obteniendo una colección de objetos, no un array
        $materiales = $proyecto->materiales()->get(); // Suponiendo que materiales es una relación en el modelo Proyecto

        // Agrupar los materiales por semana
        $materialesPorSemana = $materiales->groupBy('semana'); // Agrupamos por semana, por ejemplo

        return $materialesPorSemana;
    }


}
