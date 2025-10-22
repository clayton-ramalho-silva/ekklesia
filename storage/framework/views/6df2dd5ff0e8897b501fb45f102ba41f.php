<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('resumes.index')); ?>">Currículos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Currículo: <?php echo e($resume->informacoesPessoais->nome); ?> </li>          
        </ol>
      </nav>
      

      
      <?php
          // Guarda a rota na variável
          $rota = route('resumes.index');
      ?>

      <?php if (isset($component)) { $__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.voltar','data' => ['rota' => $rota]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('voltar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rota' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rota)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8)): ?>
<?php $attributes = $__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8; ?>
<?php unset($__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8)): ?>
<?php $component = $__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8; ?>
<?php unset($__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8); ?>
<?php endif; ?>
      

      
</section>   


<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                <?php if(!$resume->interview): ?>         
                    <!--<div class="box-entrevistar"> -->
                        <a href="<?php echo e(route('interviews.interviewResume', $resume)); ?>#form-interview"  class="link-entrevista d-flex align-items-center" >Iniciar Entrevista</a>       
                    <!--</div>-->   
                 <?php endif; ?>
            </div>
            <?php if(!$resume->jobs()->exists()): ?>
            <div class="col">
                 <!-- Button trigger modal -->
                <button type="button" class="btn-padrao btn-associar-vaga" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Associar a uma vaga
                </button>
                <?php echo $__env->make('components.modal-associar-vaga', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endif; ?>
            
            
            <?php if(Auth::user()->role === 'admin'): ?>
            <div class="col">

                <form action="<?php echo e(route('resumes.destroy', $resume)); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-padrao btn-cancelar ms-3 d-flex align-items-center justify-content-center" 
                            onclick="return confirm('Tem certeza que deseja deletar este currículo? Esta ação não pode ser desfeita.')" 
                            id="delete-resume">
                        Deletar Currículo
                    </button>
                </form>

            </div>
            <?php endif; ?>
        </div>
    </div>

</section>



<section class="sessao">
    
    
    <article class="f1 container-form-create">

        <div class="container">

            <div class="row form-padrao">
                <div class="col-12 py-0 pe-5 form-1">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between mb-4">
                            <h4 class="fw-normal">Cadastro de Currículo</h4>

                            
                            <p class="fw-bold">Data do cadastro: <?php echo e($resume->created_at->format('d/m/Y')); ?></p>
                        </div>
                        
                    </div>
                    
                     
                     
                            
                    <?php if (isset($component)) { $__componentOriginal866ebe14907986e2fb699d5fd31e02df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal866ebe14907986e2fb699d5fd31e02df = $attributes; } ?>
<?php $component = App\View\Components\StatusButton::resolve(['resume' => $resume,'status' => $resume->status] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\StatusButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal866ebe14907986e2fb699d5fd31e02df)): ?>
<?php $attributes = $__attributesOriginal866ebe14907986e2fb699d5fd31e02df; ?>
<?php unset($__attributesOriginal866ebe14907986e2fb699d5fd31e02df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal866ebe14907986e2fb699d5fd31e02df)): ?>
<?php $component = $__componentOriginal866ebe14907986e2fb699d5fd31e02df; ?>
<?php unset($__componentOriginal866ebe14907986e2fb699d5fd31e02df); ?>
<?php endif; ?>                                           
                             
                    
                    
                    
                   
        
                       
                    <form class="form-padrao" id="form-companies-create" action="<?php echo e(route('resumes.update', $resume)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>                 
                        <?php if (isset($component)) { $__componentOriginal33c22dec070d9318081ec87c1cb417f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal33c22dec070d9318081ec87c1cb417f1 = $attributes; } ?>
<?php $component = App\View\Components\ResumeEditForm::resolve(['resume' => $resume,'editResume' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('resume-edit-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ResumeEditForm::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal33c22dec070d9318081ec87c1cb417f1)): ?>
<?php $attributes = $__attributesOriginal33c22dec070d9318081ec87c1cb417f1; ?>
<?php unset($__attributesOriginal33c22dec070d9318081ec87c1cb417f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal33c22dec070d9318081ec87c1cb417f1)): ?>
<?php $component = $__componentOriginal33c22dec070d9318081ec87c1cb417f1; ?>
<?php unset($__componentOriginal33c22dec070d9318081ec87c1cb417f1); ?>
<?php endif; ?>
                    </form>
                    
                   
                </div>
                
                 
                <div class="col-12 border-top py-0 ps-5 form-r bloco-obs pt-5">                   
        
                    <div class="row mb-3 mt-3 bloco-observacoes">
        
                        <div class="card">
                            <div class="card-header bg-transparent">
                            <p>Observações:</p>
                            </div>
                            <div class="card-body">
                                <?php if($resume->observacoes->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $resume->observacoes->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $observacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p class="card-text"><b><?php echo e($observacao->created_at->format('d/m/y')); ?></b> - <?php echo e($observacao->observacao); ?> </p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    Nenhuma observação.
                                <?php endif; ?>
        
                            </div>
                        </div>
        
                    </div>
        
        
                    <div class="row">
        
                        <form class="form-padrao d-flex justify-content-center" action="<?php echo e(route('resumes.storeHistory', $resume->id)); ?>" method="post">
        
                            <?php echo csrf_field(); ?>
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Escreva sua observação</label>
                                <textarea name="observacao" id="observacao" class="form-control"></textarea>
                            </div>
                            <button class="btn-padrao btn-cadastrar mt-3" type="submit">Salvar</button>
        
                        </form>
        
                    </div>
        
                </div>
                
            </div>
            
        </div>

    </article>
    

    
    <?php if (isset($component)) { $__componentOriginala3dc08c5fc233bb4b25ec30d53cddeee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3dc08c5fc233bb4b25ec30d53cddeee = $attributes; } ?>
<?php $component = App\View\Components\ResumeJobsTable::resolve(['resume' => $resume] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('resume-jobs-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ResumeJobsTable::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3dc08c5fc233bb4b25ec30d53cddeee)): ?>
<?php $attributes = $__attributesOriginala3dc08c5fc233bb4b25ec30d53cddeee; ?>
<?php unset($__attributesOriginala3dc08c5fc233bb4b25ec30d53cddeee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3dc08c5fc233bb4b25ec30d53cddeee)): ?>
<?php $component = $__componentOriginala3dc08c5fc233bb4b25ec30d53cddeee; ?>
<?php unset($__componentOriginala3dc08c5fc233bb4b25ec30d53cddeee); ?>
<?php endif; ?>

    

   
    
    <?php if (isset($component)) { $__componentOriginald400731abb2b6ff1e362e8a62a9793de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald400731abb2b6ff1e362e8a62a9793de = $attributes; } ?>
<?php $component = App\View\Components\ResumeSelectionsTable::resolve(['resume' => $resume] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('resume-selections-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ResumeSelectionsTable::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald400731abb2b6ff1e362e8a62a9793de)): ?>
<?php $attributes = $__attributesOriginald400731abb2b6ff1e362e8a62a9793de; ?>
<?php unset($__attributesOriginald400731abb2b6ff1e362e8a62a9793de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald400731abb2b6ff1e362e8a62a9793de)): ?>
<?php $component = $__componentOriginald400731abb2b6ff1e362e8a62a9793de; ?>
<?php unset($__componentOriginald400731abb2b6ff1e362e8a62a9793de); ?>
<?php endif; ?>
      

</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts-custom'); ?>
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.mask.js')); ?>"></script>
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


    // Upload Foto Candidato
    document.getElementById('foto_candidato').addEventListener('change', function(event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_foto_candidato').src = e.target.result; // Atualiza a imagem
        };
        reader.readAsDataURL(file);

    });



    // Upload Curriculo
    document.getElementById('file-upload').addEventListener('change', function (event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        // Verifica se o arquivo é um PDF
        if (file.type !== "application/pdf") {
            alert("Por favor, selecione um arquivo PDF.");
            event.target.value = ""; // Limpa o campo
            return;
        }

        // Atualiza a prévia do documento
        document.getElementById("file-name").textContent = file.name;
        document.getElementById("file-download").href = URL.createObjectURL(file);
        document.getElementById("preview-doc").style.display = "block";
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
$('#cnh').select2({
    placeholder: "Selecione",
});
$('#tipo_cnh').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});
$('#tamanho_uniforme').select2({
    placeholder: "Selecione",
});
$('#nacionalidade').select2({
    placeholder: "Selecione",
});
$('#pcd').select2({
    placeholder: "Selecione",
});
$('#reservista').select2({
    placeholder: "Selecione",
});

// $('#fundamental_periodo').select2({
//     placeholder: "Selecione",
// });
// $('#medio_periodo').select2({
//     placeholder: "Selecione",
// });
// $('#tecnico_periodo').select2({
//     placeholder: "Selecione",
// });

// $('#superior_periodo').select2({
//     placeholder: "Selecione",
// });

$('#fundamental_select_periodo, #fundamental_select_modalidade, #medio_select_periodo, #medio_select_modalidade, #tecnico_select_periodo, #tecnico_select_modalidade, #superior_select_periodo, #superior_select_modalidade, #outro_select_periodo, #outro_select_modalidade ').select2({
    placeholder: "Selecione",
});

$('#rg').mask('00.000.000-A');
$('#cpf').mask('000.000.000-00');
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
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            url : "<?php echo e(url('getCep')); ?>",
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

$('#escolaridade3').on('click', function(){

    if($(this).is(':checked')){
        $('.check-escolaridade').slideDown(150);
        $('#escolaridade_outro').prop('disabled', false);
    } else {
        $('.check-escolaridade').slideUp(150);
        $('#escolaridade_outro').prop('disabled', true);
    }

});

$('#experiencia_profissional10').on('click', function(){

    console.dir('aaa');

    if($(this).is(':checked')){
        $('.check-experiencia').slideDown(150);
        $('#experiencia_profissional_outro').prop('disabled', false);
    } else {
        $('.check-experiencia').slideUp(150);
        $('#experiencia_profissional_outro').prop('disabled', true);
    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        // escolaridade:"required",
        // nome:"required",
        // email:"required",
        // rg:"required",
        // cpf:"required",
        // telefone_celular:"required",
        // telefone_residencial:"required",
        // nome_contato:"required",
        // data_nascimento:"required",
        // estado_civil:"required",
        // possui_filhos:"required",
        // sexo:"required",
        // cnh:"required",
        // cep:"required",
        // logradouro:"required",
        // numero:"required",
        // complemento:"required",
        // bairro:"required",
        // cidade:"required",
        // uf:"required",
        // informatica:"required",
        // ingles:"required",
        // tamanho_uniforme:"required",
    }
});

// Validação inicial
var validator = $( ".form-padrao" ).validate();
validator.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})


// Atualização de status
function updateStatus(newStatus) {
    const statusInput = document.getElementById('statusInput');
    
    // Se for mudar para inativo, pede confirmação especial
    if (newStatus === 'inativo') {
        if (!confirm("Se o currículo estiver associado a alguma vaga, será automaticamente desassociado. Deseja continuar?")) {
            return false; // Cancela se o usuário não confirmar
        }
    }
    
    // Atualiza o valor do campo hidden
    statusInput.value = newStatus;
    
    // Envia o formulário
    document.getElementById('statusForm').submit();
    
    return true;
}


</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css-custom'); ?>
<style>
/*Botãos submit e cancelar*/
.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.link-entrevista{
    margin-bottom: 15px;
    padding: 10px 30px;
    background-color: #ff9d0a;
    color: #fff;
    border-radius: 30px;
    transition: ease-in-out all 0.5s;
}

.link-entrevista:hover{
    background-color: #ffab2e;
    color: #fff;    
}

.table-container.lista-processos-seletivos .col4,
.table-container.lista-processos-seletivos .col5{
    width: 10%;
}

.table-container.lista-processos-seletivos .col6{
    width: 5%;
}

.form-padrao .bloco-obs .bloco-observacoes .card-text{
    font-size: 15px !important;
    color: #333 !important; 
    font-weight: 400 !important;
}

.form-padrao .bloco-obs .bloco-observacoes .card-text b{
    font-size: 13px !important;
    color: #287FC0 !important; 
    font-weight: bold !important;
}


.status-ativo,
.status-ativo:hover{
color: #fff;    
background-color: gray !important;
}

.status-ativo.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(94, 94, 94) !important;
}



.status-processo,
.status-processo:hover {
    color: #000; 
background-color: yellow !important;
}
.status-processo.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(228, 228, 0) !important;
}

.status-contratado,
.status-contratado:hover{
    color: #fff; 
background-color: green !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(0, 105, 0) !important;
}


.status-inativo,
.status-inativo:hover{
    color: #fff; 
    background-color: red !important;
}

.status-contratado.dropdown-toggle-split:hover{
color: #fff;    
background-color: rgb(225, 0, 0) !important;
}


.dropdown-menu.show{
    z-index: 9999;
}

.status-aberta{
    background-color: #ffff00 !important;
}
.status-fechada{
    background-color: #008000 !important;
}
.status-espera{
    background-color: #808080 !important;
}
.status-cancelada{
    background-color: #ff0000 !important;
}


</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/resumes/edit.blade.php ENDPATH**/ ?>