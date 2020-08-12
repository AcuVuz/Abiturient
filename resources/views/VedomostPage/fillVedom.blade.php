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
		function fill_vedomost()
		{
			var vid = $('#ved').val();
			$.ajax({
				url: '/vedomost/get_vedPers',
				method: 'post',
				data: {
					vid : vid
				},
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data) {
					$('#table_vedomost').html(data[0]);
					$('#title_ved').html(data[1]);
				},
				error: function(msg) {
					$('#table_vedomost').html(msg.responseText);
				}
			});
		}
		fill_vedomost(); 
	</script>
@endsection

@section('content')
	<h4 class="font-weight-bold py-3 mb-4">
		 Заполнение ведомости № <span id="title_ved"></span>
	</h4>
	<div id="loadForm" style="display: none;"></div>
	<div class="card mb-4">
		<div class="card-body">
			<form action="#" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<input type="button" class="btn btn-success" value="Сохранить">
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="form-group col-md-3">
						<label class="form-label">Номер ведомости</label>
						<select onchange="fill_vedomost();" id="ved" name="ved" class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option value="-1">Выберите элемент</option>
							@foreach ($vedList as $vl)
								<option value="{{ $vl->id }}" @if($loop->iteration == 1) selected @endif>{{ $vl->id }}</option>
							@endforeach
						</select>
					</div>
					<div class="col"></div>
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="col-md-7">
						<table class="table table-hover" style="cursor: default;">
							<thead class="thead-light">
								<td class="text-center">№</td>
								<td class="text-center">ФИО</td>
								<td class="text-center">Балл</td>
							</thead>
							<tbody id="table_vedomost">
							</tbody>
						</table>
					</div>
					<div class="col"></div>
				</div>
			</form>
		</div>
	</div>
@endsection
