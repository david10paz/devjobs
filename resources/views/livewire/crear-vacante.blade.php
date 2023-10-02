<form class="md:w-1/2 space-y-5" novalidate wire:submit.prevent='crearVacante'>
    <div>
        <x-label for="titulo" :value="__('Titulo vacante')" />
        <x-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')"
            placeholder="Escribe tu título de vacante" />
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-label for="salario" :value="__('Salario mensual')" />
        <select id="salario" wire:model="salario"
            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Selecciona un salario</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-label for="categoria" :value="__('Categoría')" />
        <select id="categoria" wire:model="categoria"
            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Selecciona una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-label for="empresa" :value="__('Empresa')" />
        <x-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"
            placeholder="Escribe el nombre de la empresa" />
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <div class="mb-2">
            <x-label for="pais" :value="__('País')" />
            <select id="pais" wire:model="pais"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Selecciona un pais</option>
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                @endforeach
            </select>
            @error('pais')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
        </div>
        <div>
            <x-label for="ciudad" :value="__('Ciudad')" />
            <select id="ciudad" wire:model="ciudad"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @if ($ciudades->count() == 0)
                    <option value="">Tienes que seleccionar antes un país</option>
                @endif
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
                @endforeach
            </select>
            @error('ciudad')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
        </div>
    </div>
    <div>
        <x-label for="ultimo_dia" :value="__('Última día para solicitar')" />
        <x-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-label for="descripcion" :value="__('Descripción puesto')" />
        <textarea id="descripcion"
            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            wire:model="descripcion" :value="old('descripcion')" placeholder="Escribe aquí tu descripción"></textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <div>
        <x-label for="imagen" :value="__('Imagen')" />
        <x-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*" />

        <div class="my-5 w-30 flex">
            @if ($imagen)
                <img src="{{ $imagen->temporaryUrl() }}" />
            @endif
        </div>

        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-button class="w-full justify-center">
        {{ __('Crear vacante') }}
    </x-button>
</form>
