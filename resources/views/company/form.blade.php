@extends ('company.layouts.main')

@section('page_heading','Empresa')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-12 margin-bottom-20">
                <form role="form" action="/company" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Empresa</label>
                        <input id="name" name="name" class="form-control" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input id="cnpj" name="cnpj" class="form-control" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input id="address" name="address" class="form-control" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input id="phone" name="phone" class="form-control" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="subscription_limit">Limite de assinatura</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" id="subscription_limit" name="subscription_limit" class="form-control" min="1" max="100000" maxlength="6" required>
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
