@extends('layouts.app')



@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('ministerios.index') }}">Ministérios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('ministerios.index');
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

            <h4 class="fw-normal mb-4">Cadastro de Ministério</h4>

            <form class="form-padrao" id="form-ministerios-create" action="{{ route('ministerios.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                        <div class="col-9 py-0 pe-5 form-l">
                            <div class="row">

                                <div class="col-6 form-campo">
                                    <div class="mb-3">
                                        <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" value="{{ old('nome')}}">
                                        @error('nome') <div class="alert alert-danger">{{ $message }}</div> @enderror

                                    </div>
                                </div>

                                <!-- Departamentos -->
                                <div class="col-6 form-campo">
                                    <div class="mb-3">
                                        <div class="floatlabel-wrapper ">
                                            <label for="departamento" class="label-floatlabel" class="form-label floatlabel-label">Departamento</label>
                                            <select name="departamento" id="departamento" class="form-select active-floatlabel" >
                                                <option></option>
                                                <option value="Administrativo" {{ old('departamento') == 'Administrativo' ? 'selected' : ''}}> Administrativo</option>
                                                <option value="Eclesiástico" {{ old('departamento') == 'Eclesiástico' ? 'selected' : ''}}> Eclesiástico</option>
                                                <option value="Outro" {{ old('departamento') == 'Outro' ? 'selected' : ''}}> Outro</option>                                            
                                            </select>
                                            @error('departamento') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Lideres -->
                                <div class="col-12 form-campo">
                                    <div class="mb-3">
                                        <div class="floatlabel-wrapper ">
                                            <label for="lideres" class="label-floatlabel" class="form-label floatlabel-label">Lider</label>
                                            <select name="lideres[]" id="lideres" class="form-select active-floatlabel" multiple="multiple">
                                                @foreach ($membros as $membro)
                                                    <option value="{{$membro->id}}" {{ old('lideres') == $membro->id ? 'selected' : ''}}> {{ $membro->nome }}</option>                                               
                                                @endforeach
                                                
                                            </select>
                                            @error('lideres') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>                                    
                                </div>  

                                <!-- Participantes -->
                                <div class="col-12 form-campo participantes">
                                        <div class="mb-3">
                                            <div class="floatlabel-wrapper ">
                                                <label for="participantes" class="label-floatlabel" class="form-label floatlabel-label">Participantes</label>
                                                <select name="participantes[]" id="participantes" class="form-select active-floatlabel" multiple="multiple">
                                                    @foreach ($membros as $membro)
                                                        <option value="{{$membro->id}}" {{ old('participantes') == $membro->id ? 'selected' : ''}}> {{ $membro->nome }}</option>                                               
                                                    @endforeach
                                                    
                                                </select>
                                                @error('participantes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div> 
                                </div>  

                                <h4 class="fw-normal mb-4 mt-4">Descrição</h4>
                                <div class="col-12 form-campo">
                                    <div class="mb-3">
                                        <textarea id="descricao" name="descricao" class="form-control">{{ old('descricao')}} </textarea>
                                        @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                    
                                    </div>
                                </div>


                                
                            </div>
                        </div>                      
                        
                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                            <a href="{{ route('resumes.index')}}" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
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
    selector: '#descricao',
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

$('#lideres').select2({
        //placeholder: 'Todas as cidades (selecione para filtrar)',        
        width: '100%',
        closeOnSelect: true,
        allowClear: true
    });

$('#participantes').select2({
    //placeholder: 'Todas as cidades (selecione para filtrar)',        
    width: '100%',    
    closeOnSelect: true,
    allowClear: true
});

$('#departamento').select2({
    placeholder: "Selecione",
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


/* Css do multiple select */

.select2-container--default .select2-selection--multiple .select2-selection__choice{
    display: flex;
    width: fit-content;
    height: 30px;
    align-items: center;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    height: 30px;
    display: flex;
    align-items: center;
}

.select2-container--default.select2-container--focus .select2-selection--multiple{
    border: solid #cacaca 1px;
    min-height: 70px !important;
    
}
.select2-container .select2-selection--multiple{
    min-height: 70px !important;
}

.participantes .select2-container--default.select2-container--focus .select2-selection--multiple{
    border: solid #cacaca 1px;
    min-height: 200px !important;
    
}
.participantes .select2-container .select2-selection--multiple{
    min-height: 200px !important;
}


.select2-container--default .select2-selection--multiple{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
    border: solid #cacaca 1px;
}

.select2-container .select2-selection--multiple .select2-selection__rendered{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
    width: fit-content
}

.select2-container--default .select2-search--inline .select2-search__field{
    height: 30px;
    display: flex;
    box-shadow: none !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__clear{
    display: none;
}
    </style>
@endpush