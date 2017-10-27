@extends('company.layouts.main')

@section('page_heading','Dashboard')

@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-6 col-md-12">
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
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $remainingSubscription }}</div>
                            <div>Restante da assinatura</div>
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
                    @include('company.widgets.table', ['list' => $list])
                @endslot
            @endcomponent
        </div>
    </div>
</div>

@endsection