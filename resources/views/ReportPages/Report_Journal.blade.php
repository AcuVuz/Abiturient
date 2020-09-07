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
            .rotate{
                writing-mode: vertical-lr; 
                transform: rotate(-180deg); 
                margin: 0; 
                white-space: nowrap;
                padding: 0 5px;
            }
            .journal-table{
                width: 100%; 
                border-collapse: collapse; 
                border-spacing: 0; 
                font-size: 12px;
            }
            .journal-table tbody{
                text-align: center;
            }
            .journal-table th {
                padding: 10px 7px;
            }
            .journal-table td{
                padding: 0 7px;
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
            <div class="row" style="padding: 7mm;">
                <table class="journal-table"  border="1" cellspacing="0" cellpadding="0">
                    <thead>
                        <th>№ п/п</th>
                        <th>
                            <p class="rotate">Номер личного дела/Номер заявления </p>
                        </th>
                        <th>
                            <p class="rotate">Регистрационный номер заявления </p>
                        </th>
                        <th>
                            <p class="rotate">Дата приема документов </p>
                        </th>
                        <th>Фамилия, имя, отчество</th>
                        <th>Адрес места проживания</th>
                        <th>Пол (муж./жен.)/Дата рождения</th>
                        <th>Наименование учебного заведения, выдавшего документ
                        о полученном уровне профессионального образования
                        </th>
                        <th>Номер, серия, дата выдачи документа о полученном уровне профессионального образования</th>
                        <th>Номер сертификата (сертификатов) ВНО, ЕГЭ или ГИА и дата выдачи</th>
                        <th>Информация о наличии права на особые условия зачисления</th>
                        <th>Наличие ЦАН</th>
                        <th>Причины, по которым абитуриенту отказано в участии в конкурсе и зачислении на учебу</th>
                        <th>Подпись абитуриента в получении возвращенных документов или отметка об их возврате</th>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="padding: 0 5px;">1</td>
                        <td><p class="rotate">10470/47<p></td>
                        <td><p class="rotate">34Био48<p></td>
                        <td><p class="rotate">27.06.2019<p></td>
                        <td>Токарева Наталья Михайловна</td>
                        <td>ЛНР Луганская область Красный Луч Микрорайон 1 27 23</td>
                        <td>Женский / 06.11.1999</td>
                        <td>ГБПОУ ЛНР "Краснолучанская общеобразовательная средняя школа 1-3 ступеней "</td>
                        <td>атестат номер номер</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
	</body>
</html>
