@extends('admin.layouts.main')

@section('page_heading','Transações')

@section('section')

    @include('admin.widgets.filter')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-search fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $fillUpsCount }}</div>
                                <div>Registros</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    {{ number_format($totalConsumption, 2, ',', '.') }}
                                </div>
                                <div>Total</div>
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
                        @include('admin.widgets.reports')
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

@endsection