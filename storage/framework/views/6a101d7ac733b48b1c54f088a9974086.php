<div class="container">

    <div class="row">

        <div class="col-12">

            <div class="modal fade modal-associar-vaga" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-xl">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>Vagas abertas</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="table-container lista-associar-vaga">

                                <ul class="tit-lista">
                                    <li class="col1">Empresa</li>
                                    <li class="col2">Área</li>
                                    <li class="col3">Vagas</li>
                                    <li class="col4">Cidade</li>
                                    <li class="col5">Candidatos Selecionados</li>
                                    <li class="col6">Ações</li>
                                </ul>

                                <?php if($jobs->count() > 0): ?>

                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                            <b>Título</b>
                                            <?php echo limite($job->setor, 28); ?>

                                        </li>
                                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                            <b>Vagas</b>
                                            <?php echo e($job->filled_positions); ?> / <?php echo e($job->qtd_vagas); ?>

                                        </li>
                                        <li class="col4">
                                            <b>Cidade</b>
                                            <?php echo e($job->cidade); ?>

                                        </li>
                                        <li class="col5">
                                            <b>Candidatos Selecionados</b>
                                            <?php if($job->resumes->count() > 0): ?>
                                                <?php echo e($job->resumes->count()); ?> candidatos
                                            <?php else: ?>
                                                Nenhum candidato selecionado
                                            <?php endif; ?>
                                        </li>
                                        <li class="col6">
                                            <b>Ações</b>
                                            <?php
                                            $resumeAssociado = false;

                                            foreach ($job->resumes as $curriculo) {
                                                if ($curriculo->id == $resume->id) {
                                                    $resumeAssociado = true;
                                                }
                                            }
                                            ?>

                                            <?php if($resumeAssociado): ?>
                                                <button disabled="disabled" class="btn btn-primagy btn-sm d-inline">Associado</button>
                                            <?php else: ?>

                                            <form action="<?php echo e(route('interviews.associarVaga')); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                                                <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                                                <button type="submit" class="btn btn-success btn-sm">Associar</button>
                                            </form>
                                            <?php endif; ?>
                                        </li>

                                    </ul>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>
                                <span class="sem-resultado">Nenhuma vaga encontrada</span>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<?php $__env->startPush('css-custom'); ?>
    <style>
        .modal-associar-vaga.show{
            z-index: 9999999;
        }

        .lista-associar-vaga {
            max-height: 500px;
            overflow-y: scroll;
        }
    </style>
<?php $__env->stopPush(); ?><?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/components/modal-associar-vaga.blade.php ENDPATH**/ ?>