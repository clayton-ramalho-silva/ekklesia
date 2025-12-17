<x-admin>
    @section('title', 'Membros')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela Membros</h3>
            <div class="card-tools"><a href="{{ route('admin.membro.create') }}" class="btn btn-sm btn-primary">Add</a></div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="membroTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $membro)
                        <tr>
                            <td>{{ $membro->id }}</td>
                            <td>{{ $membro->nome }}</td>
                            <td>{{ $membro->email }}</td>
                            <td>{{ $membro->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.membro.edit', encrypt($membro->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.membro.destroy', encrypt($membro->id)) }}" method="POST"
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
                $('#membroTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
