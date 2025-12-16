<x-admin>
    @section('title', 'Editar Igreja')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Igreja</h3>
            <div class="card-tools"><a href="{{ route('admin.igreja.index') }}" class="btn btn-sm btn-dark">Back</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.igreja.update',$igreja) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $igreja->id }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:*</label>
                            <input type="text" class="form-control" name="nome" required
                                value="{{ $igreja->nome }}">
                                <x-error>nome</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="denominacao" class="form-label">Denominação:*</label>
                            <input type="text" class="form-control" name="denominacao" required
                                value="{{ $igreja->denominacao }}">
                                <x-error>denominacao</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cnpj" class="form-label">CNPJ:*</label>
                            <input type="text" class="form-control" name="cnpj" required
                                value="{{ $igreja->cnpj }}">
                                <x-error>cnpj</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="endereco" class="form-label">Endereço:*</label>
                            <input type="text" class="form-control" name="endereco" required
                                value="{{ $igreja->endereco }}">
                                <x-error>endereco</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone:*</label>
                            <input type="text" class="form-control" name="telefone" required
                                value="{{ $igreja->telefone }}">
                                <x-error>telefone</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Email" class="form-label">Email:*</label>
                            <input type="email" class="form-control" name="email" required
                                value="{{ $igreja->email }}">
                                <x-error>email</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-2 image">
                                <img src="{{ asset('images/igreja/'.$igreja->logo) }}" alt="Logo" class="img-fluid">
                                 {{-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                                alt="User Image"> --}}
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="logo" class="form-label">Logo:*</label>
                                    <input type="file" class="form-control" name="logo" 
                                        value="{{ $igreja->logo }}">
                                        <x-error>logo</x-error>
                                </div>
                            </div>
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
</x-admin>
