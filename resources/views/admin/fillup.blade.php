@extends ('admin.layouts.main')

@section('page_heading','Abastecimento')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12 margin-bottom-20">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form role="form" action="{{ route('admin.postFillUp') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="company">Empresa</label>
                        <select id="company" name="company" class="form-control" required>
                            <option hidden selected value>Selecione...</option>
                            @foreach ($companies ?? [] as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee_registration_number">Matrícula funcionário</label>
                        <input id="employee_registration_number" name="employee_registration_number" value="{{ $employee_registration_number ?? old('employee_registration_number') }}" class="form-control" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input id="address" name="address" value="{{ $address ?? old('address') }}" class="form-control" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <input id="type" name="type" value="{{ $type ?? old('type') }}" class="form-control" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="subscription_limit">Valor</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="number" id="value" name="value" value="{{ $value ?? old('value') }}" class="form-control" step="0.01" min="1" max="10000" maxlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="employee_password">Senha</label>
                        <input type="password" id="employee_password" name="employee_password" class="form-control" minlength="6" maxlength="8">
                    </div>
                    <button type="submit" class="btn btn-primary">Lançar</button>
                    <a class="btn btn-default" href="{{ route('admin.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

@endsection
