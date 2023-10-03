<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidatos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mt-4">
                    <h1 class="text-4xl font-bold text-center mb-10">Candidatos: <span
                            class="text-gray-500 font-extrabold">{{ $vacante->titulo }}</span></h1>
                    <div class="md:flex md:justify-center p-5">
                        <ul class="divide-y divide-gray-200 w-full">
                            @if ($vacante->candidatos->count() > 0)
                                @foreach ($vacante->candidatos as $candidato)
                                    <div class="flex items-center mr-2 mt-2">
                                        <div class="flex-1">
                                            <p class="text-xl font-medium text-gray-800">{{ $candidato->user->name }}
                                            </p>
                                            <p class="text-sm font-normal text-gray-600">{{ $candidato->user->email }}
                                            </p>
                                            <p class="text-sm font-normal text-gray-600">Día que se presentó:
                                                {{ $candidato->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="mr-5">
                                            <a href="{{ asset('storage/cv/' . $candidato->cv) }}" target="_blank"
                                                rel="norefferer noopener"
                                                class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">Ver
                                                CV</a>
                                        </div>
                                        <div class="mr-5">
                                            <a href="tel:{{ $candidato->user->phone }}" target="_blank"
                                                class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-white bg-green-500 hover:bg-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                                </svg>

                                                <span class="ml-2 font-bold">Llamar a candidato</span>
                                            </a>
                                        </div>
                                        <div>
                                            <form
                                                action="{{ route('candidatos.rechazar', ['vacante' => $vacante->id, 'user' => $candidato->user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-white bg-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    <span class="ml-2 font-bold">Rechazar</span>

                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="p-3 text-center text-sm text-gray-600">No hay candidatos por el momento</p>
                            @endif

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
