<x-app-layout>
    <style>
        body {
            background-color: #0d1117;
            color: white;
            font-family: Arial, sans-serif;
        }

        .table-d {
            color: white;
            background-color: #181A32;
            /* Cambiar color de fondo de la tabla */
        }

        .table-d tr {
            color: white;
        }

        .table-d th,
        .table-d td {
            vertical-align: middle;
            border-color: #212529;
            color: white;
            /* Ajustar el color del borde para que combine */
        }

        .progress {
            height: 25px;
            border-radius: 15px;
        }

        .btn-outline-light {
            border-radius: 20px;
        }

        .icon-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-icon {
            cursor: pointer;
            font-size: 1.2rem;
        }

        .cone {
            background-color: #181A32;
            border-radius: 5px;
            text-align: center;
            width: 250px;
            margin-left: 15px;
        }
    </style>
    <div class="container my-5">
        <!-- Encabezado -->
        <div class="row mb-4">
            <!-- Planificación -->
            <div class="col-md-4 cone">
                <div class="icon-container">
                    <img src="images/planificacion.png" alt="Planificación" style="width: 40px; height: 40px;">
                    <h5>PLANIFICACIÓN</h5>
                </div>
                <p>xxx-xxx-xxx</p>
                <i class="dropdown-icon bi bi-chevron-down text-light"></i>
            </div>

            <!-- Avance Total -->
            <div class="col-md-4 text-center">
                <h5>AVANCE TOTAL</h5>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100">
                        80%
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="col-md-4 text-end">
                <button class="btn btn-outline-light">DE LA SEMANA XX-XX-XXXX</button>
                <button class="btn btn-outline-light">A LA SEMANA XX-XX-XXXX</button>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-d table-striped">
                <thead>
                    <tr>
                        <th>NOMBRE DE LA HERRAMIENTA O MATERIAL</th>
                        <th>Semana xx-xx-xx al xx-xx-xx</th>
                        <th>Actividad completada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Material 1</td>
                        <td>8</td>
                        <td><span class="text-success">&#10004;</span></td>
                    </tr>
                    <tr>
                        <td>Material 2</td>
                        <td>5</td>
                        <td><span class="text-danger">&#10008;</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Botones -->
        <div class="row mt-4">
            <div class="col-md-6">
                <button class="btn btn-outline-light">Guardar</button>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-outline-light">Imprimir</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>