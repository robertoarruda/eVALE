@extends ('admin.layouts.main')

@section('page_heading','Empresa')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12 margin-bottom-20">
                @isset($id)
                    <form role="form" action="{{ route('admin.update', $id) }}" method="post">
                @else
                    <form role="form" action="{{ route('admin.store') }}" method="post">
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
                        <label for="cnpj">CNPJ</label>
                        <input id="cnpj" name="cnpj" value="{{ $cnpj ?? old('cnpj') }}" class="form-control" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input id="address" name="address" value="{{ $address ?? old('address') }}" class="form-control" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input id="phone" name="phone" value="{{ $phone ?? old('phone') }}" class="form-control" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="subscription_limit">Limite de assinatura</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="number" id="subscription_limit" name="subscription_limit" value="{{ $subscription_limit ?? old('subscription_limit') }}" class="form-control" step="0.01" min="1" max="100000" maxlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input id="login" name="login" value="{{ $login ?? old('login') }}" class="form-control" maxlength="10" required>
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
                    <a class="btn btn-default" href="{{ route('admin.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

@endsection
