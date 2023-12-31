<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{ $vacante->titulo }}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa:
                <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Último día para postularse:
                <span class="normal-case font-normal">{{ $vacante->ultimo_dia }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoría:
                <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario:
                <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
            @php
                $pais = DB::table('paises')
                    ->where('id', $vacante->ciudad->paises_id)
                    ->first();
            @endphp
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Pais:
                <span class="normal-case font-normal">{{ $pais->name }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Ciudad:
                <span class="normal-case font-normal">{{ $vacante->ciudad->name }}</span>
            </p>

        </div>
    </div>

    <div class="md:grid md:grid-cols-6 p-4 my-10 gap-4">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" />
        </div>

        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripción del puesto</h2>
            <p> {{ $vacante->descripcion }}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>¿Desear presentarte a esta canditatura? <a href="{{ route('login') }}"><span
                        class="text-indigo-600 font-bold">Obten una cuenta o regístrate
                        para poder postularte a esta oferta</span></a></p>
        </div>
    @endguest

    @auth
        {{-- Si son developers pueden postularse a una vacante --}}
        @if (auth()->user()->rol == 1)
            <p class="text-lg">Numero de candidatos presentados a esta vacante: <span
                    class="font-bold">{{ $numeroCandidatosVacante }}</span></p>
            @if ($candidatoPresentado == false)
                <livewire:postular-vacante :vacante="$vacante" />
            @else
                <div class="border border-green-500 bg-green-100 text-green-800 font-bold uppercase p-2 mt-2 text-sm">
                    Usted ya está presentado a esta candidatura de vacante
                </div>
            @endif
        @endif
    @endauth

</div>
