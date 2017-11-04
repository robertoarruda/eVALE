@extends('company.layouts.main')

@section('page_heading','Dashboard')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $employeesCount }}</div>
                                <div>Funcionários</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    {{ number_format($totalConsumption, 2, ',', '.') }}
                                </div>
                                <div>Fatura atual</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    {{ number_format($remainingSubscription, 2, ',', '.') }}
                                </div>
                                <div>Limite disponível da assinatura</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @component('company.widgets.panel')
                    @slot('panelTitle', 'Funcionários')
                    @slot('panelBody')
                        @include('company.widgets.index')
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

@endsection