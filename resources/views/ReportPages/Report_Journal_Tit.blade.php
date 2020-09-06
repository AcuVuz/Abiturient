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
		<div class="wrap-list">
			<div class="row" style="text-align: center; padding: 2mm 30mm; font-size: 18px">
                <p>Государственное образовательное учреждение высшего профессионального образования</br>
                Луганской Народной Республики «Луганский национальный университет имени Тараса Шевченко»</p>
                <hr>
            </div>
            <div class="row" style="text-align: center; padding: 20mm 30mm; font-size: 18px">
                <h2>ЖУРНАЛ</h2>
                <p>регистрации лиц, поступающих в высшие учебные заведения в 2020 году</p>
            </div>
            <div class="row" style="padding: 2mm 30mm; font-size: 18px; display: flex; justify-content: center;">
                <table>
                    <tr>
                        <td>Форма обучения</td>
                        <td style="text-decoration: underline; padding-left: 15px;">Очная</td>
                    </tr>
                    <tr>
                        <td>Институт, факультет</td>
                        <td style="text-decoration: underline; padding-left: 15px;">Институт экономики и бизнеса</td>
                    </tr>
                    <tr>
                        <td>Направление подготовки</td>
                        <td style="text-decoration: underline; padding-left: 15px;">38.03.01 Экономика(Экономика предприятий и организаций)</td>
                    </tr>
                    <tr>
                        <td>Уровень профессионального образования</td>
                        <td style="text-decoration: underline; padding-left: 15px;"> Бакалавр</td>
                    </tr>
                </table>
            </div>
		</div>
	</body>
</html>
