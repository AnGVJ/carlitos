<?php

namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Proyecto;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TablaDinamicaController extends Controller
{
    public function generarRangosSemanas($fechaInicio, $fechaFin)
    {
        $rangos = [];
        $inicio = Carbon::parse($fechaInicio);
        $fin = Carbon::parse($fechaFin);

        while ($inicio <= $fin) {
            $semanaInicio = $inicio->copy();
            $semanaFin = $inicio->copy()->addDays(5); // Semanas de 6 días
            if ($semanaFin > $fin) {
                $semanaFin = $fin;
            }
            $rangos[] = [
                'inicio' => $semanaInicio->format('Y-m-d'),
                'fin' => $semanaFin->format('Y-m-d'),
                'titulo' => "Semana del " . $semanaInicio->format('d') . " al " . $semanaFin->format('d') . " de " . $semanaFin->locale('es')->monthName . " de " . $semanaFin->year,
            ];
            $inicio->addDays(7);
        }

        return $rangos;
    }

    public function mostrarTablaDinamica(Request $request)
    {
        $proyectoId = $request->input('proyecto'); // Proyecto seleccionado
        $proyectoSeleccionado = null;
        $materialesPorSemana = [];

        // Obtener los proyectos, incluyendo la columna 'avance'
        $proyectos = DB::table('proyectos')->select('id', 'Nombreproyecto', 'Fechainicio', 'Fechafinal', 'avance')->get();

        // Verificar si se seleccionó un proyecto
        if ($proyectoId) {
            $proyectoSeleccionado = $proyectos->firstWhere('id', $proyectoId);

            if ($proyectoSeleccionado) {
                // Fechas del proyecto seleccionado
                $fechaInicio = $proyectoSeleccionado->Fechainicio;
                $fechaFin = $proyectoSeleccionado->Fechafinal;

                // Generar los rangos de semanas
                $rangos = $this->generarRangosSemanas($fechaInicio, $fechaFin);

                // Obtener materiales que coinciden con el proyecto
                $materiales = DB::table('materiales')
                    ->where('obra', $proyectoSeleccionado->Nombreproyecto)
                    ->select('concepto', 'cantidad', 'unidad')
                    ->get();

                if ($materiales->isNotEmpty()) {
                    // Distribuir materiales en semanas
                    $numSemanas = count($rangos);
                    foreach ($materiales as $material) {
                        $cantidadRestante = $material->cantidad;
                        $cantidadPorSemana = floor($cantidadRestante / $numSemanas);

                        foreach ($rangos as $index => $rango) {
                            if ($cantidadRestante > 0) {
                                $cantidadAsignada = $cantidadPorSemana;

                                if ($index === $numSemanas - 1) {
                                    $cantidadAsignada += $cantidadRestante % $numSemanas;
                                }

                                if ($cantidadAsignada > 0) {
                                    $materialesPorSemana[$rango['titulo']][] = [
                                        'concepto' => $material->concepto,
                                        'cantidad' => $cantidadAsignada,
                                        'unidad' => $material->unidad,
                                    ];
                                }

                                $cantidadRestante -= $cantidadAsignada;
                            }
                        }
                    }
                } else {
                    // No hay materiales para este proyecto
                    $rangos = [];
                }
            }
        }

        // Enviar datos a la vista
        return view('materiales.tabla_dinamica', compact('proyectos', 'proyectoSeleccionado', 'materialesPorSemana'));
    }

    public function generarReporte(Request $request)
    {
        $proyectoId = $request->input('proyecto'); // Proyecto seleccionado
        $proyectoSeleccionado = null;
        $materialesPorSemana = [];

        // Obtener los proyectos
        $proyectos = DB::table('proyectos')->select('id', 'Nombreproyecto', 'Fechainicio', 'Fechafinal')->get();

        // Verificar si se seleccionó un proyecto
        if ($proyectoId) {
            $proyectoSeleccionado = $proyectos->firstWhere('id', $proyectoId);

            if ($proyectoSeleccionado) {
                // Fechas del proyecto seleccionado
                $fechaInicio = $proyectoSeleccionado->Fechainicio;
                $fechaFin = $proyectoSeleccionado->Fechafinal;

                // Generar los rangos de semanas
                $rangos = $this->generarRangosSemanas($fechaInicio, $fechaFin);

                // Obtener materiales que coinciden con el proyecto
                $materiales = DB::table('materiales')
                    ->where('obra', $proyectoSeleccionado->Nombreproyecto)
                    ->select('concepto', 'cantidad', 'unidad')
                    ->get();

                if ($materiales->isNotEmpty()) {
                    // Distribuir materiales en semanas
                    $numSemanas = count($rangos);
                    foreach ($materiales as $material) {
                        $cantidadRestante = $material->cantidad;
                        $cantidadPorSemana = floor($cantidadRestante / $numSemanas);

                        foreach ($rangos as $index => $rango) {
                            if ($cantidadRestante > 0) {
                                $cantidadAsignada = $cantidadPorSemana;

                                if ($index === $numSemanas - 1) {
                                    $cantidadAsignada += $cantidadRestante % $numSemanas;
                                }

                                if ($cantidadAsignada > 0) {
                                    $materialesPorSemana[$rango['titulo']][] = [
                                        'concepto' => $material->concepto,
                                        'cantidad' => $cantidadAsignada,
                                        'unidad' => $material->unidad,
                                    ];
                                }

                                $cantidadRestante -= $cantidadAsignada;
                            }
                        }
                    }
                }
            }
        }

        // Solo pasar los datos relevantes para el contenido que quieres imprimir
        $pdf = PDF::loadView('materiales.tabla_dinamica', compact('proyectos', 'proyectoSeleccionado', 'materialesPorSemana'));

        // Retornar el PDF como descarga
        return $pdf->download('reporte_materiales.pdf');
    }

}