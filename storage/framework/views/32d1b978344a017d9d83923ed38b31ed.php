    
    <div class="row">
        <div class="col-9 py-0 pe-5 form-l">

            <div class="row">

                <div class="col-12 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome"  value="<?php echo e($resume->informacoesPessoais->nome ?? ''); ?>">
                        <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>
                </div>

                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf"  value="<?php echo e($resume->informacoesPessoais->cpf ?? ''); ?>">
                        <?php $__errorArgs = ['cpf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg"  value="<?php echo e($resume->informacoesPessoais->rg); ?>">
                        <?php $__errorArgs = ['rg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                 <div class="col-6 form-campo">
                    <div class="mb-3">
                        <div class="floatlabel-wrapper ">
                            <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                            <select name="cnh" id="cnh" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Sim" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->cnh === 'Sim') ? 'selected' : ''); ?>> Sim</option>
                                <option value="Não" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->cnh === 'Não') ? 'selected' : ''); ?>> Não</option>
                                <option value="Em andamento" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->cnh === 'Em andamento') ? 'selected' : ''); ?>> Em andamento</option>
                            </select>
                            <?php $__errorArgs = ['cnh'];
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

                <!-- Campo de Tipo de CNH (inicialmente oculto) -->
                <div class="col-6 form-campo" id="tipoCnhContainer">
                    <div class="mb-3">
                        <div class="floatlabel-wrapper">
                            <label for="tipo_cnh" class="label-floatlabel form-label floatlabel-label">Tipo de CNH</label>
                            <select name="tipo_cnh" id="tipo_cnh" class="form-select active-floatlabel" disabled>
                                <option></option>
                                <option value="A" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'A') ? 'selected' : ''); ?>>A - Motocicleta</option>
                                <option value="B" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'B') ? 'selected' : ''); ?>>B - Automóvel</option>
                                <option value="AB" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'AB') ? 'selected' : ''); ?>>AB - Motocicleta e Automóvel</option>
                                <option value="C" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'C') ? 'selected' : ''); ?>>C - Caminhão</option>
                                <option value="D" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'D') ? 'selected' : ''); ?>>D - Ônibus</option>
                                <option value="E" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->tipo_cnh === 'E') ? 'selected' : ''); ?>>E - Carreta</option>
                            </select>
                            <?php $__errorArgs = ['tipo_cnh'];
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
                        <div class="floatlabel-wrapper ">
                            <?php                  
                                $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                                $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                                $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';
        
                                //Verifica se a idade é maior que 22 anos e 8 meses
                                $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                                $limiteEmMeses = (22 * 12) + 8;
                            ?>
                        
                            <?php if($idadeEmMeses > $limiteEmMeses): ?>
                                <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger" style="right: -23%;">
                                    <?php echo e($idadeFormatada); ?>                                               
                                </span>                                                
                            <?php else: ?>
                                <span class="position-absolute top-0 translate-middle badge rounded-pill bg-light text-dark" style="right: -23%;">
                                    <?php echo e($idadeFormatada); ?>                                              
                                </span>
                                
                            <?php endif; ?>
                            <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                            <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="<?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->data_nascimento) ? \Carbon\Carbon::parse($resume->informacoesPessoais->data_nascimento)->format('Y-m-d') : ''); ?>" >
                            <?php $__errorArgs = ['data_nascimento'];
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

                 <!-- Nacionalidade teste -->
                <?php
                    $paises = getPaises();                                
                ?>
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <div class="floatlabel-wrapper ">
                            <label for="nacionalidade" class="label-floatlabel" class="form-label floatlabel-label">Nacionalidade</label>
                            <select name="nacionalidade" id="nacionalidade" class="form-select active-floatlabel" >
                                <option></option>
                                <?php $__currentLoopData = $paises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pais): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pais); ?>" <?php echo e($resume->informacoesPessoais && $resume->informacoesPessoais->nacionalidade ===  "$pais"  ? 'selected' : ''); ?>> <?php echo e($pais); ?></option>                                                                                        
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['nacionalidade'];
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
                        <div class="floatlabel-wrapper ">
                            <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Solteiro" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->estado_civil === 'Solteiro') ? 'selected' : ''); ?> > Solteiro</option>
                                <option value="Casado" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->estado_civil === 'Casado') ? 'selected' : ''); ?>> Casado</option>
                                <option value="Divorciado" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->estado_civil === 'Divorciado') ? 'selected' : ''); ?>> Divorciado</option>
                                <option value="Viúvo" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->estado_civil === 'Viúvo') ? 'selected' : ''); ?>> Viúvo</option>
                                <option value="Separado" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->estado_civil === 'Separado') ? 'selected' : ''); ?>> Separado</option>
                            </select>
                            <?php $__errorArgs = ['estado_civil'];
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

                <!-- Reservista -->
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <div class="floatlabel-wrapper ">
                            <label for="reservista" class="label-floatlabel" class="form-label floatlabel-label">Possui Reservista?(Dispensa do Exército)</label>
                            <select name="reservista" id="reservista" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Sim" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->reservista === 'Sim') ? 'selected' : ''); ?>> Sim</option>
                                <option value="Não" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->reservista === 'Não') ? 'selected' : ''); ?>> Não</option>
                                <option value="Em andamento" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->reservista === 'Em andamento') ? 'selected' : ''); ?>> Em andamento</option>                                            
                            </select>
                            <?php $__errorArgs = ['reservista'];
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
                            <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                            <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Sim" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->possui_filhos === 'Sim') ? 'selected' : ''); ?>> Sim</option>
                                <option value="Não" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->possui_filhos === 'Não') ? 'selected' : ''); ?>> Não</option>
                            </select>
                            <?php $__errorArgs = ['possui_filhos'];
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

                <!-- Campo de filhos_sim -->
                <div class="col-4 form-campo" id="filhosSimContainer" >
                    <div class="mb-3">
                        <div class="floatlabel-wrapper">
                            <input type="number" class="floatlabel form-control" id="filhos_qtd" name="filhos_qtd"  placeholder="Quantidade dos filhos?" value="<?php echo e($resume->informacoesPessoais->filhos_qtd ?? ''); ?>" disabled>
                            <?php $__errorArgs = ['filhos_qtd'];
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
                <div class="col-4 form-campo" id="filhosSimContainer" >
                    <div class="mb-3">
                        <div class="floatlabel-wrapper">
                            <input type="text" class="floatlabel form-control" id="filhos_sim" name="filhos_sim"  placeholder="Qual a idade dos filhos?" value="<?php echo e($resume->informacoesPessoais->filhos_sim ?? ''); ?>" disabled>
                            <?php $__errorArgs = ['filhos_sim'];
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
                        <div class="floatlabel-wrapper ">
                            <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                            <select name="sexo" id="sexo" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Homem" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->sexo === 'Homem') ? 'selected' : ''); ?>> Homem</option>
                                <option value="Mulher" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->sexo === 'Mulher') ? 'selected' : ''); ?>> Mulher</option>
                                <option value="Prefiro não dizer" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->sexo === 'Prefiro não dizer') ? 'selected' : ''); ?> > Prefiro não dizer</option>
                                <option value="Outro" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->sexo === 'Outro') ? 'selected' : ''); ?> > Outro</option>
                            </select>
                            <?php $__errorArgs = ['sexo'];
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

                    <!-- Campo de sexo_outro -->
                <div class="col-6 form-campo" id="sexoOutroContainer" >
                    <div class="mb-3">
                        <div class="floatlabel-wrapper">
                            <input type="text" class="floatlabel form-control" id="sexo_outro" name="sexo_outro" placeholder="Qual o seu gênero?" value="<?php echo e($resume->informacoesPessoais->sexo_outro ?? ''); ?>" disabled>
                            <?php $__errorArgs = ['sexo_outro'];
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
                        <div class="floatlabel-wrapper ">
                            <label for="pcd" class="label-floatlabel" class="form-label floatlabel-label">PCD?</label>
                            <select name="pcd" id="pcd" class="form-select active-floatlabel" >
                                <option></option>
                                <option value="Sim, com laudo." <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->pcd === 'Sim, com laudo.') ? 'selected' : ''); ?>> Sim, com laudo.</option>
                                <option value="Sim, sem laudo." <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->pcd === 'Sim, sem laudo.') ? 'selected' : ''); ?>> Sim, sem laudo.</option>
                                <option value="Não" <?php echo e(($resume->informacoesPessoais && $resume->informacoesPessoais->pcd === 'Não') ? 'selected' : ''); ?>> Não</option>
                            </select>
                            <?php $__errorArgs = ['pcd'];
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

                <!-- Campo de pcd_sim (inicialmente oculto) -->
                <div class="col-6 form-campo" id="pcdContainer" >
                    <div class="mb-3">
                        <div class="floatlabel-wrapper">
                            <input type="text" class="floatlabel form-control" id="pcd_sim" name="pcd_sim" placeholder="Número do CID" value="<?php echo e($resume->informacoesPessoais->pcd_sim ?? ''); ?>" disabled>
                            <?php $__errorArgs = ['pcd_sim'];
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

                
                <h4 class="fw-normal mb-4 mt-4">Endereço</h4>

                <div class="col-4 form-campo">
                    <div class="mb-3 position-relative">
                        <i class="fas fa-spinner"></i>
                        <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep"  value="<?php echo e($resume->contato->cep); ?>">
                        <?php $__errorArgs = ['cep'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-8 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro"  value="<?php echo e($resume->contato->logradouro); ?>">
                        <?php $__errorArgs = ['logradouro'];
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
                        <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero"  value="<?php echo e($resume->contato->numero); ?>">
                        <?php $__errorArgs = ['numero'];
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
                        <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento"  value="<?php echo e($resume->contato->complemento); ?>">
                        <?php $__errorArgs = ['complemento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-5 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro"  value="<?php echo e($resume->contato->bairro); ?>">
                        <?php $__errorArgs = ['bairro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade"  value="<?php echo e($resume->contato->cidade); ?>">
                        <?php $__errorArgs = ['cidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-6 mb-3 form-campo">
                    <div class="floatlabel-wrapper ">
                        <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                        <select name="uf" id="uf" class="form-select active-floatlabel" >
                            <option></option>
                            <?php
                            echo get_estados($resume->contato->uf);
                            ?>
                        </select>
                        <?php $__errorArgs = ['uf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>


                <h4 class="fw-normal mb-4 mt-4">Informações Contato</h4>
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email"  value="<?php echo e($resume->contato->email); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Telefone Celular(Whatsapp)" class="floatlabel form-control" id="telefone_celular" name="telefone_celular"  value="<?php echo e($resume->contato->telefone_celular); ?>">
                        <?php $__errorArgs = ['telefone_celular'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Telefone para recado" class="floatlabel form-control" id="telefone_residencial" name="telefone_residencial"  value="<?php echo e($resume->contato->telefone_residencial); ?>">
                        <?php $__errorArgs = ['telefone_residencial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Nome para recado" class="floatlabel form-control" id="nome_contato" name="nome_contato"  value="<?php echo e($resume->contato->nome_contato); ?>">
                        <?php $__errorArgs = ['nome_contato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram" value="<?php echo e($resume->informacoesPessoais->instagram ?? ''); ?>">
                        <?php $__errorArgs = ['instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-6 form-campo">
                    <div class="mb-3">
                        <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin" value="<?php echo e($resume->informacoesPessoais->linkedin ?? ''); ?>">
                        <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                

                                

                <h4 class="fw-normal mb-4 mt-4">Mais Informações</h4>   

                <?php
                    $vagasInteresse = is_array($resume->vagas_interesse) 
                        ? $resume->vagas_interesse 
                        : json_decode($resume->vagas_interesse ?? '[]', true);
                ?>
                
                 <!-- Vagas Interesse -->
                <div class="d-flex col-6 form-campo">
                    <div class="mb-3 form-checkbox">
                        <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse2" value="Administrativo" name="vagas_interesse[]" <?php if(in_array('Administrativo', $vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse2">
                                Administrativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse5" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse5">
                                Atendente de Lojas e Mercados
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse3" value="Camareiro(a) de Hotel" name="vagas_interesse[]" <?php if(in_array('Camareiro(a) de Hotel',$vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse3">
                                Camareiro(a)/Mensageiro em Hotéis
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]" <?php if(in_array('Conservação e Limpeza', $vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse7">
                                Conservação e Limpeza
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse1" value="Copa & Cozinha" name="vagas_interesse[]" <?php if(in_array('Copa & Cozinha', $vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse1">
                                Copa & Cozinha
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse6" value="Construção e Reparos" name="vagas_interesse[]" <?php if(in_array('Construção e Reparos', $vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse6">
                                Manutenção/Construção e Reparos
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse4" value="Recepcionista" name="vagas_interesse[]" <?php if(in_array('Recepcionista',$vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse4">
                                Recepção
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vagas_interesse8" value="Garçom/Cumim" name="vagas_interesse[]" <?php if(in_array('Garçom/Cumim',$vagasInteresse)): echo 'checked'; endif; ?> >
                            <label class="form-check-label" for="vagas_interesse4">
                                Garçom/Cumim
                            </label>
                        </div>
                        <?php $__errorArgs = ['vagas_interesse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Experiência -->
                <div class="d-flex col-6 form-campo">
                    <div class="mb-3 form-checkbox">
                        <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                         <?php
                            $experienciaProfissional = [];
                            if (is_array($resume->experiencia_profissional)) {
                                $experienciaProfissional = $resume->experiencia_profissional;
                            } elseif (!empty($resume->experiencia_profissional)) {
                                $decoded = json_decode($resume->experiencia_profissional, true);
                                $experienciaProfissional = is_array($decoded) ? $decoded : [];
                            }
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional3" value="Administrativo" name="experiencia_profissional[]" <?php if(in_array('Administrativo', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional3">
                                Administrativo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional6" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional6">
                                Atendente de Lojas e Mercados
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional4" value="Camareiro(a) de Hotel" name="experiencia_profissional[]" <?php if(in_array('Camareiro(a) de Hotel', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional4">
                                Camareiro(a)/Mensageiro em Hotéis
                            </label>
                        </div>
                         <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional9" value="Conservação e Limpeza" name="experiencia_profissional[]" <?php if(in_array('Conservação e Limpeza', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional9">
                                Conservação e Limpeza
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional2" value="Copa & Cozinha" name="experiencia_profissional[]" <?php if(in_array('Copa & Cozinha', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional2">
                                Copa & Cozinha
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional8" value="Construção e Reparos" name="experiencia_profissional[]" <?php if(in_array('Construção e Reparos', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional8">
                                Manutenção/Construção e Reparos
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional5" value="Recepcionista" name="experiencia_profissional[]" <?php if(in_array('Recepcionista', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional5">
                                Recepção
                            </label>
                        </div>      
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional7" value="Garçon/Cumim" name="experiencia_profissional[]" <?php if(in_array('Garçon/Cumim)', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional7">
                                Garçom/Cumim
                            </label>
                        </div>                  

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional1" value="Nenhuma por enquanto" name="experiencia_profissional[]" <?php if(in_array('Nenhuma por enquanto', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional1">
                                Nenhuma Experiencia Profissional
                            </label>
                        </div>                       
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="experiencia_profissional10" value="Outro" name="experiencia_profissional[]" <?php if(in_array('Outro', $experienciaProfissional)): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="experiencia_profissional10">
                                Outro
                            </label>
                        </div>
                        <div class="campo-escondido check-experiencia"<?php echo (in_array('Outro', (array) $resume->experiencia_profissional ?? [])) ? ' style="display:block"' : ''; ?>>
                            <input type="text" placeholder="Qual?" class="floatlabel form-control" id="experiencia_profissional_outro" name="experiencia_profissional_outro" value="<?php echo e($resume->experiencia_profissional_outro); ?>">
                        </div>
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

                <!-- Formação -->
                <div class="d-flex col-12 form-campo">

                    <div class="mb-3 form-checkbox">
                        <label for="telefone_celular" class="form-label">Formação/Escolaridade*
                            (Especifique no campo "OUTRO" caso tenha Ensino Superior, Técnico ou outro)</label>

                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade4" value="Ensino Fundamental Completo" 
                                    <?php if(in_array(
                                        'Ensino Fundamental Completo', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade4">
                                    Ensino Fundamental Completo
                                </label>
                            </div>

                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade5" value="Ensino Fundamental Cursando" 
                                    <?php if(in_array(
                                        'Ensino Fundamental Cursando', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade5">
                                    Ensino Fundamental Cursando
                                </label>
                            </div>

                            
                            
                    
                            <div class="col-12 form-campo check-fundamental-cursando campo-escondido" id="fundamentalCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Fundamental Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Fundamental Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="fundamental_select_periodo" class="label-floatlabel">Qual ao Período?</label>
                                        <select name="fundamental_periodo" id="fundamental_select_periodo" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Manhã" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_periodo === 'Manhã') ? 'selected' : ''); ?>>Manhã</option>
                                            <option value="Tarde" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_periodo === 'Tarde') ? 'selected' : ''); ?>>Tarde</option>
                                            <option value="Noite" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_periodo === 'Noite') ? 'selected' : ''); ?>>Noite</option>
                                            <option value="Integral" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_periodo === 'Integral') ? 'selected' : ''); ?>>Integral</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['fundamental_periodo'];
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
                            
                            <div class="col-12 form-campo check-fundamental-cursando campo-escondido" id="fundamentalCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Fundamental Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Fundamental Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="fundamental_select_modalidade" class="label-floatlabel">Modalidade</label>
                                        <select name="fundamental_modalidade" id="fundamental_select_modalidade" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Presencial" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_modalidade === 'Presencial') ? 'selected' : ''); ?>>Presencial</option>
                                            <option value="EAD" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_modalidade === 'EAD') ? 'selected' : ''); ?>>EAD</option>
                                            <option value="Híbrido" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_modalidade === 'Híbrido') ? 'selected' : ''); ?>>Híbrido</option>
                                            <option value="Outros" <?php echo e(($resume->escolaridade && $resume->escolaridade->fundamental_modalidade === 'Outros') ? 'selected' : ''); ?>>Outros</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['fundamental_modalidade'];
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

                            
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo" 
                                <?php if(in_array(
                                        'Ensino Médio Completo', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade2">
                                    Ensino Médio Completo
                                </label>
                            </div>


                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto" 
                                    <?php if(in_array(
                                        'Ensino Médio Incompleto', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade1">
                                    Ensino Médio Cursando
                                </label>
                            </div>   
                            
                            
                    
                            <div class="col-12 form-campo check-medio-cursando campo-escondido" id="medioCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Médio Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Médio Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="medio_select_periodo" class="label-floatlabel">Qual ao Período?</label>
                                        <select name="medio_periodo" id="medio_select_periodo" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Manhã" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_periodo === 'Manhã') ? 'selected' : ''); ?>>Manhã</option>
                                            <option value="Tarde" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_periodo === 'Tarde') ? 'selected' : ''); ?>>Tarde</option>
                                            <option value="Noite" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_periodo === 'Noite') ? 'selected' : ''); ?>>Noite</option>
                                            <option value="Integral" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_periodo === 'Integral') ? 'selected' : ''); ?>>Integral</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['medio_periodo'];
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

                            <div class="col-12 form-campo check-medio-cursando campo-escondido" id="medioCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Médio Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Médio Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="medio_select_modalidade" class="label-floatlabel">Modalidade</label>
                                        <select name="medio_modalidade" id="medio_select_modalidade" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Presencial" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_modalidade === 'Presencial') ? 'selected' : ''); ?>>Presencial</option>
                                            <option value="EAD" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_modalidade === 'EAD') ? 'selected' : ''); ?>>EAD</option>
                                            <option value="Híbrido" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_modalidade === 'Híbrido') ? 'selected' : ''); ?>>Híbrido</option>
                                            <option value="Outros" <?php echo e(($resume->escolaridade && $resume->escolaridade->medio_modalidade === 'Outros') ? 'selected' : ''); ?>>Outros</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['medio_modalidade'];
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
                            

                            
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade6" value="Ensino Técnico Completo" 
                                    <?php if(in_array(
                                        'Ensino Técnico Completo', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade6">
                                    Ensino Técnico Completo
                                </label>
                            </div>

                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade7" value="Ensino Técnico Cursando" 
                                    <?php if(in_array(
                                        'Ensino Técnico Cursando', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade7">
                                    Ensino Técnico Cursando
                                </label>
                            </div>

                            
                    
                            <div class="col-12 form-campo check-tecnico-cursando campo-escondido" id="tecnicoCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Técnico Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Técnico Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <input  type="text" placeholder="Qual curso?" class="floatlabel form-control" id="tecnico_curso" name="tecnico_curso" value="<?php echo e($resume->escolaridade->tecnico_curso); ?>">
                                </div>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="tecnico_select_periodo" class="label-floatlabel">Qual ao Período?</label>
                                        <select name="tecnico_periodo" id="tecnico_select_periodo" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Manhã" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_periodo === 'Manhã') ? 'selected' : ''); ?>>Manhã</option>
                                            <option value="Tarde" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_periodo === 'Tarde') ? 'selected' : ''); ?>>Tarde</option>
                                            <option value="Noite" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_periodo === 'Noite') ? 'selected' : ''); ?>>Noite</option>
                                            <option value="Integral" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_periodo === 'Integral') ? 'selected' : ''); ?>>Integral</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['tecnico_periodo'];
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

                            <div class="col-12 form-campo check-tecnico-cursando campo-escondido" id="tecnicoCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Ensino Técnico Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Ensino Técnico Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="tecnico_select_modalidade" class="label-floatlabel">Modalidade</label>
                                        <select name="tecnico_modalidade" id="tecnico_select_modalidade" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Presencial" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_modalidade === 'Presencial') ? 'selected' : ''); ?>>Presencial</option>
                                            <option value="EAD" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_modalidade === 'EAD') ? 'selected' : ''); ?>>EAD</option>
                                            <option value="Híbrido" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_modalidade === 'Híbrido') ? 'selected' : ''); ?>>Híbrido</option>
                                            <option value="Outros" <?php echo e(($resume->escolaridade && $resume->escolaridade->tecnico_modalidade === 'Outros') ? 'selected' : ''); ?>>Outros</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['tecnico_modalidade'];
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


                            
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade8" value="Superior Completo" 
                                    <?php if(in_array(
                                        'Superior Completo', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade8">
                                    Superior Completo
                                </label>
                            </div>

                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade9" value="Superior Cursando" 
                                    <?php if(in_array(
                                        'Superior Cursando', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade9">
                                    Superior Cursando
                                </label>
                            </div>

                            
                    
                            <div class="col-12 form-campo check-superior-cursando campo-escondido" id="superiorCursandoContainer" <?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Superior Cursando', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Superior Cursando' ? ' style="display:block"' : ''); ?>>
                                <div class="mb-3">
                                    <input  type="text" placeholder="Qual curso?" class="floatlabel form-control" id="superior_curso" name="superior_curso" value="<?php echo e($resume->escolaridade->superior_curso); ?>">
                                </div>
                                <div class="mb-3">
                                    <input  type="text" placeholder="Qual Instituição?" class="floatlabel form-control" id="superior_semestre" name="superior_instituicao" value="<?php echo e($resume->escolaridade->superior_instituicao); ?>">
                                </div>
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="superior_select_periodo" class="label-floatlabel">Qual o Período?</label>
                                        <select name="superior_periodo" id="superior_select_periodo" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Manhã" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_periodo === 'Manhã') ? 'selected' : ''); ?>>Manhã</option>
                                            <option value="Tarde" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_periodo === 'Tarde') ? 'selected' : ''); ?>>Tarde</option>
                                            <option value="Noite" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_periodo === 'Noite') ? 'selected' : ''); ?>>Noite</option>
                                            <option value="Integral" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_periodo === 'Integral') ? 'selected' : ''); ?>>Integral</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['superior_periodo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="superior_select_modalidade" class="label-floatlabel">Qual a Modalidade?</label>
                                        <select name="superior_semestre" id="superior_select_modalidade" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Presencial" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_semestre === 'Presencial') ? 'selected' : ''); ?>>Presencial</option>
                                            <option value="EAD" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_semestre === 'EAD') ? 'selected' : ''); ?>>EAD</option>
                                            <option value="Híbrido" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_semestre === 'Híbrido') ? 'selected' : ''); ?>>Híbrido</option>
                                            <option value="Outros" <?php echo e(($resume->escolaridade && $resume->escolaridade->superior_semestre === 'Outros') ? 'selected' : ''); ?>>Outros</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['superior_semestre'];
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

                            
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro" 
                                <?php if(in_array(
                                        'Outro', 
                                        (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade)) 
                                            ? $resume->escolaridade->escolaridade 
                                            : []
                                    )): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="escolaridade3">
                                Outro
                                </label>
                            </div>

                            <div class="campo-escondido check-escolaridade"<?php echo is_array($resume->escolaridade?->escolaridade) ? ((in_array('Outro', $resume->escolaridade?->escolaridade ?? [])) ? ' style="display:block"' : '') : ($resume->escolaridade?->escolaridade === 'Outro' ? ' style="display:block"' : ''); ?>>
                                <input type="text" placeholder="Qual curso?" class="floatlabel form-control" id="escolaridade_outro" name="escolaridade_outro" value="<?php echo e($resume->escolaridade->escolaridade_outro ?? ''); ?>">
                                <input type="text" placeholder="Qual Instituição?" class="floatlabel form-control" id="instituicao" name="instituicao" value="<?php echo e($resume->escolaridade->instituicao ?? ''); ?>">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="outro_select_periodo" class="label-floatlabel">Qual o Período?</label>
                                        <select name="outro_periodo" id="outro_select_periodo" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Manhã" <?php echo e(($resume->escolaridade && $resume->escolaridade->outro_periodo === 'Manhã') ? 'selected' : ''); ?>>Manhã</option>
                                            <option value="Tarde" <?php echo e(($resume->escolaridade && $resume->escolaridade->outro_periodo === 'Tarde') ? 'selected' : ''); ?>>Tarde</option>
                                            <option value="Noite" <?php echo e(($resume->escolaridade && $resume->escolaridade->outro_periodo === 'Noite') ? 'selected' : ''); ?>>Noite</option>
                                            <option value="Integral" <?php echo e(($resume->escolaridade && $resume->escolaridade->outro_periodo === 'Integral') ? 'selected' : ''); ?>>Integral</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['outro_periodo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="floatlabel-wrapper">
                                        <label for="outro_select_modalidade" class="label-floatlabel">Qual a Modalidade?</label>
                                        <select name="semestre" id="outro_select_modalidade" class="form-select active-floatlabel">
                                            <option></option>
                                            <option value="Presencial" <?php echo e(($resume->escolaridade && $resume->escolaridade->semestre === 'Presencial') ? 'selected' : ''); ?>>Presencial</option>
                                            <option value="EAD" <?php echo e(($resume->escolaridade && $resume->escolaridade->semestre === 'EAD') ? 'selected' : ''); ?>>EAD</option>
                                            <option value="Híbrido" <?php echo e(($resume->escolaridade && $resume->escolaridade->semestre === 'Híbrido') ? 'selected' : ''); ?>>Híbrido</option>
                                            <option value="Outros" <?php echo e(($resume->escolaridade && $resume->escolaridade->semestre === 'Outros') ? 'selected' : ''); ?>>Outros</option>                                            
                                        </select>
                                        <?php $__errorArgs = ['semestre'];
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
                            <?php $__errorArgs = ['escolaridade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>

                <div class="d-flex col-6 form-campo">

                    <div class="mb-3 form-checkbox">
                        <label for="telefone_celular" class="form-label">Já foi Jovem Aprendiz?</label>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz1" value="Sim, da ASPPE" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="foi_jovem_aprendiz1">
                                Sim, da ASPPE
                            </label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz2" value="Sim, de Outra Qualificadora" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="foi_jovem_aprendiz2">
                                Sim, de Outra Qualificadora
                            </label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz3" value="Não" <?php echo e($resume->foi_jovem_aprendiz === 'Não' ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="foi_jovem_aprendiz3">
                                Não
                            </label>
                        </div>
                        <?php $__errorArgs = ['foi_jovem_aprendiz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                </div>

                

               
                <!-- Uniformes-->
                

                <div class="d-flex col-6 form-campo">

                    <div class="mb-3 form-checkbox">
                        <label for="informatica" class="form-label">Possui conhecimento no pacote Office (Excel/Word)</label>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="informatica" id="informatica1" value="Básico"<?php echo e(($resume->escolaridade && $resume->escolaridade->informatica === 'Básico') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="informatica1">
                                Básico
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="informatica" id="informatica2" value="Intermediário" <?php echo e(($resume->escolaridade && $resume->escolaridade->informatica === 'Intermediário') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="informatica2">
                            Intermediário
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Avançado" <?php echo e(($resume->escolaridade && $resume->escolaridade->informatica === 'Avançado') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="informatica3">
                            Avançado
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="informatica" id="informatica4" value="Nenhum" <?php echo e(($resume->escolaridade && $resume->escolaridade->informatica === 'Nenhum') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="informatica4">
                            Nenhum / Inexistente
                            </label>
                        </div>

                    </div>

                </div>

                <div class="d-flex col-6 form-campo">

                    <div class="mb-3 form-checkbox">
                        <label for="ingles" class="form-label">Conhecimento de Inglês?</label>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="ingles" id="ingles1" value="Básico"<?php echo e(($resume->escolaridade && $resume->escolaridade->ingles === 'Básico') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="ingles1">
                                Básico
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="ingles" id="ingles2" value="Intermediário" <?php echo e(($resume->escolaridade && $resume->escolaridade->ingles === 'Intermediário') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="ingles2">
                            Intermediário
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="ingles" id="ingles3" value="Avançado" <?php echo e(($resume->escolaridade && $resume->escolaridade->ingles === 'Avançado') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="ingles3">
                            Avançado
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="ingles" id="ingles4" value="Nenhum" <?php echo e(($resume->escolaridade && $resume->escolaridade->ingles === 'Nenhum') ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="ingles4">
                            Nenhum / Inexistente
                            </label>
                        </div>

                    </div>

                </div>  
                
                <div class="d-flex col-6 form-campo">
                    <div class="mb-3 form-checkbox">
                        <label for="cras" class="form-label">Sua família é atendida por algum equipamento do governo?(CRAS/CREAS/BOLSA FAMÍLIA/AUX. BRASIL)</label>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="cras" id="cras1" value="Sim" <?php echo e($resume->cras === 'Sim' ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['cras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="cras1">
                                Sim
                            </label>
                        </div>

                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="cras" id="cras2" value="Não" <?php echo e($resume->cras === 'Não' ? ' checked' : ' '); ?>>
                            <?php $__errorArgs = ['cras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <label class="form-check-label" for="cras2">
                            Não
                            </label>
                        </div>                                  

                    </div>
                </div>

                <div class="d-flex col-6 form-campo">
                    <div class="mb-3 form-checkbox pb-3">
                        <label for="fonte" class="form-label">Como ficou sabendo do nosso programa?</label>
                        <input type="text" placeholder="Site/Google/Etc" class="floatlabel form-control" id="fonte" name="fonte" value="<?php echo e($resume->fonte); ?>"  >
                    </div>
                </div> 

            </div>
            <?php if($editResume): ?>
                <div class="col-9 bloco-submit d-flex mt-3 mb-3">
                    <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                    <a href="<?php echo e(route('resumes.index')); ?>" class="btn-padrao btn-cancelar ms-3">Cancelar</a>

                </div>
                
            <?php endif; ?>


        </div>

        <div class="col-3 border-start py-0 ps-5 form-r">


            
            <div class="mb-3 d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Foto Candidato</p>
                <?php
                    $fotoCandidato = $resume->informacoesPessoais->foto_candidato;
                    $fotoCandidatoPath = $fotoCandidato ? asset("documents/resumes/fotos/{$fotoCandidato}") : asset("img/image-not-found.png");
                    //dd($fotoCandidatoPath);
                ?>


                <input type="file" id="foto_candidato" class="file-input" accept="image/*" name="foto_candidato">
                <div class="preview-container mb-3">
                    <img id="preview_foto_candidato" src="<?php echo e($fotoCandidatoPath); ?>" class="preview_foto_candidato" alt="Prévia da Foto Candidato">
                </div>
                <label for="foto_candidato" class="btn-padrao btn-select-file">Selecionar</label>


                

                <?php $__errorArgs = ['foto_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>                                
            

                <?php if($resume->informacoesPessoais->foto_candidato_externa): ?>
                    <div class="mb-5 d-flex flex-column align-items-center">   
                        <p class="fw-bold text-center">Foto armazenada no Drive</p>                                 
                    <a href="<?php echo e($resume->informacoesPessoais->foto_candidato_externa); ?>" target="_blank" class="fw-bold text-center">Baixar Foto do Candidato</a>
                </div>
            <?php endif; ?>

            <div class="mb-3 d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Enviar Currículo</p>

                
                <div class="preview-container mb-3">
                    <?php
                        $curriculo = $resume->curriculo_doc;
                        $curriculoPath = $curriculo ? asset("documents/resumes/curriculos/{$curriculo}") : "https://github.com/mdo.png";
                    ?>
                    <?php if($curriculo): ?>
                        <a href="<?php echo e($curriculoPath); ?>" target="_blank" > Baixar Currículo atual </a>
                        <input type="file" id="file-upload" class="file-input"
                        accept=".pdf" name="curriculo_doc" value="<?php echo e($resume->curriculo_doc); ?>">

                        
                    <?php else: ?>
                        <img id="preview-image" src="<?php echo e(asset('img/image-not-found.png')); ?>" class="preview-image" alt="Prévia do Currículo">
                        <input type="file" id="file-upload" class="file-input"
                        accept=".pdf" name="curriculo_doc" value="<?php echo e($resume->curriculo_doc); ?>">
                    <?php endif; ?>

                    <div id="preview-doc" class="preview-doc" style="display: none;">
                        <p id="file-name"></p>
                        <a id="file-download" href="#" target="_blank" class="btn btn-sm btn-primary">Baixar</a>
                    </div>
                </div>

                <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>

                <?php $__errorArgs = ['curriculo_doc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

        

            <?php if($resume->curriculo_externo): ?>
                <div class="mb-3 d-flex flex-column align-items-center">                                    
                    <a href="<?php echo e($resume->curriculo_externo); ?>" target="_blank" class="fw-bold text-center">Baixar Currículo Externo</a>
                </div>
                
            <?php endif; ?>

            

        </div>

    </div>

<?php /**PATH /home/case/Área de trabalho/2025/ldweb/Projeto asppe/painelasppe/resources/views/components/resume-edit-form.blade.php ENDPATH**/ ?>