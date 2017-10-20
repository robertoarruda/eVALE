@extends('admin.layouts.main')

@section('page_heading','Dashboard')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                @component('admin.widgets.panel')
                    @slot('panelTitle', 'Empresas')
                    @slot('panelBody')
                        @include('admin.widgets.table', ['list' => $list])
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

@endsection