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
        function fill_predmet()
		{
			var stid = $('#abit_stlevel').val();
			$.ajax({
				url: '/grafik/get_predmet',
				method: 'post',
				data: { stid : stid },
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data) {
					$('#abit_predmet').html(data[0]);
					$('#table_grafTable').html(data[1]);

					$('.btn').prop('disabled', '');
				},
				error: function(msg) {
					$('#abit_predmet').html(msg.responseText);
				}
			});
		}
	</script>
@endsection

@section('content')
	<h4 class="font-weight-bold py-3 mb-4">
		 График экзаменов
	</h4>
	<div id="loadForm" style="display: none;"></div>
	<div class="card mb-4">
		<div class="card-body">
			<form action="/grafik/save" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
                    <input type="submit" class="btn btn-success" value="Сохранить" disabled>
				</div>
				<div class="form-row" id="abit_facultet_block">
					<div class="form-group col-md-2">
						<label class="form-label">Образовательный уровень</label>
						<select id="abit_stlevel" name="abit_stlevel" onchange="fill_predmet();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
                            <option>Выберите элемент</option>
                            @foreach ($stlevel as $st)
                                <option value="{{ $st->id }}">{{ $st->name }}</option>
                            @endforeach
						</select>
                    </div>
                    <div class="form-group col-md-6">
						<label class="form-label">Предмет</label>
						<select id="abit_predmet" name="abit_predmet" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
							<option>Выберите элемент</option>
						</select>
                    </div>
                    <div class="form-group col-md-2">
						<label class="form-label">Дата экзамена</label>
						<input type="datetime-local" class="form-control" name="date_exam" id="date_exam">
					</div>
                    <div class="form-group col-md-2">
						<label class="form-label">Дата окончания экзамена</label>
						<input type="datetime-local" class="form-control" name="date_exam_end" id="date_exam_end">
					</div>
				</div>
				<div class="form-group">
					<label class="form-label">График экзаменов</label>
					<table class="table table-hover" style="cursor: default;">
						<thead>
							<td>№ п/п</td>
							<td>Предмет</td>
							<td>Дата экзамена</td>
							<td>Дата окончания экзамена</td>
						</thead>
						<tbody id="table_grafTable">
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
