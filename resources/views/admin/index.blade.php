@extends('admin.layouts.main')

@section('page_heading','Dashboard')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-briefcase fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $companiesCount }}</div>
                                <div>Empresas</div>
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
                                <div>Total a receber</div>
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
                                    {{ number_format($subscriptionsTotal, 2, ',', '.') }}
                                </div>
                                <div>Crédito disponibilizado</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @component('admin.widgets.panel')
                    @slot('panelTitle', 'Empresas')
                    @slot('panelBody')
                        @include('admin.widgets.index')
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

@endsection