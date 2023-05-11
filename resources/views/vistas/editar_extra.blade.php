<x-app-layout>
@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="{{route('update_extra',[$id => $extra->id ])}}">
    @csrf
    <div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Editar Extra</h1>
    </div>
    <div class="m-2 flex flex-wrap">
      <div class="m-3 w-1/3">
        <label for="producto" class="mb-2 block font-medium text-gray-900">Producto</label>
        <input type="text" name="producto" value="{{$extra->producto}}" class="block w-full border border-gray-400 p-2.5" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="tamaño" class="mb-2 block font-medium text-gray-900">Tamaño</label>
        <input type="text" name="tamaño" value="{{$extra->tamaño}}" class="block w-full border border-gray-400 p-2.5" required  />
      </div>
      <div class="m-3 w-1/3">
        <label for="precio" class="mb-2 block font-medium text-gray-900">Precio</label>
        <input type="number" name="precio" value="{{$extra->precio}}" class="block w-full border border-gray-400 p-2.5" required />
      </div>
    </div>
    <button type="submit" class="ml-5 rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white">Guardar</button>
  </form>
</x-app-layout>