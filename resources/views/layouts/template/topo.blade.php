
<div class="topo-main">

    <div class="buscar">

        @php
            $route = \Route::getCurrentRoute();
            
            $rota = $route->getName();
            //dd($rota);
            
            $isEditRoute = strpos($rota, '.edit') !== false;

            $additionalHideRoutes = [
                'interviews.interviewResume',
                'interviews.show'
                // Você pode adicionar outras rotas especiais aqui se necessário
            ];
            //$shouldHideSearch = $isEditRoute || 'interviews.interviewResume';
            $shouldHideSearch = $isEditRoute || in_array($rota, $additionalHideRoutes);

            $placeholderBusca = '';
            if ($rota === 'resumes.index' || $rota === 'interviews.index') {
                $placeholderBusca = 'Busca por nome (sem restrição de idade)';
            } else {
                $placeholderBusca = 'Buscar';
            }
        @endphp

        @if (!$shouldHideSearch)
            <form action="{{ route($rota) }}" class="formulario-busca">
                <input type="hidden" name="form-path" value="">
                <input type="text" name="form_busca" value="{{ isset($form_busca) && $form_busca !== '' ?  $form_busca : ''}}" placeholder="{{ $placeholderBusca }}"/>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </button>
            </form>
            
        @endif
    </div>

    <div class="rtop">

        <div class="notificacao">


                <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                    <style type="text/css">
                        .st0{
                            fill:none;
                            stroke:#000000;
                            stroke-width:2;
                            stroke-linecap:round;
                            stroke-linejoin:round;
                            stroke-miterlimit:10;
                        }
                    </style>
                    <path class="st0" d="M27.8,23.2l-1.1-1.7c-1.9-2.8-2.9-6.1-2.9-9.5c0-3.6-2.4-6.5-5.6-7.5C17.9,3.6,17,3,16,3s-1.9,0.6-2.2,1.5
                          c-3.2,1-5.6,3.9-5.6,7.5c0,3.4-1,6.7-2.9,9.5l-1.1,1.7C3.7,24,4.2,25,5.2,25h21.6C27.8,25,28.3,24,27.8,23.2z"></path>
                    <path class="st0" d="M20,25c0,2.2-1.8,4-4,4s-4-1.8-4-4"></path>
                </svg>

            <span class="countNot">5</span>

            <div class="notificacaoLista">
                <ul>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                    <li>Lucas adicionou um novo curriculo</li>
                </ul>
            </div>


        </div>

        <div class="usuario">
            @php
                $fotoUser = Auth::user()->image;
                $fotoPath = $fotoUser ? asset("documents/users/image/{$fotoUser}") : asset('img/image-not-found.png');
            @endphp

                <figure>
                    <img src="{{ $fotoPath }}"/>

                </figure>

            <span>
                        <b>{{ Auth::user()->name }}</b>
                        <em>{{ Auth::user()->role }}</em>
                    </span>

            </div>

    </div>

</div>