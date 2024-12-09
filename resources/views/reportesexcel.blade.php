@extends('layouts.app') {{-- Asegúrate de tener una plantilla base configurada --}}

@section('content')
<div class="container mt-5">
    <div class="card bg-dark text-light">
        <div class="card-header">
            <h4>Reportes Excel</h4>
        </div>
        <div class="card-body">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Num</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre de Excel</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportes as $reporte)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reporte->numeroexcel }}</td>
                            <td>{{ $reporte->nombre }}</td>
                            <td>{{ $reporte->fechadecreacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection