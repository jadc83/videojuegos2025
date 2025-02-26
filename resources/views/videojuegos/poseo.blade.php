<x-app-layout>
    <form action="{{ route('videojuegos.comprar') }}" method="POST">
        @csrf
        <select name="videojuego_id">
            @foreach ($videojuegos as $videojuego)
                <option value="{{ $videojuego->id }}">{{ $videojuego->titulo }}</option>
            @endforeach
        </select>
        <x-primary-button>Lo tengo</x-primary-button>
    </form>
</x-app-layout>
