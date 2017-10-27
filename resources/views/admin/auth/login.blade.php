@extends ('layouts.app', ['bdstyle' => 'bg-info'])
@section ('body')
    <div class="container">
        <div class="row" style="margin-top: 100px;">
            <div class="col-md-4 col-md-offset-4">
                @component('admin.widgets.panel')
                    @slot('panelLogo')
                        <div src="{{ asset('img/LOGO.svg') }}" class="login-logo"></div>
                    @endslot
                    @slot ('panelBody')
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="login" class="control-label">Usuário</label>

                                    <input id="login" type="login" class="form-control" name="login"
                                           value="{{ old('login') }}" required autofocus>

                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="password" class="control-label">Senha</label>

                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2  col-md-8 text-center">
                                    <div class="checkbox-inline">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Mantenha-me conectado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                    <br>
                                    <a class="btn-link" href="{{ route('company.login') }}">
                                        Empresa?
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
