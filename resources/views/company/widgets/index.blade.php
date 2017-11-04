@if(!$employees->count())
<div class="alert alert-info">Nenhum registro encontrado!</div>
@else
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="col-sm-6">Nome</th>
                <th class="col-sm-2 text-right">Limite mensal</th>
                <th class="col-sm-2 text-right">Saldo disponível</th>
                <th class="col-sm-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td class="text-right">
                    R$ {{ number_format($employee->consumption_limit, 2, ',', '.') }}
                </td>
                <td class="text-right">
                    R$ {{ number_format($employee->remaining_consumption_limit, 2, ',', '.') }}
                </td>
                <td class="text-right">
                    <form role="form" action="{{ route('company.destroy', $employee->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a href="{{ route('company.edit', $employee->id) }}" class="btn btn-default">Editar</a>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endempty
