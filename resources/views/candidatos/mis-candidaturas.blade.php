<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidaturas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mt-4">
                    <h1 class="text-4xl font-bold text-center mb-10">Candidaturas de: <span
                            class="text-gray-500 font-extrabold">{{ auth()->user()->name }}</span></h1>
                    <div class="md:flex md:justify-center p-5">
                        <ul class="divide-y divide-gray-200 w-full">
                            @if (count($vacantes_solicitadas) > 0)
                                @foreach ($vacantes_solicitadas as $vacante_solicitada)
                                    <div class="flex items-center mr-2 mt-2">
                                        <div class="flex-1">
                                            <a class="text-3xl font-extrabold text-gray-600"
                                            href="{{ route('vacantes.show', $vacante_solicitada->id) }}">
                                            <p class="text-xl font-medium text-gray-800">
                                                {{ $vacante_solicitada->titulo }}
                                            </p>
                                            </a>
                                            <p class="text-sm font-normal text-gray-600">
                                                {{ $vacante_solicitada->empresa }}
                                            </p>
                                        </div>
                                        @if ($vacante_solicitada->rechazado == 0)
                                            <div class="mr-5">
                                                <div
                                                    class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-white bg-yellow-500 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="ml-2 font-bold">Pendiente</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mr-5">
                                                <div
                                                    class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-white bg-red-700 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    <span class="ml-2 font-bold">Rechazado</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <p class="p-3 text-center text-sm text-gray-600">No hay candidaturas por el momento</p>
                            @endif

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
