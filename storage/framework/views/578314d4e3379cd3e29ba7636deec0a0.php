 <article class="f1">

        <h4>Processos Seletivos</h4>        

        <div class="table-container lista-processos-seletivos">

            <ul class="tit-lista">
                <li class="col1">Empresa</li>
                <li class="col2">Título</li>
                <li class="col3">Vagas</li>
                <li class="col4">Seleção</li>
                <li class="col5">Recrutador</li>
                <li class="col6">Status</li>
            </ul>

            

            
                <?php if($jobAprovado): ?>

                    
                    <?php
                    $selection = $resume->selections->where('job_id', $jobAprovado->id)->first();
                    
                    ?>

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-<?php echo e($jobAprovado->id); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="col1">
                            <?php if($jobAprovado->company->logotipo): ?>
                                <b>Empresa</b>
                                <?php if(file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo))): ?>
                                    <img src="<?php echo e(asset("documents/companies/images/{$jobAprovado->company->logotipo}")); ?>" alt="<?php echo e($jobAprovado->company->nome_fantasia); ?>" title="<?php echo e($jobAprovado->company->nome_fantasia); ?>">
                                <?php else: ?>
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$jobAprovado->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <?php endif; ?>
                            <?php else: ?>
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            <?php endif; ?>
                            <span>
                                <strong><?php echo e($jobAprovado->company->nome_fantasia); ?></strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            <?php echo e($jobAprovado->cargo); ?>

                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            <?php echo e($jobAprovado->filled_positions); ?> / <?php echo e($jobAprovado->qtd_vagas); ?>

                        </li>
                        <li class="col4">
                            <b>Status da Seleção</b>
                            <?php echo e($selection->status_selecao == 'aprovado' ? 'Contratado' : $selection->status_selecao); ?>

                        </li>
                        <li class="col5">
                            <b>Recrutador</b>
                            <?php if(count($jobAprovado->recruiters) <= 0): ?>
                            Nenhum recrutador associado
                            <?php else: ?>
                            <?php $__currentLoopData = $jobAprovado->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($recruiter->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </li>
                        <li class="col6">
                            <b>Status</b>
                            <button disabled="disabled" class="btn btn-success">Contratado</button>
                        </li>

                    </ul>

                    <!-- Modal Seleção aprovado -->
                    <div class="modal fade modal-vagas" id="modal-selection-<?php echo e($jobAprovado->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº <?php echo e($jobAprovado->id); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

                                                <ul>
                                                    <li class="col1">
                                                        <?php if($jobAprovado->company->logotipo): ?>
                                                            <b>Empresa</b>
                                                            <?php if(file_exists(public_path('documents/companies/images/'.$jobAprovado->company->logotipo))): ?>
                                                                <img src="<?php echo e(asset("documents/companies/images/{$jobAprovado->company->logotipo}")); ?>" alt="<?php echo e($jobAprovado->company->nome_fantasia); ?>" title="<?php echo e($jobAprovado->company->nome_fantasia); ?>">
                                                            <?php else: ?>
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$jobAprovado->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                        <?php endif; ?>
                                                        <span>
                                                            <strong><?php echo e($jobAprovado->company->nome_fantasia); ?></strong>
                                                        </span>
                                                    </li>
                                                    <li class="col2">
                                                        <b>Setor</b>
                                                        <?php echo e($jobAprovado->cargo); ?>

                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        <?php echo e($jobAprovado->filled_positions); ?> / <?php echo e($jobAprovado->qtd_vagas); ?>

                                                        <?php if($jobAprovado->filled_positions >= $jobAprovado->qtd_vagas): ?>
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        <?php if(count($jobAprovado->recruiters) <= 0): ?>
                                                            Nenhum recrutador associado
                                                        <?php else: ?>
                                                            <?php $__currentLoopData = $jobAprovado->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($recruiter->name); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>                                           
                                            
                                            <?php
                                                $selection = $resume->selections->where('job_id', $jobAprovado->id)->first();
                                            ?>

                                                <form class="form-padrao d-flex" action="<?php echo e(route('selections.updateSelection', $selection->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="job_id" value="<?php echo e($jobAprovado->id); ?>">
                                                    <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção:</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aprovado" <?php echo e($selection->status_selecao == 'aprovado' ? 'selected' : ''); ?> > Aprovado</option>
                                                                    <option value="reprovado" <?php echo e($selection->status_selecao == 'reprovado' ? 'selected' : ''); ?> > Reprovado</option>
                                                                    <option value="aguardando" <?php echo e($selection->status_selecao == 'aguardando' ? 'selected' : ''); ?>> Aguardando</option>
                                                                    
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

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação:</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                    <option value="0" <?php echo e($selection->avaliacao == 0 ? 'selected' : ''); ?> > Negativa</option>
                                                                    <option value="1" <?php echo e($selection->avaliacao == 1 ? 'selected' : ''); ?>> Positiva</option>
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
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observacao:</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"><?php echo e($selection->observacao); ?></textarea>
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

                                                        
                                                        <button class="btn btn-primary" type="submit">Atualizar</button>

                                                    </div>

                                                </form>
                                            

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    

                  
                    
                <?php endif; ?>

                
                <hr>
                <?php $__currentLoopData = $selections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selecao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>               
                    

                        <ul <?php if($jobAprovado && $selecao->job->id == $jobAprovado->id): ?> style="display:none;"<?php endif; ?>  data-bs-toggle="modal" data-bs-target="#modal-selection-<?php echo e($selecao->job->id); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                            <li class="col1">
                                <?php if($selecao->job->company->logotipo): ?>
                                    <b>Empresa</b>
                                    <?php if(file_exists(public_path('documents/companies/images/'.$selecao->job->company->logotipo))): ?>
                                        <img src="<?php echo e(asset("documents/companies/images/{$selecao->job->company->logotipo}")); ?>" alt="<?php echo e($selecao->job->company->nome_fantasia); ?>" title="<?php echo e($selecao->job->company->nome_fantasia); ?>">
                                    <?php else: ?>
                                        <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$selecao->job->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <?php endif; ?>
                                <span>
                                    <strong><?php echo e($selecao->job->company->nome_fantasia); ?></strong>
                                </span>
                            </li>
                            <li class="col2">
                                <b>Título</b>
                                <?php echo e($selecao->job->cargo); ?>

                            </li>
                            <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                <b>Vagas</b>
                                <?php echo e($selecao->job->filled_positions); ?> / <?php echo e($selecao->job->qtd_vagas); ?>

                            </li>
                            <li class="col4">
                                    <b>Status da Seleção</b>
                                    <?php echo e($selecao->status_selecao == 'aprovado' ? 'Contratado' : $selecao->status_selecao); ?>

                                </li>
                            <li class="col5">
                                <b>Recrutador</b>
                                <?php if(count($selecao->job->recruiters) <= 0): ?>
                                Nenhum recrutador associado
                                <?php else: ?>
                                <?php $__currentLoopData = $selecao->job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($recruiter->name); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </li>
                            <li class="col6">                            

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

                        </ul>

                        <!-- Modal -->
                        <div class="modal fade modal-vagas" id="modal-selection-<?php echo e($selecao->job->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4>Vaga - Nº <?php echo e($selecao->job->id); ?></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-12">

                                                <div class="table-container lista-info-vaga">

                                                    <ul>
                                                        <li class="col1">
                                                            <?php if($selecao->job->company->logotipo): ?>
                                                                <b>Empresa</b>
                                                                <?php if(file_exists(public_path('documents/companies/images/'.$selecao->job->company->logotipo))): ?>
                                                                    <img src="<?php echo e(asset("documents/companies/images/{$selecao->job->company->logotipo}")); ?>" alt="<?php echo e($selecao->job->company->nome_fantasia); ?>" title="<?php echo e($selecao->job->company->nome_fantasia); ?>">
                                                                <?php else: ?>
                                                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$selecao->job->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                                            <?php endif; ?>
                                                            <span>
                                                                <strong><?php echo e($selecao->job->company->nome_fantasia); ?></strong>
                                                            </span>
                                                        </li>
                                                        <li class="col2">
                                                            <b>Setor</b>
                                                            <?php echo e($selecao->job->cargo); ?>

                                                        </li>
                                                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                            <b>Vagas</b>
                                                            <?php echo e($selecao->job->filled_positions); ?> / <?php echo e($selecao->job->qtd_vagas); ?>

                                                            <?php if($selecao->job->filled_positions >= $selecao->job->qtd_vagas): ?>
                                                                <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                            <?php endif; ?>
                                                        </li>
                                                        <li class="col4">
                                                            <b>Recrutador</b>
                                                            <?php if(count($selecao->job->recruiters) <= 0): ?>
                                                                Nenhum recrutador associado
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $selecao->job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($recruiter->name); ?>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <h4>Processo Seletivo</h4>

                                                    <form class="form-padrao d-flex" action="<?php echo e(route('selections.updateSelection', $selecao->id)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <input type="hidden" name="job_id" value="<?php echo e($selecao->job->id); ?>">
                                                        <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">

                                                        <div class="col-6">

                                                            <div class="mb-3 col-12">

                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                    <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                        <option value="aprovado" <?php echo e($selecao->status_selecao == 'aprovado' ? 'selected' : ''); ?> > Contratado</option>
                                                                        <option value="reprovado" <?php echo e($selecao->status_selecao == 'reprovado' ? 'selected' : ''); ?> > Reprovado</option>
                                                                        <option value="aguardando" <?php echo e($selecao->status_selecao == 'aguardando' ? 'selected' : ''); ?>> Aguardando</option>
                                                                        
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

                                                                <div class="floatlabel-wrapper required">
                                                                    <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                    <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>
                                                                        <option value="0" <?php echo e($selecao->avaliacao == 0 ? 'selected' : ''); ?> > Negativa</option>
                                                                        <option value="1" <?php echo e($selecao->avaliacao == 1 ? 'selected' : ''); ?>> Positiva</option>
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
                                                                <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"><?php echo e($selecao->observacao); ?></textarea>
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

                                                            
                                                            <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Atualizar</button>

                                                        </div>

                                                        

                                                    </form>
                                                

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              


        </div>

    </article>


<?php $__env->startPush('css-custom'); ?>
    
<style>

.lista-processos-seletivos ul .col1{
width: 40% !important;
}

.lista-processos-seletivos ul .col2{
width: 20% !important;
}
.lista-processos-seletivos ul .col3{
width: 5% !important;
}
.lista-processos-seletivos ul .col4{
width: 10% !important;
}
.lista-processos-seletivos ul .col5{
width: 10% !important;
}
.lista-processos-seletivos ul .col6{
width: 10% !important;
}





</style>
<?php $__env->stopPush(); ?><?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/components/resume-selections-table.blade.php ENDPATH**/ ?>