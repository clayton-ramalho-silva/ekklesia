<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('interviews.index')); ?>">Nova Entrevista</a></li>
          <li class="breadcrumb-item active" aria-current="page">Candidato: <?php echo e($resume->informacoesPessoais->nome); ?></li>
        </ol>
      </nav>

      
      <?php
          // Guarda a rota na variável
          $rota = route('interviews.index');
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


<section class="sessao">

    <article class="f1">

        <div class="container mt-3">
            <div class="row form-padrao">
                <div class="col-6 d-flex justify-content-between mb-4">

                    
                       <?php if (isset($component)) { $__componentOriginal866ebe14907986e2fb699d5fd31e02df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal866ebe14907986e2fb699d5fd31e02df = $attributes; } ?>
<?php $component = App\View\Components\StatusButton::resolve(['id' => $resume->id,'status' => $resume->status] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                       
                   
                    
                    
                </div>
                 <div class="col-6">
                            <div class="col-12 bloco-ativo d-flex mb-3">

                                <p class="fw-bold">Currículo Cadastrado em: <?php echo e($resume->created_at->format('d/m/Y')); ?></p>
                            </div>

                        </div>
                
            </div>
        

            

        </div>

    </article>

</section>



<section class="sessao mt-5">

    <article class="f1">

        <div class="container mt-3">

            <form class="form-padrao" id="form-interview" action="<?php echo e(route('interviews.store')); ?>" method="post" enctype="multipart/form-data">

                                    
                <?php if (isset($component)) { $__componentOriginal33c22dec070d9318081ec87c1cb417f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal33c22dec070d9318081ec87c1cb417f1 = $attributes; } ?>
<?php $component = App\View\Components\ResumeEditForm::resolve(['resume' => $resume,'editResume' => false] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                
                <div class="row mb-3 mt-3">

                    <div class="col-12">
                        <h4>Entrevista</h4>
                    </div>

                    <div class="col-12 d-flex flex-wrap">

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Data Entrevista:</b> <?php echo e(\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y')); ?>

                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Hora Entrevista:</b> <?php echo e(\Carbon\Carbon::now('America/Sao_Paulo')->format('H:i:s')); ?>

                            </p>
                        </div>
                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Entrevistador:</b> <?php echo e(Auth::user()->name); ?>

                            </p>
                        </div>

                    </div>

                </div>

                <?php echo csrf_field(); ?>
                <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                <div class="row mb-3 mt-3">

                    <!-- Inicio -->
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="outros_idiomas" class="label-floatlabel" class="form-label floatlabel-label">Fala outro idioma?</label>
                                <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" ><?php echo e(old('outros_idiomas')); ?></textarea>
                                <?php $__errorArgs = ['outros_idiomas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="apresentacao_pessoal" class="label-floatlabel" class="form-label floatlabel-label">Sobre sua apresentação pessoal (Tem piercing? Pode Tirar? Tatto?)</label>
                                <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" ><?php echo e(old('apresentacao_pessoal')); ?></textarea>
                                <?php $__errorArgs = ['apresentacao_pessoal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="saude_candidato" class="label-floatlabel" class="form-label floatlabel-label">Sobre A Sua Saúde? (Saúde Física: Toma Medicação? / Faz Algum Tratamento? / Tem Alguma Restrição De Mobilidade? Alguma Cirurgia Realizada Ou À Realizar? – Saúde Mental: Faz Terapia? Já Fez? Toma Medicação?)</label>
                                <textarea class="form-control" id="saude_candidato" name="saude_candidato"  style="padding-top: 43px !important"><?php echo e(old('saude_candidato')); ?></textarea>
                                <?php $__errorArgs = ['saude_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="vacina_covid" class="label-floatlabel" class="form-label floatlabel-label">Vacina COVID</label>
                                <select name="vacina_covid" id="vacina_covid" class="form-select active-floatlabel altura-75" style="height: 75px !important" >
                                    <option></option>
                                    <option value="Não pretende tomar" <?php echo e(old('vacina_covid') === 'Não pretende tomar' ? 'selected' : ''); ?>> Não pretende tomar</option>
                                    <option value="Pretende tomar" <?php echo e(old('vacina_covid') === 'Pretende tomar' ? 'selected' : ''); ?>> Pretende tomar</option>
                                    <option value="1 dose" <?php echo e(old('vacina_covid') === '1 dose' ? 'selected' : ''); ?>> 1 dose</option>
                                    <option value="2 doses" <?php echo e(old('vacina_covid') === '2 doses' ? 'selected' : ''); ?>> 2 doses</option>
                                    <option value="3 doses" <?php echo e(old('vacina_covid') === '3 doses' ? 'selected' : ''); ?>> 3 doses</option>
                                    <option value="4 doses" <?php echo e(old('vacina_covid') === '4 doses' ? 'selected' : ''); ?>> 4 doses ou mais</option>
                                    <option value="Não tomou" <?php echo e(old('vacina_covid') === 'Não tomou' ? 'selected' : ''); ?>> Não tomou</option>
                                </select>
                                <?php $__errorArgs = ['vacina_covid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="ja_foi_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Já foi jovem aprendiz?</label>
                                <select name="ja_foi_jovem_aprendiz" id="ja_foi_jovem_aprendiz" class="form-select active-floatlabel altura-75" disabled>
                                    <option></option>
                                    <option value="Sim, da ASPPE" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'selected' : ''); ?>> Sim, da ASPPE</option>
                                    <option value="Sim, de Outra Qualificadora" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'selected' : ''); ?>> Sim, de Outra Qualificadora</option>
                                    <option value="Não" <?php echo e($resume->foi_jovem_aprendiz === 'Não' ? 'selected' : ''); ?>> Não</option>                                    
                                </select>
                                <?php $__errorArgs = ['ja_foi_jovem_aprendiz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-5 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel altura-75" id="qual_formadora" name="qual_formadora" placeholder="Qual a formadora?(Caso já tenha sido jovem aprendiz.)"  value="<?php echo e(old('qual_formadora')); ?>">
                            <?php $__errorArgs = ['qual_formadora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="experiencia_profissional" class="label-floatlabel" class="form-label floatlabel-label">Experiência profissional (nome da empresa, tempo de empresa, motivo da saída, que atividades exercia)</label>
                                <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" ><?php echo e(old('experiencia_profissional')); ?></textarea>
                                <?php $__errorArgs = ['experiencia_profissional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="qual_motivo_demissao" class="label-floatlabel" class="form-label floatlabel-label">Por qual motivo você pediria demissão?</label>
                                <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" ><?php echo e(old('qual_motivo_demissao')); ?></textarea>
                                <?php $__errorArgs = ['qual_motivo_demissao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="caracteristicas_positivas" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas caracteristicas positivas? </label>
                                <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" ><?php echo e(old('caracteristicas_positivas')); ?></textarea>
                                <?php $__errorArgs = ['caracteristicas_positivas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="habilidades" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas habilidades?</label>
                                <textarea class="form-control" id="habilidades" name="habilidades" ><?php echo e(old('habilidades')); ?></textarea>
                                <?php $__errorArgs = ['habilidades'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pontos_melhoria" class="label-floatlabel" class="form-label floatlabel-label">Um ponto de melhoria?</label>
                                <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" ><?php echo e(old('pontos_melhoria')); ?></textarea>
                                <?php $__errorArgs = ['pontos_melhoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="rotina_candidato" class="label-floatlabel" class="form-label floatlabel-label">Qual sua rotina, me fale um pouco sobre você (hobbies, compromissos religosos, esportivos)</label>
                                <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" ><?php echo e(old('rotina_candidato')); ?></textarea>
                                <?php $__errorArgs = ['rotina_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="disponibilidade_horario" class="label-floatlabel" class="form-label floatlabel-label">Disponibilidade Para O Trabalho (Total, Horario Comercial, Disp Aos Finais De Semana?)</label>
                                <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" ><?php echo e(old('disponibilidade_horario')); ?></textarea>
                                <?php $__errorArgs = ['disponibilidade_horario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="familia" class="label-floatlabel" class="form-label floatlabel-label">Me fale da sua famila (mora com quem? O que os pais fazem?)</label>
                                <textarea class="form-control" id="familia" name="familia" ><?php echo e(old('familia')); ?></textarea>
                                <?php $__errorArgs = ['familia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="renda_familiar" name="renda_familiar" placeholder="Qual a renda familiar da sua casa?"  value="<?php echo e(old('renda_familiar')); ?>">
                            <?php $__errorArgs = ['renda_familiar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Recebe algum benefício do governo?</label>
                                <select name="familia_cras" id="familia_cras" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="Sim" <?php echo e(old('familia_cras') === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e(old('familia_cras') === 'Não' ? 'selected' : ''); ?>> Não</option>
                                </select>
                                <?php $__errorArgs = ['familia_cras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                
                    <!-- Campo de Tipo Benefcio -->
                    <div class="col-4 form-campo" id="tipoBeneficioContainer" >
                        <div class="mb-3">
                            <div class="floatlabel-wrapper">
                                <input type="text" class="floatlabel form-control" id="tipo_beneficio" name="tipo_beneficio" placeholder="Tipo Benefício: Bolsa Família, CRAS, CREAS." value="<?php echo e(old('tipo_beneficio')); ?>" disabled>
                                <?php $__errorArgs = ['tipo_beneficio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="objetivo_longo_prazo" class="label-floatlabel" class="form-label floatlabel-label">Quais são seus objetivos profissionais para o futuro?</label>
                                <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" ><?php echo e(old('objetivo_longo_prazo')); ?></textarea>
                                <?php $__errorArgs = ['objetivo_longo_prazo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="porque_ser_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Porque gostaria de ser Jovem Aprendiz?</label>
                                <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" ><?php echo e(old('porque_ser_jovem_aprendiz')); ?></textarea>
                                <?php $__errorArgs = ['porque_ser_jovem_aprendiz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="fonte_curriculo" name="fonte_curriculo" placeholder="Fonte de Captação (Como soube da ASPPE?)"  value="<?php echo e(old('fonte_curriculo')); ?>">
                            <?php $__errorArgs = ['fonte_curriculo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Perfil Santa Casa?</label>
                                <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="Sim" <?php echo e(old('perfil_santa_casa') === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e(old('perfil_santa_casa') === 'Não' ? 'selected' : ''); ?>> Não</option>
                                </select>
                                <?php $__errorArgs = ['perfil_santa_casa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="classificacao" class="label-floatlabel" class="form-label floatlabel-label">Classificação?</label>
                                <select name="classificacao" id="classificacao" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="A" <?php echo e(old('classificacao') === 'A' ? 'selected' : ''); ?>> A</option>
                                    <option value="B" <?php echo e(old('classificacao') === 'B' ? 'selected' : ''); ?>> B</option>
                                    <option value="C" <?php echo e(old('classificacao') === 'C' ? 'selected' : ''); ?>> C</option>
                                    <option value="D" <?php echo e(old('classificacao') === 'D' ? 'selected' : ''); ?>> D</option>
                                </select>
                                <?php $__errorArgs = ['classificacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    

                    

                    
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Parecer do RH</label>
                                <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador"><?php echo e(old('parecer_recrutador')); ?></textarea>
                                <?php $__errorArgs = ['parecer_recrutador'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="observacoes" class="label-floatlabel" class="form-label floatlabel-label">Entrevistas</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" ><?php echo e(old('observacoes')); ?></textarea>
                                <?php $__errorArgs = ['observacoes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="obs_rh" class="label-floatlabel" class="form-label floatlabel-label">Observações RH</label>
                                <textarea class="form-control" id="obs_rh" name="obs_rh" ><?php echo e(old('obs_rh')); ?></textarea>
                                <?php $__errorArgs = ['obs_rh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Fim -->                    


                    <div class="mt-3 bloco-submit">
                        <button type="submit" class="btn btn-primary btn-padrao btn-cadastrar">Salvar Entrevista</button>
                    </div>

                    <div class="col-8"></div>

                </div>

            </form>

            

        </div>

    </article>

</section>

<section class="sessao my-5">   

    
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
$('#vacina_covid').select2({
    placeholder: "Selecione",
});
$('#familia_cras').select2({
    placeholder: "Selecione",
});
$('#perfil').select2({
    placeholder: "Selecione",
});
$('#perfil_santa_casa').select2({
    placeholder: "Selecione",
});
$('#classificacao').select2({
    placeholder: "Selecione",
});
$('#nacionalidade').select2({
    placeholder: "Selecione",
});

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
                    $('#uf').val(result.uf);
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

$("#form-interview").validate({
    ignore: [],
    rules:{
        // saude_candidato:"required",
        // vacina_covid:"required",
        // perfil:"required",
        // perfil_santa_casa:"required",
        // classificacao:"required",
        // qual_formadora:"required",
        // familia_cras:"required",
        // fonte_curriculo:"required",
        // pontuacao:"required",
    }
});

var validator1 = $( "#form-companies-create" ).validate();
validator1.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})

// Atualização de status
function confirmarMudancaStatus(checkbox) {
    // Se estiver desmarcando (mudando para inativo)
    if (!checkbox.checked) {
        // Mostra confirmação
        if (confirm("Se o currículo estiver associado a alguma vaga, será automaticamente desassociado. Deseja continuar?")) {
            // Se confirmou, define o valor adequado e envia o form
            document.getElementsByName('status')[0].value = 'inativo';
            document.getElementById('statusForm').submit();
        } else {
            // Se cancelou, reverte o checkbox para marcado
            checkbox.checked = true;
            return false;
        }
    } else {
        // Se estiver marcando (mudando para ativo), envia diretamente
        document.getElementsByName('status')[0].value = 'ativo';
        document.getElementById('statusForm').submit();
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css-custom'); ?>
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

.bloco-submit{
    position: fixed;
    bottom: 0;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 3px 8px #c7c7c7;
    border-radius: 20px;
    z-index: 999999;
    width: 74%;
}

</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/interviews/interviewResume.blade.php ENDPATH**/ ?>