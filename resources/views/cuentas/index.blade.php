<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Cuentas') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="grid grid-cols-4">
                <div class="ml-6 py-4">
                    <a href="{{ url('/cuentas/create') }}">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                            Crear Nueva Cuenta
                        </button>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    @if(app('request')->input('edit_succes') == 1)
    {
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">¡Cuenta Actualizado!</p>
                <p class="text-sm">El Cuenta se actualizó de forma correcta a nuestro sistema</p>
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
                <p class="font-bold">¡Cuenta Eliminado!</p>
                <p class="text-sm">El cuenta ya no se nencuentra en nuestro sistema</p>
            </div>
            </div>
      </div>
    }
    @endif

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="flex items-center justify-between px-6 py-3 bg-gray-50 dark:bg-gray-700">
                    <div>
                        <label for="numeroCuenta" class="text-gray-600 dark:text-gray-400">Número de Cuenta:</label>
                        <input type="text" id="numeroCuenta" class="ml-2 border rounded-md px-3 py-2">
                    </div>
                    <button onclick="filtrarCuentas()" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md">Filtrar</button>
                </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Número de cuenta
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Saldo $
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cuentas as $cuenta)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $cuenta->id }}
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo number_format($cuenta->saldo, 2, ",", ".");?>
                                </td>
                                <td>
                                    <a href="{{ route('cuentas.edit', ['id' => $cuenta->id]) }}">
                                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">
                                            Editar
                                        </button>
                                    </a>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onClick="deletecuenta('{{ route('cuentas.delete', ['id' => $cuenta->id]) }}')">
                                            Eliminar
                                        </button>
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Quieres eliminar el cuenta?</h3>
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
    function filtrarCuentas() {
        var numeroCuenta = document.getElementById('numeroCuenta').value;

        var rows = document.querySelectorAll('#row');

        rows.forEach(function(row) {
            var numeroCuentaColumna = row.querySelector('th').textContent.trim();

            // Agregar o quitar la clase 'hidden' según el criterio de filtrado
            var ocultarFila = numeroCuenta && numeroCuentaColumna !== numeroCuenta;

            if (ocultarFila) {
                row.classList.add('hidden');
            } else {
                row.classList.remove('hidden');
            }
        });
    }
</script>
</x-app-layout>