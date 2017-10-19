<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="col-sm-10">Nome</th>
                <th class="col-sm-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>
                        <a href="/company/{{ $data->id }}/edit" class="btn btn-default">Editar</a>
                        <a href="/company/{{ $data->id }}" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
