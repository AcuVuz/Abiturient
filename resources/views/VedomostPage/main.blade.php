@extends('layout.layout-2')

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('scripts')
	<!-- Dependencies -->
	<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
	<script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
	<script>
		function fill_facult()
		{
			var bid = $('#abit_branch').val();
			$.ajax({
				url: '/vedomost/get_facultet',
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
				url: '/vedomost/get_stlevel',
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
			$.ajax({
				url: '/vedomost/get_form_obuch',
				method: 'post',
				data: { fkid : fkid, stid : stid },
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
			$.ajax({
				url: '/vedomost/get_group',
				method: 'post',
				data: { 
					fkid : fkid, 
					stid : stid, 
					foid : foid
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

		function fill_predmet()
		{
			var gid 	= $('#abit_group').val();
			$.ajax({
				url: '/vedomost/get_predmet',
				method: 'post',
				data: { gid  : gid },
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data) {
					$('#abit_predmet').html(data);
				},
				error: function(msg) {
					$('#abit_predmet').html(msg.responseText);
				}
			});
		}

		function fill_vedomost()
		{
			var stid 	= $('#abit_stlevel').val();
			var foid 	= $('#abit_formobuch').val();
			var gid 	= $('#abit_group').val();
			var exid 	= $('#abit_predmet').val();
			var etid 	= $('#abit_typeExam').val();

			$.ajax({
				url: '/vedomost/get_vedomost',
				method: 'post',
				data: { 
					stid 	: stid, 
					foid 	: foid, 
					gid  	: gid,
					exid  	: exid,
					etid	: etid
				},
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data) {
					$('#table_vedomost').html(data);
				},
				error: function(msg) {
					$('#table_vedomost').html(msg.responseText);
				}
			});
		}
	</script>
@endsection

@section('content')
	<h4 class="font-weight-bold py-3 mb-4">
		 Ведомости
	</h4>
	<div class="card mb-4">
		<div class="card-body">
			<form action="/vedomost/create" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<input type="button" onclick="fill_vedomost();" class="btn btn-success" value="Отобразить">
					<input type="submit" class="btn btn-secondary" value="Сформировать">
					<input type="button" class="btn btn-primary" value="Распечатать">
				</div>
				<div class="form-group">
					<label class="form-label">Выбор структуры</label>
					<select onchange="fill_facult();" class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="abit_branch" id="abit_branch">
						<option value="-1">Выберите элемент</option>
						@foreach ($abit_branch as $ab)
							<option value="{{ $ab->id }}">{{ $ab->short_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-row" id="abit_facultet_block">
					<div class="form-group col-md-6">
						<label class="form-label">Институт/Факультет</label>
						<select id="abit_facultet" name="abit_facultet" onchange="fill_stlevel();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option>Выберите элемент</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">Образовательный уровень</label>
						<select id="abit_stlevel" name="abit_stlevel" onchange="fill_formobuch();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
							<option>Выберите элемент</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">Форма обучения</label>
						<select id="abit_formobuch" name="abit_formobuch" onchange="fill_group();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
							<option>Выберите элемент</option>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label">Направление подготовки</label>
						<select id="abit_group" name="abit_group" onchange="fill_predmet();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option>Выберите элемент</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label class="form-label">Предмет</label>
						<select id="abit_predmet" name="abit_predmet" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option>Выберите элемент</option>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label class="form-label">Тип экзамена</label>
						<select id="abit_typeExam" name="abit_typeExam" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option value="-1">Выберите элемент</option>
							@foreach ($type_exam as $te)
								<option value="{{ $te->id }}">{{ $te->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">Дата экзамена</label>
						<input type="date" class="form-control" name="date_exam" id="date_exam">
					</div>
				</div>
				<div class="form-group">
					<label class="form-label">Список ведомостей</label>
					<table class="table table-hover" style="cursor: default;">
						<thead>
							<td>№ п/п</td>
							<td>Номер ведомости</td>
							<td>Тип экзамена</td>
							<td>Дата ведомости</td>
							<td>Поличество записей в ведомости</td>
						</thead>
						<tbody id="table_vedomost">
							<tr>
								<td class="text-center" colspan="5">
									Нет записей
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
@endsection
