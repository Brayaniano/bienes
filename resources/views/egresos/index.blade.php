<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Egresos de todos los bienes') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
            <a href="{{ url('/egresos/create') }}">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                Crear Nuevo Egreso
                </button>
            </a>
            </div>
        </div>
    </div>
    @if(app('request')->input('edit_succes') == 1)
    {
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">¡Egreso Actualizado!</p>
                <p class="text-sm">El egreso se actualizó de forma correcta a nuestro sistema</p>
            </div>
            </div>
      </div>
    }
    @endif

    <div class="py-1">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <!-- ... (código existente) ... -->
    <div class="flex items-center justify-between px-6 py-3 bg-gray-50 dark:bg-gray-700">
        <div>
            <label for="fechaInicio" class="text-gray-600 dark:text-gray-400">Fecha Inicio:</label>
            <input type="date" id="fechaInicio" class="ml-2 border rounded-md px-3 py-2">
        </div>
        <div>
            <label for="fechaFin" class="text-gray-600 dark:text-gray-400">Fecha Fin:</label>
            <input type="date" id="fechaFin" class="ml-2 border rounded-md px-3 py-2">
        </div>
        <div>
            <label for="idCuenta" class="text-gray-600 dark:text-gray-400">ID Cuenta:</label>
            <input type="text" id="idCuenta" class="ml-2 border rounded-md px-3 py-2">
        </div>
        <div>
            <label for="idBien" class="text-gray-600 dark:text-gray-400">ID Bien:</label>
            <input type="text" id="idBien" class="ml-2 border rounded-md px-3 py-2">
        </div>
        <button onclick="filtrarTabla()" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md">Filtrar</button>
    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Número de Cuenta
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Identificación del bien
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor $
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descripción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($egresos as $egreso)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('cuentas.edit',['id' => $egreso->id_cuenta]) }}">
                                    {{ $egreso->id_cuenta }}
                                </a>
                                </th>
                                <td class="px-6 py-4">
                                @if(isset($egreso->edificio) && $egreso->edificio->count() > 0)
                                <a href="{{ url('/edificio',['id' => $egreso->edificio->id]) }}">
                                    {{ $egreso->edificio->id }}
                                </a>
                                @elseif( isset($egreso->local) && $egreso->local->count() > 0)
                                <a href="{{ url('/local',['id' => $egreso->local->id]) }}">
                                    {{ $egreso->local->id }}
                                </a>
                                @elseif(isset($egreso->piso) && $egreso->piso->count() > 0)
                                <a href="{{ url('/piso',['id' => $egreso->piso->id]) }}">
                                    {{ $egreso->piso->id }}
                                </a>
                                @endif
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($egreso->saldo, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4">
                                {{ $egreso->fecha_ingreso }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $egreso->description }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
    function filtrarTabla() {
        var fechaInicio = document.getElementById('fechaInicio').value;
        var fechaFin = document.getElementById('fechaFin').value;
        var idCuenta = document.getElementById('idCuenta').value;
        var idBien = document.getElementById('idBien').value;

        var rows = document.querySelectorAll('#row');
        
        rows.forEach(function(row) {
            var fechaColumna = row.querySelector('td:nth-child(4)').textContent.trim();
            var idCuentaColumna = row.querySelector('th a').textContent.trim();
            var idBienColumna = row.querySelector('td:nth-child(2) a').textContent.trim();

            // Ocultar la fila si no cumple con los criterios de filtrado
            var ocultarFila = 
                (fechaInicio && fechaColumna < fechaInicio) ||
                (fechaFin && fechaColumna > fechaFin) ||
                (idCuenta && idCuentaColumna !== idCuenta) ||
                (idBien && idBienColumna !== idBien);

            row.style.display = ocultarFila ? 'none' : '';
        });
    }
</script>
</x-app-layout>