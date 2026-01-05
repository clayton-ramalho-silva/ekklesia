<x-admin>
    @section('title', 'Editar Ministério')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Ministério</h3>
            <div class="card-tools"><a href="{{ route('admin.ministerio.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ministerio.update',$ministerio) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $ministerio->id }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:*</label>
                            <input type="text" class="form-control" name="nome" required
                                value="{{ $ministerio->nome }}">
                            <x-error>nome</x-error>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <textarea class="form-control" name="descricao" rows="3">{{ $ministerio->descricao }}</textarea>
                            <x-error>descricao</x-error>
                        </div>
                    </div>                   
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="igreja_id" class="form-label">Igreja:*</label>
                            <select class="form-control" name="igreja_id" required>
                                <option value="">Selecione uma igreja</option>
                                @foreach($igrejas as $igreja)
                                    <option value="{{ $igreja->id }}" {{ $ministerio->igreja_id == $igreja->id ? 'selected' : '' }}>
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
                            <select class="form-control" name="lider_id" >
                                <option value="">Selecione um lider</option>
                                @foreach($membros as $membro)
                                    <option value="{{ $membro->id }}" {{ $ministerio->lider_id == $membro->id ? 'selected' : '' }}>
                                        {{ $membro->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error>lider_id</x-error>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="membros" class="form-label">Membros do Ministério:</label>
                            <small class="d-block text-muted mb-1">
                                Segure <kbd>Ctrl</kbd> (ou <kbd>Cmd</kbd> no Mac) para selecionar múltiplos.
                            </small>
                            <select 
                                class="form-control select2-membros" 
                                name="membros[]" 
                                multiple
                            >
                                @foreach($membros as $membro)
                                    <option 
                                        value="{{ $membro->id }}" 
                                        {{ $ministerio->membros->contains($membro->id) ? 'selected' : '' }}
                                    >
                                        {{ $membro->nome }} 
                                        @if($membro->id == $ministerio->lider_id) 
                                            (Líder)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <x-error>membros</x-error>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    @section('js')
        <script>
            $(document).ready(function() {
                $('.select2-membros').select2({
                    placeholder: "Selecione os membros...",
                    allowClear: true,
                    width: '100%',
                    // Opcional: ícone de usuário
                    templateResult: formatMembro,
                    templateSelection: formatMembro
                });
                
                function formatMembro(membro) {
                    if (!membro.id) return membro.text;
                    let text = membro.text;
                    if (text.includes('(Líder)')) {
                        return $('<span><i class="fas fa-user-tie text-primary"></i> ' + text + '</span>');
                    }
                    return $('<span><i class="fas fa-user"></i> ' + text + '</span>');
                }

                console.log('Select2 initialized for membros select box.');
            });
            
        </script>
        
    @endsection
</x-admin>



