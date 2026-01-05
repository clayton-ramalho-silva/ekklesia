<x-admin>
    @section('title', 'Criação de Ministérios')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Criar Ministério</h3>
            <div class="card-tools"><a href="{{ route('admin.ministerio.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ministerio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:*</label>
                            <input type="text" class="form-control" name="nome" required
                                value="{{ old('nome') }}">
                            <x-error>nome</x-error>
                        </div>
                    </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <textarea class="form-control" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                            <x-error>descricao</x-error>
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
                            <x-error>igreja_id</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lider_id" class="form-label">Lider:</label>
                            <select class="form-control" name="lider_id">
                                <option value="">Selecione um lider</option>
                                @foreach($membros as $membro)
                                    <option value="{{ $membro->id }}" {{ old('lider_') == $membro->id ? 'selected' : '' }}>
                                        {{ $membro->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error>lider_id</x-error>
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
