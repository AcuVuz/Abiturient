@extends('layout.layout-2')

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<style>
		.create_from_spec {
			display: none;
		}
		.create_from_predmet {
			display: none;
		}
		.activ{
			display: block;
		}
	</style>
@endsection

@section('scripts')
	<!-- Dependencies -->
	<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
	<script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
	<script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
	<script>
		function create()
		{
            var prikaz_id 	= $('#prikaz_id').val();
            var is_budg 	= $('#is_budg').val();
            var fo_id 		= $('#fo_id').val();
            var name 		= $('#name').val();
            var date_prikaz = $('#date_prikaz').val();

            $.ajax({
                url: '/prikaz/save',
                method: 'post',
                data: {
                    prikaz_id 	: prikaz_id,
                    is_budg 	: is_budg,
                    fo_id 		: fo_id,
                    name  		: name,
                    date_prikaz : date_prikaz
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.reload();
                },
                error: function(msg) {
                    console.log(msg.responseText);
                }
            });
		}

		function del()
		{
            var prikaz_id 	= $('#prikaz_id').val();
			$.ajax({
				url: '/prikaz/delete',
				method: 'post',
				data: { prikaz_id : prikaz_id },
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data) {
                    window.location.reload();
				},
				error: function(msg) {
                    console.log(msg.responseText);
				}
			});
		}
	</script>
@endsection

@section('content')
	<h4 class="font-weight-bold py-3 mb-4">
		 Приказы
	</h4>
	<div id="loadForm" style="display: none;"></div>
	<div class="card mb-4">
		<div class="card-body">
			<form action="#" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="prikaz_id" id="prikaz_id" value="-1">
				<div class="form-group">
					<input type="button" onclick="$('#prikaz_id').val('-1'); $('#name').val('');" class="btn btn-success" value="Новый приказ">
					<input type="button" onclick="create();" class="btn btn-success" value="Сохранить" >
					<input type="button" onclick="document.location.href = '/prikaz/fill_prikaz'" class="btn btn-danger" value="Заполнить">
					@if($role == 1) <input type="button" onclick="del();" class="btn btn-danger" value="Удалить"> @endif
				</div>
                <div class="form-row" id="abit_facultet_block">
                    <div class="form-group col-md-2">
                        <label class="form-label">Тип приказа</label>
                        <select id="is_budg" name="is_budg" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            <option value="F">Контракт</option>
                            <option value="T">Бюджет</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-label">Форма обучения</label>
                        <select id="fo_id" name="fo_id" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
                            @foreach ($fo as $f)
                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-label">Номер приказа</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-label">Дата приказа</label>
                        <input type="date" class="form-control" name="date_prikaz" id="date_prikaz">
                    </div>
                </div>
				<div class="form-group">
					<label class="form-label">Список приказов</label>
					<table class="table table-hover" style="cursor: default;">
						<thead>
							<td>№ п/п</td>
							<td>Номер приказа</td>
							<td>Тип приказа</td>
							<td>Форма обучения</td>
							<td>Дата приказа</td>
						</thead>
						<tbody id="table_prikaz">
							@foreach ($prikaz as $prik)
                                <tr onclick="
                                        $('#prikaz_id').val('{{ $prik->id }}'); 
                                        $('#is_budg').val('{{ $prik->is_budg }}'); 
                                        $('#name').val('{{ $prik->name }}'); 
                                        $('#fo_id').val('{{ $prik->fo_id }}'); 
                                        $('#date_prikaz').val('{{ $prik->date_prikaz }}'); 
                                    ">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prik->name }}</td>
                                    <td>{{ $prik->is_budg == 'T' ? 'Бюджет' : 'Контракт' }}</td>
                                    <td>{{ $prik->fo_name }}</td>
                                    <td>{{ $prik->date_prikaz }}</td>
                                </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
@endsection
