<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Экзаменационная карта</title>
		<style>
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 297mm;
				height: 160mm;
				font-family: "Times New Roman", Times, serif;
			}
			.tfio td:last-child {
				padding-left: 10mm;
			}
			.tekz td, th {
				padding: 1.3mm;
			}
		</style>
		<style type="text/css" media="print">
			@page {
				size: auto;
				margin: 0;
			}
			.photo{
				width: 3cm;
				height: 4cm;
				min-width:3cm;
				min-height:4cm;
			}
		</style>
	</head>
	<body class="body-report">
		<div class="wrap-list">
			<div class="row">
				<div class="col" style="width: 50%; float: left;">
					<div class="row" style="padding-left:12mm; padding-top: 8mm;">Экзаменационный лист № {{ $statement->id }}</div>
					<div class="row" style="padding-left:12mm; padding-top: 2mm;">Форма обучения: {{ $statement->fo_name }}</div>
					<div class="row" style="padding-left:12mm; padding-top: 2mm; max-width: 120mm;">{{ $statement->group_name }}</div>
					<div class="row" style="padding-left:12mm; padding-top: 2mm;">
						<table class="tfio">
							<tr>
								<td>Фамилия</td>
								<td><span style="text-decoration: underline;">{{ $person->famil }}</span></td>
							</tr>
							<tr>
								<td>Имя</td>
								<td><span style="text-decoration: underline;">{{ $person->name }}</span></td>
							</tr>
							<tr>
								<td>Отчество</td>
								<td><span style="text-decoration: underline;">{{ $person->otch }}</span></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col" style="float: right; width: 50%;">
					<div class="col" style="float: left;">
						<div class="photo" style="margin-top: 8mm; line-height:4cm;
						border: 1px solid black; width: 3cm; height: 4cm; text-align: center;
						min-width: 3cm; min-height: 4cm;">Фото</div>
					</div>
					<div class="col">
						<div class="row" style="padding-top: 8mm; padding-left: 35mm;">Дата выдачи</div>
						<div class="row" style="padding-left: 35mm; padding-top: 2mm;">
							"<span style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>"
							<span style="border-bottom: 1px solid black;">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span> 2020г.
						</div>
						<div class="row" style="max-width: 50mm; padding-left: 35mm; padding-top: 3mm;">
							Ответственный секретарь
							приемной комиссии
						</div>
						<div class="row" style="padding-left: 35mm; padding-top: 4mm;">
							<span style="border-bottom: 1px solid black;">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
						</div>
						<div class="row" style="padding-left: 45mm; padding-top: 1mm; font-size: 12px;">(подпись)</div>
						<div class="row" style="padding-top: 5mm; padding-left: 35mm;">Печать</div>
					</div>
				</div>
			</div>
			<div class="row" style="text-align: center;">&nbsp;</div>
			<div class="row" style="text-align: center;"><h3>I. Оценки за вступительные экзамены</h3></div>
			<div class="row">
				<table class="tekz" border="1" cellspacing="0" style="margin: 5mm 15mm 5mm 15mm;">
					<thead>
						<tr>
							<th>№</br>п/п</th>
							<th>Название учебного предмета</th>
							<th>Характер экзамена</th>
							<th>Дата экзамена</th>
							<th colspan="2">Оценка</th>
							<th>Фамилии и инициалы экзаменаторов</th>
							<th>Подписи экзаменаторов</th>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th>Цифрами</th>
							<th>Прописью</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td colspan="3" style="text-align: center;">Средний балл документа об образовании</td>
							<td style="text-align: center;">{{ isset($docObr) ? $docObr->sr_bal : '' }}</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						@foreach ($examCard as $ec)
							<tr>
								<td>{{ $loop->iteration + 1 }}.</td>
								<td>{{ $ec->pred_name }}</td>
								<td></td>
								<td>{{ date('d.m.Y', strtotime($ec->date_exam)) }}</td>
								<td style="text-align: center;">{{ $ec->ball }}</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="row" style="padding-left:12mm; padding-top: 5mm;">
				<h3 style="float:left; margin: 0;">II. Сумма баллов за вступительные экзамены</h3>
				<span style="border-bottom: 1px solid black; margin-left: 2mm;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
			</div>
			<div class="row" style="font-size: 12px;">
				<span style="margin-left: 18mm;">(цифрами)</span>
				<span style="margin-left: 60mm;">(прописью)</span>
			</div>
			<div class="row" style="padding-left: 80mm; padding-top: 5mm;">
				<h4 style="float:left; margin: 0;">Ответственный секретарь</br>приемной комиссии</h4>
				</br>
				<span style="border-bottom: 1px solid black; margin-left: 2mm;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</span>
				<span style="margin-left: 3mm;">И.В. Хорошевская</span>
			</div>
		</div>
	</body>
</html>
