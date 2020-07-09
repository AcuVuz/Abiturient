<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Заявление</title>
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
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
			@page {
				size: auto;   /* auto is the initial value */
				margin: 0;  /* this affects the margin in the printer settings */
			}
		</style>
	</head>
	<body class="body-report">
		<div class="wrap-list">
			<div class="col" style=" margin-left: 120mm;  margin-top: 10mm;">
				<p>
					Ректору</br>
					Луганского национального университета</br>
					имени Тараса Шевченко</br>
				</p>
			</div>
			<div class="col"  style="width: 100%; padding-left: 12mm; margin-top: 10mm;">
				<table>
					<tr>
						<td style="width: 25mm;">абитуриент</td>
						<td style="border-bottom: 1px solid black; width: 157mm">{{ $person->famil.' '.$person->name.' '.$person->otch }}</td>
					</tr>
					<tr style="font-size: 11px;">
						<td>{{ $person->type_doc }}:</td>
						<td>{{ $person->pasp_ser.' '.$person->pasp_num.', '.$person->pasp_vid.', '.date('d.m.Y', strtotime($person->pasp_date)) }}</td>
					</tr>
				</table>
			</div>
			<div class="col" style="margin-top: -2mm;">
				<p style="font-size: 22px; text-align:center;"><b>Заявление</b></p>
				<p style="padding-left: 12mm;">
					Прошу допустить меня к участию в конкурсном отборе на: {{ $statement->fo_id == 1 ? 'Очную ' : $statement->fo_id == 2 ? 'Заочную ': ''}} форму обучения
					по программе подготовки {{ $statement->st_id == 1 ? 'бакалавра' : $statement->st_id == 2 ? 'бакалавра на базе СПО' : $statement->st_id == 1 ? 'магистра' : ''}}: {{ $statement->minid.' '.$statement->group_name }}
				</p>
				<p style="padding-left: 12mm;">
					Иностранный язык: {{ $person->english_lang == 'T' ? 'английский' : $person->deutsch_lang == 'T' ? 'немецкий' : $person->franch_lang == 'T' ? 'французский' : '' }}
				</p>
			</div>
			<div class="col">
				<p style="font-size: 19px; text-align:center;"><b>О себе сообщаю</b></p>
				<table style="padding-left: 12mm;">
					<tr>
						<td>Пол: {{ $person->gender == 'Муж' ? 'мужской' : 'женский' }}</td>
					</tr>
					<tr>
						<td>Гражданство: {{ $person->citizen == "LNR" ? "ЛНР" : "" }} 
										 {{ $person->citizen == "DNR" ? "ДНР" : "" }}
										 {{ $person->citizen == "UA" ? "Украина" : "" }}
										 {{ $person->citizen == "RU" ? "Российская Федерация" : ""  }}</td>
					</tr>
					<tr>
						<td>Дата рождения: {{ date('d.m.Y', strtotime($person->birthday)) }}</td>
					</tr>
					<tr>
						<td>Область: {{ $person->addr_obl }}</td>
					</tr>
					<tr>
						<td>Район: {{ $person->addr_rajon }}</td>
					</tr>
					<tr>
						<td>Город/Село: {{ $person->addr_city }}</td>
					</tr>
					<tr>
						<td>Улица: {{ $person->addr_street }}</td>
					</tr>
					<tr>
						<td>Мобильный телефон: {{ isset($person->phone_one) ? $person->phone_one.' ' : '' }} {{ isset($person->phone_two) ? $person->phone_two : '' }}</td>
					</tr>
					<tr>
						<td>Окончил (-а): {{ isset($docObr) ? isset($docObr->doc_date) ? $docObr->uch_zav : '': '' }}</td>
					</tr>
				</table>
			</div>
			<div class="col" style="padding-left: 12mm; padding-top: 2mm">
				<table>
					<tr>
						<td>Награда за обучение</td>
					</tr>
					<tr>
						<td>Средний балл аттестата/диплома: {{ isset($docObr) ? $docObr->sr_bal : '' }}</td>
					</tr>
					<tr>
						<td>
							Дополнительные сведения (награды, льготы): 
							@foreach ($allPrivilege as $ap)
								{{ $ap->name.'; ' }}	
							@endforeach

						</td>
					</tr>
				</table>
			</div>
			<div class="col" style="padding-left: 12mm; padding-top: 2mm">
				<table>
					<tr>
						<td>Имею образование: {{ isset($docObr) ? $docObr->educ_name : '' }}</td>
					</tr>
					<tr>
						<td>На время обучения поселение в общежитии {{ $person->hostel_need == '0' ? 'не требуется' : 'требуется' }}</td>
					</tr>
				</table>
			</div>
			<div class="col" style="padding-left: 12mm; margin-top: -3mm">
				<p style="font-size: 18px;">
					<b>Результаты ВНО/ЕГЭ: @if (count($sertificate) == 0) отсутствуют @endif</b>
					@if(count($sertificate) > 0)
						@foreach ($sertificate as $sert)
							<p>{{ $loop->iteration.'. '.$sert->type_sertificate.' '.$sert->pred_name.' '.$sert->ball_sert.'б. '.date('d.m.Y', strtotime($sert->date_sert)) }}</p>
						@endforeach
					@endif
				</p>
			</div>
			<div class="col">
				<p style="padding-left: 12mm; padding-right: 12mm; text-indent: 5mm;"> Даю согласие на обработку и использование моих персональных данных в электронной базе данных
					Луганского национального университета имени Тараса Шевченко, обнародование результатов ВНО/ЕГЭ
					вступительных испытаний и наличия оснований для особых условий зачисления.
				</p>
				<div style="width: 30mm; float: right;border-bottom: 1px solid black; margin-right: 12mm;"></div>
			</div>
			<div class="col" style="margin-top: -1mm">
				<p style="padding-left: 12mm; padding-right: 12mm; text-indent: 5mm;"> Извещен, что предоставление мной недостоверных персональных данных, данных об особых условиях
					зачисления, полученное ранее образование, прохождение ВНО/ЕГЭ есть основанием для отчисления меня из
					числа студентов.
				</p>
				<div style="width: 30mm; float: right;border-bottom: 1px solid black; margin-right: 12mm;"></div>
			</div>
			<div class="col" style="margin-top: -1mm">
				<p style="padding-left: 12mm; padding-right: 12mm; text-indent: 5mm;">С правилами приема, лицензией, сертификатом об аккредитации выбранного направления ознакомлен (-а).</p>
			</div>
			<div class="col" style="margin-top: -1mm">
				<p style="text-decoration: underline; padding-left: 12mm; padding-right: 12mm; text-indent: 5mm;"><b>Осведомлен (-а), что в случае непредоставления в установленный срок (до 20.08.19) оригиналов
					документов (об образовании, сертификатов) в приемную комиссию Луганского национального
					университета имени Тараса Шевченко, меня не зачислят на обучение на бюджетное место, а также на
					обучение за счет льготных долгосрочных кредитов, что и заверяю личной подписью.
				</p></b>
				<div style="width: 30mm; float: right;border-bottom: 1px solid black; margin-right: 12mm;"></div>
			</div>
			<div class="col" style="margin-top: 10mm">
				<table>
					<tr>
						<td style="padding-left: 12mm;">«<span style="border-bottom: 1px solid black;">&nbsp &nbsp &nbsp &nbsp</span>» <span style="border-bottom: 1px solid black;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span> 2020 г.</td>
						<td style="padding-left: 56mm;">
							Подпись 
							<span style="border-bottom: 1px solid black;">
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
