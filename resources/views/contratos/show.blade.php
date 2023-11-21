<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contrato con número de identifiacación {{$contrato->id}}
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
                                    Fecha de Inicio del contrato
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha de Fin del contrato
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor total Mensual $
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$contrato->fecha_inicio}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$contrato->fecha_fin}}
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo number_format($contrato->valor_total_mensual, 2, ",", ".");?>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
                <h2 class="text-white text-xl">Estos son Los Bienes asociados a este Contrato</h2>
            </div>
        </div>
    </div>
        <!--inicio test-->
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div x-data="{ openTab: 1 }" class="p-8 m-auto">
                        <div class="w-full">
                            <div class="mb-4 flex space-x-4 p-2 dark:bg-gray-700 rounded-lg shadow-md">
                                <button x-on:click="openTab = 1" :class="{ 'bg-gray-600 text-white': openTab === 1 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300"><span class="text-gray-300" :class="{ 'bg-gray-600 text-white': openTab === 1 }">Edificios</span></button>
                                <button x-on:click="openTab = 2" :class="{ 'bg-gray-600 text-white': openTab === 2 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300"><span class="text-gray-300" :class="{ 'bg-gray-600 text-white': openTab === 2 }">Pisos</span></button>
                                <button x-on:click="openTab = 3" :class="{ 'bg-gray-600 text-white': openTab === 3 }" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300"><span class="text-gray-300" :class="{ 'bg-gray-600 text-white': openTab === 3 }">Locales</span></button>
                            </div>

                            <div x-show="openTab === 1" class="transition-all duration-300 bg-gray p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            @if (!$contratoBienes->isEmpty() && $contratoBienes->first(function ($item) {
                                return $item->edificio !== null;
                            }))   
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Nombre de Edificio
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Dirección Completa
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Codigo Postal
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Valor $
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
                                        @foreach ($contratoBienes as $contratoBien)
                                        @if ($contratoBien->edificio != null)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $contratoBien->edificio->nombre }}
                                                </th>
                                                <td class="px-6 py-4">
                                                {{ $contratoBien->edificio->direccion }}
                                                </td>
                                                <td class="px-6 py-4">
                                                {{ $contratoBien->edificio->postal }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo number_format($contratoBien->edificio->valor, 2, ",", ".");?>
                                                </td>
                                                <td class="px-6 py-4" id="state">
                                                @switch($contratoBien->edificio->estado)
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
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                            @else
                                <p class="text-white text-xl">No hay edificios disponibles en este contrato</p>
                            @endif
                            </div>
                            <div x-show="openTab === 2" class="transition-all duration-300 bg-gray p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            @if (!$contratoBienes->isEmpty() && $contratoBienes->first(function ($item) {
                                return $item->piso !== null;
                            }))  
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
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($contratoBienes as $contratoBien)
                                        @if ($contratoBien->piso != null)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $contratoBien->piso->numero }}
                                            </th>
                                            <td class="px-6 py-4">
                                            {{ $contratoBien->piso->direccion }}
                                            </td>
                                            <td class="px-6 py-4">
                                            {{ $contratoBien->piso->postal }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo number_format($contratoBien->piso->valor, 2, ",", ".");?>
                                            </td>
                                            <td class="px-6 py-4" id="state">
                                            @switch($contratoBien->piso->estado)
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
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <p class="text-white text-xl">No hay pisos disponibles en este contrato</p>
                                    @endif
                                </div>

                            <div x-show="openTab === 3" class="transition-all duration-300 bg-gray p-4 rounded-lg shadow-md border-l-4 border-blue-600">
                            @if (!$contratoBienes->isEmpty() && $contratoBienes->first(function ($item) {
                                return $item->local !== null;
                            }))        
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
                                            <th scope="col" class="px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($contratoBienes as $contratoBien)    
                                        @if ($contratoBien->local != null)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $contratoBien->local->numero }}
                                            </th>
                                            <td class="px-6 py-4">
                                            {{ $contratoBien->local->dimensiones }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo number_format($contratoBien->local->valor, 2, ",", ".");?>
                                            </td>
                                            <td class="px-6 py-4" id="state">
                                            @switch($contratoBien->local->estado)
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
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            @else
                                <p class="text-white text-xl">No hay locales disponibles en este contrato</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="py-4">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-8">
            <div class="m-0 p-0">
                <h2 class="text-white text-xl">Información del Inquilino de este contrato</h2>
            </div>
        </div>
    </div>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                                <th scope="col" class="px-6 py-3">
                                    Indentificación
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Apellido
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Número de Cuenta
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Edad
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sexo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha de Nacimiento
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" id="row">
                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $inquilino->cedula }}
                                </th>
                                <td class="px-6 py-4">
                                {{ $inquilino->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $inquilino->apellido }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $inquilino->numero_cuenta }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $inquilino->edad }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $inquilino->sexo }}
                                </td>
                                <td class="px-6 py-4">
                                {{ $inquilino->fecha_nacimiento }}
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                    <!-- fin test -->
    </div>
</x-app-layout>