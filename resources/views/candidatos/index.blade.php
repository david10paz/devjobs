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
                    <h1 class="text-4xl font-bold text-center mb-10">Candidatos: <span class="text-gray-500 font-extrabold">{{ $vacante->titulo }}</span></h1>
                    <div class="md:flex md:justify-center p-5">
                        <ul class="divide-y divide-gray-200 w-full">
                            @if ($vacante->candidatos->count() > 0)
                                @foreach ($vacante->candidatos as $candidato)
                                <div class="flex items-center">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{$candidato->user->name}}</p>
                                        <p class="text-sm font-normal text-gray-600">{{$candidato->user->email}}</p>
                                        <p class="text-sm font-normal text-gray-600">Día que se presentó: {{$candidato->created_at->diffForHumans()}}</p>
                                    </div>
                                    <div>
                                        <a href="{{asset('storage/cv/' . $candidato->cv)}}" target="_blank" rel="norefferer noopener" class="inline-flex items-center shadow-sm px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">Ver CV</a>
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
