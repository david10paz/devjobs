<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
        @if ($vacantes->count() > 0)
            @foreach ($vacantes as $vacante)
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between">
                    <div class="space-y-3">
                        <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                            {{ $vacante->titulo }}
                        </a>
                        <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                        <p class="text-sm text-gray-500 font-bold">Último día: {{ $vacante->ultimo_dia }}</p>
                    </div>
                    <div class="flex gap-3 items-center mt-5 md:mt-0">
                        <a href="{{ route('candidatos.index', $vacante->id) }}"
                            class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">{{$vacante->candidatos->count()}} Candidatos</a>
                        <a href="{{ route('vacantes.edit', $vacante->id) }}"
                            class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                        <button wire:click="$emit('alertaEliminarVacante', {{$vacante->id}})"
                            class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-sm text-gray-500 font-bold flex p-5">No hay vacantes que mostrar</p>
        @endif
    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        window.Livewire.on('alertaEliminarVacante', vacanteId => {

            Swal.fire({
                title: '¿Estás seguro?',
                text: "No vas a poder recuperar la vacante",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, borralo!'
            }).then((result) => {
                if (result.isConfirmed) {

                    //eliminamos la vacante
                    Livewire.emit('eliminarVacante', vacanteId)

                    Swal.fire(
                        '¡Eliminado!',
                        'Tu vacante ha sido elimanada correctamente',
                        'success'
                    )
                }
            })
        })
    });
</script>
