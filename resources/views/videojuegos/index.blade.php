<x-app-layout>
    <div class="flex-col">
        <!-- Filtros y búsqueda -->
        <div class="mb-2 mx-auto w-8/12 mt-4">
            <form method="GET" action="{{ route('videojuegos.index') }}" class="mb-4 flex items-center gap-4">
                <!-- Ordenar -->
                <div class="flex flex-col">
                    <label for="orden" class="text-sm">Ordenar</label>
                    <select name="orden" id="orden" class="form-input w-52" onchange="this.form.submit()">
                        <option value="">Ordenar</option>
                        <option value="distribuidora_asc" {{ request('orden') == 'distribuidora_asc' ? 'selected' : '' }}>
                            Distribuidora (Z-A)
                        </option>
                        <option value="distribuidora_desc" {{ request('orden') == 'distribuidora_desc' ? 'selected' : '' }}>
                            Distribuidora (A-Z)
                        </option>
                        <option value="desarrolladora_asc" {{ request('orden') == 'desarrolladora_asc' ? 'selected' : '' }}>
                            Desarrolladora (Ascendente)
                        </option>
                        <option value="desarrolladora_desc" {{ request('orden') == 'desarrolladora_desc' ? 'selected' : '' }}>
                            Desarrolladora (Descendente)
                        </option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Tabla de videojuegos -->
        <div>
            @if ($videojuegos->count() > 0)
                <table class="w-8/12 mx-auto mt-4 text-sm text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3 text-center">Titulo</th>
                            <th class="px-6 py-3 text-center">Fecha de salida</th>
                            <th class="px-6 py-3 text-center">Desarrolladora</th>
                            <th class="px-6 py-3 text-center">Distribuidora</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($videojuegos as $videojuego)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


                                <!-- Titulo del videojuego -->
                                <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-white">
                                    <a href="{{ route('videojuegos.show', $videojuego) }}">{{ $videojuego->titulo }}</a>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $videojuego->salida }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $videojuego->desarrolladora->nombre }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    {{ $videojuego->desarrolladora->distribuidora->nombre }}
                                </td>

                                <td class="px-6 py-4 text-center flex justify-between">
                                    <form action="{{ route('videojuegos.show', $videojuego) }}" method="GET">
                                        @csrf
                                        <x-primary-button>Detalles</x-primary-button>
                                    </form>
                                    <form action="{{ route('videojuegos.edit', $videojuego) }}" method="GET">
                                        @csrf
                                        <x-primary-button>Editar</x-primary-button>
                                    </form>
                                    <form action="{{ route('videojuegos.destroy', $videojuego) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <x-primary-button>Borrar</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-gray-500 mt-4">No hay videojuegos disponibles.</p>
            @endif
        </div>

        <!-- Botón nuevo videojuego -->
        <div class="flex justify-center w-full mt-4">
            <form action="{{ route('videojuegos.create') }}" method="GET">
                <x-primary-button>Nuevo videojuego</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
