@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Vagas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('jobs.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

<section class="sessao">

    <article class="f1">

        <div class="container">

            <form id="form-jobs" class="form-padrao" action="{{ route('jobs.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="mb-3 col-6">
                        <div class="floatlabel-wrapper required">
                            <label for="company_id" class="label-floatlabel" class="form-label floatlabel-label">Escolher Empresa</label>
                            <select name="company_id" id="company_id" class="form-select" required>
                                <option></option>
                                @foreach ($companies->sortBy('nome_fantasia') as $company )
                                    <option value="{{ $company->id}}" {{ old('company_id') == $company->id ? 'selected' : '' }}> {{ $company->nome_fantasia }} </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Área" class="floatlabel form-control" id="setor" name="setor" value="{{ old('setor') }}" required>
                        @error('setor') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-4 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="cargo" class="label-floatlabel" class="form-label floatlabel-label">Setor</label>
                            <select name="cargo" id="cargo" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Copa & Cozinha" {{ old('cargo') == 'Copa & Cozinha' ? 'selected': '' }} >Copa & Cozinha</option>
                                <option value="Administrativo" {{ old('cargo') == 'Administrativo' ? 'selected': '' }}>Administrativo</option>
                                <option value="Camareiro(a) de Hotel" {{ old('cargo') == 'Camareiro(a) de Hotel' ? 'selected': '' }}>Camareiro(a) de Hotel</option>
                                <option value="Recepcionista" {{ old('cargo') == 'Recepcionista' ? 'selected': '' }}>Recepcionista</option>
                                <option value="Atendente de Lojas e Mercados (Comércio & Varejo)" {{ old('cargo') == 'Atendente de Lojas e Mercados (Comércio & Varejo)' ? 'selected': '' }}>Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                                <option value="Construção e Reparos" {{ old('cargo') == 'Construção e Reparos' ? 'selected': '' }}>Construção e Reparos</option>
                                <option value="Conservação e Limpeza" {{ old('cargo') == 'Conservação e Limpeza' ? 'selected': '' }}>Conservação e Limpeza</option>
                            </select>
                            @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-4 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="cbo" class="label-floatlabel" class="form-label floatlabel-label">CBO</label>
                            <select name="cbo" id="cbo" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="4110-10" {{ old('cbo') == '4110-10' ? 'selected' : '' }}>4110-10 / Assistente Administrativo</option>
                                <option value="4122-05" {{ old('cbo') == '4122-05' ? 'selected' : '' }}>4122-05 / Contínuo</option>
                                <option value="4211-25" {{ old('cbo') == '4211-25' ? 'selected' : '' }}>4211-25 / Operador de Caixa</option>
                                <option value="4221-05" {{ old('cbo') == '4221-05' ? 'selected' : '' }}>4221-05 / Recepcionista Geral</option>
                                <option value="5133-15" {{ old('cbo') == '5133-15' ? 'selected' : '' }}>5133-15 / Camareiro de Hotel</option>
                                <option value="5134-05" {{ old('cbo') == '5134-05' ? 'selected' : '' }}>5134-05 / Garçom</option>
                                <option value="5134-15" {{ old('cbo') == '5134-15' ? 'selected' : '' }}>5134-15 / Cumim</option>
                                <option value="5134-25" {{ old('cbo') == '5134-25' ? 'selected' : '' }}>5134-25 / Copeiro</option>
                                <option value="5134-35" {{ old('cbo') == '5134-35' ? 'selected' : '' }}>5134-35 / Atendente de lanchonete</option>
                                <option value="5135-05" {{ old('cbo') == '5135-05' ? 'selected' : '' }}>5135-05 / Aux. nos Serviços de Alimentação</option>
                                <option value="5142-25" {{ old('cbo') == '5142-25' ? 'selected' : '' }}>5142-25 / Trabalhador de serviços de limpeza e conservação</option>
                                <option value="5143-25" {{ old('cbo') == '5143-25' ? 'selected' : '' }}>5143-25 / Trabalhador na Manutenção de Edificações</option>
                                <option value="5211-25" {{ old('cbo') == '5211-25' ? 'selected' : '' }}>5211-25 / Repositor de Mercadorias</option>
                                <option value="5211-35" {{ old('cbo') == '5211-35' ? 'selected' : '' }}>5211-35 / Frentista</option>
                                <option value="5211-40" {{ old('cbo') == '5211-40' ? 'selected' : '' }}>5211-40 / Atendente de lojas e mercados</option>                              
                            </select>
                            @error('cbo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper">
                                <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Entrevista na Empresa</label>
                                <input type="date" class="form-control active-floatlabel" id="data_entrevista_empresa" name="data_entrevista_empresa" value="{{ old('data_entrevista_empresa') }}">
                                @error('data_entrevista_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <div class="floatlabel-wrapper form-textarea">
                            <label for="descricao" class="label-floatlabel" class="form-label floatlabel-label">Atividades esperadas</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control">{{ old('descricao') }}</textarea>
                            @error('descricao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="genero" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                            <select name="genero" id="genero" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Feminino" {{ old('genero') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                <option value="Indiferente" {{ old('genero') == 'Indiferente' ? 'selected' : '' }}>Indiferente</option>
                            </select>
                            @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="number" placeholder="Quantidade de vagas" class="floatlabel form-control" id="qtd_vagas" name="qtd_vagas" value="{{ old('qtd_vagas') }}" required>
                        @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-4 form-campo">
                        <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
                        @error('cidade') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 form-campo col-2">
                        <div class="floatlabel-wrapper required">
                            <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                            <select name="uf" id="uf" class="form-select active-floatlabel" required>
                                <option></option>
                                @php
                                echo get_estados(old('uf'));
                                @endphp
                            </select>
                            @error('genero') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- <div class="mb-3 col-2 form-campo">
                        <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required>
                        @error('uf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div> --}}

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Salário" class="floatlabel form-control" id="salario" name="salario" value="{{ old('salario') }}" required>
                        @error('salario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Escala" class="floatlabel form-control" id="dias_semana" name="dias_semana" value="{{ old('dias_semana') }}" required placeholder="Seg. à Sáb.">
                        @error('dias_semana') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Horário" class="floatlabel form-control" id="horario" name="horario" value="{{ old('horario') }}" required>
                        @error('horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Dia, Hora e Modalidade do Curso" class="floatlabel form-control" id="dias_curso" name="dias_curso" value="{{ old('dias_curso') }}">
                        @error('dias_curso') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <input type="text" placeholder="Benefícios" class="floatlabel form-control" id="exp_profissional" name="exp_profissional" value="{{ old('exp_profissional') }}" required>
                        @error('cargo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-12">
                        <div class="floatlabel-wrapper form-textarea">
                            <label for="beneficios" class="label-floatlabel" class="form-label floatlabel-label">Requisitos/Diferenciais</label>
                            <textarea class="form-control active-floatlabel" id="beneficios" name="beneficios" required>{{ old('beneficios') }}</textarea>
                            @error('exp_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="informatica" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em informática?</label>
                            <select name="informatica" id="informatica" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Não" {{ old('informatica') == 'Não' ? 'selected' : '' }}>Não</option>
                                <option value="Básico" {{ old('informatica') == 'Básico' ? 'selected' : '' }}>Básico</option>
                                <option value="Intermediário" {{ old('informatica') == 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                <option value="Avançado" {{ old('informatica') == 'Avançado' ? 'selected' : '' }}>Avançado</option>
                            </select>
                            @error('informatica') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-6 form-campo">
                        <div class="floatlabel-wrapper required">
                            <label for="ingles" class="label-floatlabel" class="form-label floatlabel-label">Conhecimento em inglês?</label>
                            <select name="ingles" id="ingles" class="form-select active-floatlabel" required>
                                <option></option>
                                <option value="Não" {{ old('ingles') == 'Não' ? 'selected' : '' }}>Não</option>
                                <option value="Básico" {{ old('ingles') == 'Básico' ? 'selected' : '' }}>Básico</option>
                                <option value="Intermediário" {{ old('ingles') == 'Intermediário' ? 'selected' : '' }}>Intermediário</option>
                                <option value="Avançado" {{ old('ingles') == 'Avançado' ? 'selected' : '' }}>Avançado</option>
                            </select>
                            @error('ingles') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                <div class="col-12 bloco-submit mt-3 d-flex">
                    <button type="submit" class="btn-padrao btn-cadastrar">Salvar</button>
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
$('#salario').mask('#.##0,00', {reverse: true});
$('#company_id').select2({
    placeholder: "Selecione",
});
/*
$('#setor').select2({
    placeholder: "Selecione um setor",
});
*/
$('#uf').select2({
    placeholder: "Selecione",
});
$('#cbo').select2({
    placeholder: "Selecione",
});
$('#cargo').select2({
    placeholder: "Selecione",
});
$('#genero').select2({
    placeholder: "Selecione",
});
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});

$("#form-jobs").validate({
    ignore: [],
    rules:{
        company_id:"required",
        setor:"required",
        cbo:"required",
        cargo:"required",
        genero:"required",
        qtd_vagas:"required",
        cidade:"required",
        uf:"required",
        salario:"required",
        dias_semana:"required",
        horario:"required",
        //dias_curso:"required",
        exp_profissional:"required",
        beneficios:"required",
        informatica:"required",
        ingles:"required",
    }
});
</script>
@endpush

@push('css-custom')
<style>
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

</style>
@endpush