<x-app-layout>
<div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Peliculas</h1>
</div>

@if(session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<a href="{{route('crear_pelicula')}}">
        <div class="m-5 flex justify-center">
            <button class="rounded border border-blue-500 bg-transparent px-4 py-2 font-semibold text-blue-500 hover:border-transparent hover:bg-blue-500 hover:text-white"> 
                Agregar Pelicula
            </button>
        </div>
</a>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Pelicula
                </th>
                <th scope="col" class="px-6 py-3">
                    Duracion (minutos)
                </th>
                <th scope="col" class="px-6 py-3">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($peliculas as $pelicula)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$pelicula->nombre}}
                </th>
                <td class="px-6 py-4">
                    {{$pelicula->duracion}}
                </td>
                <td class="px-6 py-4">
                    <div class="flex">
                        <form method="POST" action="{{ route('destroy_pelicula', ['id' => $pelicula->id] ) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="rounded border border-red-500 m-2 bg-transparent px-4 py-2 font-semibold text-red-500 hover:border-transparent hover:bg-red-500 hover:text-white" onclick="return confirm('Estas seguro?')" value="Eliminar">
                        </form>
                        <a href="{{route('editar_pelicula', ['id' => $pelicula->id])}}">
                            <button class="rounded border border-green-500 bg-transparent m-2 px-4 py-2 font-semibold text-green-500 hover:border-transparent hover:bg-green-500 hover:text-white">
                                Editar
                            </button>
                        </a>
                        <a href="{{route('ver_pelicula', ['id' => $pelicula->id])}}">
                            <button class="rounded border border-blue-500 bg-transparent m-2 px-4 py-2 font-semibold text-blue-500 hover:border-transparent hover:bg-blue-500 hover:text-white">
                                Ver
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
         {{$peliculas->links()}}
    </div>
</div>
</x-app-layout>


