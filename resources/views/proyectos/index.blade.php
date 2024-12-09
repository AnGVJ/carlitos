@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 text-light" style="background-color: #060528 !important;">
    <!-- Cabecera -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex bgd align-items-center" style="width: 300px; border-radius: 5px;">
            <div class="rounded-circle p-3 me-3" style="background-color: #060528 !important;">
                <img src="images/proyec.png" alt="Icono" class="img-fluid" style="width: 70px;">
            </div>
            <div class="nuevoc">
                <h4 class="mb-0">TOTAL DE PROYECTOS</h4>
                <p class="mb-0 text-center" style="color:white;">{{ $totalProyectos }} proyectos</p>

            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary me-2">Crear nuevo proyecto</a>
            <!-- Formulario Importar -->
            <form action="{{ route('proyectos.import') }}" method="POST" enctype="multipart/form-data"
                style="display: inline-block;">
                @csrf
                <label for="file-import" class="btn btn-primary mb-0">Subir nuevo proyecto</label>
                <input type="file" id="file-import" name="file" style="display: none;" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- Buscador y filtros -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" class="form-control w-50 me-3 bgd text-light" placeholder="Buscar proyecto">
        <div class="d-flex align-items-center">
            <input type="date" class="form-control bgd text-light me-2">
            <select class="form-control bgd text-light me-2">
                <option>Estado</option>
                <option value="Terminado">Terminado</option>
                <option value="En proceso">En proceso</option>
                <option value="Faltante">Faltante</option>
            </select>
            <button class="btn btn-secondary">Más filtros</button>
        </div>
    </div>

    <!-- Tabla -->
    <table class="table bgd" style="color: white;">
        <thead>
            <tr>
                <th>No</th>
                <th>Id</th>
                <th>Nombre de la obra</th>
                <th>Municipio de la obra</th>
                <th>Localidad de la obra</th>
                <th>Fecha de inicio</th>
                <th>Fecha de término</th>
                <th>N° de Oficio</th>
                <th>Monto total de la obra</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $proyecto)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $proyecto->id }}</td>
                    <td><a href="{{ route('seguimiento.show', $proyecto->id) }}"
                            style="color:white;">{{ $proyecto->Nombreproyecto }}</a></td>
                    <td>{{ $proyecto->Municipio }}</td>
                    <td>{{ $proyecto->Localidad }}</td>
                    <td>{{ $proyecto->Fechainicio }}</td>
                    <td>{{ $proyecto->Fechafinal }}</td>
                    <td>{{ $proyecto->Oficio }}</td>
                    <td>{{ $proyecto->Monto }}</td>
                    <td>
                        @if($proyecto->Estado == 'Terminado')
                            <span class="badge bg-success">●</span>
                        @elseif($proyecto->Estado == 'En proceso')
                            <span class="badge bg-warning">●</span>
                        @else
                            <span class="badge bg-danger">●</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botón Exportar -->
    <div class="text-end">

    </div>
</div>
@endsection