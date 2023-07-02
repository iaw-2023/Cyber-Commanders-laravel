<x-app-layout>
@if(session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Funciones en : {{$nombre}}</h1>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
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
            </tr>
        </thead>
        <tbody>
            @foreach($funciones as $funcion)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$funcion->fecha}}
                </td>
                <td class="px-6 py-4">
                @if($funcion->pelicula!=null)
                        {{$funcion->pelicula->nombre}}
                    @else
                        PELICULA BORRADA    
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{$funcion->precio}}
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
