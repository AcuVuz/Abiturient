<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Печать титулки журнала</title>
		<style>
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 290mm;
				height: 205mm;
				font-family: "Times New Roman", Times, serif;
                display: flex;
                flex-direction: column;
			}
		</style>
		<style type="text/css" media="print">
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 295mm;
				height: 209mm;
				font-family: "Times New Roman", Times, serif;
			}
			@page {
				size: auto;   /* auto is the initial value */
				margin: 0;  /* this affects the margin in the printer settings */
			}
		</style>
	</head>
	<body class="body-report">
		@foreach ($group as $g)
			<div class="wrap-list">
				<div class="row" style="text-align: center; padding: 2mm 30mm; font-size: 18px">
					<p>Государственное образовательное учреждение высшего образования</br>
					Луганской Народной Республики «Луганский государственный педагогический университет»</p>
					<hr>
				</div>
				<div class="row" style="text-align: center; padding: 20mm 30mm; font-size: 18px">
					<h2>ЖУРНАЛ</h2>
					<p>регистрации лиц, поступающих в высшие учебные заведения в {{ date("Y", time()) }} году</p>
				</div>
				<div class="row" style="padding: 2mm 30mm; font-size: 18px; display: flex; justify-content: center;">
					<table>
						<tr>
							<td>Форма обучения</td>
							<td style="text-decoration: underline; padding-left: 15px;">{{ $g->fo_name }}</td>
						</tr>
						<tr>
							<td>Институт, факультет</td>
							<td style="text-decoration: underline; padding-left: 15px;">{{ $g->fk_name }}</td>
						</tr>
						<tr>
							<td>Направление подготовки</td>
							<td style="text-decoration: underline; padding-left: 15px;">{{ $g->minid.' '.$g->name }}</td>
						</tr>
						<tr>
							<td>Уровень профессионального образования</td>
							<td style="text-decoration: underline; padding-left: 15px;">{{ $g->st_name }}</td>
						</tr>
					</table>
				</div>
			</div>
		@endforeach
	</body>
</html>
