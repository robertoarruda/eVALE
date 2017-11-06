@if(!$fillUps->count())
    <div class="alert alert-info">Nenhum registro encontrado!</div>
@else
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-sm-2">Data</th>
                    <th class="col-sm-6">Funcionário</th>
                    <th class="col-sm-2">Combustível</th>
                    <th class="col-sm-2 text-right">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fillUps as $fillUp)
                    <tr>
                        <td>{{ $fillUp->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $fillUp->employee->name ?? 'Indefinido' }}</td>
                        <td>{{ $fillUp->fuelType->name ?? 'Indefinido' }}</td>
                        <td class="text-right">R$ {{ number_format($fillUp->value, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endempty
