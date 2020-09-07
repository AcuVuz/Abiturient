<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Печать журнала</title>
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
                            <p class="rotate">Номер личного кабинета </p>
                        </th>
                        <th>
                            <p class="rotate">Дата приема документов </p>
                        </th>
                        <th>Фамилия, имя, отчество</th>
                        <th>Адрес места проживания</th>
                        <th>Пол (муж./жен.)/Дата рождения</th>
                        <th>Наименование учебного заведения, который выдал документ о полученном образовательно-квалификационном уровне</th>
                        <th>Средний балл документа о полном (базовом) высшем образовании</th>
                        <th>Подпись абитуриента в получении возвращенных документов или отметка об их возврате</th>
                    </thead>
                    <tbody>
                        @foreach ($statements as $stat)
                            <tr>
                                <td style="padding: 0 5px;">{{ $loop->iteration }}</td>
                                <td><p class="rotate">{{ $stat->person_id }}<p></td>
                                <td><p class="rotate">{{ date("d.m.Y", strtotime($stat->date_crt)) }}<p></td>
                                <td>{{ $stat->famil.' '.$stat->name.' '.$stat->otch }}</td>
                                <td>{{ $stat->country.' '.$stat->adr_obl.' '.$stat->adr_rajon.' '.$stat->adr_city.' '.$stat->adr_street.' '.$stat->adr_house.' '.$stat->adr_flatroom }}</td>
                                <td>{{ $stat->gender == "Муж" ? "Мужской" : "Женский" }} / {{ date("d.m.Y", strtotime($stat->birthday)) }}</td>
                                <td>{{ isset($doc_obr[$stat->id]) ? $doc_obr[$stat->id]->uch_zav : '' }}</td>
                                <td>{{ isset($doc_obr[$stat->id]) ? $doc_obr[$stat->id]->sr_bal : '' }}</td>
                                <td>{{ $stat->comment_return }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</body>
</html>
