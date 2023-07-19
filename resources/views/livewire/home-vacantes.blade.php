<div>

    @livewire('filtrar-vacantes')

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12"><u>Nuestras vacantes disponibles</u></h3>

            <div class="bg-white shadow-sm rounded-lg p-6 divide-y divide-gray-200">
                @if ($vacantes->count() > 0)
                    @foreach ($vacantes as $vacante)
                        <div class="md:flex md:justify-between md:items-center py-5">
                            <div>
                                <a class="text-3xl font-extrabold text-gray-600" href="{{ route('vacantes.show', $vacante->id) }}">{{$vacante->titulo}}</a>
                                <p class="text-base text-gray-600 mb-2">{{$vacante->empresa}}</p>
                                <p class="text-xs font-bold text-gray-600 mb-2">{{$vacante->categoria->categoria}}</p>
                                <p class="text-xs font-bold text-gray-600 mb-2">{{$vacante->salario->salario}}</p>
                                <p class="text-base text-gray-600">Último día para postularse: <span class="font-bold">{{$vacante->ultimo_dia}}</span></p>
                            </div>
                            <div>
                                <a class="bg-teal-500 p-3 text-sm font-bold text-white rounded-lg uppercase block text-center mt-5 md:mt-0"
                                    href="{{ route('vacantes.show', $vacante->id) }}">Ver vacante</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-gray-500 font-bold flex p-5">No hay vacantes que mostrar</p>
                @endif
            </div>
        </div>
    </div>

</div>
