@extends ('company.layouts.main')

@section('page_heading','Funcionário')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12 margin-bottom-20">
                @isset($id)
                    <form role="form" action="{{ route('company.update', $id) }}" method="post">
                @else
                    <form role="form" action="{{ route('company.store') }}" method="post">
                @endisset

                    {{ csrf_field() }}

                    @isset($id)
                        {{ method_field('put') }}
                    @endisset

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input id="name" name="name" value="{{ $name ?? old('name') }}" class="form-control" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input id="cpf" name="cpf" value="{{ $cpf ?? old('cpf') }}" class="form-control" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="consumption_limit">Limite mensal</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="number" id="consumption_limit" name="consumption_limit" value="{{ $consumption_limit ?? old('consumption_limit') }}" class="form-control" step="0.01" min="1" max="100000" maxlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registration_number">Número de matrícula</label>
                        <input id="registration_number" name="registration_number" value="{{ $registration_number ?? old('registration_number') }}" class="form-control" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="6" maxlength="8" {{ empty($id) ? 'required' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmação de senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="6" maxlength="8" {{ empty($id) ? 'required' : '' }}>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a class="btn btn-default" href="{{ route('company.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

@endsection
