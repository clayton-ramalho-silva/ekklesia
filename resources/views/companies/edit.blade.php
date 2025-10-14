@extends('layouts.app')

@section('content')

<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Empresas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar: {{ $company->nome_fantasia}}</li>
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

            <form class="form-padrao" id="form-companies-create" action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cnpj" name="cnpj" value="{{ old('cnpj', $company->cnpj) }}" required  placeholder="CNPJ">
                                @error('cnpj') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="razao_social" name="razao_social" value="{{ old('razao_social', $company->razao_social) }}" required placeholder="Razão Social">
                                @error('razao_social') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia', $company->nome_fantasia) }}" placeholder="Nome Fantasia">
                                @error('nome_fantasia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo position-relative">
                                <i class="fas fa-spinner"></i>
                                <input type="text" class="form-control floatlabel" id="cep" name="cep" value="{{ old('cep', $company->location->cep) }}" placeholder="CEP">
                                @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="logradouro" name="logradouro" value="{{ old('logradouro', $company->location->logradouro) }}" placeholder="Endereço">
                                @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="numero" name="numero" value="{{ old('numero', $company->location->numero) }}" placeholder="Número">
                                @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="complenento" name="complenento" value="{{ old('complemento', $company->location->complenento) }}" placeholder="Complemento">
                                @error('complenento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="bairro" name="bairro" value="{{ old('bairro', $company->location->bairro) }}" placeholder="Bairro">
                                @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="pais" name="pais" value="{{ old('pais', $company->location->pais) }}" placeholder="País">
                                @error('pais') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-4 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cidade" name="cidade" value="{{ old('cidade', $company->location->cidade) }}" placeholder="Cidade">
                                @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3 form-campo col-2">
                                 <div class="floatlabel-wrapper ">
                                    <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                    <select name="uf" id="uf" class="form-select active-floatlabel" >
                                        <option></option>
                                        @php
                                        echo get_estados($company->location->uf);
                                        @endphp
                                    </select>
                                    @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- <div class="col-2 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="uf" name="uf" value="{{ $company->location->uf }}" placeholder="UF">
                                @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div> --}}

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_contato" name="nome_contato" value="{{ old('nome_contato', $company->contacts->nome_contato) }}" placeholder="Nome do contato na empresa">
                                @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="email" class="form-control floatlabel" id="email" name="email" value="{{ old('email', $company->contacts->email) }}" placeholder="E-mail">
                                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-4 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="telefone" name="telefone" value="{{ old('telefone', $company->contacts->telefone)  }}" placeholder="Telefone">
                                @error('telefone') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-2 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="ramal" name="ramal" value="{{ old('ramal', $company->contacts->ramal ?? '') }}" placeholder="Ramal">
                                @error('ramal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="whatsapp" name="whatsapp" value="{{old('whatsapp', $company->contacts->whatsapp )  }}" placeholder="(Whatsapp)">
                                @error('whatsapp') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <div class="floatlabel-wrapper form-textarea">
                                    <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observações</label>
                                    <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control">{{ old('observacao', $company->observacao) }}</textarea>
                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                        </div>

                        <div class="col-9 bloco-ativo d-flex mb-3">
                            <h5>Status</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="status" {{$company->status == 'ativo' ? 'checked' : ''}}>
                                <label class="form-check-label" for="status">{{$company->status == 'ativo' ? 'Ativo' : 'Inativo' }}</label>
                            </div>
                        </div>

                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="{{ route('companies.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">
                            <p class="fw-bold text-center">Logotipo da empresa</p>
                            @php
                                $logotipo = $company->logotipo;
                                $logotipoPath = $logotipo ? asset("documents/companies/images/{$logotipo}") : "https://github.com/mdo.png";
                            @endphp


                            <input type="file" id="file-upload" class="file-input" accept="image/*" name="logotipo">
                            <div class="preview-container mb-3">
                                <img id="preview-image" src="{{ $logotipoPath }}" class="preview-image" alt="Prévia do logotipo">
                            </div>
                            <label for="file-upload" class="btn-padrao btn-select-file">Selecionar</label>


                            {{--
                            <img src="{{ $logotipoPath }}" width="150px" height="150px" alt="logotipo" class="img-thumbnail">
                            <input type="file" class="form-control mt-3" id="logotipo" name="logotipo" value="{{ $company->logotipo }}">
                            --}}

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

// Regras de validação
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

// Validação inicial
var validator = $( "#form-companies-create" ).validate();
validator.form();


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
article.container-form-create{
    box-shadow: none;
    padding: 0;
}
.fa-spinner{
    right: 26px !important;
}
</style>
@endpush