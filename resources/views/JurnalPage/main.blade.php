@extends('layout.layout-2')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/account.css') }}">
    <style>
		.dropdown-menu .show{
			max-height: 200px;
			overflow: hidden scroll;
		}
	</style>
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script>
        function print_titul() {
            var group_id = $('#abit_group').val();
            window.open("/jurnal/print_titul?group_id=" + group_id, "_blank")
        }

        function print_jurnal() {
            var group_id = $('#abit_group').val();
            window.open("/jurnal/print_jurnal?group_id=" + group_id, "_blank")
        }

        function fill_facult()
        {
            var bid = $('#abit_branch').val();
            $.ajax({
                url: '/jurnal/get_facultet',
                method: 'post',
                data: { bid : bid },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#abit_facultet').html(data);
                },
                error: function(msg) {
                    $('#abit_facultet').html(msg.responseText);
                }
            });
            $('#abit_stlevel').html('<option>Выберите элемент</option>');
            $('#abit_formobuch').html('<option>Выберите элемент</option>');
            $('#abit_group').html('<option>Выберите элемент</option>');
        }
        
        function fill_stlevel()
        {
            var fkid = $('#abit_facultet').val();
            $.ajax({
                url: '/jurnal/get_stlevel',
                method: 'post',
                data: { fkid : fkid },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#abit_stlevel').html(data);
                },
                error: function(msg) {
                    $('#abit_stlevel').html(msg.responseText);
                }
            });
            $('#abit_formobuch').html('<option>Выберите элемент</option>');
            $('#abit_group').html('<option>Выберите элемент</option>');
        }

        function fill_formobuch()
        {
            var fkid = $('#abit_facultet').val();
            var stid = $('#abit_stlevel').val();
            var pid = $('#pid').val();
            $.ajax({
                url: '/jurnal/get_form_obuch',
                method: 'post',
                data: { fkid : fkid, stid : stid, pid  : pid  },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#abit_formobuch').html(data);
                },
                error: function(msg) {
                    $('#abit_formobuch').html(msg.responseText);
                }
            });
            $('#abit_group').html('<option>Выберите элемент</option>');
        }

        function fill_group()
        {
            var fkid = $('#abit_facultet').val();
            var stid = $('#abit_stlevel').val();
            var foid = $('#abit_formobuch').val();
            var pid = $('#pid').val();
            $.ajax({
                url: '/jurnal/get_group',
                method: 'post',
                data: { 
                    fkid : fkid, 
                    stid : stid, 
                    foid : foid, 
                    pid  : pid 
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#abit_group').html(data);
                },
                error: function(msg) {
                    $('#abit_group').html(msg.responseText);
                }
            });
        }
    </script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Журнал
    </h4>
    <div id="loadForm" style="display: none;"></div>
	<div class="card mb-4">
		<div class="card-body">
			<form action="#" method="POST">
                {{ csrf_field() }}
				<div class="form-group">
					<a href="/jurnal/print_titul" class="btn btn-danger" target="_blade">Печать титулки всех журналов (не рекомендуется)</a>
					<input type="button" onclick="print_titul();"  class="btn btn-success" value="Печать титулки">
					<input type="button" onclick="print_jurnal();" class="btn btn-success" value="Печать журнала" >
				</div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Образовательная организация
                            <span class="text-danger">*</span>
                        </label>
                        <select id="abit_branch" name="abit_branch" onchange="fill_facult();" class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
                            <option>Выберите элемент</option>
                            @foreach ($abit_branch as $ab)
                                <option value="{{ $ab->id }}">{{ $ab->short_name }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Институт/Факультет
                            <span class="text-danger">*</span>
                        </label>
                        <select id="abit_facultet" name="abit_facultet" onchange="fill_stlevel();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            <option>Выберите элемент</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Образовательный уровень
                            <span class="text-danger">*</span>
                        </label>
                        <select id="abit_stlevel" name="abit_stlevel" onchange="fill_formobuch();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
                            <option>Выберите элемент</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Форма обучения
                            <span class="text-danger">*</span>
                        </label>
                        <select id="abit_formobuch" name="abit_formobuch" onchange="fill_group();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
                            <option>Выберите элемент</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label">Специальность
                            <span class="text-danger">*</span>
                        </label>
                        <select id="abit_group" name="abit_group" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            <option>Выберите элемент</option>
                        </select>
                    </div>
                </div>
			</form>
		</div>
	</div>
@endsection
