<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xk font-bold my-4">Postularme a esta vacante</h3>


    @if (session()->has('mensaje'))
        <div class="border border-green-500 bg-green-100 text-green-700 font-bold uppercase p-2 mt-2 text-sm">
            {{ session('mensaje') }}
        </div>
    @else
        <form wire:submit.prevent='postularme' class="w-96 mt-5">
            <div class="mb-4">
                <x-label for="cv" :value="__('Curriculum Vitae (PDF)')" />
                <x-input id="cv" wire:model='cv' class="block mt-1 w-full" type="file" accept=".pdf" />
            </div>

            @error('cv')
                <livewire:mostrar-alerta :message="$message" />
            @enderror

            <x-button class="w-full justify-center mt-3">
                {{ __('Postularme') }}
            </x-button>
        </form>
    @endif

</div>
