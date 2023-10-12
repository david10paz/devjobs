<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mt-4">
                    <h1 class="text-4xl font-bold text-center mb-10">Mis notificaciones</h1>

                    <div class="divide-y divide-gray-200 w-full">
                        @if ($notificaciones->count() > 0)
                            @foreach ($notificaciones as $notificacion)
                                <div class="p-5 lg:flex lg:justify-between lg:items-center">
                                    <div>
                                        @php
                                            $usuario = DB::table('users')->select('name', 'email')->where('id', $notificacion->data['usuario_id'])->first();    
                                        @endphp
                                        <p>Tienes un nuevo candidato <span class="font-bold">({{$usuario->name}} - {{$usuario->email}})</span> <br/> en <span
                                                class="font-bold">{{ $notificacion->data['nombre_vacante'] }}</span></p>
                                        <p><span
                                                class="font-bold text-gray-600">{{ $notificacion->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="lg:flex lg:items-center">
                                        <div class="mt-5 lg:mt-0 mr-3">
                                            <a href="{{ route('candidatos.index', ['vacante' => $notificacion->data['id_vacante'], 'notificacion' => $notificacion->id]) }}"
                                                class="bg-teal-500 p-3 text-sm font-bold text-white rounded-lg uppercase">Ver
                                                candidato</a>
                                        </div>
                                        <div class="mt-5 lg:mt-0">
                                            <form
                                                action="{{ route('notificacion.destroy', ['notificacion' => $notificacion->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 p-3 text-sm font-bold text-white rounded-lg uppercase">
                                                    Eliminar notificación
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-gray-600">No hay notificaciones</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
