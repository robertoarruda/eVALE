@extends ('company.layouts.main')

@section('page_heading','Funcionário')

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
                        <input id="name" name="name" value="{{ $name ?? '' }}" class="form-control" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input id="cpf" name="cpf" value="{{ $cpf ?? '' }}"  class="form-control" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label for="registration_number">Matrícula ID</label>
                        <input id="registration_number" name="registration_number" value="{{ $registration_number ?? '' }}"  class="form-control" maxlength="14">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input id="phone" name="phone" value="{{ $phone ?? '' }}"  class="form-control" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" value="{{ $password ?? '' }}"  class="form-control" minlength="6" maxlength="8" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
