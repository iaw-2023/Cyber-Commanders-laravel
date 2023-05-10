<x-app-layout>
  <form method="POST" action="{{route('store_extra')}}">
    @csrf
    <div class="bg flex justify-center">
      <h1 class="m-4 text-4xl font-extrabold leading-none tracking-tight">Nuevo Extra</h1>
    </div>
    <div class="m-2 flex flex-wrap">
      <div class="m-3 w-1/3">
        <label for="producto" class="mb-2 block font-medium text-gray-900">Producto</label>
        <input type="text" name="producto" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte producto" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="tamaño" class="mb-2 block font-medium text-gray-900">Tamaño</label>
        <input type="text" name="tamaño" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte tamaño" required />
      </div>
      <div class="m-3 w-1/3">
        <label for="precio" class="mb-2 block font-medium text-gray-900">Precio</label>
        <input type="number" name="precio" class="block w-full border border-gray-400 p-2.5" placeholder="Inserte precio" required />
      </div>
    </div>
    <button type="submit" class="ml-5 rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white">Guardar</button>
  </form>
</x-app-layout>