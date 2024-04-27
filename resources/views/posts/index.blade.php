{{-- Componentes como plantillas --}}
<x-app-layout>
    <x-slot name="title">
        Posts
    </x-slot-title>

    {{-- Componentes anonimos --}}
    <x-container class="mt-4" width="4xl">
        <x-alert>
            <x-slot name="title"> Aquí se mostrarán los posts</x-slot>
            Proximamente se mostrarán actualizados...
        </x-alert>
    </x-container>

    {{-- @php
        $type = 'success';
    @endphp --}}

    {{-- Componentes de clases --}}
    {{-- <div class="container mx-auto mt-10"> --}}
        {{-- <h1 class="text-center font-bold mb-4">Aquí se mostrarán los posts</h1> --}}
        
        {{-- <x-alert type="info" class="pl-20"> type se define en el componente y class al no ser llamado desde el componente se establece como atributo --}}
            {{-- slot con nombre 👇 --}}
            {{-- <x-slot name="title">
                Mensaje:
            </x-slot> --}}
            {{-- slot principal 👇 --}}
            {{-- Proximamente se mostrarán actualizados... --}}
        {{-- </x-alert> --}}
        {{-- ...
        <x-alert type="danger">
            <x-slot name="title">
                Mensaje de error:
            </x-slot>
            No se logro cargar los posts...
        </x-alert>
        ... --}}
        {{-- <x-alert :type="$type"> opción 1 y recomendada --}}
        {{-- <x-alert type="{{ $success }}"> --}} {{-- opción 2 --}}
            {{-- <x-slot name="title">
                Mensaje:
            </x-slot>
            Todo va bien --}}
        {{-- </x-alert> --}}
    {{-- </div> --}}

    {{-- Directiba @include --}}
    {{-- @include('prueba', ['color' => 'rojo', 'num' => 1])
    @includeIf('prueba2')
    @includeWhen(true, 'prueba', ['color' => 'amarillo', 'num' => 2])
    @includeWhen(false, 'prueba', ['color' => 'azul', 'num' => 3])
    @includeUnless(false, 'prueba', ['color' => 'morado', 'num' => 4])
    @includeUnless(true, 'prueba', ['color' => 'Rosado', 'num' => 5])
    @includeFirst(['prueba2', 'prueba', 'posts.create'], ['color' => 'verde', 'num' => 6]) --}}

    {{-- Atributos adicionales --}}
    {{-- <form action="">
        <div>
            <label><input type="checkbox" name="paises[]" @checked(true)>Perú</label>
            <label><input type="checkbox" name="paises[]" @checked(false)>Colombia</label>
            <label><input type="checkbox" name="paises[]">Chile</label>
            <label><input type="checkbox" name="paises[]">Argentina</label>
        </div>
        <div>
            <select name="ciudad">
                <option value="">Todas las ciudades</option>
                <option value="medellin">Medellín</option>
                <option value="bogota" @selected(true)>Bogotá</option>
                <option value="cali">Cali</option>
                <option value="barranquilla">Barranquilla</option>
                <option value="cartagena">Cartagena</option>
            </select>
        </div>
        <div>
            <input type="text" @readonly(true) @required(false)>
            <input type="text" @readonly(false) @required(true)>
        </div>
        <button @disabled(true)>Enviar</button>
    </form> --}}

    {{-- Directiva @class --}}
    {{-- <ul>
        @foreach ($posts as $post)
            <li @class([
                'color-red' => $loop->first,
                'color-green' => $loop->last
            ])>
                <h2>{{ $post['title'] }}</h2>
            </li>
        @endforeach
    </ul> --}}

    {{-- Variable $loop --}}
    {{-- <ul>
        @foreach ($posts as $post)
            <li>
                <h4>
                    {{ $post['title'] }} - Iteración {{ $loop->iteration }} - Indice {{ $loop->index }} - Iteraciones restantes {{ $loop->remaining }}
                    
                    @if($loop->first)
                        (Primera iteración)
                    @endif
                        
                    @if($loop->last)
                        (Última itereación)
                    @endif
                </h4>
    
                <ul>
                    @foreach ($post['tags'] as $tag)
                        <li>
                            {{ $tag }}
                            
                            @if ($loop->parent->first)
                                (Le pertenece al primer post)
                            @endif

                            @if ($loop->parent->last)
                                (Le pertenece al último post)
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul> --}}

    {{-- Directiva @continue --}}
    {{-- @for ($i = 1; $i <= $count; $i++) --}}
        
        {{-- opción 1 y recomendada --}}
        {{-- @continue($i % 3 == 0) --}}
        {{-- opción 2 --}}
        {{-- @if ($i % 3 == 0)
            @continue
        @endif --}}
        
        {{-- <p>{{ $i }}</p>
    @endfor --}}

    {{-- Directiva @break --}}
    {{-- @for ($i = 1; $i <= $count; $i++) --}}
        {{-- opción 1 y recomendada --}}
        {{-- @break($i == 5) --}}
        {{-- opción 2 --}}
        {{-- @if ($i == 5)
            @break
        @endif --}}

        {{-- <p>{{ $i }}</p>
    @endfor --}}

    {{-- Directiva @for --}}
    {{-- @for ($i = 1; $i <= $count; $i++)
        <p>
            @for ($j = 1; $j <= $i; $j++)
                *
            @endfor
        </p>
    @endfor --}}

    {{-- Directiva @while --}}
    {{-- @php
        $i = 0;
    @endphp

    @while ($count >=  $i)
        <p>*</p>
        @php
            $i++;
        @endphp
    @endwhile    --}}

    {{-- Directiva @forelse --}}
    {{-- @forelse ($post as $post)
        <li>
            <h2>{{ $post['title'] }}</h2>
            <p>{{ $post['content'] }}</p>
        </li>
    @empty
        <p>No hay posts para mostrar...</p>
    @endforelse --}}

    {{-- Directiva @foreach --}}
    {{-- <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post['title'] }}</h2>
                <p>{{ $post['content'] }}</p>
            </li>
        @endforeach
    </ul> --}}

    {{-- Directiva @switch --}}
    {{-- @switch($dia)
        @case(1)
            <p>Lunes</p>
            @break
        @case(2)
            <p>Martes</p>
            @break
        @case(3)
            <p>Miercoles</p>
            @break
        @case(4)
            <p>Jueves</p>
            @break
        @case(5)
            <p>Viernes</p>
            @break
        @case(6)
            <p>Sabado</p>
            @break
        @case(7)
            <p>Domingo</p>
            @break
        @default
            <p>No es un diá de la semana</p>
    @endswitch --}}

    {{-- Directivas @env @production --}}
    {{-- @env('local')
        <p>Estamos en local</p>
    @endenv

    @env('production')
        <p>Estamos en producción 1.0</p>
    @endenv
    @production
        <p>Estamos en producción 2.0</p>
    @endproduction --}}

    {{-- Directivas Condicionales --}}
    {{-- @if (true)
        <p>Este mensaje se mostrará si el valor de la condicional es verdadero.</p>
    @else
        <p>Este mensaje se mostrará si el valor de la condicional es falso.</p>
    @endif

    @unless (false)
        <p>Le has pasado el valor de false a la directiva unless.</p>
    @endunless

    @isset($marca)
        <p>La variable existe y tiene un valor asignado</p>
    @else
        <p>La variable no existe o no tiene un valor asignado.</p>
    @endisset

    @empty($post45)
        <p>La variable no existe o no tiene un valor asignado.</p>
    @endempty --}}

    {{-- <script>
        let posts_1 = {!! json_encode($posts) !!};
        let posts_2 = @json($posts); // forma recomendada para interactuar con blade y js
        console.log(posts_2);
    </script> --}}

    {{-- forma de mostrar variables en blade -> Escapado automático --}}
    {{-- {{ $tag1 }} --}}
    {{-- <p>---------</p> --}}
    {{-- forma de mostrar variables en blade -> Sin escapado --}}
    {{-- {!! $tag2 !!} --}}

    {{-- forma para evitar el conflicto y asegurarte si estás trabajando con un framework de JavaScript 
        que también utiliza la sintaxis de blade, dicho código de js no se vea afectado --}}
    {{-- <script>
        var appData = {
            name: "@{{ $name }}",
            age: {{ $age }},
            // Otros datos
        };
    </script> --}}
</x-app-layout>