<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Статистика МОН</title>
		<style>
			.body-report{
				padding: 0px;
				margin: 0px;
			}
			.wrap-list{
				width: 295mm;
				height: 209mm;
				font-family: "Times New Roman", Times, serif;
                display: flex;
                flex-direction: column;
                
			}
            .row{
                display: flex;
            }
            .ht{
                text-align: center;
            }
            table{
                border-collapse: collapse;
            }
            table td{
                padding: 15px;
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
            <div class="row" style="justify-content: flex-end; padding: 15mm; padding-right: 20mm; font-size: 14px">
                <p>
                    Приложение</br>
                    к письму МОН ЛНР</br>
                    от 09.09.2020  № 04-4416
                </p>
            </div>
            <div class="row" style="justify-content: center; padding-bottom: 15px">Списки студентов,  зачисленных на обучение в 2020-2021 учебном году</div>
            <div class="row" style="padding: 0 20px;">
                <table cellspacing="0" border="1">
                    <thead>
                        <th>№ п/п</th>
                        <th>ФИО студента (полностью)</th>
                        <th>Год рождения</th>
                        <th>Адрес основного места прописки</th>
                        <th>Направление подготовки/специальности,профиль</th>
                        <th>Курс обучения</th>
                        <th>Форма обучения очно/заочно</th>
                        <th>Условия обучения бюджет/контракт</th>
                        <th>Льготная категория</th>
                        <th>Особое право зачисления (наличие медали, победитель НО «РМАН», победитель или призер олимпиад и др.)</th>
                    </thead>
                    <tbody>
                        @foreach ($abits as $abit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $abit->famil.' '.$abit->name.' '.$abit->otch }}</td>
                                <td>{{ date('d.m.Y', strtotime($abit->birthday)) }}</td>
                                <td>{{ $abit->country.' '.$abit->adr_obl.' '.$abit->adr_rajon.' '.$abit->adr_city.' '.$abit->adr_street.' '.$abit->adr_house.' '.$abit->adr_flatroom }}</td>
                                <td>{{ $abit->minid.' '.$abit->spec }}</td>
                                <td>{{ $abit->st_id == 2 ? '3' : '1' }}</td>
                                <td>{{ $abit->fo_name }}</td>
                                <td>{{ $abit->is_budg == 'T' ? 'Бюджет' : 'Контракт' }}</td>
                                <td>{{ $lgot[$abit->id] > 0 ? '+' : '' }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</body>
</html>
