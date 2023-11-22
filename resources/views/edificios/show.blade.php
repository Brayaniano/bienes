<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edificio id #{{$edificio->id}}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Número de Piso
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dirección
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Código Postal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor $
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Saldo $
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
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $edificio->nombre }}
                                </th>
                                <td class="px-6 py-4">
                                {{ $edificio->direccion }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $edificio->postal }}
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($edificio->valor, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($edificio->cuenta->saldo, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4" id="state">
                                @switch($edificio->estado)
                                    @case(1)
                                        <span>Disponible</span>
                                        @break

                                    @case(2)
                                        <span>Alquilado</span>
                                        @break

                                    @case(3)
                                        <span>En Proceso de Alquiler</span>
                                        @break    
                                    @case(4)
                                        <span>No disponible</span>
                                        @break

                                    @default
                                        <span>Something went wrong, please try again</span>
                                @endswitch
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(!$pisos->isEmpty())
    <div class="py-4">
        <div class="max-w-6xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Pisos asociados a este Edificio</h2>
            </div>
        </div>
    </div>
    <div class="py-1">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Número Piso
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dirección
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor $
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pisos as $piso)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $piso->numero }}
                                </th>
                                <td class="px-6 py-4">
                                {{ $piso->direccion }}
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($piso->valor, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4">
                                @switch($piso->estado)
                                    @case(1)
                                        <span>Disponible</span>
                                        @break

                                    @case(2)
                                        <span>Alquilado</span>
                                        @break

                                    @case(3)
                                        <span>En Proceso de Alquiler</span>
                                        @break    
                                    @case(4)
                                        <span>No disponible</span>
                                        @break

                                    @default
                                        <span>Something went wrong, please try again</span>
                                @endswitch
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>