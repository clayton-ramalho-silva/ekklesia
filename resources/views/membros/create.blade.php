@extends('layouts.app')



@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('membros.index') }}">Membros</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('membros.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>



 @if (session('danger'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg width="30px" height="30px" style="margin-bottom: 10px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>danger</title>
                <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                    <g id="error-copy" fill="#ffffff" transform="translate(42.666667, 42.666667)">
                        <path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M240.64,213.333333 L293.973333,160 L272,138.026667 L218.666667,191.36 L165.333333,138.026667 L143.36,160 L196.693333,213.333333 L143.36,266.666667 L165.333333,288.64 L218.666667,235.306667 L272,288.64 L293.973333,266.666667 L240.64,213.333333 Z" id="Shape">
                        </path>
                    </g>
                </g>
            </svg>
          <div>
            {{ session('danger') }}
          </div>
        </div>
    @endif

<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <h4 class="fw-normal mb-4">Cadastro de Membro</h4>

            <form class="form-padrao" id="form-membros-create" action="{{ route('membros.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-12 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" value="{{ old('nome')}}">
                                    @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror

                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf" value="{{ old('cpf')}}" placeholder="CPF">
                                    <div id="cpf-error" class="d-none alert alert-danger"></div>
                                    @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg" placeholder="RG" value="{{ old('rg')}}" >
                                    @error('rg') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>                              

                            <!-- Data de Nascimento -->
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                        <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento')}}" >
                                        @error('data_nascimento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>                                                      

                            <!-- Estado Civil -->
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                        <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" >
                                            <option></option>
                                            <option value="Solteiro" {{ old('estado_civil') == 'Solteiro' ? 'selected' : ''}}> Solteiro</option>
                                            <option value="Casado" {{ old('estado_civil') == 'Casado' ? 'selected' : ''}}> Casado</option>
                                            <option value="Divorciado" {{ old('estado_civil') == 'Divorciado' ? 'selected' : ''}}> Divorciado</option>
                                            <option value="Viúvo" {{ old('estado_civil') == 'Viúvo' ? 'selected' : ''}}> Viúvo</option>                                            
                                        </select>
                                        @error('estado_civil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>                                                     

                            {{-- Possui Filhos? --}}
                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                                        <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" >
                                            <option></option>
                                            <option value="Sim" {{ old('possui_filhos') == 'Sim' ? 'selected' : ''}}> Sim</option>
                                            <option value="Não" {{ old('possui_filhos') == 'Não' ? 'selected' : ''}}> Não</option>
                                        </select>
                                        @error('possui_filhos') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                             <!-- Campo de filhos_sim (inicialmente oculto) -->
                             <div class="col-4 form-campo" id="filhosSimContainer" >
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                         <input type="number" class="floatlabel form-control" id="filhos_qtd" name="filhos_qtd"  placeholder="Quantidade dos filhos?" value="{{ old('filhos_qtd')}}" disabled>
                                        @error('filhos_qtd') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 form-campo" id="filhosSimContainer" >
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                         <input type="text" class="floatlabel form-control" id="filhos_idade" name="filhos_idade"  placeholder="Qual a idade dos filhos?" value="{{ old('filhos_idade')}}" disabled>
                                        @error('filhos_idade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            

                             {{-- Gênero  --}}
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                        <select name="sexo" id="sexo" class="form-select active-floatlabel" >
                                            <option></option>
                                            <option value="Mulher" {{ old('sexo') == 'Mulher' ? 'selected' : ''}}> Feminino</option>                                            
                                            <option value="Homem" {{ old('sexo') == 'Homem' ? 'selected' : ''}}> Masculino</option>                                            
                                        </select>
                                        @error('sexo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>                                                                           

                            <h4 class="fw-normal mb-4 mt-4">Endereço</h4>

                            <div class="col-4 form-campo">
                                <div class="mb-3 position-relative">
                                    <i class="fas fa-spinner"></i>
                                    <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep" value="{{ old('cep')}}" >
                                    @error('cep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-8 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro" value="{{ old('logradouro')}}" >
                                    @error('logradouro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-3 form-campo">
                                <div class="mb-2">
                                    <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero" value="{{ old('numero')}}" >
                                    @error('numero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-4 form-campo">
                                <div class="mb-2">
                                    <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento" value="{{ old('complemento')}}" >
                                    @error('complemento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-5 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro" value="{{ old('bairro')}}" >
                                    @error('bairro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" value="{{ old('cidade')}}" >
                                    @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <div class="floatlabel-wrapper ">
                                    <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                    <select name="uf" id="uf" class="form-select active-floatlabel" >
                                        <option></option>
                                        @php
                                        echo get_estados(old('uf'));
                                        @endphp
                                    </select>
                                    @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                           
                            <h4 class="fw-normal mb-4 mt-4">Informações Contato</h4>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email" value="{{ old('email')}}" >
                                    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Telefone Celular(Whatsapp)" class="floatlabel form-control" id="telefone_celular" value="{{ old('telefone_celular')}}" name="telefone_celular" >
                                    @error('telefone_celular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Telefone para recado" class="floatlabel form-control" id="telefone_residencial" value="{{ old('telefone_residencial')}}" name="telefone_residencial" >
                                    @error('telefone_residencial') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Nome para recado" class="floatlabel form-control" id="nome_contato" value="{{ old('nome_contato')}}" name="nome_contato" >
                                    @error('nome_contato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" value="{{ old('instagram')}}" name="instagram">
                                    @error('instagram') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                           <h4 class="fw-normal mb-4 mt-4">Informações Eclesiásticas</h4>

                           <!-- Data de Conversão -->
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Conversão</label>
                                        <input type="date" class="form-control active-floatlabel" id="data_conversao" name="data_conversao" value="{{ old('data_conversao')}}" >
                                        @error('data_conversao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div> 

                            <!-- Data de Batismo -->
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Batismo</label>
                                        <input type="date" class="form-control active-floatlabel" id="data_batismo" name="data_batismo" value="{{ old('data_batismo')}}" >
                                        @error('data_batismo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div> 

                            <!-- Data de Membresia -->
                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper ">
                                        <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Membresia</label>
                                        <input type="date" class="form-control active-floatlabel" id="data_membresia" name="data_membresia" value="{{ old('data_membresia')}}" >
                                        @error('data_membresia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div> 

                            <h4 class="fw-normal mb-4 mt-4">Observações</h4>
                            <div class="col-12 form-campo">
                                <div class="mb-3">
                                    <textarea id="observacao" name="observacao" class="form-control">{{ old('observacao')}} </textarea>
                                    @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                  
                                </div>
                            </div>

                            <h4 class="fw-normal mb-4 mt-4">Cargos, Ministérios e Departamentos</h4>


                           

                        </div>

                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                            <a href="{{ route('resumes.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">
                        
                            <div class="mb-3 d-flex flex-column align-items-center">
                                <p class="fw-bold text-center">Foto Membro</p>

                                <input type="file" id="foto_membro" class="file-input" accept="image/*" name="foto_membro">
                                <div class="preview-container mb-3">
                                    <img id="preview_foto_membro" src="{{ asset('img/image-not-found.png') }}" class="preview_foto_membro" alt="Prévia Foto Membro">
                                </div>
                                <label for="foto_membro" class="btn-padrao btn-select-file">Selecionar</label>
                                
                                @error('foto_membro') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                <span class="mensagem-arquivo">O arquivo deve ter o tamanho máximo de 2MB.</span>
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
  tinymce.init({
    selector: '#observacao',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Aug 19, 2025:
      //'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    uploadcare_public_key: '10e8044b08f0e6ccb529',
  });
</script>








<script>
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

document.addEventListener("DOMContentLoaded", function () {

    // Upload Foto Membro
    document.getElementById('foto_membro').addEventListener('change', function(event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_foto_membro').src = e.target.result; // Atualiza a imagem
        };
        reader.readAsDataURL(file);

    });
   
});

$('#uf').select2({
    placeholder: "Selecione",
});
$('#estado_civil').select2({
    placeholder: "Selecione",
});
$('#possui_filhos').select2({
    placeholder: "Selecione",
});
$('#sexo').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});



$('#rg').mask('00.000.000-A');
$('#cep').mask('00000-000');
$('#telefone_celular').mask('(00) 00000-0000');
$('#telefone_residencial').mask(SPMaskBehavior, spOptions);

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

                    $.message('CEP enválido, por favor verifique o número informado', 2);

                } else {

                    $.message('CEP não encontrado, por favor verifique o número informado', 2);

                }

            }
        });

    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        //nome:"required",
        //cpf:"required",
        //cnh:"required",
        //data_nascimento:"required",
        // nacionalidade:"required",
        // estado_civil:"required",
        // reservista:"required",
        // possui_filhos:"required",
        // sexo:"required",
        // pcd:"required",
        // cep:"required",
        // logradouro:"required",
        // numero:"required",
        // escolaridade:"required",
        // complemento:"required",
        // bairro:"required",
        // cidade:"required",
        // uf:"required",
        // email:"required",
        // telefone_celular:"required",
        // telefone_residencial:"required",
        // nome_contato:"required",
        // foi_jovem_aprendiz:"required",
        //informatica:"required",
        //ingles:"required",
        //cras:"required",
        //fonte:"required"        
        //rg:"required",
        //tamanho_uniforme:"required",
    }
});


// Função para validar CPF
function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/[^\d]/g, '');
    
    // Verifica se tem 11 dígitos
    if (cpf.length !== 11) {
        return false;
    }
    
    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (/^(\d)\1+$/.test(cpf)) {
        return false;
    }
    
    // Validação do primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digitoVerificador1 = resto === 10 || resto === 11 ? 0 : resto;
    
    if (digitoVerificador1 !== parseInt(cpf.charAt(9))) {
        return false;
    }
    
    // Validação do segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digitoVerificador2 = resto === 10 || resto === 11 ? 0 : resto;
    
    return digitoVerificador2 === parseInt(cpf.charAt(10));
}

// Aplicar validação ao campo CPF
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');
    
    // Validação quando o formulário for enviado
    $('form').submit(function(event) {
        const cpf = $('#cpf').val();
        
        if (!validarCPF(cpf)) {
            event.preventDefault();
            // Adiciona classe de erro e mensagem
            $('#cpf').addClass('is-invalid');
            
            // Verifica se já existe uma mensagem de erro
            if ($('#cpf-error').length === 0) {
                $('#cpf').after('<div id="cpf-error" class="alert alert-danger">CPF inválido. Por favor, verifique.</div>');
            }
            return false;
        } else {
            // Remove mensagens de erro se o CPF for válido
            $('#cpf').removeClass('is-invalid');
            $('#cpf-error').remove();
        }
    });
    
    // Validação em tempo real (opcional)
    $('#cpf').on('blur', function() {
        const cpf = $(this).val();
        
        // Só valida se o campo estiver completo
        if (cpf.length === 14) {
            if (!validarCPF(cpf)) {
                $(this).addClass('is-invalid');
                if ($('#cpf-error').length === 0) {
                    $(this).after('<div id="cpf-error" class="alert alert-danger">CPF inválido. Por favor, verifique.</div>');
                }
            } else {
                $(this).removeClass('is-invalid');
                $('#cpf-error').remove();
            }
        }
    });
});



</script>
@endpush


@push('css-custom')
<style>

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
    text-align: center;
    margin-top: 15px;
}

.preview-image {
    display: block;
    max-width: 200px;
    max-height: 200px;
    width: auto;
    height: auto;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

/* Estilo para documentos */
.preview-doc {
    text-align: center;
    font-size: 14px;
    color: #333;
    margin-top: 10px;
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

/*Botãos submit e cancelar*/
.btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}


        /*Cabeçario*/
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

article.container-form-create{
    box-shadow: none;
    padding: 0;
}

    </style>
@endpush