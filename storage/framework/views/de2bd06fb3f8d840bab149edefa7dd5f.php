
    <!-- Vagas Associadas do candidato -->
    <article class="f1">

        <h4>Vagas Associadas a este Currículo</h4>        

        <div class="table-container lista-processos-seletivos">

            <ul class="tit-lista">
                <li class="col1">Empresa</li>
                <li class="col2">Título</li>
                <li class="col3">Vagas</li>                
                <li class="col5">Recrutador</li>
                <li class="col6">Status</li>
                <li class="col6">Ações</li>
            </ul>
            
            
            <?php if($vagasAssociadas): ?>            
                <?php $__currentLoopData = $vagasAssociadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                  

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-<?php echo e($job->id); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="col1">
                            <?php if($job->company->logotipo): ?>
                                <b>Empresa</b>
                                <?php if(file_exists(public_path('documents/companies/images/'.$job->company->logotipo))): ?>
                                    <img src="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" alt="<?php echo e($job->company->nome_fantasia); ?>" title="<?php echo e($job->company->nome_fantasia); ?>">
                                <?php else: ?>
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <?php endif; ?>
                            <?php else: ?>
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            <?php endif; ?>
                            <span>
                                <strong><?php echo e($job->company->nome_fantasia); ?></strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            <?php echo e($job->cargo); ?>

                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            <?php echo e($job->filled_positions); ?> / <?php echo e($job->qtd_vagas); ?>

                        </li>                        
                        <li class="col5">
                            <b>Recrutador</b>
                            <?php if(count($job->recruiters) <= 0): ?>
                            Nenhum recrutador associado
                            <?php else: ?>
                            <?php $__currentLoopData = $job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($recruiter->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </li>
                        <li class="col6">
                           <?php switch($job->status):
                                case ('aberta'): ?>
                                    <i title="Aberta" class="status-aberta"></i>        
                                    <?php break; ?>
                                <?php case ('fechada'): ?>
                                    <i title="Fechada" class="status-fechada"></i>              
                                    <?php break; ?>
                                <?php case ('cancelada'): ?>
                                    <i title="Cancelada" class="status-cancelada"></i>        
                                    <?php break; ?>
                                <?php case ('espera'): ?>
                                    <i title="Espera" class="status-espera"></i>        
                                    <?php break; ?>
                            
                                <?php default: ?>
                                    
                            <?php endswitch; ?>                              
                        </li>
                        <li class="col7 col7-admin ">
                            
                            
                           <?php if (isset($component)) { $__componentOriginalbbd144822bdd23d6312c1c263e9182cd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbbd144822bdd23d6312c1c263e9182cd = $attributes; } ?>
<?php $component = App\View\Components\ButtonDesassociarVaga::resolve(['resume' => $resume] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-desassociar-vaga'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ButtonDesassociarVaga::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbbd144822bdd23d6312c1c263e9182cd)): ?>
<?php $attributes = $__attributesOriginalbbd144822bdd23d6312c1c263e9182cd; ?>
<?php unset($__attributesOriginalbbd144822bdd23d6312c1c263e9182cd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbbd144822bdd23d6312c1c263e9182cd)): ?>
<?php $component = $__componentOriginalbbd144822bdd23d6312c1c263e9182cd; ?>
<?php unset($__componentOriginalbbd144822bdd23d6312c1c263e9182cd); ?>
<?php endif; ?>                            
                           
                        </li>

                    </ul>

                    <!-- Modal -->
                    <div class="modal fade modal-vagas" id="modal-selection-<?php echo e($job->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº <?php echo e($job->id); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

                                                <ul>
                                                    <li class="col1">
                                                        <?php if($job->company->logotipo): ?>
                                                            <b>Empresa</b>
                                                            <?php if(file_exists(public_path('documents/companies/images/'.$job->company->logotipo))): ?>
                                                                <img src="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" alt="<?php echo e($job->company->nome_fantasia); ?>" title="<?php echo e($job->company->nome_fantasia); ?>">
                                                            <?php else: ?>
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                        <?php endif; ?>
                                                        <span>
                                                            <strong><?php echo e($job->company->nome_fantasia); ?></strong>
                                                        </span>
                                                    </li>
                                                    <li class="col2">
                                                        <b>Setor</b>
                                                        <?php echo e($job->cargo); ?>

                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        <?php echo e($job->filled_positions); ?> / <?php echo e($job->qtd_vagas); ?>

                                                        <?php if($job->filled_positions >= $job->qtd_vagas): ?>
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        <?php if(count($job->recruiters) <= 0): ?>
                                                            Nenhum recrutador associado
                                                        <?php else: ?>
                                                            <?php $__currentLoopData = $job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($recruiter->name); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>

                                            

                                                <form class="form-padrao d-flex" action="<?php echo e(route('selections.storeSelection')); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                                                    <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">

                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aguardando" selected> Aguardando</option>
                                                                    <option value="aprovado" > Contratado</option>
                                                                    <option value="reprovado" > Reprovado</option>
                                                                    
                                                                </select>
                                                                <?php $__errorArgs = ['status_selecao'];
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

                                                            <div class="floatlabel-wrapper required col-12">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option>Escolher</option>
                                                                    <option value="0" > Negativa</option>
                                                                    <option value="1" > Positiva</option>
                                                                </select>
                                                                <?php $__errorArgs = ['avaliacao'];
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

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observação</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"></textarea>
                                                            <?php $__errorArgs = ['observacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Salvar</button>

                                                    </div>

                                                </form>                                            

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <span class="sem-resultado">Candidato não associado a vagas ainda</span>
            <?php endif; ?>

        </div>

    </article>
    <!-- Fim Vagas Associadas do candidato -->

<?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/components/resume-jobs-table.blade.php ENDPATH**/ ?>