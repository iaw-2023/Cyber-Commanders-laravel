<x-app-layout>

    <div class="block justify-center">
      <h1 class="m-4 text-4xl text-center font-extrabold leading-none tracking-tight">{{$pelicula->nombre}}</h1>
    </div>

    <div class="m-4 text-2l text-left font-bold leading-none tracking-tight">
        <h2>Duracion : {{$pelicula->duracion}} Minutos</h2>
    </div>

    <div class="flex w-full justify-center items-center">
        <img class="object-center" name='poster' src="{{$pelicula->poster}}"> 
        
    </div>
    
</x-app-layout>