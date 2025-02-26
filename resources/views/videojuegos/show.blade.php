<x-app-layout>
    {{$videojuego->titulo}}
    {{$videojuego->salida}}
    {{$videojuego->desarrolladora->nombre}}
    {{$videojuego->desarrolladora->distribuidora->nombre}}
</x-app-layout>
