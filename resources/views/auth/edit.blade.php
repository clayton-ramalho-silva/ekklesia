@extends('layouts.app')

@section('content')

<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar: {{ $user->name }}</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('users.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <h4 class="fw-normal mb-4">Cadastro do usuário</h4>

            <!-- Exibir mensagens de erro -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        <b>Erro de cadastro</b>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Formulário de Cadastro -->
            <form action="{{ route('users.update', $user) }}" class="form-padrao" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="mb-3 col-6 form-campo">
                                <input type="text" class="form-control floatlabel" placeholder="Nome" id="name" name="name" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3 col-6 form-campo">
                                <input type="email" class="form-control floatlabel" placeholder="E-mail" id="email" name="email" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3 col-6 form-campo" style="position: relative">
                                <input type="password" class="form-control floatlabel" placeholder="Senha" id="password" name="password">
                                <span onclick="togglePasswordVisibility('password')" style="position:absolute; top:50%; right:50px; transform:translateY(-50%); cursor:pointer;">
                                    <!-- Olho aberto -->
                                    <svg id="eye-open-password" xmlns="http://www.w3.org/2000/svg" class="feather feather-eye" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="20" height="20">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>

                                    <!-- Olho fechado -->
                                    <svg id="eye-off-password" xmlns="http://www.w3.org/2000/svg" class="feather feather-eye-off" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="20" height="20" style="display:none;">
                                        <path d="M17.94 17.94A10.97 10.97 0 0112 20C5 20 1 12 1 12a21.77 21.77 0 014.22-5.91"/>
                                        <path d="M22.54 9.46A11 11 0 0123 12s-4 8-11 8a10.97 10.97 0 01-5.66-1.66"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                </span>
                            </div>

                            <div class="mb-3 col-6 form-campo" style="position: relative">
                                <input type="password" class="form-control floatlabel" placeholder="Confirme a Senha" id="password_confirmation" name="password_confirmation">
                                <span onclick="togglePasswordVisibility('password_confirmation')" style="position:absolute; top:50%; right:50px; transform:translateY(-50%); cursor:pointer;">
                                    <!-- Olho aberto -->
                                    <svg id="eye-open-password_confirmation" xmlns="http://www.w3.org/2000/svg" class="feather feather-eye" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="20" height="20">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>

                                    <!-- Olho fechado -->
                                    <svg id="eye-off-password_confirmation" xmlns="http://www.w3.org/2000/svg" class="feather feather-eye-off" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" width="20" height="20" style="display:none;">
                                        <path d="M17.94 17.94A10.97 10.97 0 0112 20C5 20 1 12 1 12a21.77 21.77 0 014.22-5.91"/>
                                        <path d="M22.54 9.46A11 11 0 0123 12s-4 8-11 8a10.97 10.97 0 01-5.66-1.66"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                </span>
                            </div>
                            <!-- Adicione um texto informativo -->
                            <div class="col-12">
                                <small class="text-muted">
                                    🔒 Deixe os campos de senha em branco para manter a senha atual
                                </small>
                            </div>

                            <div class="mb-3">
                                <div class="floatlabel-wrapper required">
                                    <label for="role" class="label-floatlabel" class="form-label floatlabel-label">Papel do Usuário</label>
                                    <select name="role" id="role" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <option value="recruiter" {{$user->role == 'recruiter' ? 'selected' : '' }}>Recrutador</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Administrador</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-9 bloco-ativo d-flex mb-3">
                            <h5>Status</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="status" {{$user->status == '1' ? 'checked' : ''}}>
                                <label class="form-check-label" for="status">{{$user->status == '1' ? 'Ativo' : 'Inativo' }}</label>
                            </div>
                        </div>

                        <div class="col-9 d-flex bloco-submit mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="{{ route('users.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">
                            <p class="fw-bold text-center">Foto</p>
                            <input type="file" id="file-upload" class="file-input" accept="image/*" name="image">
                            <div class="preview-container mb-3">
                                @if ($user->image)
                                    <img id="preview-image" src="{{ asset("documents/users/image/".$user->image) }}" class="preview-image" alt="Prévia da imagem">
                                @else
                                    <img id="preview-image" src="{{ asset('img/image-not-found.png') }}" class="preview-image" alt="Sem imagem">
                                @endif
                            </div>
                            <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>

                            @error('logotipo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>


                    {{-- <div class="col-3 border-start py-0 ps-5">

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            @php
                                $fotoUser = $user->image;
                                $fotoPath = $fotoUser ? asset("documents/users/image/{$fotoUser}") : "https://github.com/mdo.png";
                            @endphp
                            <img src="{{ $fotoPath }}" alt="mdo" width="50" height="50" class="rounded-circle">

                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                    </div> --}}

                </div>

            </form>

        </div>

    </article>

</section>
@endsection

@push('scripts-custom')

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/floatlabels.min.js') }}"></script>
<script>
// Regras de validação
$('#role').select2({
    placeholder: "Selecione",
});

// Regras de validação
$(".form-padrao").validate({
    rules:{
        name: "required",
        email: {required: true, email:true}
    }
});

document.getElementById('file-upload').addEventListener('change', function(event) {
    if (event.target.files.length === 0) {
        return; // Sai da função se nenhum arquivo for selecionado
    }

    const file = event.target.files[0]; // Obtém o arquivo selecionado

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview-image').src = e.target.result; // Atualiza a imagem
    };
    reader.readAsDataURL(file);

});

var validator = $( ".form-padrao" ).validate();
validator.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})

document.addEventListener('DOMContentLoaded', function() {
    const senhaFields = ['password', 'password_confirmation'];
    
    senhaFields.forEach(function(fieldId) {
        const field = document.getElementById(fieldId);
        const senhaOriginal = field.value;
        
        // Mostra apenas 8 asteriscos
        field.value = '*'.repeat(8);
        
        // Quando o usuário focar, limpa o campo
        field.addEventListener('focus', function() {
            if (this.value === '*'.repeat(8)) {
                this.value = '';
            }
        });
        
        // Se sair sem digitar nada, volta para os asteriscos
        field.addEventListener('blur', function() {
            if (this.value === '') {
                this.value = '*'.repeat(8);
            }
        });
        
        // Antes de submeter, se ainda são os asteriscos, mantém senha original
        field.closest('form').addEventListener('submit', function() {
            if (field.value === '*'.repeat(8)) {
                field.value = senhaOriginal;
            }
        });
    });
});


function togglePasswordVisibility(fieldId) {
        const input = document.getElementById(fieldId);
        const eyeOpen = document.getElementById('eye-open-' + fieldId);
        const eyeOff = document.getElementById('eye-off-' + fieldId);

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.style.display = 'none';
            eyeOff.style.display = 'inline';
        } else {
            input.type = 'password';
            eyeOpen.style.display = 'inline';
            eyeOff.style.display = 'none';
        }
    }
</script>
</script>
@endpush


@push('css-custom')
<style>
article.container-form-create{
    box-shadow: none;
    padding: 0;
}


/* Esconde o input original */
.file-input {
    display: none;
}

/* Estiliza o botão */
.file-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

/* Efeito hover */
.file-label:hover {
    background-color: #0056b3;
}

/* Estiliza o texto do nome do arquivo */
.file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}

/* Estiliza a prévia da imagem */
.preview-container {
    width: 100%;
    text-align: center;
    margin-top: 15px;
}
.preview-image {
    display: block;
    max-height: 230px;
    width: 100%;
    height: auto;
    padding: 3px;
    box-sizing: border-box;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    aspect-ratio: 3 / 3;
}

.btn-select-file{
    cursor: pointer;
    height: 38px;
    padding: 12px 20px !important;
    background-color: gray;
}

.btn-select-file:hover{
    background-color: #a7a7a7;
}
        .btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}

.breadcrumb-item{
    font-size: 23px;
    font-weight: 500;
}

.breadcrumb-item a{

    color: grey !important;
}

.breadcrumb-item.active{
    color: #009cff !important;
}
</style>
@endpush