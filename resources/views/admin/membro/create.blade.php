<x-admin>
    @section('title', 'Criação de Membros')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Criar Membro</h3>
            <div class="card-tools"><a href="{{ route('admin.membro.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.membro.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:*</label>
                            <input type="text" class="form-control" name="nome" required
                                value="{{ old('nome') }}">
                            @error('nome')
                                <span class="text-danger">{{ $message }}</span>                                
                            @enderror
                            {{-- <x-error>nome</x-error> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="apelido" class="form-label">Apelido:</label>
                            <input type="text" class="form-control" name="apelido" 
                                value="{{ old('apelido') }}">
                                @error('apelido')
                                    
                                @enderror
                            {{-- <x-error>apelido</x-error> --}}
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="igreja_id" class="form-label">Igreja:*</label>
                            <select class="form-control" name="igreja_id" required>
                                <option value="">Selecione uma igreja</option>
                                @foreach($igrejas as $igreja)
                                    <option value="{{ $igreja->id }}" {{ old('igreja_id') == $igreja->id ? 'selected' : '' }}>
                                        {{ $igreja->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('igreja_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <x-error>igreja_id</x-error> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-control" name="status">
                                <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                                <option value="visitante" {{ old('status') == 'visitante' ? 'selected' : '' }}>Visitante</option>
                                <option value="transferido" {{ old('status') == 'transferido' ? 'selected' : '' }}>Transferido</option>
                                <option value="falecido" {{ old('status') == 'falecido' ? 'selected' : '' }}>Falecido</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <x-error>status</x-error> --}}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" name="data_nascimento" 
                                value="{{ old('data_nascimento') }}">
                            @error('data_nascimento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <x-error>data_nascimento</x-error> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <select class="form-control" name="sexo">
                                <option value="">Selecione</option>
                                <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Feminino</option>
                                <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Outro</option>
                            </select>
                             @error('sexo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <x-error>sexo</x-error> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="estado_civil" class="form-label">Estado Civil:</label>
                            <select class="form-control" name="estado_civil">
                                <option value="">Selecione</option>
                                <option value="solteiro" {{ old('estado_civil') == 'solteiro' ? 'selected' : '' }}>Solteiro</option>
                                <option value="casado" {{ old('estado_civil') == 'casado' ? 'selected' : '' }}>Casado</option>
                                <option value="viúvo" {{ old('estado_civil') == 'viúvo' ? 'selected' : '' }}>Viúvo</option>
                                <option value="divorciado" {{ old('estado_civil') == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                            </select>
                             @error('estado_civil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <x-error>estado_civil</x-error> --}}
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control cpf-mask" name="cpf" 
                                value="{{ old('cpf') }}" placeholder="000.000.000-00">
                             @error('cpf')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                                {{-- <x-error>cpf</x-error> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="rg" class="form-label">RG:</label>
                            <input type="text" class="form-control" name="rg" 
                                value="{{ old('rg') }}">
                            @error('rg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="titulo_eleitor" class="form-label">Título de Eleitor:</label>
                            <input type="text" class="form-control" name="titulo_eleitor" 
                                value="{{ old('titulo_eleitor') }}">
                            @error('titulo_eleitor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control phone-mask" name="telefone" 
                                value="{{ old('telefone') }}">
                             @error('telefone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" class="form-control" name="email" 
                                value="{{ old('email') }}">
                             @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="whatsapp_ativo" value="1" 
                                    {{ old('whatsapp_ativo') ? 'checked' : '' }}>
                                <label class="form-check-label" for="whatsapp_ativo">WhatsApp Ativo</label>
                            </div>
                             @error('whatsapp_ativo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cep" class="form-label">CEP:</label>
                            <input type="text" class="form-control cep-mask" name="cep" 
                                value="{{ old('cep') }}" placeholder="00000-000">
                             @error('cep')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="endereco" class="form-label">Endereço:</label>
                            <input type="text" class="form-control" name="endereco" 
                                value="{{ old('endereco') }}">
                             @error('endereco')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bairro" class="form-label">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" 
                                value="{{ old('bairro') }}">
                             @error('bairro')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cidade" class="form-label">Cidade:</label>
                            <input type="text" class="form-control" name="cidade" 
                                value="{{ old('cidade') }}">
                            @error('cidade')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="uf" class="form-label">UF:</label>
                            <select class="form-control" name="uf">
                                <option value="">Selecione</option>
                                @php
                                    $estados = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
                                @endphp
                                @foreach($estados as $estado)
                                    <option value="{{ $estado }}" {{ old('uf') == $estado ? 'selected' : '' }}>
                                        {{ $estado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('uf')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="data_conversao" class="form-label">Data de Conversão:</label>
                            <input type="date" class="form-control" name="data_conversao" 
                                value="{{ old('data_conversao') }}">
                            @error('data_conversao')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="data_batismo" class="form-label">Data de Batismo:</label>
                            <input type="date" class="form-control" name="data_batismo" 
                                value="{{ old('data_batismo') }}">
                            @error('data_batismo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="data_entrada_igreja" class="form-label">Data de Entrada na Igreja:</label>
                            <input type="date" class="form-control" name="data_entrada_igreja" 
                                value="{{ old('data_entrada_igreja') }}">
                            @error('data_entrada_igreja')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="observacoes" class="form-label">Observações:</label>
                            <textarea class="form-control" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="foto_url" class="form-label">Foto:</label>
                            <input type="file" class="form-control" name="foto_url" 
                                accept="image/*">
                            <small class="form-text text-muted">Aceita imagens (JPG, PNG, etc.)</small>
                            @error('foto_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin>
