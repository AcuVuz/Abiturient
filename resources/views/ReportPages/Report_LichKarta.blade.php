<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Печать личной карты</title>
		<style>
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 210mm;
				height: 297mm;
				font-family: "Times New Roman", Times, serif;
			}
			.sp-tb td{
				padding-top: 2mm;
			}
		</style>
		<style type="text/css" media="print">
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 210mm;
				height: 297mm;
				font-family: "Times New Roman", Times, serif;
			}
			/*
			.wrap-list{
				width: 210mm;
				height: 297mm;
				font-family: DejaVu Sans, sans-serif;
			}
			*/
			.sp-tb td{
				padding-top: 2mm;
			}
			@page {
				size: auto;   /* auto is the initial value */
				margin: 0;  /* this affects the margin in the printer settings */
			}
		</style>
	</head>
	<body class="body-report">
		<div class="wrap-list" id="wrap-list">
			<div class="row" style="padding-left: 12mm; padding-top: 10mm; padding-right: 12mm;">
				<table>
					<td>
						<p>
							БАЛЛЫ ВСТУПИТЕЛЬНЫХ ЭКЗАМЕНОВ
						</p>
						<table border="1" cellspacing="0" style="margin-top: -4mm;">
							<thead>
								<th style="text-align: center;">&nbsp</th>
								<th style="text-align: center;">&nbsp</th>
								<th style="text-align: center;">&nbsp</th>
								<th style="text-align: center;">ДОП</th>
								<th style="text-align: center;">СБА</th>
								<th style="text-align: center;">ВСЕГО</th>
							</thead>
							<tbody>
								<td style="width: 15mm; text-align: center;">&nbsp</td>
								<td style="width: 15mm; text-align: center;">&nbsp</td>
								<td style="width: 15mm; text-align: center;">&nbsp</td>
								<td style="width: 15mm; text-align: center;">0</td>
								<td style="width: 15mm; text-align: center;">{{ isset($documentObr->sr_bal) ? $documentObr->sr_bal : '' }}</td>
								<td style="width: 15mm; text-align: center;">&nbsp</td>
							</tbody>
						</table>
					</td>
					<td style="padding-left: 17mm;">
						<p>Приказ о зачислении № <span style="border-bottom: 1px solid black;">
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						</span></p>
						<p>от "<span style="border-bottom: 1px solid black;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>"
							&nbsp; &nbsp; &nbsp; &nbsp;
							<span style="border-bottom: 1px solid black;">
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp;
							</span>
						</p>
					</td>
				</table>
			</div>
			<div class="row" style="width: 100%; padding-top: 5mm;">
				<h3 style="font-size: 20px; text-align: center; margin-top: 1mm;">ЛИЧНАЯ КАРТОЧКА АБИТУРИЕНТА</h3>
			</div>
			<div class="row" style="width: 100%; padding-top: 5mm; padding-left: 12mm; padding-right: 12mm;">
				<div class="col" style="float: left;">
					<div style="width: 30mm; height: 40mm; border: 1px solid black;">
						<img src="{{ asset($person->photo_url) }}" alt="" style="width: 30mm; height: 40mm;">
					</div>
				</div>
				<div class="col" style="float: left; font-size: 18px; padding-left: 20mm;">
					<table>
						<tr>
							<td>Фамилия:</td>
							<td><span style="text-decoration: underline; padding-left: 3mm;"><b>{{ $person->famil }}</b></span></td>
						</tr>
						<tr>
							<td>Имя:</td>
							<td><span style="text-decoration: underline; padding-left: 3mm;"><b>{{ $person->name }}</b></span></td>
						</tr>
						<tr>
							<td>Отчество:</td>
							<td><span style="text-decoration: underline; padding-left: 3mm;"><b>{{ $person->otch }}</b></span></td>
						</tr>
					</table>
				</div>
				<div class="col" style="float: left; padding-left: 20mm;">
					<div style="width: 55mm; height: auto; border: 1px solid black;">
						<p style="text-align: center;"><b>{{ $statement->shifr_statement }}</b></p>
					</div>
					<div style="width: 55mm; min-height: 26mm; margin-top: 2mm; border: 1px solid black;">
						<div style="width: 100%; height: 10mm; border-bottom: 1px solid black;">
							<p style="text-align: center; margin-top: 0mm;">
								<b>
									Направление</br>
									(специальность)
								</b>
							</p>
						</div>
						<div>
							<p style="text-decoration: underline; margin-top: 0mm;">
								{{ $statement->group_name }}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="padding-top: 50mm; padding-left: 12mm; padding-right: 12mm; font-size: 18px;">
				<table class="sp-tb">
					<tr>
						<td>Дата рождения:</td>
						<td><span style="text-decoration: underline;">{{ date('d.m.Y', strtotime($person->birthday)) }}</span></td>
					</tr>
					<tr>
						<td>Домашний Адрес:</td>
						<td><span style="text-decoration: underline;">{{ $person->fact_residence }}</span></td>
					</tr>
					<tr>
						<td>Телефон:</td>
						<td><span style="text-decoration: underline;">{{ isset($person->phone_one) ? $person->phone_one : '' }} {{ isset($person->phone_two) ? $person->phone_two : '' }}</span></td>
					</tr>
					<tr>
						<td>Документ об образовании:</td>
						<td><span style="text-decoration: underline;">{{ isset($documentObr->doc_ser) ? $documentObr->name.' '.$documentObr->doc_ser.' '.$documentObr->doc_num : ''}}</span></td>
					</tr>
					<tr>
						<td>Выдан:</td>
						<td><span style="text-decoration: underline;">{{ isset($documentObr->doc_vidan) && isset($documentObr->doc_date) ? $documentObr->doc_vidan.' '.date('d.m.Y', strtotime($documentObr->doc_date)).' г.' : '' }}</span></td>
					</tr>
					<tr>
						<td>Название учебного заведения:</td>
						<td><span style="text-decoration: underline;">{{ isset($documentObr->uch_zav) ? $documentObr->uch_zav  : ''}}</span></td>
					</tr>
					<tr>
						<td>Льготы:</td>
						<td><span style="text-decoration: underline;">{{ $lgots }}</span></td>
					</tr>
					<tr>
						<td>{{ $person->type_doc }}:</td>
							<td>Серия: <span style="text-decoration: underline;">{{ $person->pasp_ser }}</span> Номер: <span style="text-decoration: underline;">{{ $person->pasp_num }}</span></td>
						</tr>
					<tr>
						<td>Выдан:</td>
						<td>
							<span style="text-decoration: underline;">{{ date('d.m.Y', strtotime($person->pasp_date)).' '.$person->pasp_vid }}</span>
						</td>
					</tr>
				</table>
			</div>
			<div class="row" style="padding-top: 50mm; padding-left: 12mm; padding-right: 12mm; font-size: 18px;">
				<span style="margin-top: 55mm;">Дата заполнения <span style="border-bottom: 1px solid black;">{{ date('d.m.Y', time()) }} </span></span>
					<span style="padding-left: 35mm;">Подпись абитуриента <span style="border-bottom: 1px solid black;">
						&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
						&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
						&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
					</span>
				</span>
			</div>
		</div>
	</body>
</html>
