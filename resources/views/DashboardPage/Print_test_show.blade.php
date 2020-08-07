@extends('layout.layout-2')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .act {
            background-color: lightgreen;
        }
    </style>
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
    <script>
        function print_test()
		{
			if (tid != 0) {
				let form = document.createElement('form');
				form.action = '/print/test';
				form.method = 'POST';
				form.target = '_blank'
				form.innerHTML = '<input type="hidden" name="tid" value="' + tid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}
		}

        function search_pred()
        {
            var text = $('#search_predmet').val();
            var id = $('#abit_oku').val();
            $.ajax({
                url: '/print/test/search_predmet',
                type: 'POST',
                data: {
                    stid : id,
                    text : text
                },
                async: true,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#table_predmet').html(data);
                },
                error: function(msg) {
                    alert('Error, try again');
                }
            });
        }
    </script>
@endsection

@section('content')
    <div id="loadForm" style="display: none;"></div>
    <h4 class="font-weight-bold py-3 mb-4">
        Печать тестов
    </h4>
    <div class="card mb-4">
        <button type="button" onclick="print_test();" class="btn btn-success col-md-2">Печать</button>
        <div class="card-body">
            <div class="form-group form-group-predmet">
                <div class="form-label-sticky">
                    <label class="form-label">
                        <span>Выбрать предметы</span>
                        <span>
                            <input type="text" name="search_predmet" id="search_predmet" onkeyup="search_pred();">
                        </span>
                    </label>
                    <label class="form-label">
                        <span>№</span>
                        <span>Наименование</span>
                        <span style="justify-content:flex-end; margin-right:25px;">Образовательный уровень</span>
                    </label>
                </div>
                <table class="table table-hover" style="cursor: default;">
                    <tbody id="table_predmet">
                        @foreach ($predmet as $p)
                            <tr onclick="tid = {{ $p->test_id }};">
                                <td class="text-left">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $p->name }}</td>
                                <td class="text-left">{{ $p->StName }}</td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
