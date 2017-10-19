@extends('company.layouts.main')

@section('page_heading','Dashboard')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                @component('company.widgets.panel')
                    @slot('panelTitle', 'Empresas')
                    @slot('panelBody')
                        @include('company.widgets.table', ['list' => $list])
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

@endsection