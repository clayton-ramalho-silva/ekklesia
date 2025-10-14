@extends('layouts.app')

@section('content')

<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Empresas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('companies.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <h4 class="fw-normal mb-4">Cadastro da Empresa</h4>

            <form class="form-padrao" id="form-companies-create" action=" {{route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" required placeholder="CNPJ">
                                @error('cnpj') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="razao_social" name="razao_social" value="{{ old('razao_social') }}" required placeholder="Razão Social">
                                @error('razao_social') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia') }}" placeholder="Nome Fantasia">
                                @error('nome_fantasia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo position-relative">
                                <i class="fas fa-spinner"></i>
                                <input type="text" class="form-control floatlabel" id="cep" name="cep" value="{{ old('cep') }}" placeholder="CEP">
                                @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="logradouro" name="logradouro" value="{{ old('logradouro') }}"  placeholder="Endereço">
                                @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="numero" name="numero" value="{{ old('numero') }}"  placeholder="Número">
                                @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="complenento" name="complenento" value="{{ old('complenento') }}" placeholder="Complemento">
                                @error('complenento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="bairro" name="bairro" value="{{ old('bairro') }}"  placeholder="Bairro">
                                @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="pais" name="pais" value="{{ old('pais') }}"  placeholder="País">
                                @error('pais') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-4 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cidade" name="cidade" value="{{ old('cidade') }}"  placeholder="Cidade">
                                @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-2">
                                <div class="floatlabel-wrapper ">
                                    <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                    <select name="uf" id="uf" class="form-select active-floatlabel" >
                                        <option></option>
                                        @php
                                        echo get_estados(old('uf'));
                                        @endphp
                                    </select>
                                    @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- <div class="col-2 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="uf" name="uf" value="{{ old('uf') }}" required placeholder="UF">
                                @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div> --}}

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_contato" name="nome_contato" value="{{ old('nome_contato') }}" placeholder="Nome do contato na empresa">
                                @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="email" class="form-control floatlabel" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail">
                                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-4 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="telefone" name="telefone" value="{{ old('telefone') }}" placeholder="Telefone">
                                @error('telefone') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-2 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="ramal" name="ramal" value="{{ old('ramal') }}" placeholder="Ramal">
                                @error('ramal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="(Whatsapp)">
                                @error('whatsapp') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <div class="floatlabel-wrapper form-textarea">
                                    <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observações</label>
                                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ old('observacao') }}</textarea>
                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                        </div>

                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                            <a href="{{ route('companies.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">
                            <p class="fw-bold text-center">Logotipo da empresa</p>

                            <input type="file" id="file-upload" class="file-input" accept="image/*" name="logotipo">
                            <div class="preview-container mb-3">
                                <img id="preview-image" src="{{ asset('img/image-not-found.png') }}" class="preview-image" alt="Prévia do logotipo">
                            </div>
                            <label for="file-upload" class="btn-padrao btn-select-file">Selecionar</label>

                            <!-- <img id="preview-image" src="{{ asset('img/image-not-found.png') }}" class="img-thumbnail mx-auto d-block mb-3" alt="Logotipo da empresa"> -->
                            <!-- <input type="file" class="form-control floatlabel" id="logotipo" name="logotipo"> -->

                            <!-- original
                                <label for="file-upload" class="file-label">Selecionar</label>
                                <input type="file" id="file-upload" name="logotipo" class="file-input" accept="image/*">
                                <span class="file-name">Nenhum arquivo selecionado</span>
                            -->
                            @error('logotipo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </article>

</section>
@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
$('#telefone').mask(SPMaskBehavior, spOptions);
$('#whatsapp').mask('(00) 00000-0000', {clearIfNotMatch: true});
$('#cnpj').mask('00.000.000/0000-00', {clearIfNotMatch: true});
$('#cep').mask('00000-000', {clearIfNotMatch: true});
$('#numero').mask('0000000000');

$('#uf').select2({
    placeholder: "Selecione",
});

$('#cep').on('input', function(){

    var cep     = $(this).val(),
        digitos = cep.length;

    if(digitos === 9){

        $('.fa-spinner').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url : "{{ url('getCep') }}",
            data : {'cep': cep},
            type : 'POST',
            dataType : 'json',
            success : function(result){

                $('.fa-spinner').hide();

                if(result.msg === '1'){

                    $('#cidade').val(result.cidade);
                    $('#bairro').val(result.bairro);
                    $('#uf').val(result.uf).select2();
                    $('#logradouro').val(result.rua);

                    setTimeout(function(){
                        $('.floatlabel').trigger('change');
                    }, 150)

                } else if(result.msg === '3'){

                    $.message('CEP env�lido, por favor verifique o n�mero informado', 2);

                } else {

                    $.message('CEP n�o encontrado, por favor verifique o n�mero informado', 2);

                }

            }
        });

    }

});

$("#form-companies-create").validate({
    rules:{
        cnpj:"required",
        razao_social:"required",
        // nome_fantasia:"required",
        // cep:"required",
        // logradouro:"required",
        // numero:"required",
        // bairro:"required",
        // pais:"required",
        // cidade:"required",
        // uf:"required",
        // nome_contato:"required",
        // telefone:"required",
        // whatsapp:"required",
        // email:{required: true, email:true},
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
</script>
@endpush

@push('css-custom')
<style>
/*Ajuste padding-left botão buscar no topo*/
.topo-main .buscar input{
    padding-left: 50px !important;
}
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
.fa-spinner{
    right: 26px !important;
}
</style>
@endpush