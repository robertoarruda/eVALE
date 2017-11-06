@extends ('admin.layouts.main')

@section('page_heading','Abastecimento')

@section('section')

    @if(!$companies->count())

        <div class="alert alert-warning">Cadastre primeiramente uma empresa.</div>

    @else

        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 margin-bottom-20">
                    <form role="form" action="{{ route('admin.postFillUp') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="fuel_type_id">Tipo</label>
                            <select id="fuel_type_id" name="fuel_type_id" class="form-control" required>
                                <option hidden selected value>Selecione...</option>
                                @foreach ($fuel_types ?? [] as $fuel_type)
                                    @php ($selected = old('fuel_type_id') == $fuel_type->id ? 'selected' : '')
                                    <option {{ $selected }} value="{{ $fuel_type->id }}">{{ $fuel_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subscription_limit">Valor</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="number" id="value" name="value" value="{{ $value ?? old('value') }}" class="form-control" step="0.01" min="1" max="100000" maxlength="6" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_id">Empresa</label>
                            <select id="company_id" name="company_id" class="form-control" required>
                                <option hidden selected value>Selecione...</option>
                                @foreach ($companies ?? [] as $company)
                                    @php ($selected = old('company_id') == $company->id ? 'selected' : '')
                                    <option {{ $selected }} value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="employee_registration_number">Número de matrícula</label>
                            <input id="employee_registration_number" name="employee_registration_number" value="{{ $employee_registration_number ?? old('employee_registration_number') }}" class="form-control" maxlength="14" required>
                        </div>
                        <div class="form-group">
                            <label for="employee_password">Senha</label>
                            <input type="password" id="employee_password" name="employee_password" class="form-control" minlength="6" maxlength="8" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lançar</button>
                        <a class="btn btn-default" href="{{ route('admin.index') }}">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>

    @endif

@endsection
