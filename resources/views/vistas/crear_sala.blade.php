<x-app-layout>
  <form method="POST" action="{{route('store_sala')}}">
    @csrf
    <div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Nueva Sala</h1>
    </div>
    <div class="m-2 flex flex-wrap">
      <div class="m-3 w-1/3">
        <label for="nombre" class="mb-2 block font-medium text-gray-900">Nombre</label>
        <input type="text" name="nombre" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte nombre" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="tipo" class="mb-2 block font-medium text-gray-900">Tipo</label>
        <input type="text" name="tipo" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte tipo" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="capacidad" class="mb-2 block font-medium text-gray-900">Capacidad</label>
        <input type="number" name="capacidad" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte capacidad" required />
      </div>
    </div>
    <button type="submit" class="ml-5 rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white">Guardar</button>
  </form>
</x-app-layout>