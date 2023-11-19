<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Información del Inquilino {{$inquilino->nombre}} {{$inquilino->apellido}}
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
                                <td>
                                    <a href="{{ url('/inquilino',['id' => $inquilino->cedula]) }}">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                            Ver
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>