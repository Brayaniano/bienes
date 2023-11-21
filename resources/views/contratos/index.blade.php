<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Contratos') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
            <a href="{{ url('/contratos/create') }}">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                Crear Nuevo Contrato
                </button>
            </a>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
                <span class="text-white">Filtrar por estado</span>
            <select id="filter-state" class="mb-2" onclick="filterContratosByState()">
                <option value="all">Todos los Estados</option>
                <option value="vigente">Vigente</option>
                <option value="Expirado">Expirado</option>
                <option value="Proximo a entrar en vigencia">Proximo a entrar en vigencia</option>
            </select>
            </div>
        </div>
    </div>
    @if(app('request')->input('edit_succes') == 1)
    {
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
                <p class="font-bold">¡Contrato Actualizado!</p>
                <p class="text-sm">El contrato se actualizó de forma correcta a nuestro sistema</p>
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
                <p class="font-bold">¡Contrato Eliminado!</p>
                <p class="text-sm">El contrato ya no se nencuentra en nuestro sistema</p>
            </div>
            </div>
      </div>
    }
    @endif

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Númmero de Contrato
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor total mensual$
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha de Inicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha de Fin
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
                        @foreach ($contratos as $contrato)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $contrato->id }}
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo number_format($contrato->valor_total_mensual, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4">
                                {{ $contrato->fecha_inicio }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $contrato->fecha_fin }}
                                </td>
                                <td class="px-6 py-4" id="state">
                                @switch($contrato->estado)
                                    @case(5)
                                        <span>Vigente</span>
                                        @break

                                    @case(6)
                                        <span>Expirado</span>
                                        @break

                                    @case(7)
                                        <span>Proximo a entrar en vigencia</span>
                                        @break    

                                    @default
                                        <span>Something went wrong, please try again</span>
                                @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('contratos.edit', ['id' => $contrato->id]) }}">
                                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">
                                            Editar
                                        </button>
                                    </a>
                                    <a href="{{ url('/contrato',['id' => $contrato->id]) }}">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                            Ver
                                        </button>
                                    </a>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onClick="deleteContrato('{{ route('contratos.delete', ['id' => $contrato->id]) }}')">
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Quieres eliminar el Contrato?</h3>
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
function deleteContrato(url) {
    const a = document.querySelector("#delete");
    a.href = url;
}

function filterContratosByState() {
  const selectedState = document.getElementById('filter-state').value;
        const tableBody = document.querySelector('tbody');

  for (const row of tableBody.querySelectorAll('tr')) {
    const stateElement = row.querySelector('td#state').innerText;
    stateElemento = validateString(stateElement);
        if (selectedState === 'all') {
            row.classList.remove("hidden");
        }else{
            if(stateElemento !== selectedState){
                row.classList.add("hidden");
            }else{
                row.classList.remove("hidden");
            }
        }
      
    }
}

function validateString(string){
    const trimmedString = string.trim();
    const splitString = trimmedString.split("\n\t");
    const joinedString = splitString.join("");
    return joinedString;
}

</script>
</x-app-layout>