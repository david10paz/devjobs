<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
    @if ($vacantes->count() > 0)
        @foreach ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between">
                <div class="space-y-3">
                    <a href="#" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500 font-bold">Último día: {{ $vacante->ultimo_dia }}</p>
                </div>
                <div class="flex gap-3 items-center mt-5 md:mt-0">
                    <a href="#"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Candidatos</a>
                    <a href="#"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                    <a href="#"
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</a>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-sm text-gray-500 font-bold flex p-5">No hay vacantes que mostrar</p>
    @endif
</div>

<div class="mt-10">
    {{$vacantes->links()}}
</div>
