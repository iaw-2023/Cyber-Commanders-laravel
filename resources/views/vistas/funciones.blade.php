<x-app-layout>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Fecha
                </th>
                <th scope="col" class="px-6 py-3">
                    Pelicula
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3">
                    Sala
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($funciones as $funcion)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$funcion->fecha}}
                </th>
                <td class="px-6 py-4">
                    {{$funcion->pelicula->nombre}}
                </td>
                <td class="px-6 py-4">
                    {{$funcion->precio}}
                </td>
                <td class="px-6 py-4">
                    {{$funcion->sala->nombre}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
         {{$funciones->links()}}
    </div>
</div>
</x-app-layout>
