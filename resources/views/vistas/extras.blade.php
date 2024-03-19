<x-app-layout>
    @if(session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="bg flex justify-center">
        <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Extras</h1>
    </div>
    @hasanyrole('adminCandyBar|superAdmin')
    <a href="{{route('crear_extra')}}">
        <div class="m-5 flex justify-center">
            <button class="rounded border border-blue-500 bg-transparent px-4 py-2 font-semibold text-blue-500 hover:border-transparent hover:bg-blue-500 hover:text-white">
                Agregar Extra
            </button>
        </div>
    </a>
    @endhasanyrole

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Producto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tamaño
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Precio
                    </th>
                    @hasanyrole('adminCandyBar|superAdmin')
                    <th scope="col" class="px-6 py-3">
                        Opciones
                    </th>
                    @endhasanyrole
                </tr>
            </thead>
            <tbody>
                @foreach($extras as $extra)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$extra->producto}}
                    </td>
                    <td class="px-6 py-4">
                        {{$extra->tamaño}}
                    </td>
                    <td class="px-6 py-4">
                        {{$extra->precio}}
                    </td>
                    @hasanyrole('adminCandyBar|superAdmin')
                    <td class="px-6 py-4 ">
                        <div class="flex justify-center">
                            <form method="POST" action="{{ route('destroy_extra', ['id' => $extra->id] ) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="rounded border border-red-500 m-2 bg-transparent px-4 py-2 font-semibold text-red-500 hover:border-transparent hover:bg-red-500 hover:text-white" onclick="return confirm('Estas seguro?')" value="Eliminar">
                            </form>
                            <a href="{{route('editar_extra', ['id' => $extra->id])}}">
                                <button class="rounded border border-green-500 bg-transparent m-2 px-4 py-2 font-semibold text-green-500 hover:border-transparent hover:bg-green-500 hover:text-white">
                                    Editar
                                </button>
                            </a>
                        </div>
                    </td>
                    @endhasanyrole
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>