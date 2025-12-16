<x-admin>
    @section('title', 'Criação de Igreja')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Criar Igreja</h3>
            <div class="card-tools"><a href="{{ route('admin.igreja.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.igreja.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="denominacao" class="form-label">Denominação:*</label>
                            <input type="text" class="form-control" name="denominacao" required
                                value="{{ old('denominacao') }}">
                                <x-error>denominacao</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cnpj" class="form-label">CNPJ:*</label>
                            <input type="text" class="form-control" name="cnpj" required
                                value="{{ old('cnpj') }}">
                                <x-error>cnpj</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="endereco" class="form-label">Endereço:*</label>
                            <input type="text" class="form-control" name="endereco" required
                                value="{{ old('endereco') }}">
                                <x-error>endereco</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone:*</label>
                            <input type="text" class="form-control" name="telefone" required
                                value="{{ old('telefone') }}">
                                <x-error>telefone</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Email" class="form-label">E-mail:*</label>
                            <input type="email" class="form-control" name="email" required
                                value="{{ old('email') }}">
                                <x-error>email</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="logo" class="form-label">Logo:*</label>
                            <input type="file" class="form-control" name="logo" 
                                value="{{ old('logo') }}">
                                <x-error>logo</x-error>
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
