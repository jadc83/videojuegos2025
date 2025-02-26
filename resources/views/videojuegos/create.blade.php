<x-app-layout>

    <div class="flex justify-center items-center">
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('videojuegos.store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="mb-5">

                <x-input-label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Denominacion
                </x-input-label>
                <x-text-input name="titulo" type="text" id="titulo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :value="old('titulo')" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />

            </div>

            <div class="mb-5">
                <x-input-label for="salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Fecha de salida
                </x-input-label>
                <x-text-input name="salida" type="date" id="salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    :value="old('salida')" />
                <x-input-error :messages="$errors->get('salida')" class="mt-2" />
            </div>

            <select class="form-select mt-1 block w-full" name="desarrolladora_id" id="desarrolladora">
                <option value="">Seleccione una desarrolladora</option>
                @foreach ($desarrolladoras as $desarrolladora)
                    <option value="{{ $desarrolladora->id }}" {{ old('desarrolladora_id') == $desarrolladora->id ? 'selected' : '' }}>
                        {{ $desarrolladora->nombre }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('desarrolladora_id')" class="mt-2" />


            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Crear
            </button>

        </form>
    </div>

</x-app-layout>
