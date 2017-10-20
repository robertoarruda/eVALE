@extends ('admin.layouts.main')

@section('page_heading','Empresa')

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
                        <input id="name" name="name" value="{{ $name ?? '' }}" class="form-control" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input id="cnpj" name="cnpj" value="{{ $cnpj ?? '' }}"  class="form-control" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input id="address" name="address" value="{{ $address ?? '' }}"  class="form-control" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input id="phone" name="phone" value="{{ $phone ?? '' }}"  class="form-control" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="subscription_limit">Limite de assinatura</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" id="subscription_limit" name="subscription_limit" value="{{ $subscription_limit ?? '' }}"  class="form-control" min="1" max="100000" maxlength="6" required>
                            <span class="input-group-addon">,00</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
