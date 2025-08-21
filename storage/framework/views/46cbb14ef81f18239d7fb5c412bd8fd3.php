<?php $__env->startSection('content'); ?>
<section class="cabecario">

    <h1>Entrevistas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroEntrevistas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-interviews" method="GET" action="<?php echo e(route('interviews.index')); ?>" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroInterview">

                <div class="row d-flex">

                    <div class="col-12 mb-3">
                        <label for="nome" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Nome do Candidato</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e(request('nome')); ?>" placeholder="Buscar por nome...">
                    </div>
                    <div class="col-6">
                        <label for="vagas_interesse" class="form-label">Vagas de Interesse</label>
                        <select name="vagas_interesse[]" id="vagas_interesse" class="form-select" multiple>
                            <?php $__currentLoopData = ['Copa & Cozinha', 'Administrativo', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)',
                                        'Construção e Reparos', 'Conservação e Limpeza']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php echo e(in_array($option, request('vagas_interesse', []))? 'selected' : ''); ?>>
                                    <?php echo e($option); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                           
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="experiencia_profissional" class="form-label">Experiência Profissional</label>
                        <select name="experiencia_profissional[]" id="experiencia_profissional" class="form-select" multiple>
                            <?php $__currentLoopData = ['Nenhuma por enquanto', 'Copa & Cozinha', 'Administrativo', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)', 'TI (Tecnologia da Informação',
                                        'Construção e Reparos', 'Conservação e Limpeza']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php echo e(in_array($option, request('experiencia_profissional', []))? 'selected' : ''); ?>>
                                    <?php echo e($option); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="ativo" <?php echo e(request('status') == 'ativo' ? 'selected' : ''); ?> > Disponível</option>
                            <option value="processo" <?php echo e(request('status') == 'processo' ? 'selected' : ''); ?>> Em processo</option>
                            <option value="contratado" <?php echo e(request('status') == 'contratado' ? 'selected' : ''); ?> > Contratado</option>
                            <option value="inativo" <?php echo e(request('status') == 'inativo' ? 'selected' : ''); ?>> Inativo</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Homem" <?php echo e(request('sexo') == 'Homem' ? 'selected' : ''); ?>> Homem</option>
                            <option value="Mulher" <?php echo e(request('sexo') == 'Mulher' ? 'selected' : ''); ?>> Mulher</option>
                            <option value="Prefiro não dizer" <?php echo e(request('sexo') == 'Prefiro não dizer' ? 'selected' : ''); ?>> Prefiro não dizer</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cnh" class="form-label">Possui CNH?</label>
                        <select name="cnh" id="cnh" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim"  <?php echo e(request('cnh') == 'Sim' ? 'selected' : ''); ?>> Sim</option>
                            <option value="Não"  <?php echo e(request('cnh') == 'Não' ? 'selected' : ''); ?>> Não</option>
                            <option value="Em andamento"  <?php echo e(request('cnh') == 'Em andamento' ? 'selected' : ''); ?>> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="min_age" class="form-label">Idade mínima:</label>
                        <input type="number" name="min_age" id="min_age" class="form-control" value="<?php echo e(request('min_age')); ?>" >
                    </div>

                    <div class="col-6">
                        <label for="reservista" class="form-label">Possui Reservista?</label>
                        <select name="reservista" id="reservista" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" <?php echo e(request('reservista') == 'Sim' ? 'selected' : ''); ?>> Sim</option>
                            <option value="Não" <?php echo e(request('reservista') == 'Não' ? 'selected' : ''); ?>> Não</option>
                            <option value="Em andamento" <?php echo e(request('reservista') == 'Em andamento' ? 'selected' : ''); ?>> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="foi_jovem_aprendiz" class="form-label">Já foi Jovem Aprendiz?</label>
                        <select name="foi_jovem_aprendiz" id="foi_jovem_aprendiz" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim, da ASPPE"  <?php echo e(request('foi_jovem_aprendiz') == 'Sim, da ASPPE' ? 'selected' : ''); ?>> Sim, da ASPPE</option>
                            <option value="Sim, de Outra Qualificadora"  <?php echo e(request('foi_jovem_aprendiz') == 'Sim, de Outra Qualificadora' ? 'selected' : ''); ?>> Sim, de Outra Qualificadora</option>
                            <option value="Não"  <?php echo e(request('foi_jovem_aprendiz') == 'Não' ? 'selected' : ''); ?>> Não</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="escolaridade" class="form-label">Formação/Escolaridade</label>
                        <select name="escolaridade" id="escolaridade" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Ensino Fundamental Completo" <?php echo e(request('escolaridade') == 'Ensino Fundamental Completo' ? 'selected' : ''); ?>> Ensino Fundamental Completo</option>
                            <option value="Ensino Fundamental Cursando" <?php echo e(request('escolaridade') == 'Ensino Fundamental Cursando' ? 'selected' : ''); ?>> Ensino Fundamental Cursando</option>
                            <option value="Ensino Médio Completo" <?php echo e(request('escolaridade') == 'Ensino Médio Completo' ? 'selected' : ''); ?>> Ensino Médio Completo</option>
                            <option value="Ensino Médio Incompleto" <?php echo e(request('escolaridade') == 'Ensino Médio Incompleto' ? 'selected' : ''); ?>>  Ensino Médio Cursando</option>
                            <option value="Ensino Técnico Completo" <?php echo e(request('escolaridade') == 'Ensino Técnico Completo' ? 'selected' : ''); ?>> Ensino Técnico Completo</option>
                            <option value="Ensino Técnico Cursando" <?php echo e(request('escolaridade') == 'Ensino Técnico Cursando' ? 'selected' : ''); ?>> Ensino Técnico Cursando</option>
                            <option value="Superior Completo" <?php echo e(request('escolaridade') == 'Superior Completo' ? 'selected' : ''); ?>> Superior Completo</option>
                            <option value="Superior Cursando" <?php echo e(request('escolaridade') == 'Superior Cursando' ? 'selected' : ''); ?>> Superior Cursando</option>
                            <option value="Outro" <?php echo e(request('escolaridade') == 'Outro' ? 'selected' : ''); ?>> Outro</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="informatica" class="form-label">Possui conhecimento no pacote Office (Excel/Word)?</label>
                        <select name="informatica" id="informatica" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" <?php echo e(request('informatica') == 'Básico' ? 'selected' : ''); ?>> Básico</option>
                            <option value="Intermediário" <?php echo e(request('informatica') == 'Intermediário' ? 'selected' : ''); ?>> Intermediário</option>
                            <option value="Avançado" <?php echo e(request('informatica') == 'Avançado' ? 'selected' : ''); ?>> Avançado</option>
                            <option value="Nenhum" <?php echo e(request('informatica') == 'Nenhum' ? 'selected' : ''); ?>> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" <?php echo e(request('ingles') == 'Básico' ? 'selected' : ''); ?>> Básico</option>
                            <option value="Intermediário" <?php echo e(request('ingles') == 'Intermediário' ? 'selected' : ''); ?>> Intermediário</option>
                            <option value="Avançado" <?php echo e(request('ingles') == 'Avançado' ? 'selected' : ''); ?>> Avançado</option>
                            <option value="Nenhum" <?php echo e(request('ingles') == 'Nenhum' ? 'selected' : ''); ?>> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select select2">
                            <option>Todas</option>
                            <?php
                            echo get_cidades($resumes, 3);
                            ?>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="data_min" class="form-label">Data Cadastro (de):</label>
                        <input type="date" name="data_min" id="data_min" class="form-control" value="<?php echo e(request('data_min')); ?>">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="data_max" class="form-label">Data Cadastro (até):</label>
                        <input type="date" name="data_max" id="data_max" class="form-control" value="<?php echo e(request('data_max')); ?>">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select select2">
                            <option value="">Todas</option>
                            <option value="7" <?php echo e(request('filtro_data') == '7' ? 'selected' : ''); ?>>Últimos 7 dias</option>
                            <option value="15" <?php echo e(request('filtro_data') == '15' ? 'selected' : ''); ?>>Últimos 15 dias</option>
                            <option value="30" <?php echo e(request('filtro_data') == '30' ? 'selected' : ''); ?>>Últimos 30 dias</option>
                            <option value="90" <?php echo e(request('filtro_data') == '90' ? 'selected' : ''); ?>>Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="ingles" class="form-label">PCD</label>
                        <select name="pcd" id="pcd" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim, com laudo." <?php echo e(request('pcd') == 'Sim, com laudo.' ? 'selected' : ''); ?>> Sim, com laudo.</option>
                            <option value="Sim, sem laudo." <?php echo e(request('pcd') == 'Sim, sem laudo.' ? 'selected' : ''); ?>> Sim, sem laudo.</option>
                            <option value="Não" <?php echo e(request('pcd') == 'Não' ? 'selected' : ''); ?>> Não</option>                            
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="ingles" class="form-label">Sua família é atendida por algum equipamento do governo?</label>
                        <select name="cras" id="cras" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" <?php echo e(request('cras') == 'Sim' ? 'selected' : ''); ?>> Sim</option>                            
                            <option value="Não" <?php echo e(request('cras') == 'Não' ? 'selected' : ''); ?>> Não</option>                            
                        </select>
                    </div>
                    

                    

                    

                    <div class="col-12 mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>
                        <a href="<?php echo e(route('interviews.index')); ?>" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

<div class="bloco-filtros-ativos">

    Filtros ativos <span></span>

</div>

<section class="sessao">

    <article class="f-interna">

        <h4>Últimos currículos</h4>

        <div class="table-container lista-entrevistas">

            <ul class="tit-lista">
                
                <li class="col-inscricao">Entrevista</li> 
                <li class="col-nome">Nome</li> 
                <li class="col-cpf">CPF</li>
                <li class="col-cnh">CNH</li>
                <li class="col-tipo_cnh">Tipo CNH</li>
                <li class="col-data_nascimento">Data de Nascimento</li>
                <li class="col-nacionalidade">Nacionalidade</li>
                <li class="col-estado_civil">Estado Civil</li>
                <li class="col-possui_filhos">Possui filhos?</li>
                <li class="col-filhos_sim">Qual idade deles?</li>
                <li class="col-genero">Gênero</li>
                <li class="col-genero_outro">Qual seu gênero?</li>
                <li class="col-pcd">PCD</li>
                <li class="col-pcd_sim">Número CID</li>
                <li class="col-reservista">Reservista</li>
                <li class="col-endereco">Endereço</li>
                <li class="col-cidade">Cidade</li>
                <li class="col-uf">UF</li>
                <li class="col-email">E-mail</li>
                <li class="col-telefone_celular">Telefone Celular</li>
                <li class="col-telefone_recado">Telefone Recado</li>
                <li class="col-nome_recado">Nome Recado</li>
                <li class="col-instagram">Instagram</li>
                <li class="col-linkedin">Linkedin</li>
                <li class="col-vaga">Tipo de vaga</li>
                <li class="col-experiencia_profissional">Experiencia Profissional</li>
                <li class="col-formacao">Formação</li>
                <li class="col-formacao_complemento">Formação Complemento</li>
                <li class="col-superior_periodo">Qual o Período?</li>
                
                <li class="col-informatica">Possui conhecimento no pacote Office (Excel/Word)?</li>
                <li class="col-ingles">Inglês</li>
                <li class="col-cras">Família atendida por algum equipamento Público?</li>
                <li class="col-tamanho_uniforme">Fonte Currículo</li>                                             
                

                
                <li class="col-idiomas">Outros idiomas?</li>
                <li class="col-apresentacao-pessoal">Apresentação Pessoal</li>
                <li class="col-saude">Saúde</li>
                <li class="col-vacina">Vacina COVID</li>
                <li class="col-jovem-aprendiz">Já foi jovem aprendiz?</li>
                <li class="col-formadora">Formadora</li>
                <li class="col-experiencia-profissional">Expreriência Profissional</li>
                <li class="col-demissao">Por qual motivo pediria demissão?</li>
                <li class="col-caracteristicas-positivas">Características Positivas</li>
                <li class="col-habilidades">Habilidades</li>
                <li class="col-pontos-melhoria">Pontos de Melhoria</li>
                <li class="col-rotina">Qual sua rotina?</li>
                <li class="col-disponibilidade-horario">Disponibilidade de Horário</li>
                <li class="col-familia">Família</li>
                <li class="col-renda_familiar">Renda Familiar</li>
                <li class="col-cras">Família recebe benefício?</li>
                <li class="col-objetivo-longo-prazo">Objetivos longo prazo</li>
                <li class="col-porque-gostaria-jovem-aprendiz">Por que ser Jovem Aprendiz?</li>
                <li class="col-fonte-curriculo">Fonte Captação Currículo</li>
                <li class="col-perfil-stacasa">Perfil Sta. Casa</li>
                <li class="col-classificacao">Classificação</li>
                <li class="col-status">Status</li>
                <li class="col-entrevistado">Entrevistado?</li>                
                <li class="col-parecer">Parecer do RH</li>
                <li class="col-obs-entrevista">Entrevistas</li>
                <li class="col-obs_rh">Observações RH</li>


                

                
            </ul>

            <?php if($resumes->count() > 0): ?>

                <?php $__currentLoopData = $resumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <ul onclick="window.open('<?php echo e(route('interviews.show', $resume->interview->id)); ?>', '_blank')" title="Ver ou Editar Entrevista">               
                
                   
                    <?php                       

                        $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                        $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                        $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';

                        //Verifica se a idade é maior que 22 anos e 8 meses
                        $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                        $limiteEmMeses = (22 * 12) + 8;
                        // dd($resume->interview->created_at->format('d/m/Y'));
                    ?>
                    <li class="col-inscricao">
                        <div class="col-icon">
                            
                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
    
                        </div>
                        <?php echo e($resume->interview->created_at->format('d/m/Y')); ?>

                    </li>
                    <li class="col-nome">                        
                        <div class="col-info">
                            <span class="info-nome">
                                <strong><?php echo e($resume->informacoesPessoais->nome ?? ''); ?></strong>
                            </span>
                            <?php if($idadeEmMeses > $limiteEmMeses): ?>
                                <p class="badge bg-danger"><?php echo e($idadeFormatada); ?></p>
                            <?php else: ?>
                                <p class="badge bg-light text-dark"><?php echo e($idadeFormatada); ?></p>
                            <?php endif; ?>

                        </div>

                    </li>
                    <li class="col-cpf">
                        <?php
                            $cpf = $resume->informacoesPessoais->cpf ?? '';
                            if ($cpf) {
                                $cpf = preg_replace('/\D/', '', $cpf);
                                if (strlen($cpf) === 11) {
                                    $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
                                }
                            }
                        ?>
                        <?php echo e($cpf); ?>

                    </li>
                    <li class="col-cnh">                       
                        <?php echo e($resume->informacoesPessoais->cnh ?? ''); ?>

                    </li>
                    <li class="col-tipo_cnh"><?php echo e($resume->informacoesPessoais->tipo_cnh ?? ''); ?></li>
                     <li class="col-data_nascimento">                        
                        <?php echo e($resume->informacoesPessoais->data_nascimento->format('d/m/Y') ?? ''); ?>

                    </li>
                    <li class="col-nacionalidade"><?php echo e($resume->informacoesPessoais->nacionalidade ?? ''); ?></li>
                     <li class="col-estado_civil"><?php echo e($resume->informacoesPessoais->estado_civil ?? ''); ?></li>
                    <li class="col-possui_filhos"><?php echo e($resume->informacoesPessoais->possui_filhos ?? ''); ?></li>
                    <li class="col-filhos_sim"><?php echo e($resume->informacoesPessoais->filhos_sim ?? ''); ?></li>
                    <li class="col-genero">
                        <?php switch($resume->informacoesPessoais->sexo):
                            case ('Mulher'): ?>
                                Feminino
                                <?php break; ?>
                            <?php case ('Homem'): ?>
                                Masculino
                            <?php break; ?>
                            <?php default: ?>
                                Outro
                                
                        <?php endswitch; ?>                       
                    </li>
                    <li class="col-genero_outro"><?php echo e($resume->informacoesPessoais->sexo_outro ?? ''); ?></li>
                    
                    <li class="col-pcd"><?php echo e($resume->informacoesPessoais->pcd ?? ''); ?></li>
                    <li class="col-pcd_sim"><?php echo e($resume->informacoesPessoais->pcd_sim ?? ''); ?></li>
                    <li class="col-reservista"><?php echo e($resume->informacoesPessoais->reservista ?? ''); ?></li>
                    <li class="col-endereco"><?php echo e($resume->contato->logradouro); ?> , <?php echo e($resume->contato->numero); ?> - <?php echo e($resume->contato->bairro); ?></li>
                    <li class="col-cidade"><?php echo e($resume->contato->cidade); ?></li>
                    <li class="col-uf"><?php echo e($resume->contato->uf); ?></li>
                    <li class="col-email">                        
                        <?php echo e($resume->contato->email ?? ''); ?>

                    </li>
                    <li class="col-telefone_celular">
                        <?php
                            $celular = $resume->contato->telefone_celular ?? '';
                            if ($celular) {
                                $celular = preg_replace('/\D/', '', $celular);
                                if (strlen($celular) === 11) {
                                    // Formato: (11) 99999-9999
                                    $celular = '(' . substr($celular, 0, 2) . ') ' . substr($celular, 2, 5) . '-' . substr($celular, 7, 4);
                                } elseif (strlen($celular) === 10) {
                                    // Formato: (11) 9999-9999 (celular antigo)
                                    $celular = '(' . substr($celular, 0, 2) . ') ' . substr($celular, 2, 4) . '-' . substr($celular, 6, 4);
                                }
                            }
                        ?>
                        <?php echo e($celular); ?>

                    </li>

                    <li class="col-telefone_recado">
                        <?php
                            $residencial = $resume->contato->telefone_residencial ?? '';
                            if ($residencial) {
                                $residencial = preg_replace('/\D/', '', $residencial);
                                if (strlen($residencial) === 10) {
                                    // Formato: (11) 3333-4444
                                    $residencial = '(' . substr($residencial, 0, 2) . ') ' . substr($residencial, 2, 4) . '-' . substr($residencial, 6, 4);
                                } elseif (strlen($residencial) === 11) {
                                    // Caso tenha 11 dígitos (com 9 na frente)
                                    $residencial = '(' . substr($residencial, 0, 2) . ') ' . substr($residencial, 2, 5) . '-' . substr($residencial, 7, 4);
                                }
                            }
                        ?>
                        <?php echo e($residencial); ?>

                    </li>
                    <li class="col-nome_recado"><?php echo e($resume->contato->nome_contato ?? ''); ?></li>
                    <li class="col-instagram"><?php echo e($resume->informacoesPessoais->instagram ?? ''); ?></li>
                    <li class="col-linkedin"><?php echo e($resume->informacoesPessoais->linkedin ?? ''); ?></li>
                    <li class="col-vaga">
                        <b>Tipo de Vaga</b>
                        
                        <?php if($resume->vagas_interesse && is_array($resume->vagas_interesse)): ?>
                            <?php $__currentLoopData = $resume->vagas_interesse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><?php echo e($vaga); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        <?php else: ?>
                            Nenhuma vaga de interesse informada.
                        <?php endif; ?>
                        
                    </li>
                    <li class="col-experiencia_profissional">
                        <b>Experiência Profissional</b>
                        
                        <?php if($resume->experiencia_profissional && is_array($resume->experiencia_profissional)): ?>
                            <?php $__currentLoopData = $resume->experiencia_profissional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experiencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><?php echo e($experiencia); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        <?php else: ?>
                            Nenhuma vaga de interesse informada.
                        <?php endif; ?>
                        
                    </li>
                    <li class="col-formacao">
                        <?php if($resume->escolaridade->escolaridade && is_array($resume->escolaridade->escolaridade)): ?>
                            <?php $__currentLoopData = $resume->escolaridade->escolaridade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($formacao); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        <?php else: ?>
                            Nenhuma formação informada.
                        <?php endif; ?>
                    </li>
                    <li class="col-formacao_complemento">
                        <?php if($resume->escolaridade->escolaridade_outro): ?>
                            <p><strong>Curso: </strong><?php echo e($resume->escolaridade->escolaridade_outro); ?></p>
                            <?php if($resume->escolaridade->semestre): ?> <p><strong>Semestre: </strong><?php echo e($resume->escolaridade->semestre); ?></p> <?php endif; ?>
                            <?php if($resume->escolaridade->instituicao): ?> <p><strong>Instituição: </strong><?php echo e($resume->escolaridade->instituicao); ?></p> <?php endif; ?>
                        <?php endif; ?>
                    </li>
                    <li class="col-superior_periodo"><?php echo e($resume->escolaridade->superior_periodo ?? ''); ?></li>
                     
                      <li class="col-informatica">
                        <b>Informática</b>
                        <?php echo e($resume->escolaridade->informatica ?? ''); ?>

                    </li>
                    <li class="col-ingles">
                        <b>Inglês</b>
                        <?php echo e($resume->escolaridade->ingles ?? ''); ?>

                    </li>
                    <li class="col-cras"><?php echo e($resume->cras ?? ''); ?></li>
                    <li class="col-tamanho_uniforme">
                        <b>Fonte Curriculo</b>
                        <?php echo e($resume->fonte ?? ''); ?>

                    </li>
                    
                    
                    
                    <li class="col-idiomas"><?php echo e($resume->interview->outros_idiomas); ?></li>
                    <li class="col-apresentacao-pessoal"><?php echo e($resume->interview->apresentacao_pessoal); ?></li>
                    <li class="col-saude"><?php echo e($resume->interview->saude_candidato); ?></li>
                    <li class="col-vacina"><?php echo e($resume->interview->vacina_covid); ?></li>
                    <li class="col-jovem-aprendiz"><?php echo e($resume->foi_jovem_aprendiz ?? ''); ?></li>
                    <li class="col-formadora"><?php echo e($resume->interview->qual_formadora); ?></li>
                    <li class="col-experiencia-profissional"><?php echo e($resume->interview->experiencia_profissional); ?></li>
                    <li class="col-demissao"><?php echo e($resume->interview->qual_motivo_demissao); ?></li>
                    <li class="col-caracteristicas-positivas"><?php echo e($resume->interview->caracteristicas_positivas); ?></li>
                    <li class="col-habilidades"><?php echo e($resume->interview->habilidades); ?></li>
                    <li class="col-pontos-melhoria"><?php echo e($resume->interview->pontos_melhoria); ?></li>
                    <li class="col-rotina"><?php echo e($resume->interview->rotina_candidato); ?></li>
                    <li class="col-disponibilidade-horario"><?php echo e($resume->interview->disponibilidade_horario); ?></li>
                    <li class="col-familia"><?php echo e($resume->interview->familia); ?></li>
                    <li class="col-renda_familiar"><?php echo e($resume->interview->renda_familiar); ?></li>
                    <li class="col-cras"><?php echo e($resume->interview->familia_cras); ?></li>
                    <li class="col-objetivo-longo-prazo"><?php echo e($resume->interview->objetivo_longo_prazo); ?></li>
                    <li class="col-porque-gostaria-jovem-aprendiz"><?php echo e($resume->interview->porque_ser_jovem_aprendiz); ?></li>
                    <li class="col-fonte-curriculo"><?php echo e($resume->interview->fonte_curriculo); ?></li>
                    <li class="col-perfil-stacasa"><?php echo e($resume->interview->perfil_santa_casa); ?></li>
                     <li class="col-classificacao"><?php echo e($resume->interview->classificacao); ?></li>
                     <li class="col-status">
                        <b>Status</b>
                        <?php switch($resume->status):
                            case ('ativo'): ?>
                                <i class="status-ativo" title="Disponível"></i>Disponível
                                <?php break; ?>
                            <?php case ('inativo'): ?>
                                <i class="status-inativo" title="Inativo"></i>Inativo
                                <?php break; ?>
                            <?php case ('processo'): ?>
                                <i class="status-em-processo" title="Em processo"></i>Em processo
                                <?php break; ?>
                            <?php case ('contratado'): ?>
                                <i class="status-contratado" title="Contratado"></i>Contratado
                                <?php break; ?>                           
                                
                        <?php endswitch; ?>
                    </li>
                    <li class="col-entrevistado">
                        <b>Entrevistado</b>
                        <?php if($resume->interview): ?>
                            <a href="<?php echo e(route('interviews.show', $resume->interview->id)); ?>" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('interviews.interviewResume', $resume)); ?>"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        <?php endif; ?>
                    </li>         
                    <li class="col-parecer"><?php echo e($resume->interview->parecer_recrutador); ?></li>   
                    <li class="col-obs-entrevista"><?php echo e($resume->interview->observacoes); ?></li>  
                    <li class="col-obs_rh"><?php echo e($resume->interview->obs_rh); ?></li>     
                    
                    
                    
                    
                    
                    
                    
                    
                    

                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
            <span class="sem-resultado">Nenhum currículo encontrado</span>
            <?php endif; ?>

        </div>
        <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper">
            <?php echo e($resumes->appends(request()->query())->links('vendor.pagination.custom')); ?>

            <p class="pagination-info">Mostrando <?php echo e($resumes->firstItem()); ?> a <?php echo e($resumes->lastItem()); ?> de <?php echo e($resumes->total()); ?> currículos</p>
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="<?php echo e(route('interviews.create')); ?>" class="btInt btCadastrar">Entrevistar <small>Realize uma entrevista</small></a>
        <?php if(Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com'): ?>
            <a href="<?php echo e(route('reports.export.interviews')); ?>" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>            
        <?php endif; ?>
        <a href="<?php echo e(route('companies.create')); ?>" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts-custom'); ?>
<script>

$(document).ready(function(){
    // Inicializa o Select2
    $('.bloco-filtros .select2').select2({
        placeholder: "Selecione",
    });

    // Botão limpar - redireciona para URL sem parâmetros
    $('button[name="limpar"]').on('click', function(e){
        e.preventDefault();
        window.location.href = "<?php echo e(route('resumes.index')); ?>";
    });

    // Atualiza filtros ativos quando a página carrega
    updateActiveFilters();
});

// Função para mostrar filtros ativos
function updateActiveFilters(){
    let params = new URLSearchParams(window.location.search);
    let activeFilters = [];
    let filtersContainer = $('.bloco-filtros-ativos span');
    filtersContainer.empty(); // Limpa os filtros anteriores

    params.forEach((value, key) => {
        // Ignora parâmetros de paginação e vazios
        if( key !== 'page' && value && value !== 'Todos' && value !== 'Todas'){
            // Para arrays (selects múltiplos)
            if (key.endsWith('[]')){
                activeFilters.push(createFilterBadge(key.replace('[]', ''), value));
            } else {
                activeFilters.push(createFilterBadge(key, value));
            }
        }
    });

    if(activeFilters.length > 0) {
        filtersContainer.append(activeFilters);
        $('.bloco-filtros-ativos').slideDown(150);
    } else {
        $('.bloco-filtros-ativos').slideUp(150);
    }
}

// Cria um badge para cada filtro com botão de remover
function createFilterBadge(key, value) {
    // Cria um elemento span para o badge
    let badge = $('<span class="filter-badge"></span>');

    // Adiciona o valor do filtro
    badge.append(document.createTextNode(value));

    // Adciona o botão de remover (x)
    let removeBtn = $('<button class="remove-filter" data-key="'+key+'" data-value="'+value+'">x</button>');
    badge.append(removeBtn);

    return badge;
}

// Remove um filtro especifico e recarrega a pagina
$(document).on('click', '.remove-filter', function(){
    let key = $(this).data('key');
    let value = $(this).data('value');
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);

    // Para filtros multiplos (array)
    if (key.endsWith('[]')){
        let currentValues = params.getAll(key);
        let newValues = currentValues.filter(v => v !== value);

        // Remove o parametro completamente se não houver mais valores
        params.delete(key);
        newValues.forEach(v => params.append(key, v));
    }
    // Para filtro simples
    else {
        params.delete(key);
    }

    // Remove também a página para voltar a primeira
    params.delete('paga');

    // Atualiza a URL e recarrega
    window.location.href = url.pathname + '?' + params.toString();

});


</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css-custom'); ?>
<style>
    td,tr{
        font-size: 12px;
    }
    .btInt{
    flex-wrap: nowrap;
}

.lista-entrevistas{
    overflow: scroll;
    height: 500px;
}

.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.link-entrevista{
    transition: all ease-in-out 0.25s;
}
.link-entrevista:hover{
    text-decoration: underline;
}

.table-container.lista-entrevistas .col5{
    justify-content: center;
    flex-direction: column;
    font-weight: 700;
    font-size: 11px;
    color: #244f77;
    text-align: center;
}





/* css paginate */
/* Em seu arquivo CSS */
.pagination-container {
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    display: block;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.2s;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #fff;
    border-color: #ddd;
}

.page-link:hover {
    background-color: #f8f9fa;
}


/* Estilo dos badges de filtro*/
.bloco-filtros-ativos {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    font-weight: 700;
    font-size: 12px;
    margin: 10px 0;
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    -ms-border-radius: 20px;
    padding: 3px 14px;
    background-color: #F2F2F2;
    letter-spacing: normal;
}

.filter-badge {
    display: inline-block;
    margin-right: 8px;   
    padding: 5px 10px;
    padding-left: 24px;
    background: #fff;
    border-radius: 15px;
    font-size: 12px;
    position: relative;
}

.remove-filter {
    margin-left: 5px;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0 5px;
    color: #ff0000;
    font-size: 15px;
    position: absolute;
    top: 3px;
    left: 0;
    font-weight: 700;
    font-family: 'Montserrat';
    line-height: 1em;
}

.remove-filter:hover {
    color: #dc3545;
}




/* css paginate */
/* Em seu arquivo CSS */
.pagination-container {
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    display: block;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.2s;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #fff;
    border-color: #ddd;
}

.page-link:hover {
    background-color: #f8f9fa;
}

.btn-cancelar{
    padding: 8px 30px;
}

/* Estilo responsivo */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
    }
    
    .page-item {
        margin-bottom: 5px;
    }
}



.table-container.lista-entrevistas {
    width: 100%;
    overflow-x: auto; /* Habilita scroll horizontal quando necessário */
    overflow-y: auto; /* Mantém o scroll vertical */
    white-space: nowrap; /* Impede que o conteúdo quebre em várias linhas */
    -webkit-overflow-scrolling: touch; /* Melhora o scroll em dispositivos móveis */
}

.tit-lista, .lista-entrevistas > ul {
    min-width: 100%; /* Garante que a largura mínima seja 100% do container */
    display: inline-block; /* Ou você pode usar display: flex */
}

/* Se estiver usando flexbox (opcional) */

.tit-lista {
    display: flex;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
}


.lista-entrevistas > ul {
    display: flex;
}



.tit-lista {
    display: flex;
    flex-wrap: nowrap; /* Isso é essencial! */
}

.tit-lista li {
    flex-shrink: 0; /* Impede que os itens encolham */    
}

.lista-entrevistas > ul {
    display: flex;
    flex-wrap: nowrap;
}

.lista-entrevistas > ul > li {
    flex-shrink: 0;
    margin-right: 10px;
   
}

.table-container.lista-entrevistas ul{
    width: fit-content;
}

/* coluna data inscricao */
.col-icon{
margin-right: 10px;
}

.col-inscricao{
    width: 130px;
}

/* coluna nome */
.col-nome{
    width: 400px;
}

.col-info{
    position: relative;
    /* margin-left: 15px; */
}

p.badge{
    position: absolute;
    top: -18px;
    right: -30px;
}

/* coluna email */
.col-email{
    width: 250px;
}

.col-data_nascimento{
    width: 160px;
}

.col-rg{
    width: 160px;
}
.col-cpf{
    width: 160px;
}

.col-estado_civil{
    width: 160px;
}
.col-possui_filhos{
    width: 160px;
}
.col-instagram{
    width: 160px;
}
.col-linkedin{
    width: 190px;
}
.col-telefone_celular{
    width: 160px;
}
.col-telefone_recado{
    width: 160px;
}
.col-nome_recado{
    width: 160px;
}

.col-endereco{
    width: 200px;
    white-space: pre-wrap;
}
.col-cidade{
    width: 100px;
    white-space: pre-wrap;
}
.col-uf{
    width: 50px;
}


/* coluna vaga */
.col-vaga{
    width: 200px;
    max-width: 200px;
    overflow: hidden;
}

.col-vaga p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-experiencia_profissional{
    width: 200px;
    max-width: 200px;
    overflow: hidden;
}

.col-experiencia_profissional p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-tamanho_uniforme{
    width: 200px;
}


/* coluna cnh */
.col-cnh{
    width: 100px;
}

/* coluna genero */
.col-genero{
    width: 100px;
}

/* coluna reservista */
.col-reservista{
    width: 115px;
}

.col-jovem-aprendiz{
    width: 200px;
}

.col-formacao{
    width: 240px;
}

.col-formacao_complemento{
    width: 240px;
    white-space: pre-wrap;
}
.col-informatica{
    width: 200px;
    white-space: pre-wrap;
}
.col-ingles{
    width: 100px;
}





/* coluna entrevistado */

/* coluna genero */
.col-obs{
    width: 175px;
    white-space: pre-wrap;
}

/* coluna reservista */
.col-saude{
    width: 150px;
    overflow: hidden;
    white-space: pre-wrap;
}

.col-vacina{
    width: 120px;
    white-space: pre-wrap;
}

.col-perfil{
    width: 175px;
}
.col-perfil-stacasa{
    width: 125px;
}
.col-classificacao{
    width: 120px;
}
.col-entrevistado{
    width: 115px;
    display: flex;
    justify-content: center;
}

.col-entrevistado a{
    width: auto;
    padding: 5px;
}


.col-formadora{
    width: 200px;
    white-space: pre-wrap;
}

.col-parecer{
    width: 400px;
    white-space: pre-wrap;
}
.col-curso-extracurriculares{
    width: 200px;
    white-space: pre-wrap;
}
.col-apresentacao-pessoal{
    width: 200px;
    white-space: pre-wrap;
}
.col-experiencia-profissional{
    width: 400px;
    white-space: pre-wrap;
}

.col-caracteristicas-positivas{
    width: 200px;
    white-space: pre-wrap;
}
.col-habilidades{
    width: 200px;
    white-space: pre-wrap;
}
.col-porque-gostaria-jovem-aprendiz{
    width: 200px;
    white-space: pre-wrap;
}
.col-demissao{
    width: 200px;
    white-space: pre-wrap;
}
.col-pretencoes-candidato{
    width: 200px;
    white-space: pre-wrap;
}
.col-objetivo-longo-prazo{
    width: 200px;
    white-space: pre-wrap;
}
.col-pontos-melhoria{
    width: 200px;
    white-space: pre-wrap;
}
.col-familia{
    width: 200px;
    white-space: pre-wrap;
}
.col-disponibilidade-horario{
    width: 200px;
    white-space: pre-wrap;
}
.col-fale-um-pouco{
    width: 200px;
    white-space: pre-wrap;
}

.col-rotina{
    width: 200px;
    white-space: pre-wrap;
}
.col-idiomas{
    width: 200px;
    white-space: pre-wrap;
}
.col-cras{
    width: 200px;
    white-space: pre-wrap;
}
.col-fonte-curriculo{
    width: 200px;
    white-space: pre-wrap;
}
.col-sugestao-empresa{
    width: 200px;
    white-space: pre-wrap;
}

.col-obs-entrevista{
    width: 400px;
    white-space: pre-wrap;
}
.col-pontuacao{
    width: 200px;
    white-space: pre-wrap;
}

.col-status{
    width: 125px;
}

.col-status i{
    margin-right: 10px;
}

.col-filhos_sim, .col-genero_outro, .col-tipo_cnh, 
.col-pcd, .col-pcd_sim, .col-superior_periodo, .col-cras{
    width: 200px;
    white-space: pre-wrap;
}

.col-nacionalidade, .col-renda_familiar, .col-obs_rh{
    width: 150px;
    white-space: pre-wrap;
}

</style>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/interviews/index.blade.php ENDPATH**/ ?>