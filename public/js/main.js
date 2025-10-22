// Scripts do App
$.message = function(msg, type){

    var num    = Math.floor((Math.random() * 100000000) + 10000000),
        classe = (type == 1) ? 'msg-success' : 'msg-error',
        icon   = (type == 1) ? 'success' : 'error',
        base   = ($('.sistem-message').length > 0) ? 500 : 0;

    if(($('.sistem-message').length > 0)){

        $('.sistem-message').css('right','-100%');
        setTimeout(function(){
            $('.sistem-message').remove();
        },470);

    }

    setTimeout(function(){
        $('body').append('<div class="msg'+num+' sistem-message '+classe+'"><i class="icon-'+icon+'"></i><span>'+msg+'</span></div>');
    },0 + base);
    setTimeout(function(){
        $('.msg'+num+'').css('right','0');
    },150 + base);

    // Caso seja mensagem de erro, n�o esconde automaticamente
    //if(type == 1){

        setTimeout(function(){
            $('.msg'+num+'').css('right','-100%');
        },6000 + base);
        setTimeout(function(){
            $('.msg'+num+'').remove();
        },7000 + base);

    //}

}

let types = {
    'status[]': 'checkbox',
    'cidade': 'text',
    'uf': 'select',
    'filtro_data': 'select',
};

// Script de filtros
function get_form_filters($itens){

    let filtros   = '',
        nome      = '',
        data_name = '';

    $.each($itens, function(num, item){

        if(item.value && item.value !== 'Todos' && item.value !== 'Todas'){

            data_name = item.name;

            if(item.value === 'ativo'){
                nome = 'Ativos'
            } else if(item.value === 'inativo'){
                nome = 'Inativos'
            } else if(item.name === 'filtro_data'){
                nome = 'Últimos '+item.value+' dias';
            } else if(item.value === 'admin'){
                nome = 'Administrador';
            } else if(item.value === 'recruiter'){
                nome = 'Recrutador';
            } else if(item.name === 'ingles'){
                nome = 'Inglês: '+item.value;
            } else if(item.name === 'informatica'){
                nome = 'Informatica: '+item.value;
            } else if(item.name === 'recruiters'){
                nome = 'Recrutador: '+item.value;
            } else if(item.name === 'min_salario'){
                nome = 'Salário Min.: '+item.value;
                data_name = 'input-salario';
            } else if(item.name === 'max_salario'){
                nome = 'Salário Max.: '+item.value;
                data_name = 'input-salario';
            } else if(item.name === 'entrevistado'){
                nome = (item.value === '1') ? 'Já entrevistado' : 'Não entrevistado';
            } else if(item.name === 'cnh'){
                nome = 'CNH: '+item.value;
            } else if(item.name === 'min_age'){
                nome = 'Idade Min.: '+item.value;
            } else if(item.name === 'reservista'){
                nome = 'Reservista: '+item.value;
            } else if(item.name === 'foi_jovem_aprendiz'){
                nome = 'Reservista: '+item.value;
            } else if(item.name === 'escolaridade'){
                nome = 'Formação: '+item.value;
            } else if(item.name === 'vagas_interesse[]'){
                nome = 'Vaga: '+item.value;
            } else if(item.name === 'experiencia_profissional[]'){
                nome = 'Experiência: '+item.value;
                data_name = 'input-experiencia';
            } else {
                nome = item.value;
            }

            filtros += '<a class="bt-filtro" data-name="'+data_name+'" data-value="'+item.value+'" title="Remover filtro"><i>X</i>'+nome+'</a>';

        }

        // console.dir(num+' - '+item.name+' - '+item.value);

    });

    if(filtros === ''){
        $('.bloco-filtros-ativos').slideUp(150)
        $('.bloco-filtros-ativos span').html('');
    } else {
        $('.bloco-filtros-ativos').slideDown(150);
        $('.bloco-filtros-ativos span').html(filtros);
    }

}

$(document).on('click', '.bt-filtro', function(){

    var bt    = $(this),
        name  = bt.attr('data-name'),
        value = bt.attr('data-value'),
        num   = $('.bloco-filtros-ativos').find('a').length;

    if(num === 1){
        $('.bloco-filtros-ativos').slideUp(150)
        $('.bloco-filtros-ativos span').html('');
    }

    console.dir(num);
    console.dir(name);
    console.dir(types[name]);

    bt.hide();

    if(name === 'input-salario'){

        $('input[data-name="input-salario"]').hide();
        $('[name=min_salario]').val('').trigger('change');
        $('[name=max_salario]').val('').trigger('change');

    } else if(name === 'input-vagas'){

        var wanted_option = $('select[name="vagas_interesse[]"] option[value="'+ value +'"]');
        wanted_option.prop('selected', false);
        $('select[name="vagas_interesse[]"]').trigger('change.select2');

    } else if(name === 'input-experiencia'){

        var wanted_option = $('select[name="experiencia_profissional[]"] option[value="'+ value +'"]');
        wanted_option.prop('selected', false);
        $('select[name="experiencia_profissional[]"]').trigger('change.select2');

    } else {

        if(types[name] === 'checkbox'){
            $('input[type=checkbox][value='+value+']').prop("checked",false);
        } else {
            $('[name='+name+']').val('').trigger('change');
        }

    }

    $('.bloco-filtros').submit();

    setTimeout(function(){
        bt.remove();
    },300)

});

$(document).on('click', '.icon-error', function(){

    setTimeout(function(){
        $('.sistem-message').css('right','-100%');
    },200);
    setTimeout(function(){
        $('.sistem-message').remove();
    },500);

})

$(".btMenu").click(function(){

    if($("body").hasClass("fechado")){
        $("body").removeClass("fechado");
    } else{
        $("body").addClass("fechado");
    }

});

$(".btMenuRes").click(function(){

    if($("header").hasClass("aberto")){
        $("header").removeClass("aberto");
    } else{
        $("header").addClass("aberto");
    }

});

$('#filter-form-users').on('submit', function(e) {

    console.dir('aaa');

    e.preventDefault();
    let formData = (envio === 'filtrar') ? $(this).serialize() : '';

    get_form_filters($(this).serializeArray());

    $.ajax({
        url: "{{ route('users.index') }}",
        type: "GET",
        data: formData,
        success: function(response) {
            $('.table-container').html($(response).find('.table-container').html());
            $('.dropdown-menu').removeClass('show');
        },
        error: function(xhr, status, error) {
            console.error("Erro ao buscar dados:", error);
        }
    });

});



////////////////////////////////////////////////////////////////////////////////////////////////
/* Campo oculto CNH */
function toggleTipoCnh() {
    if($('#cnh').val() == 'Sim' || $('#cnh').val() == 'Em andamento' ) {
        $('#tipo_cnh').prop('disabled', false).prop('required', true);
        $('#tipoCnhContainer').removeClass('disabled-field');
    } else {
        $('#tipo_cnh').prop('disabled', true).prop('required', false).val('');
        $('#tipoCnhContainer').addClass('disabled-field');
    }
}

// Executa ao carregar a página (para caso de old do laravel)
toggleTipoCnh();

// Executa quando o select do CNH muda
$('#cnh').on('change', toggleTipoCnh);


/* Campo oculto filhos_sim */
function toggleFilhosSim() {
    if($('#possui_filhos').val() == 'Sim') {
        $('#filhos_sim').prop('disabled', false).prop('required', true);
        $('#filhos_qtd').prop('disabled', false).prop('required', true);
        $('#filhosSimContainer').removeClass('disabled-field');
    } else {
        $('#filhos_sim').prop('disabled', true).prop('required', false).val('');
        $('#filhos_qtd').prop('disabled', true).prop('required', false).val('');
        $('#filhosSimContainer').removeClass('disabled-field');
    }
}

// Executa ao carregar a página (para caso de old do laravel)
toggleFilhosSim();

// Executa quando o select do CNH muda
$('#possui_filhos').on('change', toggleFilhosSim);

/* Campo oculto sexo_outro */
function toggleSexoOutro() {
    if($('#sexo').val() == 'Outro') {
        $('#sexo_outro').prop('disabled', false).prop('required', true);
        $('#sexoOutroContainer').removeClass('disabled-field');
    } else {
        $('#sexo_outro').prop('disabled', true).prop('required', false).val('');
        $('#sexoOutroContainer').addClass('disabled-field');
    }
}

// Executa ao carregar a página (para caso de old do laravel)
toggleSexoOutro();

// Executa quando o select do CNH muda
$('#sexo').on('change', toggleSexoOutro);


/* Campo oculto pcd_sim */
function togglePcdSim() {
    if($('#pcd').val() == 'Sim, com laudo.' || $('#pcd').val() == 'Sim, sem laudo.') {
        $('#pcd_sim').prop('disabled', false).prop('required', true);
        $('#pcdContainer').removeClass('disabled-field');
    } else {
        $('#pcd_sim').prop('disabled', true).prop('required', false).val('');
        $('#pcdContainer').addClass('disabled-field');
    }
}

// Executa ao carregar a página (para caso de old do laravel)
togglePcdSim();

// Executa quando o select do PCD muda
$('#pcd').on('change', togglePcdSim);

////////// Tipo de beneficio
/* Campo oculto tipo_beneficio */
function toggleTipoBeneficio() {
    if($('#familia_cras').val() == 'Sim') {
        $('#tipo_beneficio').prop('disabled', false); //.prop('required', true);
        $('#tipoBeneficioContainer').removeClass('disabled-field');
    } else {
        $('#tipo_beneficio').prop('disabled', true).val(''); //.prop('required', false).val('');
        $('#tipoBeneficioContainer').addClass('disabled-field');
    }
}

// Executa ao carregar a página (para caso de old do laravel)
toggleTipoBeneficio();

// Executa quando o select do CNH muda
$('#familia_cras').on('change', toggleTipoBeneficio);






////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fundamental cursando
$('#escolaridade5').on('click', function(){

    if($(this).is(':checked')){
        $('.check-fundamental-cursando').slideDown(150);
        $('#fundamental_periodo').prop('disabled', false);
    } else {
        $('.check-fundamental-cursando').slideUp(150);
        $('#fundamental_periodo').prop('disabled', true);
    }

});

// Medio cursando
$('#escolaridade1').on('click', function(){

    if($(this).is(':checked')){
        $('.check-medio-cursando').slideDown(150);
        $('#medio_periodo').prop('disabled', false);
    } else {
        $('.check-medio-cursando').slideUp(150);
        $('#medio_periodo').prop('disabled', true);
    }

});

// Medio Tecnico Completo
$('#escolaridade6').on('click', function(){

    if($(this).is(':checked')){
        $('.check-tecnico-completo').slideDown(150);
        $('#tecnico_completo_curso').prop('disabled', false);
        $('#tecnico_completo_instituicao').prop('disabled', false);
        $('#tecnico_completo_data_conclusao').prop('disabled', false);
    } else {
        $('.check-tecnico-completo').slideUp(150);
        $('#tecnico_completo_curso').prop('disabled', true);
        $('#tecnico_completo_instituicao').prop('disabled', true);
        $('#tecnico_completo_data_conclusao').prop('disabled', true);
    }

});

// Medio Tecnico Cursando
$('#escolaridade7').on('click', function(){

    if($(this).is(':checked')){
        $('.check-tecnico-cursando').slideDown(150);
        $('#tecnico_periodo').prop('disabled', false);
    } else {
        $('.check-tecnico-cursando').slideUp(150);
        $('#tecnico_periodo').prop('disabled', true);
    }

});

// Medio Tecnico Completo
$('#escolaridade8').on('click', function(){

    if($(this).is(':checked')){
        $('.check-superior-completo').slideDown(150);
        $('#superior_completo_curso').prop('disabled', false);
        $('#superior_completo_instituicao').prop('disabled', false);
        $('#superior_completo_data_conclusao').prop('disabled', false);
    } else {
        $('.check-superior-completo').slideUp(150);
        $('#superior_completo_curso').prop('disabled', true);
        $('#superior_completo_instituicao').prop('disabled', true);
        $('#superior_completo_data_conclusao').prop('disabled', true);
    }

});


// Superior Cursando
$('#escolaridade9').on('click', function(){

    if($(this).is(':checked')){
        $('.check-superior-cursando').slideDown(150);
        $('#superior_periodo').prop('disabled', false);
    } else {
        $('.check-superior-cursando').slideUp(150);
        $('#superior_periodo').prop('disabled', true);
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


///////////////////////////////
// Numeros de telefone celular deve ser diferente do de recado
document.addEventListener('DOMContentLoaded', function() {
    const celularInput = document.getElementById('telefone_celular');
    const recadoInput = document.getElementById('telefone_residencial');
    
    // Aplicar máscara de telefone
    function aplicarMascaraTelefone(input) {
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            
            // Formatação: (00) 00000-0000 ou (00) 0000-0000
            if (value.length > 2) {
                value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
            }
            if (value.length > 10) {
                value = value.substring(0, 10) + '-' + value.substring(10);
            }
            if (value.length > 9 && value.length <= 13) {
                value = value.substring(0, 9) + '-' + value.substring(9);
            }
            
            this.value = value;
        });
    }
    
    // Aplicar máscara a ambos os campos
    aplicarMascaraTelefone(celularInput);
    aplicarMascaraTelefone(recadoInput);
    
    // Validar se os telefones são diferentes
    function validarTelefonesDiferentes() {
        const celular = celularInput.value.replace(/\D/g, '');
        const recado = recadoInput.value.replace(/\D/g, '');
        
        if (celular && recado && celular === recado) {
            // Mostrar erro
            if (!document.getElementById('telefones-iguais-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.id = 'telefones-iguais-error';
                errorDiv.className = 'alert alert-danger mt-2';
                errorDiv.textContent = 'O telefone para recado deve ser diferente do telefone celular';
                
                // Inserir após o campo de recado
                recadoInput.closest('.mb-3').appendChild(errorDiv);
            }
            
            return false;
        } else {
            // Remover mensagem de erro se existir
            const errorDiv = document.getElementById('telefones-iguais-error');
            if (errorDiv) {
                errorDiv.remove();
            }
            
            return true;
        }
    }
    
    // Adicionar validação quando os campos perdem o foco
    celularInput.addEventListener('blur', validarTelefonesDiferentes);
    recadoInput.addEventListener('blur', validarTelefonesDiferentes);
    
    // Adicionar validação ao enviar o formulário
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validarTelefonesDiferentes()) {
                e.preventDefault();
                recadoInput.focus();
            }
        });
    }
});