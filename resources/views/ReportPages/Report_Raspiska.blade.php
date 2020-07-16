<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Печать расписки</title>
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
			.pr_doc_ol li{
				margin-top: 2mm;
			}
		</style>
		<style type="text/css" media="print">
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 297mm;
				height: 210mm;
				font-family: "Times New Roman", Times, serif;
			}
			.pr_doc_ol li{
				margin-top: 2mm;
			}
			@page {
				size: auto;   /* auto is the initial value */
				margin: 0;  /* this affects the margin in the printer settings */
			}
		</style>
	</head>
	<body class="body-report">
		<div class="wrap-list">
			<div class="col" style="width: 145.5mm; height: auto; float: left;">
				<div class="row" style="margin: 5mm 10mm 0mm 5mm; font-size: 18px;">
					<table>
						<tr>
							<td><b>ОПИСЬ ЛИЧНОГО ДЕЛА</b></td>
							<td style="padding-left: 8mm;"><b>ШИФР {{ $statement->shifr_statement }}</b></td>
						</tr>
					</table>
				</div>
				<div class="row" style="margin-left: 5mm; margin-top: 2mm;">
					<table>
						<tr>
							<td>
								ФИО: {{ $person->famil.' '.$person->name.' '.$person->otch }}
							</td>
						</tr>
						<tr>
							<td>
								Направление (специальность)
							</td>
						</tr>
						<tr>
							<td style="text-decoration: underline; max-width: 120mm;">
								{{ $statement->group_name }}
							</td>
						</tr>
					</table>
				</div>
				<div class="row" style="margin-left: 5mm; margin-top: 2mm;">
					<p style="font-size: 18px;"><b>Принятые документы:</b></p>
					<ol class="pr_doc_ol" style="padding:0; padding-left: 4mm; max-width: 120mm;">
						<li>Заявление</li>
						<li>6 фотографий</li>
						@foreach ($docPers as $doc)
							@if (in_array($doc->doc_id, [1, 7])) <li>{{ isset($docObr) && isset($docObr->doc_date) ? 'Документ об образовании '.$docObr->doc_ser.' '.$docObr->doc_num.' от '.date('d.m.Y', strtotime($docObr->doc_date)).' выдан '.$docObr->doc_vidan : '' }}</li>
							@else
								<li>{{ $doc->doc_name }}</li>
							@endif
						@endforeach
					</ol>
				</div>
				<div class="row" style="margin-left: 5mm; padding-right: 40px; margin-top: 45mm">
					<table class="table_doc_vozr" border="1" cellspacing="0" style="font-size: 14px">
						<thead>
							<th colspan="2">Документы приняты</th>
							<th colspan="2">Документы возвращены
								в связи с выбыванием</th>
							<th colspan="2">Документы возвращены</th>
							<th colspan="2">Укомплектовано</th>
						</thead>
						<tbody>
							<tr>
								<td style="text-align: center;">Подпись</td>
								<td style="text-align: center;">Дата</td>
								<td style="text-align: center;">Подпись</td>
								<td style="text-align: center;">Дата</td>
								<td style="text-align: center;">Подпись</td>
								<td style="text-align: center;">Дата</td>
								<td style="text-align: center;">Подпись</td>
								<td style="text-align: center;">Дата</td>
							</tr>
							<tr>
								<td style="height: 30mm"></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col" style="width: 3mm; height: 77.5%;  float: left; padding-top: 21mm;">
				<div style="height: 87%; border-left:1px solid black; border-right:1px solid black;">
				</div>
			</div>
			<div class="col" style="width: 146mm; height: auto; float: left;">
				<div class="row" style="margin: 5mm 10mm 0mm 5mm; font-size: 15px;">
					<p style="text-decoration: underline"><b>{{ $statement->branch_name }}</b></p>
				</div>
				<div class="row" style="text-align: center;">
					<p style="font-size: 22px;"><b>РАСПИСКА</b></p>
					<p style="font-size: 17px; margin-top: -6mm"><b>о приеме документов</b></p>
				</div>
				<div class="row" style="margin-left: 5mm;">
					<table>
						<tr>
							<td>По направлению (специальности)</td>
							<td style="padding-left: 15mm;"><b>{{ $statement->shifr_statement }}</b></td>
						</tr>
						<tr>
							<td colspan="2" style="text-decoration: underline; max-width: 122mm">{{ $statement->group_name }}</td>
						</tr>
						<tr>
							<td colspan="2" style="max-width: 122mm; padding-top: 5mm;">От <span style="text-decoration: underline;">{{ $person->famil.' '.$person->name.' '.$person->otch }}</span></td>
						</tr>
					</table>
				</div>
				<div class="row" style="margin-left: 5mm;">
					<p style="font-size: 18px;"><b>Принятые документы:</b></p>
					<ol class="pr_doc_ol" style="padding:0; padding-left: 4mm; max-width: 120mm;">
						<li>Заявление</li>
						<li>6 фотографий</li>
						@foreach ($docPers as $doc)
							@if (in_array($doc->doc_id, [1, 7])) <li>{{ isset($docObr) && isset($docObr->doc_date) ? 'Документ об образовании '.$docObr->doc_ser.' '.$docObr->doc_num.' от '.date('d.m.Y', strtotime($docObr->doc_date)).' выдан '.$docObr->doc_vidan : '' }}</li>
							@else
								<li>{{ $doc->doc_name }}</li>
							@endif
						@endforeach
					</ol>
				</div>
				<div class="row" style="margin-left: 5mm; max-width: 122mm; padding-top: 30mm;">
					<table>
						<tr>
							<td>Печать <p style="margin-top: -4mm;"></p>&nbsp &nbsp Вуза</td>
							<td style="padding-left: 46mm;">
								<b>Принял секретарь</b>
								<p style="margin-top: 0mm;"><b>приемной</b></p>
								<p style="margin-top: -4mm;"><b>комиссии</b> <span style="border-bottom:1px solid black;">
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								&nbsp &nbsp &nbsp &nbsp
								</span></p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td style="padding-left: 44mm;"><b>«<span style="border-bottom: 1px solid black;">&nbsp &nbsp &nbsp &nbsp</span>» <span style="border-bottom: 1px solid black;">
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
							</span> {{ date('Y', time()) }} г.</b</td>
						</tr>
						<tr>
							<td colspan="2" style="font-size: 11.4px;">В случае потери расписки поступающий немедленно заявляет об этом в приемную комиссию</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
