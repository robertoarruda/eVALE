@if(!$companies->count())
    <div class="alert alert-info">Nenhum registro encontrado!</div>
@else
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-sm-6">Nome</th>
                    <th class="col-sm-2 text-right">Assinatura</th>
                    <th class="col-sm-2 text-right">Fatura atual</th>
                    <th class="col-sm-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td class="text-right">
                            R$ {{ number_format($company->subscription_limit, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            R$ {{ number_format($company->consumption, 2, ',', '.') }}
                        </td>
                        <td class="text-right">
                            <form role="form" action="{{ route('admin.destroy', $company->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="{{ route('admin.edit', $company->id) }}" class="btn btn-default">Editar</a>
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endempty
