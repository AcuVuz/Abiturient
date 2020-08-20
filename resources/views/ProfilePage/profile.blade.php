@extends('layout.layout-2')

@section('styles')
	<!-- Page -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/users.css') }}">
	<link href="{{ asset('fonts/fonts/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

@endsection

@section('scripts')
	<script src="{{ asset('js/toastr.min.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('js/profile.js') }}"></script>
	<script>
		var role = {{ $role }};
		BrowserDetect.init(); 
		console.log(BrowserDetect.browser);
		console.log(BrowserDetect.version);
        function startTest(testPersId, status, hash)
        {
            if (testPersId != 0 && status != 2)
            {
                let form = document.createElement('form');
                form.action = 'https://test.ltsu.org/test/start';
                form.method = 'POST';
                form.innerHTML = '<input type="hidden" name="ptid" value="' + testPersId + '"><input name="_hash" value="' + hash + '">{{ csrf_field() }}';
				if (BrowserDetect.version <= 49) $('#loadForm').html(form);
				else document.body.append(form);
                //
				form.submit();
            }
        }

        function shortResult(testPersId, hash)
        {
            let form = document.createElement('form');
            form.action = 'https://test.ltsu.org/test/result/short';
            form.method = 'POST';
            form.target = '_blank';
            form.innerHTML = '<input type="hidden" name="ptid" value="' + testPersId + '"><input name="_hash" value="' + hash + '">{{ csrf_field() }}';
            if (BrowserDetect.version <= 49) $('#loadForm').html(form);
			else document.body.append(form);
			form.submit();
        }

		function toggle_table(id){
			//$( ".hidden_card_table" ).toggle();
			$( ".hidden_card_table" + id ).slideToggle();
			
			@if($role != 5)
				$('#print_opis').prop('href', '/print/opis?asid=' + id);
				$('#print_opis_menu').show();
				$('#print_statement').prop('href', '/print/statement?asid=' + id);
				$('#print_statement_menu').show();
				$('#print_examSheet').prop('href', '/print/examSheet?asid=' + id);
				$('#print_examSheet_menu').show();
				$('#print_lich_card').prop('href', '/print/lich_card?asid=' + id);
				$('#print_lich_card_menu').show();
			@endif
		}

		@if($role != 5)
			
			var l_ptid = 0;
			var l_hash = 0;
			function fullPrint(ptid, status, hash)
			{
				if (status == 2) 
				{
					l_ptid = ptid;
					l_hash = hash;
					$('#print_fullReport_menu').show();
				}
				else 
				{
					l_ptid = 0;
					l_hash = 0;
					$('#print_fullReport_menu').hide();
				}
			}

			function fullResult()
			{
				if (l_ptid != 0)
				{
					let form = document.createElement('form');
					form.action = 'https://test.ltsu.org/test/result/full';
					form.method = 'POST';
					form.target = '_blank';
					form.innerHTML = '<input type="hidden" name="ptid" value="' + l_ptid + '"><input name="_hash" value="' + l_hash + '">{{ csrf_field() }}';
					if (BrowserDetect.version <= 49) $('#loadForm').html(form);
					else document.body.append(form);
					form.submit();
				}
			}
		@endif
	</script>
@endsection

@section('content')
@if ($role != 5)
		<menu class="menu">
			<li class="menu-item" id="menu_dop_ball">
				<button type="button" class="menu-btn" onclick="dop_ball();">
					<i class="fa fa-plus"></i>
					<span class="menu-text">Дополнительные баллы / льготы</span>
				</button>
			</li>
			<li class="menu-separator"></li>
			<li class="menu-item" id="menu_orig">
				<button type="button" class="menu-btn" onclick="set_orig();">
					<i class="fa fa-check"></i>
					<span class="menu-text">Оригинал документов</span>
				</button>
			</li>
			<li class="menu-item" id="menu_del_orig">
				<button type="button" class="menu-btn" onclick="del_orig();">
					<i class="fa fa-minus"></i>
					<span class="menu-text">Убрать оригинал документов</span>
				</button>
			</li>
			<li class="menu-separator"></li>
			<li class="menu-item" id="menu_vozvr">
				<button type="button" class="menu-btn" onclick="set_vozvr();">
					<i class="fa fa-ban"></i>
					<span class="menu-text">Сделать возврат</span>
				</button>
			</li>
			<li class="menu-item" id="menu_del_vozvr">
				<button type="button" class="menu-btn" onclick="del_vozvr();">
					<i class="fa fa-reply"></i>
					<span class="menu-text">Отменить возврат</span>
				</button>
			</li>
		</menu>
		<style>
			.container {
				left: 0;
				margin: auto;
				position: absolute;
				top: 20%;
				width: 100%;
				text-align: center;
			}
			.menu {
				position: absolute;
				width: 250px;
				padding: 2px;
				margin: 0;
				border: 1px solid #bbb;
				background: #eee;
				background: -webkit-linear-gradient(to bottom, #fff 0%, #e5e5e5 100px, #e5e5e5 100%);
				background: linear-gradient(to bottom, #fff 0%, #e5e5e5 100px, #e5e5e5 100%);
				z-index: 100;
				border-radius: 3px;
				box-shadow: 1px 1px 4px rgba(0,0,0,.2);
				opacity: 0;
				-webkit-transform: translate(0, 15px) scale(.95);
				transform: translate(0, 15px) scale(.95);
				transition: transform 0.1s ease-out, opacity 0.1s ease-out;
				pointer-events: none;
			}
			.menu-item {
				display: block;
				position: relative;
				margin: 0;
				padding: 0;
				white-space: nowrap;
			}
			.menu-btn {
				background: none;
				line-height: normal;
				overflow: visible;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				display: block;
				width: 100%;
				color: #444;
				font-family: 'Roboto', sans-serif;
				font-size: 13px;
				text-align: left;
				cursor: pointer;
				border: 1px solid transparent;
				white-space: nowrap;
				padding: 6px 8px;
				border-radius: 3px;
			}
			.menu-btn::-moz-focus-inner,
			.menu-btn::-moz-focus-inner {
				border: 0;
				padding: 0;
			}
			.menu-text {
				margin-left: 25px;
			}
			.menu-btn .fa {
				position: absolute;
				left: 8px;
				top: 50%;
				-webkit-transform: translateY(-50%);
				transform: translateY(-50%);
			}
			.menu-item:hover > .menu-btn {
				color: #fff;
				outline: none;
				background-color: #2E3940;
				background: -webkit-linear-gradient(to bottom, #5D6D79, #2E3940);
				background: linear-gradient(to bottom, #5D6D79, #2E3940);
				border: 1px solid #2E3940;
			}
			.menu-item.disabled {
				opacity: .5;
				pointer-events: none;
			}
			.menu-item.disabled .menu-btn {
				cursor: default;
			}
			.menu-separator {
				display:block;
				margin: 7px 5px;
				height:1px;
				border-bottom: 1px solid #fff;
				background-color: #aaa;
			}
			.menu-item.submenu::after {
				content: "";
				position: absolute;
				right: 6px;
				top: 50%;
				-webkit-transform: translateY(-50%);
				transform: translateY(-50%);
				border: 5px solid transparent;
				border-left-color: #808080;
			}
			.menu-item.submenu:hover::after {
				border-left-color: #fff;
			}
			.menu .menu {
				top: 4px;
				left: 99%;
			}
			.show-menu,
			.menu-item:hover > .menu {
				opacity: 1;
				-webkit-transform: translate(0, 0) scale(1);
				transform: translate(0, 0) scale(1);
				pointer-events: auto;
			}
			.menu-item:hover > .menu {
				-webkit-transition-delay: 100ms;
				transition-delay: 300ms;
			}

		</style>
		<script>
			var menu = document.querySelector('.menu');
			var sid = 0;
			var pid = 0;
			function set_orig()
			{
				let form = document.createElement('form');
				form.action = '/statement/set_orig';
				form.method = 'GET';
				form.innerHTML = '<input type="hidden" name="ag" value="' + sid + '"><input type="hidden" name="pid" value="' + pid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}

			function dop_ball()
			{
				let form = document.createElement('form');
				form.action = '/statement/dop_ball';
				form.method = 'GET';
				form.innerHTML = '<input type="hidden" name="sid" value="' + sid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}

			function del_orig()
			{
				let form = document.createElement('form');
				form.action = '/statement/del_orig';
				form.method = 'GET';
				form.innerHTML = '<input type="hidden" name="ag" value="' + sid + '"><input type="hidden" name="pid" value="' + pid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}

			function set_vozvr()
			{
				let form = document.createElement('form');
				form.action = '/statement/return';
				form.method = 'GET';
				form.innerHTML = '<input type="hidden" name="ag" value="' + sid + '"><input type="hidden" name="pid" value="' + pid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}

			function del_vozvr()
			{
				let form = document.createElement('form');
				form.action = '/statement/del_return';
				form.method = 'GET';
				form.innerHTML = '<input type="hidden" name="ag" value="' + sid + '"><input type="hidden" name="pid" value="' + pid + '">{{ csrf_field() }}';
				//document.body.append(form);
				$('#loadForm').html(form);
				form.submit();
			}

			function showMenu(x, y){
				var doc_w = $(document).width();
				if (x + 250 > doc_w) x -= 250;

				menu.style.left = x + 'px';
				menu.style.top = y + 'px';
				menu.classList.add('show-menu');
			}
			function hideMenu(){
				menu.classList.remove('show-menu');
			}
			function onContextMenu(e, l_sid, l_pid, is_orig, date_return){
				e.preventDefault();
				if (is_orig == 'T') {
					$('#menu_orig').addClass('disabled');
					$('#menu_del_orig').removeClass('disabled');
					$('#menu_del_vozvr').addClass('disabled');
					$('#menu_vozvr').addClass('disabled');
				} else {
					$('#menu_orig').removeClass('disabled');
					$('#menu_del_orig').addClass('disabled');
					if (date_return == '') {
						$('#menu_vozvr').removeClass('disabled');
						$('#menu_del_vozvr').addClass('disabled');
					} else {
						$('#menu_vozvr').addClass('disabled');
						$('#menu_del_vozvr').removeClass('disabled');
						$('#menu_orig').addClass('disabled');
					}
				}
				sid = l_sid;
				pid = l_pid;
				showMenu(e.pageX, e.pageY);
			}
			$(document).click(function(){
				hideMenu();
			});

			function upd_is_home()
			{
				var is_home = $('#is_home').is(':checked') ? 'T' : 'F';
				var pid = $('#pid').val();
				$.ajax({
					url: '/profile/is_home/update',
					method: 'post',
					data: { is_home : is_home, pid : pid},
					headers: {
						'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
					}
				});
			}
		</script>
		<div id="loadForm" style="display: none;"></div>
	@endif

	<div class="media align-items-top py-3 mb-3">
		<img src="{{ $person->photo_url }}" alt="" class="d-block ui-w-100 rounded-circle" id="photo_main">
		<div class="media-body ml-4">
			<h4 class="font-weight-bold mb-0">{{ $person->famil.' '.$person->name.' '.$person->otch }}</h4>
			<div class="text-muted mb-2">Логин: {{ $person->login }}</div>
			<div class="text-muted mb-2">E-mail: {{ $person->email }}</div>
			@if(isset($close) || $role != 5)
				<span class="profile-time-func">
					<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="FindFile();">
						<i class="ion ion-md-photos"></i>
						Фото
					</a>
					<form action="#" method="POST" enctype="multipart/form-data" id="loadPhoto" style="position:absolute;overflow: hidden;display:block;height:0px;width:0px;">
						<input type="file"   id="FindFile" accept="image/jpeg,image/png,image/gif" name="FindFile" onchange="LoadFile();" style="display: none">
						<input type="hidden" name="pid" id="pid" value="{{ $person->id }}">
						<input type="submit" id="loadFile" style="display: none" value='Загрузить'>
					</form>
					<iframe id="rFrame" name="rFrame" style="display: none"> </iframe>
					@if($person_count_statements > 0)<a href="{{ url('/scanPhoto') }}" class="btn btn-default btn-sm"><i class="ion ion-md-images "></i> Скан фото</a>@endif
					@if($person->is_checked == 'F' || $role != 5)
					<a href="{{ url('/insert_abit') }}" class="btn btn-default btn-sm"><i class="ion ion-md-person "></i> Данные</a>
						<div class="demo-paragraph-spacing mt-3">
						@if($person_count_statements < 6)
							<a href="{{ url('/success_insert_abit') }}" class="btn btn-primary">
								<i class="ion ion-md-add"></i>
									Добавить заявление
								</a>
							@endif
						@if($role != 5 && $person->is_checked == 'F')
							<a href="#" onClick="CheckedPerson('{{$person->id}}')" class="btn btn-success">
								<i class="ion ion-md-checkmark"></i>
								Проверено
							</a>
							<a href="#" onClick="DiscardPerson('{{$person->id}}')" class="btn btn-cancel">
								<i class="fa fa-times" aria-hidden="true"></i>
								Отказать
							</a>
						@endif
					</div>
					@endif
				</span>
			@endif
			@if($person->is_checked == 'T')
				<p class="profile-status">Статус: <b>Проверен</b></p>
			@endif
			@if(isset($person->Comment))
				<p class="profile-status profile-status-dismiss">Статус: <b>Отказано</b></p>
				<p class="profile-comment">Комментарий: <b>{{$person->Comment}}</b></p>
			@endif
		</div>
	</div>

	<div class="card mb-4">
		<div class="card-body">
			<table class="table user-view-table m-0">
				<tbody>
					@if($role != 5)
						<tr>
							<td style="font-size: 14pt;"><span class="badge badge-outline-success"># {{ $person->id }}</span></td>
							<td></td>
						</tr>
					@endif
					<tr>
						<td>PIN:</td>
						<td style="font-size: 14pt;"><span class="badge badge-outline-info">{{ $person->PIN }}</span></td>
					</tr>
					<tr>
						<td>Регистрация:</td>
						<td>{{ date('d/m/Y', strtotime($person->date_crt)) }}</td>
					</tr>
					<tr>
						<td>Нуждается в общежитии:</td>
						<td>@if($person->hostel_need == 1)<span class="badge badge-outline-success"> Да @else <span class="badge badge-outline-danger"> Нет @endif</span></td>
					</tr>
					<tr>
						<td>Оригинал документов:</td>
						<td>@if($person->is_orig == 'T')<span class="badge badge-outline-success"> Да @else <span class="badge badge-outline-danger"> Нет @endif</span></td>
					</tr>
					@if ($role == 1 || $role == 2)
						<tr>
							<td>Прохождение тестирование дома:</td>
							<td>
								<label class="custom-control custom-checkbox" style="width: 40px;">
									<input type="checkbox" onchange="upd_is_home();" class="custom-control-input" value="T" name="is_home" id="is_home" {{ isset($person) ? $person->is_home == 'T' ? 'checked' : '' : ''}}>
									<span class="custom-control-label">&nbsp;&nbsp;&nbsp;</span>
								</label>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		<hr class="border-light m-0">
		<div class="table-responsive">
			<table class="table card-table m-0">
				<thead>
					<tr>
						<th class="align-middle">Институт / факультет</th>
						<th class="align-middle">Направление</th>
						<th class="align-middle">Образовательный уровень</th>
						<th class="align-right">Форма обучения</th>
						<th class="align-right">Возврат</th>
					</tr>
				</thead>
				<tbody>
					@if(count($person_statement) > 0)
						@foreach ($person_statement as $ps)
							<tr onClick="toggle_table({{ $ps->id }})" class="visible_card_table_td" id="visible_card_table_td"
								onContextMenu="onContextMenu(event, {{ $ps->id.','.$person->id.',"'.$ps->is_original.'","'.$ps->date_return.'"' }})"

								@if($ps->is_original == 'T')
									style="background-color: #3fff0075;"
								@elseif($ps->date_return != null)
									style="background-color: #ffad5e;"
								@endif
							>
								<td class="align-middle">{{ $ps->fac_name }}</td>
								<td class="align-middle">{{ $ps->spec_name }}</td>
								<td class="align-middle">{{ $ps->stlevel_name }}</td>
								<td class="align-middle">{{ $ps->form_obuch }}</td>
								<td>@if($ps->date_return != null) {{ date('d.m.Y H:i:s', strtotime($ps->date_return)) }} @endif</td>
							</tr>
							<tr>
								<td colspan="5">
									<span class="hidden_card_table hidden_card_table{{ $ps->id }}">
										<table class="table card-table table-vcenter text-nowrap  align-items-center">
											<thead class="thead-light">
												<tr>
													<th>№</th>
													<th>Название теста</th>
													<th class='text-center'>Статус</th>
													<th class='text-center'>Дата прохождения</th>
													<th class='text-center'>Затраченное время</th>
													<th class='text-center'>Баллов</th>
												</tr>
											</thead>
											<tbody>
												@if(isset($persTests[$ps->id]))
													@foreach ($persTests[$ps->id] as $pt)
														@if (isset($pt->discipline))
															<tr @if($role != 5) onclick="fullPrint({{ $pt->id.','.$pt->status.',\''.$person->user_hash.'\'' }})" @endif>
																<td>{{$loop->iteration}}</td>
																<td class="align-middle">{{ $pt->discipline }}</td>
																<td class='text-center'><?php echo htmlspecialchars_decode($statusTest[$pt->id]); ?></td>
																<td class='text-center'>{{ $pt->start_time != null ? date('d.m.Y H:i', strtotime($pt->start_time)) : ''}}</td>
																<td class='text-center'>
																	@if (!empty($pt->minuts_spent)){{ $pt->minuts_spent }} мин. @endif
																</td>
																<td class='text-center'>{{ $pt->test_ball_correct }}</td>
															</tr>
														@endif
													@endforeach
												@endif
											</tbody>
										</td>
									</table>
								</span>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5" class="text-center">
								Нет заявлений
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="card">
		<div class="card text-center mb-3">
			<div class="nav-tabs-top mb-4">
				<div class="card-header">
					<ul class="nav nav-pills card-header-pills nav-responsive-md">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#navs-top-info" style="">Основная информация</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navs-top-passport" style="">Паспортные данные</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navs-top-parents" style="">Информация о родителях</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navs-top-education" style="">Информация об образовании</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navs-top-ball" style="">Результаты ЕГЭ/ВНО</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="navs-top-info">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="form-label">Фамилия</label>
									<input type="text" class="form-control" placeholder="Иванов" value="{{ $person->famil }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Имя</label>
									<input type="text" class="form-control" placeholder="Иван" value="{{ $person->name }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Отчество</label>
									<input type="text" class="form-control" placeholder="Иванович" value="{{ $person->otch }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Дата рождения</label>
									<input type="text" class="form-control" value="{{ $person->birthday }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Пол</label>
									<input type="text" class="form-control" placeholder="Пол" value="@if($person->gender == 'Муж') Мужской @elseif($person->gender == 'Жен') Женский @else @endif" disabled="true">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="form-label">Страна</label>
									<input type="text" class="form-control" value="{{$person->country}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Область/Регион</label>
									<input type="text" class="form-control" value="{{$person->adr_obl}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Район</label>
									<input type="text" class="form-control" value="{{$person->adr_rajon}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Населенный пункт</label>
									<input type="text" class="form-control" value="{{$person->adr_city}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Улица</label>
									<input type="text" class="form-control"value="{{$person->adr_street}}" disabled="true">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="form-label">Дом</label>
									<input type="text" class="form-control" value="{{$person->adr_house}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Квартира</label>
									<input type="text" class="form-control" value="{{$person->adr_flatroom}}" disabled="true">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Адрес фактического проживания</label>
									<input type="text" class="form-control" disabled="true" value="{{$person->fact_residence}}" disabled="true">
								</div>
							</div>
							<div class="form-row">

								<div class="form-group col-md-2">
									<label class="form-label">Номер телефона 1</label>
									<input type="text" class="form-control" value="{{$person->phone_one}}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Номер телефона 2</label>
									<input type="text" class="form-control" value="{{$person->phone_two}}" disabled="true">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Владение языками</label>
									<input type="text" class="form-control" value="{{$person->english_lang == 'T' ? 'Английский ' : '' }}{{$person->franch_lang == 'T' ? 'Фанцузский ' : '' }}{{$person->deutsch_lang == 'T' ? 'Немецкий ' : '' }}{{$person->other_lang != '' ? $person->other_lang : '' }}" disabled="true">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="navs-top-passport">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="form-label">Тип документа</label>
									<input type="text" class="form-control" placeholder="Паспорт" value="{{ $person->type_doc }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Серия документа</label>
									<input type="text" class="form-control" placeholder="ТН" value="{{ $person->pasp_ser }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Номер документа</label>
									<input type="text" class="form-control" placeholder="123456" value="{{ $person->pasp_num }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Дата выдачи дкоумента</label>
									<input type="text" class="form-control" placeholder="01.01.2020" value="{{ $person->pasp_date }}" disabled="true">
								</div>
								<div class="form-group col-md-4">
									<label class="form-label">Идентификационный код</label>
									<input type="text" class="form-control" placeholder="12345678910" value="{{ $person->indkod }}" disabled="true">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label class="form-label">Где и кем выдан документ</label>
									<input type="text" class="form-control" placeholder="Артемевским РО УМВД ЛНР" value="{{ $person->pasp_vid }}" disabled="true">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="navs-top-parents">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label class="form-label">ФИО отца </label>
									<input type="text" class="form-control" placeholder="" value="{{ $person->father_name }}" disabled="true">
								</div>
								<div class="form-group col-md-5">
									<label class="form-label">Телефон отца</label>
									<input type="text" class="form-control" placeholder="" value="{{ $person->father_phone }}" disabled="true">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label class="form-label">ФИО матери </label>
									<input type="text" class="form-control" placeholder="" value="{{ $person->mother_name }}" disabled="true">
								</div>
								<div class="form-group col-md-5">
									<label class="form-label">Телефон матери</label>
									<input type="text" class="form-control" placeholder="" value="{{ $person->mother_phone }}" disabled="true">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="navs-top-education">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label class="form-label">Образовательный уровень</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->typeEduc_name : ''}}" disabled="true">
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Док-то об образовании</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->typeDoc_name : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Серия документа</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->doc_ser : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Номер документа</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->doc_num : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-2">
									<label class="form-label">Дата выдачи</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->doc_date != null ? date('d.m.Y', strtotime($doc_obr->doc_date)) : '' : '' }}" disabled="true">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="form-label">Серия и номер приложения</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->app_num : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-1">
									<label class="form-label">Средний балл</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->sr_bal : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-5">
									<label class="form-label">Кем выдан документ</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->doc_vidan : '' }}" disabled="true">
								</div>
								<div class="form-group col-md-4">
									<label class="form-label">Учебное заведение</label>
									<input type="text" class="form-control" placeholder="" value="{{ isset($doc_obr) ? $doc_obr->uch_zav : '' }}" disabled="true">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="navs-top-ball">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover" style="cursor: default;">
									<thead>
										<tr>
											<th class="text-center">№</th>
											<th class="text-center">Тип</th>
											<th class="text-center">Серия и номер</th>
											<th class="text-center">Предмет</th>
											<th class="text-center">Балл</th>
											<th class="text-center">Дата</th>
										</tr>
									</thead>
									<tbody>
										@if(isset($pers_zno))
											@if(count($pers_zno) > 0)
												@foreach ($pers_zno as $pz)
													<tr onclick="select_zno({{ '\''.$pz->type_sertificate.'\',\''.$pz->ser_sert.'\',\''.$pz->num_sert.'\',\''.$pz->predmet_id.'\',\''.$pz->ball_sert.'\',\''.$pz->date_sert.'\'' }});">
														<th class="text-center" scope="row">{{ $loop->iteration }}</th>
														<td class="text-center">{{ $pz->type_sertificate }}</td>
														<td class="text-center">{{ $pz->ser_sert.' '.$pz->num_sert }}</td>
														<td class="text-center">{{ $pz->pred_name }}</td>
														<td class="text-center">{{ $pz->ball_sert }}</td>
														<td class="text-center">{{ $pz->date_sert }}</td>
													</tr>
												@endforeach
											@else
												<tr>
													<td colspan="7" class="text-center">
														Нет сертификатов
													</td>
												</tr>
											@endif
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('js/timescript.js') }}"></script>
@endsection
