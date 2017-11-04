<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form role="form" method="get">
                <div class="form-group col-lg-4">
                    <label for="filterCompany">Funcionário</label>
                    <select id="filterCompany" name="filter_employee" class="form-control">
                        <option selected value>Todos</option>
                        @foreach ($filter['employees'] ?? [] as $employee)
                            @php ($selected = request()->query('filter_employee') == $employee->id ? 'selected' : '')
                            <option {{ $selected }} value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label for="filterInitial">Início</label>
                    <input type="date" id="filterInitial" name="filter_initial" value="{{ request()->query('filter_initial') ?: $filter['initial']->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="form-group col-lg-4">
                    <label for="filterFinal">Fim</label>
                    <input type="date" id="filterFinal" name="filter_final" value="{{ request()->query('filter_final') ?: $filter['final']->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-default">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
