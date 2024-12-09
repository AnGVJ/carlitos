@extends('layouts.app') {{-- Asegúrate de tener una plantilla base configurada --}}

@section('content')
<div class="conteni">
    <div class="mt-3 d-flex justify-content-between">
        <div class="box-1 d-flex justify-content-between align-items-center">
            <!-- AVANCE TOTAL DEL PROYECTO -->
            <div class="text-center mx-3">
                <h5 class="letrita">AVANCE TOTAL DEL PROYECTO</h5>
                <div class="color-box bg-danger"></div>
            </div>

            <!-- NOOFICIO -->
            <div class="text-center mx-3">
                <h5 class="letrita">NOOFICIO</h5>
                <div class="color-box bg-pink"></div>
            </div>

            <!-- FECHA DE INICIO -->
            <div class="text-center mx-3">
                <h5 class="letrita">FECHA DE INICIO</h5>
                <div class="color-box bg-primary"></div>
            </div>

            <!-- FECHA DE FIN -->
            <div class="text-center mx-3">
                <h5 class="letrita">FECHA DE FIN</h5>
                <div class="color-box bg-purple"></div>
            </div>
        </div>


    </div>

    <div class="mt-3 tabla">
        <div class="d-flex align-items-center justify-content-between del">
            <form class="me-3 mt-3 ml-5 search-form fo" role="search">
                <div class="position-relative">
                    <input class="form-control co" type="search" placeholder="Buscar" aria-label="Buscar">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </form>
            <div class="ntnproc text-white px-3 mt-3 py-2 rounded"
                style="min-width: 150px; text-align: center; margin-left: 500px;">
                En proceso
            </div>
        </div>

        <div class="divt">
            <div class="d-flex align-items-center justify-content-between info">
                <h1 class="titulo3">Información</h1>
                <i class="bi bi-three-dots text-white"
                    style="font-size: 1.5rem; cursor: pointer; margin-right:90px;"></i>
            </div>

            <div class="containe mt-1 tablis">
                <div class="table-responsive" style="width: 100%;">
                    <table class="table">
                        <tr>
                            <th>Nombre de la obra</th>
                            <td>{{ $proyecto->Nombreproyecto }}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{ $proyecto->Municipio }}</td>
                        </tr>
                        <tr>
                            <th>Localidad</th>
                            <td>{{ $proyecto->Localidad }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de inicio</th>
                            <td>{{ $proyecto->Fechainicio }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de término</th>
                            <td>{{ $proyecto->Fechafinal }}</td>
                        </tr>
                        <tr>
                            <th>Oficio</th>
                            <td>{{ $proyecto->Oficio }}</td>
                        </tr>
                        <tr>
                            <th>Monto</th>
                            <td>{{ $proyecto->Monto }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection