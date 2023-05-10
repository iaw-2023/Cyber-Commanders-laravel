<x-app-layout>
@if(session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
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
                <th scope="col" class="px-6 py-3">
                    Opciones
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
                    @if($funcion->sala!=null)
                        {{$funcion->sala->nombre}}
                    @else
                        SALA BORRADA    
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex">
                        <form method="POST" action="{{ route('destroy_funcion', ['id' => $funcion->id] ) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="rounded border border-red-500 m-2 bg-transparent px-4 py-2 font-semibold text-red-500 hover:border-transparent hover:bg-red-500 hover:text-white" onclick="return confirm('Estas seguro?')" value="Eliminar">
                        </form>
                        <a href="{{route('editar_funcion', ['id' => $funcion->id])}}">
                            <button class="rounded border border-green-500 bg-transparent m-2 px-4 py-2 font-semibold text-green-500 hover:border-transparent hover:bg-green-500 hover:text-white">
                                Editar
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
         {{$funciones->links()}}
    </div>
</div>
    <a href="{{route('crear_funcion')}}">
        <div class="m-5 flex justify-center">
            <button class="rounded border border-blue-500 bg-transparent px-4 py-2 font-semibold text-blue-500 hover:border-transparent hover:bg-blue-500 hover:text-white"> 
                Agregar Funcion
            </button>
        </div>
    </a>
</x-app-layout>
