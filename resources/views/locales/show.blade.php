<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Local id #{{$local->id}}
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
                                    Número de Local
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dimensiones del Local(mts)
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
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $local->numero }}
                                </th>
                                <td class="px-6 py-4">
                                {{ $local->dimensiones }}
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($local->valor, 2, ",", ".");?>
                                </td>
                                <td class="px-6 py-4" id="state">
                                @switch($local->estado)
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
</x-app-layout>