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
        .move-p-table{
            width: 100%;
            border: 2px solid #e6e6e6;
        }
        .move-p-table th, td{
            padding: 8px;
            border-bottom: 1px solid #e6e6e6;
        }
        .move-p-table tr > td:first-child{
            display: none;
        }
        .move-p-table tr:hover{
            cursor: pointer;
        }
	</style>
@endsection

@section('scripts')
	<!-- Dependencies -->
	<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
	<script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
@endsection

@section('content')
	<h4 class="font-weight-bold py-3 mb-4">
		 Перенос людей в приказы
	</h4>
	<div id="loadForm" style="display: none;"></div>
	<div class="card mb-4">
		<div class="card-body">
			<form action="#" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="prikaz_id" id="prikaz_id" value="-1">
                <div class="form-row" id="abit_facultet_block">
                    <div class="form-group col-md-2">
                        <label class="form-label">Форма обучения</label>
                        <select  id="abit_formobuch" class="form-control " onchange="fill_group();" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                             @foreach ($fo as $f)
                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label class="form-label">Образовательный уровень</label>
                        <select  id="abit_stlevel" class="form-control " onchange="fill_group();" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            @foreach ($stlevel as $st)
                                <option value="{{ $st->id }}">{{$st->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-label">Приказ</label>
                        <select   id="abit_prikaz" onchange=" getAbitWithPrikaz();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            @foreach ($prikaz as $prik)
                                <option value="{{ $prik->id }}">{{$prik->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" id="abit_facultet_block">
                    <div class="form-group col-md-12">
                        <label class="form-label">Институт / Факультет</label>
                        <select   class="form-control" onchange="fill_group();" id="abit_facultet" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                            @foreach ($fakultet as $fk)
                                <option value="{{ $fk->id }}">{{$fk->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" id="abit_facultet_block">
                    <div class="form-group col-md-12">
                        <label class="form-label">Специальность</label>
                        <select   id="abit_group" onchange="getAbit()" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
                        </select>
                    </div>
                </div>
			</form>
		</div>
        <div class="card-body">
            <div class="form-row" id="abit_facultet_block">
                <div class="form-group col-md-5">
                    <label for="">Все абитуриенты</label>
                    <table class="move-p-table" id="start-move-p-table">
                        <thead>
                            <th>ФИО</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="form-group col-md-2 form-group-move-control">
                    
                </div>

                <div class="form-group col-md-5">
                <label for="">Абитуриенты перенесенные в приказ</label>
                <table class="move-p-table" id="end-move-p-table">
                    <thead>
                        <th>ФИО</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
	</div>

    <script> 
    function fill_group(){
            let fkid = $('#abit_facultet').val();
            let stid = $('#abit_stlevel').val();
            let foid = $('#abit_formobuch').val();
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
                    getAbit();
                    getAbitWithPrikaz();

                },
                error: function(msg) {
                    $('#abit_group').html(msg.responseText);
                }
            });
        }

        function getAbitWithPrikaz(){
            let stgid = $('#abit_group').val();
            let prik_id = $('#abit_prikaz').val();
            $.ajax({
                    url: '/getStatgroupWithPrikaz',
                    method: 'post',
                    data: { stgid: stgid,  prik_id : prik_id, },
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                    $('#end-move-p-table tbody').html(data);
                    }
                });
        }

        function getAbit(){
            let stgid = $('#abit_group').val();
            let prik_id = $('#abit_prikaz').val();

                $.ajax({
                    url: '/getStatgroup',
                    method: 'post',
                    data: { stgid: stgid },
                    headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#start-move-p-table tbody').html(data);
                        getAbitWithPrikaz();
                    }
                });

                

        }
        function InsertPrikaz(event, deletePrikaz = false){
            console.log()

            let stid = parseInt(event.path[1].cells[0].innerHTML);
            let prik_id = deletePrikaz ? null : $('#abit_prikaz').val();
            $.ajax({
                url: '/MovePrikaz/UpdateZach',
                method: 'post',
                data: {
                stid : stid,
                prik_id : prik_id
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    getAbit();
                    getAbitWithPrikaz();
                }
            });
        }

       $(document).ready(function(){
            fill_group();

            $('#end-move-p-table tbody tr').click(function(){
                $('#start-move-p-table').append(this)
            });
        });
    </script>
@endsection
