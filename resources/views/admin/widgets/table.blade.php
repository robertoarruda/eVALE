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
                    <form role="form" action="{{ route('admin.destroy', $data->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a href="{{ route('admin.edit', $data->id) }}" class="btn btn-default">Editar</a>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
