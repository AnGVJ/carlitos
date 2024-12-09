<x-app-layout>
    <title>Planificación de Materiales</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #131429;
            color: #ffffff;

        }

        h1,
        h2 {
            text-align: center;
            margin: 20px 0;
            color: #fff;
        }

        .container {
            width: 99%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1f1f2e;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .header div {
            text-align: center;
        }

        .header strong {
            display: block;
            color: #a8a8ff;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #26263a;
            color: #ffffff;
            margin-bottom: 0px;
        }

        .progress-bar-container {
            position: relative;
            background-color: #3b3b5c;
            border-radius: 10px;
            width: 100%;
            height: 25px;
            overflow: hidden;
        }

        .progress-bar {
            background-color: #28a745;
            height: 100%;
            width: 0%;
            transition: width 0.5s ease-in-out;
        }

        .progress-text {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: bold;
            color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1f1f2e;
            border-radius: 10px;
            overflow: hidden;
        }

        tr,
        td {
            color: white;
        }

        th,
        td {
            font-size: 12px;

            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #26263a;
        }

        th {
            background-color: #3b3b5c;
            color: #ffffff;
            font-size: 14px;
        }

        td {
            color: #a8a8ff;
        }

        tr:hover {
            background-color: #282847;
        }

        .no-materiales {
            color: #ff8080;
            font-weight: bold;
            text-align: center;
        }



        .buttons {

            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 5px;
        }

        .button {
            height: 40px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .hidden-column {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Contenedor de la tabla para permitir desplazamiento horizontal */
        .table-container {
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-top: 20px;
            max-height: 49vh;
            overflow-y: auto;
        }

        .table-container {
            /* ... otras propiedades ... */

            scrollbar-width: thin;
            scrollbar-color: white transparent;
        }

        .table-container::-webkit-scrollbar {
            width: 10px;
            /* Ajusta el ancho según sea necesario */
        }

        .table-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: white;
        }


        .nompo {
            font-size: 12px;

        }

        .medida {
            width: 75vh;
        }
    </style>



    <script>
        // Almacenar y recuperar estado de checkboxes usando localStorage
        function toggleColumnVisibility(checkbox, index) {
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('th, td');
                if (cells[index]) {
                    cells[index].classList.toggle('hidden-column', checkbox.checked);
                }
            });

            // Guardar el estado del checkbox en localStorage para el proyecto actual
            const proyectoId = document.getElementById('proyecto').value;
            const checkedColumns = JSON.parse(localStorage.getItem(proyectoId)) || {};
            checkedColumns[index] = checkbox.checked;
            localStorage.setItem(proyectoId, JSON.stringify(checkedColumns));

            // Calcular el avance de acuerdo a las columnas seleccionadas
            calculateProgress();
        }

        // Calcular el progreso total basado en las columnas seleccionadas
        function calculateProgress() {
            const checkboxes = document.querySelectorAll('th input[type="checkbox"]');
            const totalColumns = checkboxes.length;
            let selectedColumns = 0;

            // Contar las columnas marcadas
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedColumns++;
                }
            });

            // Calcular el porcentaje de avance
            const progressPercentage = (selectedColumns / totalColumns) * 100;

            // Mostrar el avance calculado
            const avanceTotal = document.getElementById('avanceTotal');
            avanceTotal.textContent = `Avance Total: ${progressPercentage.toFixed(2)}%`;

            // Actualizar la barra de progreso
            const progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = `${progressPercentage}%`;
            progressBar.querySelector('.progress-text').textContent = `${progressPercentage.toFixed(2)}%`;
        }

        // Al cargar la página, recuperar el estado de los checkboxes
        window.onload = function () {
            const proyectoId = document.getElementById('proyecto')?.value; // Cambié 'proyecto' a 'proyectoId'
            if (proyectoId) {
                const checkedColumns = JSON.parse(localStorage.getItem(proyectoId)) || {};
                const checkboxes = document.querySelectorAll('th input[type="checkbox"]');

                checkboxes.forEach((checkbox, index) => {
                    if (checkedColumns[index]) {
                        checkbox.checked = true;
                        toggleColumnVisibility(checkbox, index); // Asegura que las columnas ocultas se muestren correctamente
                    }
                });

                // Calcular el progreso inicial basado en las columnas seleccionadas
                calculateProgress();
            }
        }
        function imprimir() {
            window.print();
        }


    </script>

    </head>

    <body>
        <div class="container">
            <!-- Encabezado -->
            <div class="header">
                <div class="medida">
                    <strong>Planificación</strong>
                    <span
                        class="nompo">{{ isset($proyectoSeleccionado) ? $proyectoSeleccionado->Nombreproyecto : 'N/A' }}</span>
                </div>
                <div>
                    <strong id="avanceTotal">Avance Total: 0%</strong>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: 0%;">
                            <span class="progress-text">0%</span>
                        </div>
                    </div>
                </div>
                <div>
                    <strong>De la Semana</strong>
                    <span>{{ isset($proyectoSeleccionado) ? $proyectoSeleccionado->Fechainicio : 'xx-xx-xxxx' }}</span>
                </div>
                <div>
                    <strong>A la Semana</strong>
                    <span>{{ isset($proyectoSeleccionado) ? $proyectoSeleccionado->Fechafinal : 'xx-xx-xxxx' }}</span>
                </div>
            </div>

            <!-- Selección de proyecto -->
            <form method="GET" action="{{ route('tabla.dinamica') }}">
                <label for="proyecto">Seleccionar Proyecto</label>
                <select id="proyecto" name="proyecto" required onchange="this.form.submit();">
                    <option value="">Selecciona un proyecto</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ isset($proyectoSeleccionado) && $proyectoSeleccionado->id == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->Nombreproyecto }}
                        </option>
                    @endforeach
                </select>
            </form>

            <!-- Tabla dinámica con scroll horizontal -->
            @if(isset($proyectoSeleccionado))
                @if(!empty($materialesPorSemana))
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    @foreach(array_keys($materialesPorSemana) as $index => $rango)
                                        <th>
                                            <input type="checkbox" onchange="toggleColumnVisibility(this, {{ $index }})">
                                            {{ $rango }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($materialesPorSemana as $materiales)
                                        <td>
                                            @if(count($materiales) > 0)
                                                <ul>
                                                    @foreach($materiales as $material)
                                                        <li>{{ $material['concepto'] }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="no-materiales">No hay materiales</p>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No hay materiales disponibles para este proyecto.</p>
                @endif
            @endif

            <!-- Botones de acciones -->
            <div class="buttons">
                <form action="{{ route('reporte.materiales') }}" method="GET">
                    <input type="hidden" name="proyecto"
                        value="{{ isset($proyectoSeleccionado) ? $proyectoSeleccionado->id : '' }}">

                    <button type="submit" class="button">Generar Reporte PDF</button>
                </form>





            </div>
        </div>
</x-app-layout>