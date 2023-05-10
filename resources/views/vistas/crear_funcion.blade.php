<x-app-layout>
  <form method="POST" action="{{route('store_funcion')}}">
    @csrf
    <div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Nueva Funcion</h1>
    </div>
    <div class="m-2 flex flex-wrap">
      <div class="m-3 w-1/3">
        <label for="fecha" class="mb-2 block font-medium text-gray-900">Fecha</label>
        <input type="datetime-local" name="fecha" class="block w-full border border-gray-400 p-2.5" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="pelicula" class="mb-2 block font-medium text-gray-900">Pelicula</label>
        <select id="pelicula" name="pelicula"  class="block w-full border border-gray-400 p-2.5">
        @foreach($peliculas as $pelicula)   
            <option value="{{$pelicula->id}}">{{$pelicula->nombre}}</option>
        @endforeach
        </select>
      </div>
      <div class="m-3 w-1/3">
        <label for="sala" class="mb-2 block font-medium text-gray-900">Sala</label>
        <select id="sala" name="sala" class="w-full p-2.5">
        @foreach($salas as $sala)   
            <option value="{{$sala->id}}">{{$sala->nombre}}</option>
        @endforeach
        </select>
      </div>
      <div class="m-3 w-1/3">
        <label for="precio" class="mb-2 block font-medium text-gray-900">Precio</label>
        <input type="number" name="precio" id="precio" class="block w-full border border-gray-400 p-2.5" required />
      </div>
    </div>
    <button type="submit" class="ml-5 rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white">Guardar</button>
  </form>
</x-app-layout>