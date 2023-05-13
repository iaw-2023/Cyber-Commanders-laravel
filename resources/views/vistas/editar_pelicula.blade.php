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
  <form method="POST" action="{{route('update_pelicula',['id' => $pelicula->id])}}" enctype="multipart/form-data" >
    @csrf
    <div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Editar Pelicula</h1>
    </div>
    <div class="m-2 flex flex-wrap">
      <div class="m-3 w-1/3">
        <label for="nombre" class="mb-2 block font-medium text-gray-900">Nombre</label>
        <input type="text" name="nombre" class="block w-full border border-gray-400 p-2.5" value="{{$pelicula->nombre}}" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="duracion" class="mb-2 block font-medium text-gray-900">Duracion</label>
        <input type="number" name="duracion" class="block w-full border border-gray-400 p-2.5" value="{{$pelicula->duracion}}" required />
      </div>
    </div>
    <div class="form-group">
      <label for="imagen">Elija una imagen</label>
      <input type="file" name='imagen' class="form-control-file" id="imagen">
    </div>
    <button type="submit" class="ml-5 rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white">Guardar</button>
  </form>
</x-app-layout>