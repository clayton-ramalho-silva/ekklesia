@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('interviews.index') }}">Nova Entrevista</a></li>
          <li class="breadcrumb-item active" aria-current="page">Candidato: {{ $resume->informacoesPessoais->nome }}</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('interviews.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

{{-- Sessão Edição Currículo --}}
<section class="sessao">

    <article class="f1">

        <div class="container mt-3">
            <div class="row form-padrao">
                <div class="col-6 d-flex justify-content-between mb-4">

                    {{-- Botão mudar status --}}
                       <x-status-button :resume="$resume" :status="$resume->status" />   
                       
                   {{-- Fim Botão mudar status --}}
                    
                    {{-- <p class="fw-bold">Data do cadastro: {{$resume->created_at->format('d/m/Y') }}</p> --}}
                </div>
                 <div class="col-6">
                            <div class="col-12 bloco-ativo d-flex mb-3">

                                <p class="fw-bold">Currículo Cadastrado em: {{$resume->created_at->format('d/m/Y') }}</p>
                            </div>

                        </div>
                
            </div>
        

            

        </div>

    </article>

</section>
{{-- Fim Sessão Edição Currículo --}}

{{-- Entrevista --}}
<section class="sessao mt-5">

    <article class="f1">

        <div class="container mt-3">

            <form class="form-padrao" id="form-interview" action="{{ route('interviews.store')}}" method="post" enctype="multipart/form-data">

                {{-- Formulário Edição Currículo --}}                    
                <x-resume-edit-form 
                    :resume="$resume"
                    :editResume="false" 
                />
                {{-- Fim Formulário Edição Currículo --}}
                <div class="row mb-3 mt-3">

                    <div class="col-12">
                        <h4>Entrevista</h4>
                    </div>

                    <div class="col-12 d-flex flex-wrap">

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Data Entrevista:</b> {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Hora Entrevista:</b> {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('H:i:s') }}
                            </p>
                        </div>
                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Entrevistador:</b> {{ Auth::user()->name }}
                            </p>
                        </div>

                    </div>

                </div>

                @csrf
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                <div class="row mb-3 mt-3">

                    <!-- Inicio -->
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="outros_idiomas" class="label-floatlabel" class="form-label floatlabel-label">Fala outro idioma?</label>
                                <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" >{{ old('outros_idiomas') }}</textarea>
                                @error('outros_idiomas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="apresentacao_pessoal" class="label-floatlabel" class="form-label floatlabel-label">Sobre sua apresentação pessoal (Tem piercing? Pode Tirar? Tatto?)</label>
                                <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" >{{ old('apresentacao_pessoal') }}</textarea>
                                @error('apresentacao_pessoal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="saude_candidato" class="label-floatlabel" class="form-label floatlabel-label">Sobre A Sua Saúde? (Saúde Física: Toma Medicação? / Faz Algum Tratamento? / Tem Alguma Restrição De Mobilidade? Alguma Cirurgia Realizada Ou À Realizar? – Saúde Mental: Faz Terapia? Já Fez? Toma Medicação?)</label>
                                <textarea class="form-control" id="saude_candidato" name="saude_candidato"  style="padding-top: 43px !important">{{ old('saude_candidato') }}</textarea>
                                @error('saude_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>                            
                        </div>
                    </div>
                    
                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="vacina_covid" class="label-floatlabel" class="form-label floatlabel-label">Vacina COVID</label>
                                <select name="vacina_covid" id="vacina_covid" class="form-select active-floatlabel altura-75" style="height: 75px !important" >
                                    <option></option>
                                    <option value="Não pretende tomar" {{ old('vacina_covid') === 'Não pretende tomar' ? 'selected' : ''}}> Não pretende tomar</option>
                                    <option value="Pretende tomar" {{ old('vacina_covid') === 'Pretende tomar' ? 'selected' : ''}}> Pretende tomar</option>
                                    <option value="1 dose" {{ old('vacina_covid') === '1 dose' ? 'selected' : ''}}> 1 dose</option>
                                    <option value="2 doses" {{ old('vacina_covid') === '2 doses' ? 'selected' : ''}}> 2 doses</option>
                                    <option value="3 doses" {{ old('vacina_covid') === '3 doses' ? 'selected' : ''}}> 3 doses</option>
                                    <option value="4 doses" {{ old('vacina_covid') === '4 doses' ? 'selected' : ''}}> 4 doses ou mais</option>
                                    <option value="Não tomou" {{ old('vacina_covid') === 'Não tomou' ? 'selected' : ''}}> Não tomou</option>
                                </select>
                                @error('vacina_covid') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="ja_foi_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Já foi jovem aprendiz?</label>
                                <select name="ja_foi_jovem_aprendiz" id="ja_foi_jovem_aprendiz" class="form-select active-floatlabel altura-75" disabled>
                                    <option></option>
                                    <option value="Sim, da ASPPE" {{ $resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'selected' : ''}}> Sim, da ASPPE</option>
                                    <option value="Sim, de Outra Qualificadora" {{ $resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'selected' : ''}}> Sim, de Outra Qualificadora</option>
                                    <option value="Não" {{ $resume->foi_jovem_aprendiz === 'Não' ? 'selected' : ''}}> Não</option>                                    
                                </select>
                                @error('ja_foi_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-5 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel altura-75" id="qual_formadora" name="qual_formadora" placeholder="Qual a formadora?(Caso já tenha sido jovem aprendiz.)"  value="{{ old('qual_formadora') }}">
                            @error('qual_formadora') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="experiencia_profissional" class="label-floatlabel" class="form-label floatlabel-label">Experiência profissional (nome da empresa, tempo de empresa, motivo da saída, que atividades exercia)</label>
                                <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" >{{ old('experiencia_profissional') }}</textarea>
                                @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="qual_motivo_demissao" class="label-floatlabel" class="form-label floatlabel-label">Por qual motivo você pediria demissão?</label>
                                <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" >{{ old('qual_motivo_demissao') }}</textarea>
                                @error('qual_motivo_demissao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="caracteristicas_positivas" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas caracteristicas positivas? </label>
                                <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" >{{ old('caracteristicas_positivas') }}</textarea>
                                @error('caracteristicas_positivas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="habilidades" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas habilidades?</label>
                                <textarea class="form-control" id="habilidades" name="habilidades" >{{ old('habilidades') }}</textarea>
                                @error('habilidades') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pontos_melhoria" class="label-floatlabel" class="form-label floatlabel-label">Um ponto de melhoria?</label>
                                <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" >{{ old('pontos_melhoria') }}</textarea>
                                @error('pontos_melhoria') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sobre_candidato" class="label-floatlabel" class="form-label floatlabel-label">Fale um pouco sobre você.</label>
                                <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" >{{ old('sobre_candidato') }}</textarea>
                                @error('sobre_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="rotina_candidato" class="label-floatlabel" class="form-label floatlabel-label">Qual sua rotina, me fale um pouco sobre você (hobbies, compromissos religosos, esportivos)</label>
                                <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" >{{ old('rotina_candidato') }}</textarea>
                                @error('rotina_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="disponibilidade_horario" class="label-floatlabel" class="form-label floatlabel-label">Disponibilidade Para O Trabalho (Total, Horario Comercial, Disp Aos Finais De Semana?)</label>
                                <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" >{{ old('disponibilidade_horario') }}</textarea>
                                @error('disponibilidade_horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="familia" class="label-floatlabel" class="form-label floatlabel-label">Me fale da sua famila (mora com quem? O que os pais fazem?)</label>
                                <textarea class="form-control" id="familia" name="familia" >{{ old('familia') }}</textarea>
                                @error('familia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="renda_familiar" name="renda_familiar" placeholder="Qual a renda familiar da sua casa?"  value="{{ old('renda_familiar') }}">
                            @error('renda_familiar') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Recebe algum benefício do governo?</label>
                                <select name="familia_cras" id="familia_cras" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="Sim" {{ old('familia_cras') === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ old('familia_cras') === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('familia_cras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                
                    <!-- Campo de Tipo Benefcio -->
                    <div class="col-4 form-campo" id="tipoBeneficioContainer" >
                        <div class="mb-3">
                            <div class="floatlabel-wrapper">
                                <input type="text" class="floatlabel form-control" id="tipo_beneficio" name="tipo_beneficio" placeholder="Tipo Benefício: Bolsa Família, CRAS, CREAS." value="{{ old('tipo_beneficio') }}" disabled>
                                @error('tipo_beneficio') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pretencao_candidato" class="label-floatlabel" class="form-label floatlabel-label">Pretenções do candidato</label>
                                <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" >{{ old('pretencao_candidato') }}</textarea>
                                @error('pretencao_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="objetivo_longo_prazo" class="label-floatlabel" class="form-label floatlabel-label">Quais são seus objetivos profissionais para o futuro?</label>
                                <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" >{{ old('objetivo_longo_prazo') }}</textarea>
                                @error('objetivo_longo_prazo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="curso_extracurricular" class="label-floatlabel" class="form-label floatlabel-label">Cursos Extracurriculares</label>
                                <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" >{{ old('curso_extracurricular') }}</textarea>
                                @error('curso_extracurricular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="porque_ser_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Porque gostaria de ser Jovem Aprendiz?</label>
                                <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" >{{ old('porque_ser_jovem_aprendiz') }}</textarea>
                                @error('porque_ser_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="fonte_curriculo" name="fonte_curriculo" placeholder="Fonte de Captação (Como soube da ASPPE?)"  value="{{ old('fonte_curriculo') }}">
                            @error('fonte_curriculo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Perfil Santa Casa?</label>
                                <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="Sim" {{ old('perfil_santa_casa') === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ old('perfil_santa_casa') === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('perfil_santa_casa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="perfil" class="label-floatlabel" class="form-label floatlabel-label">Perfil?</label>
                                <select name="perfil" id="perfil" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="ADMINISTRATIVO" {{ old('perfil') === 'ADMINISTRATIVO' ? 'selected' : ''}}>ADMINISTRATIVO</option>
                                    <option value="OPERACIONAL" {{ old('perfil') === 'OPERACIONAL' ? 'selected' : ''}}> OPERACIONAL</option>                                    
                                    <option value="ADM / OPERACIONAL" {{ old('perfil') === 'ADM / OPERACIONAL' ? 'selected' : ''}}>ADM / OPERACIONAL</option>
                                </select>
                                @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    

                    {{-- <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil" class="label-floatlabel" class="form-label floatlabel-label">Perfil</label>
                                <select name="perfil" id="perfil" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Administrativo" {{ old('perfil') === 'Administrativo' ? 'selected' : ''}}> Administrativo</option>
                                    <option value="Operacional" {{ old('perfil') === 'Operacional' ? 'selected' : ''}}> Operacional</option>
                                    <option value="Adm / Operacional" {{ old('perfil') === 'Adm / Operacional' ? 'selected' : ''}}> Adm / Operacional</option>
                                </select>
                                @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Sugestão Empresa</label>
                                <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" >{{ old('sugestao_empresa') }}</textarea>
                                @error('sugestao_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Parecer do RH</label>
                                <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador">{{ old('parecer_recrutador') }}</textarea>
                                @error('parecer_recrutador') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="observacoes" class="label-floatlabel" class="form-label floatlabel-label">Entrevistas</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" >{{ old('observacoes') }}</textarea>
                                @error('observacoes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="obs_rh" class="label-floatlabel" class="form-label floatlabel-label">Observações RH</label>
                                <textarea class="form-control" id="obs_rh" name="obs_rh" >{{ old('obs_rh') }}</textarea>
                                @error('obs_rh') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="pontuacao" name="pontuacao" placeholder="Pontuação" required value="{{ old('pontuacao') }}">
                            @error('pontuacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div> --}}

                    <!-- Fim -->                    


                    <div class="mt-3 bloco-submit">
                        <button type="submit" class="btn btn-primary btn-padrao btn-cadastrar">Salvar Entrevista</button>
                    </div>

                    <div class="col-8"></div>

                </div>

            </form>

            {{-- <div class="row mb-3 mt-3">
                <div class="col-4">
                    <h4>Entrevista</h4>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Data Entrevista: {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y') }}</p>

                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Hora Entrevista: {{ \Carbon\Carbon::now('America/Sao_Paulo')->format('H:i:s') }}</p>

                    </div>
                </div>
            </div>

            <form action="{{ route('interviews.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                <div class="row mb-3 mt-3">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="saude_candidato" class="form-label">Saúde do Candidato:</label>
                            <input type="text" class="form-control" id="saude_candidato" name="saude_candidato" required value="{{ old('saude_candidato') }}">
                            @error('saude_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="vacina_covid" class="form-label">Vacina COVID:</label>
                            <select name="vacina_covid" id="vacina_covid" class="form-select" required>
                                <option value="" selected disabled>Escolher</option>
                                <option value="Não pretende tomar" {{ old('vacina_covid') === 'Não pretende tomar' ? 'selected' : ''}}> Não pretende tomar</option>
                                <option value="Pretende tomar" {{ old('vacina_covid') === 'Pretende tomar' ? 'selected' : ''}}> Pretende tomar</option>
                                <option value="1 dose" {{ old('vacina_covid') === '1 dose' ? 'selected' : ''}}> 1 dose</option>
                                <option value="2 doses" {{ old('vacina_covid') === '2 doses' ? 'selected' : ''}}> 2 doses</option>
                                <option value="3 doses" {{ old('vacina_covid') === '3 doses' ? 'selected' : ''}}> 3 doses</option>
                                <option value="4 doses" {{ old('vacina_covid') === '4 doses' ? 'selected' : ''}}> 4 doses</option>
                                <option value="5 ou mais doses" {{ old('vacina_covid') === '5 ou mais doses' ? 'selected' : ''}}> 5 ou mais doses</option>
                            </select>
                            @error('vacina_covid') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil" class="form-label">Perfil:</label>
                            <select name="perfil" id="perfil" class="form-select" required>
                                <option value="" selected disabled>Escolher</option>
                                <option value="Administrativo" {{ old('perfil') === 'Administrativo' ? 'selected' : ''}}> Administrativor</option>
                                <option value="Operacional" {{ old('perfil') === 'Operacional' ? 'selected' : ''}}> Operacional</option>
                                <option value="Adm / Operacional" {{ old('perfil') === 'Adm / Operacional' ? 'selected' : ''}}> Adm / Operacional</option>
                            </select>
                            @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil_santa_casa" class="form-label">Perfil Santa Casa:</label>
                            <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select" required>
                                <option value="" selected disabled>Escolher</option>
                                <option value="Sim" {{ old('perfil_santa_casa') === 'Sim' ? 'selected' : ''}}> Sim</option>
                                <option value="Não" {{ old('perfil_santa_casa') === 'Não' ? 'selected' : ''}}> Não</option>
                            </select>
                            @error('perfil_santa_casa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="classificacao" class="form-label">Classificação:</label>
                            <select name="classificacao" id="classificacao" class="form-select" required>
                                <option value="" selected disabled>Escolher</option>
                                <option value="A" {{ old('classificacao') === 'A' ? 'selected' : ''}}> A</option>
                                <option value="B" {{ old('classificacao') === 'B' ? 'selected' : ''}}> B</option>
                                <option value="C" {{ old('classificacao') === 'C' ? 'selected' : ''}}> C</option>
                                <option value="D" {{ old('classificacao') === 'D' ? 'selected' : ''}}> D</option>
                            </select>
                            @error('classificacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_formadora" class="form-label">Qual a formadora?(Caso já tenha sido jovem aprendiz.)</label>
                            <input type="text" class="form-control" id="qual_formadora" name="qual_formadora" required value="{{ old('qual_formadora') }}">
                            @error('qual_formadora') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="parecer_recrutador" class="form-label">Parecer do Entrevistador:</label>
                            <textarea class="form-control" rows="5" id="parecer_recrutador" name="parecer_recrutador" >{{ old('parecer_recrutador') }}</textarea>
                            @error('parecer_recrutador') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="curso_extracurricular" class="form-label">Cursos Extracurriculares:</label>
                            <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" >{{ old('curso_extracurricular') }}</textarea>
                            @error('curso_extracurricular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="apresentacao_pessoal" class="form-label">Apresentação Pessoal:</label>
                            <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" >{{ old('apresentacao_pessoal') }}</textarea>
                            @error('apresentacao_pessoal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="experiencia_profissional" class="form-label">Experiência Profissional (Tempo de Empresa/Motivo da Saída):</label>
                            <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" >{{ old('experiencia_profissional') }}</textarea>
                            @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="caracteristicas_positivas" class="form-label">Características Positivas:</label>
                            <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" >{{ old('caracteristicas_positivas') }}</textarea>
                            @error('caracteristicas_positivas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="habilidades" class="form-label">Habilidades:</label>
                            <textarea class="form-control" id="habilidades" name="habilidades" >{{ old('habilidades') }}</textarea>
                            @error('habilidades') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="porque_ser_jovem_aprendiz" class="form-label">Porque gostaria de ser Jovem Aprendiz?</label>
                            <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" >{{ old('porque_ser_jovem_aprendiz') }}</textarea>
                            @error('porque_ser_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_motivo_demissao" class="form-label">Por qual motivo pediria demissão:</label>
                            <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" >{{ old('qual_motivo_demissao') }}</textarea>
                            @error('qual_motivo_demissao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pretencao_candidato" class="form-label">Pretenções do candidato:</label>
                            <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" >{{ old('pretencao_candidato') }}</textarea>
                            @error('pretencao_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="objetivo_longo_prazo" class="form-label">Objetivos longo prazo:</label>
                            <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" >{{ old('objetivo_longo_prazo') }}</textarea>
                            @error('objetivo_longo_prazo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontos_melhoria" class="form-label">Pontos de Melhoria:</label>
                            <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" >{{ old('pontos_melhoria') }}</textarea>
                            @error('pontos_melhoria') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia" class="form-label">Família:</label>
                            <textarea class="form-control" id="familia" name="familia" >{{ old('familia') }}</textarea>
                            @error('familia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="disponibilidade_horario" class="form-label">Disponibilidade de Horário:</label>
                            <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" >{{ old('disponibilidade_horario') }}</textarea>
                            @error('disponibilidade_horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sobre_candidato" class="form-label">Fale um pouco sobre você:</label>
                            <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" >{{ old('sobre_candidato') }}</textarea>
                            @error('sobre_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="rotina_candidato" class="form-label">Qual a sua rotina?</label>
                            <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" >{{ old('rotina_candidato') }}</textarea>
                            @error('rotina_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia_cras" class="form-label">Sua família é atendida no CRAS?</label>
                            <select name="familia_cras" id="familia_cras" class="form-select" required>
                                <option value="" selected disabled>Escolher</option>
                                <option value="Sim" {{ old('familia_cras') === 'Sim' ? 'selected' : ''}}> Sim</option>
                                <option value="Não" {{ old('familia_cras') === 'Não' ? 'selected' : ''}}> Não</option>
                            </select>
                            @error('familia_cras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="outros_idiomas" class="form-label">Outros idiomas?</label>
                            <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" >{{ old('outros_idiomas') }}</textarea>
                            @error('outros_idiomas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="fonte_curriculo" class="form-label">Fonte de Captação do Currículo</label>
                            <input type="text" class="form-control" id="fonte_curriculo" name="fonte_curriculo" required value="{{ old('fonte_curriculo') }}">
                            @error('fonte_curriculo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sugestao_empresa" class="form-label">Sugestão Empresa</label>
                            <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" >{{ old('sugestao_empresa') }}</textarea>
                            @error('sugestao_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações:</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" >{{ old('observacoes') }}</textarea>
                            @error('observacoes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontuacao" class="form-label">Pontuação</label>
                            <input type="text" class="form-control" id="pontuacao" name="pontuacao" required value="{{ old('pontuacao') }}">
                            @error('pontuacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row bg-light p-3 mb-2">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Salvar Entrevista</button>

                    </div>
                </div>


            </form> --}}

        </div>

    </article>

</section>

<section class="sessao my-5">   

    {{-- Componente Tabela Vagas Associadas --}}
    <x-resume-jobs-table :resume="$resume" />

    {{-- Fim Componente Tabela Vagas Associadas --}}

   
    {{-- Componente Tabela Processos Seletivos --}}
    <x-resume-selections-table :resume="$resume" />
    {{-- Fim Componente Tabela Processos Seletivos --}}   
   
</section>

@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
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


// Previne que o clique no botão de desassociar abra o link
document.addEventListener('DOMContentLoaded', function() {
    
    // Seleciona todos os botões de desassociar
    const botoesDesassociar = document.querySelectorAll('.col7-admin button[type="submit"]');
    
    botoesDesassociar.forEach(botao => {
        botao.addEventListener('click', function(event) {
            // Previne que o evento se propague para o <ul> pai
            event.stopPropagation();
            
            // Opcional: adicionar confirmação antes de desassociar
            if (!confirm('Tem certeza que deseja desassociar este currículo?')) {
                event.preventDefault();
                return false;
            }
        });
    });
    
    // Também previne o clique em toda a coluna col5-admin
    const colunasDesassociar = document.querySelectorAll('.col7-admin');
    
    colunasDesassociar.forEach(coluna => {
        coluna.addEventListener('click', function(event) {
            // Previne que o clique na coluna abra o link
            event.stopPropagation();
        });
    });
    
});

// Alternativa: Função inline que você pode usar diretamente no HTML
function preventPropagation(event) {
    event.stopPropagation();
}
</script>
@endpush

@push('css-custom')
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
@endpush