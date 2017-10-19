@extends ('example.layouts.dashboard')

@section('page_heading','Charts')

@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                @component('example.widgets.panel')
                    @slot('panelTitle', 'Line Chart')
                    @slot('panelBody')
                        @include('example.widgets.charts.clinechart')
                    @endslot
                @endcomponent

                @component('example.widgets.panel')
                    @slot('panelTitle', 'Donut Chart')
                    @slot('panelBody')
                        <div style="max-width:400px; margin:0 auto;">@include('example.widgets.charts.cdonutchart')</div>
                    @endslot
                @endcomponent
            </div>
            <div class="col-sm-6">

                @component('example.widgets.panel')
                    @slot('panelTitle', 'Pie Chart')
                    @slot('panelBody')
                        <div style="max-width:400px; margin:0 auto;">@include('example.widgets.charts.cpiechart')</div>
                    @endslot
                @endcomponent


                @component('example.widgets.panel')
                    @slot('panelTitle', 'Bar Chart')
                    @slot('panelBody')
                        @include('example.widgets.charts.cbarchart')
                    @endslot
                @endcomponent
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->

@endsection
