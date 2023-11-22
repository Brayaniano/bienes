<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Recibos') }}
        </h2>
    </x-slot>

    @if(app('request')->input('edit_succes') == 1)
    {
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">¡Inquilino Actualizado!</p>
                <p class="text-sm">El recibo se actualizó de forma correcta a nuestro sistema</p>
            </div>
            </div>
      </div>
    }
    @endif
    @if(app('request')->input('delete_succes') == 1)
    {
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">¡Inquilino Eliminado!</p>
                <p class="text-sm">El recibo ya no se nencuentra en nuestro sistema</p>
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
        <label for="fechaInicio" class="text-gray-600 dark:text-gray-400">Desde(Fecha Vencimiento):</label>
        <input type="date" id="fechaInicio" class="ml-2 border rounded-md px-3 py-2">
    </div>
    <div>
        <label for="fechaFin" class="text-gray-600 dark:text-gray-400">Hasta(Fecha Vencimiento):</label>
        <input type="date" id="fechaFin" class="ml-2 border rounded-md px-3 py-2">
    </div>
    <div>
        <!-- Agrega un elemento select para el estado -->
        <label for="estado" class="text-gray-600 dark:text-gray-400">Estado:</label>
        <select id="estado" class="ml-2 border rounded-md px-3 py-2">
            <option value="">Todos</option>
            <option value="Disponible">Disponible</option>
            <option value="Alquilado">Alquilado</option>
            <option value="En Proceso de Alquiler">En Proceso de Alquiler</option>
        </select>
    </div>
    <button onclick="filtrarTabla()" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md">Filtrar</button>
</div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Número de cuenta
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Id del bien
                                </th>
                                <th scope="col" class="px-6 py-3" style="display:none">
                                    Id del Inquilino
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    fecha de emición
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    fecha de Vencimiento
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Estado
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($recibos as $recibo)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                
                                <a href="#">
                                {{ $recibo->id_cuenta }}
                                </a>
                                </th>
                                <td class="px-6 py-4" >
                                @if(isset($recibo->edificio) && $recibo->edificio->count() > 0)
                                <a href="{{ url('/edificio',['id' => $recibo->edificio->id]) }}">
                                    {{ $recibo->edificio->id }}
                                </a>
                                @elseif( isset($recibo->local) && $recibo->local->count() > 0)
                                <a href="{{ url('/local',['id' => $recibo->local->id]) }}">
                                    {{ $recibo->local->id }}
                                </a>
                                @elseif(isset($recibo->piso) && $recibo->piso->count() > 0)
                                <a href="{{ url('/piso',['id' => $recibo->piso->id]) }}">
                                    {{ $recibo->piso->id }}
                                </a>
                                @endif
                                </td>
                                <td class="px-6 py-4" style="display:none">
                                {{ $recibo->id_inquilino }}
                                </div>
                                <td class="px-6 py-4">
                                {{ $recibo->fecha_emicion }}
                                </div>
                                <td class="px-6 py-4">
                                {{ $recibo->fecha_vencimiento }}
                                </div>
                                <td class="px-6 py-4" id="state">
                                @switch($recibo->estado)
                                    @case(10)
                                        <span>Por pagar</span>
                                        @break

                                    @case(9)
                                        <span>vencido</span>
                                        @break

                                    @case(8)
                                        <span>Pagado</span>
                                        @break    
                                    @case(4)
                                        <span>No disponible</span>
                                        @break

                                    @default
                                        <span>Something went wrong, please try again</span>
                                @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('recibos.edit', ['id' => $recibo->id]) }}">
                                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">
                                            Editar
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Quieres eliminar el Inquilino?</h3>
                <a id="delete">
                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Si
                    </button>
                </a>
                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
function deleteInquilino(url) {
    const a = document.querySelector("#delete");
    a.href = url;
}

    function filtrarTabla() {
        var fechaInicio = document.getElementById('fechaInicio').value;
        var fechaFin = document.getElementById('fechaFin').value;
        var idCuenta = document.getElementById('idCuenta').value;
        var idBien = document.getElementById('idBien').value;
        var estado = document.getElementById('estado').value;
        debugger;
        var rows = document.querySelectorAll('#row');
        debugger;
        rows.forEach(function(row) {
            var fechaColumna = row.querySelector('td:nth-child(4)').textContent.trim();
            var idCuentaColumna = row.querySelector('th a').textContent.trim();
            var idBienColumna = row.querySelector('td:nth-child(2) a').textContent.trim();
            var estadoColumna = row.querySelector('td:nth-child(6)').textContent.trim();

            // Verifica si el estadoColumna es "Todos" o coincide con el estado seleccionado
            var estadoCoincide = estado === '' || estadoColumna === estado;

            // Ocultar la fila si no cumple con los criterios de filtrado
            var ocultarFila = 
                (fechaInicio && fechaColumna < fechaInicio) ||
                (fechaFin && fechaColumna > fechaFin) ||
                (idCuenta && idCuentaColumna !== idCuenta) ||
                (idBien && idBienColumna !== idBien) ||
                !estadoCoincide;

            row.style.display = ocultarFila ? 'none' : '';
        });
    }
</script>
</x-app-layout>