<x-admin>
    @section('title', 'Ministério')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela Ministérios</h3>
            <div class="card-tools"><a href="{{ route('admin.ministerio.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="ministerioTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Lider</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ministerio)
                        <tr>
                            <td>{{ $ministerio->id }}</td>
                            <td>{{ $ministerio->nome }}</td>
                            <td>{{ $ministerio->descricao }}</td>
                            <td>{{ $ministerio->lider->nome }}</td>
                            <td>
                                <a href="{{ route('admin.ministerio.edit', encrypt($ministerio->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.ministerio.destroy', encrypt($ministerio->id)) }}" method="POST"
                                    onsubmit="return confirm('Você tem certeza que deseja deletar?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('js')
        <script>
            $(function() {
                $('#ministerioTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
