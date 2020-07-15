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
   @page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
   }
   .list-header{
     width: 100%;
     text-align: center;
     padding-top: 5mm;
     font-size: 11px;
   }
   .row{
    width: 100%;
   }
   		</style>
	</head>
	<body class="body-report">
  	<div class="wrap-list" id="wrap-list">
     <div class="list-header">
       <h2>ГОУ ВПО ЛНР «ЛУГАНСКИЙ НАЦИОНАЛЬНЫЙ</br>
       УНИВЕРСИТЕТ ИМЕНИ ТАРАСА ШЕВЧЕНКО »</h2>
     </div>
     <div class="row" style="text-align:center;">Форма обучения: очная, заочная</div>
     <div class="row" style="text-align:center; font-size: 12px;">(подчеркнуть)</div>
     <div class="row" style="text-align:center; font-size: 16px;"><h3>ВЕДОМОСТЬ ВСТУПИТЕЛЬНОГО ЭКЗАМЕНА</h3></div>
     <div class="row" style="padding-left: 20mm;">
      Уровень профессионального образования
      <!-- Если будешь тянуть сюда данные из БД убери &nbsp, если данные приходят пустые, то вставляй  &nbsp -->
     <div style="border-bottom: 1px solid black; width: 90mm;float:right;  margin-right: 44mm;"> &nbsp &nbsp &nbsp</div>
     </div>
     <div class="row" style="text-align:center; margin-left: 34mm; margin-top: 2mm; font-size: 12px;">(бакалавриат, бакалавриат на основе СПО, магистратура)</div>
    <div class="row" style="max-width: 166mm; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 2mm;">
     Тестирование/творческий конкурс / Спортивные нормативы
    </div>

    <div class="row" style="text-align:center; font-size: 12px;">(форма вступительного экзамена)</div>

    <div class="row" style="max-width: 166mm; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 5mm;">
     Профессиональный аттестационный экзамен/ Иностранный язык (это для магистратуры).
    </div>
    <div class="row" style="max-width: 166mm; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 2mm;">
     Профессиональный аттестационный экзамен (для бакалавров на основе СПО).
    </div>
    <div class="row" style="max-width: 166mm; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 2mm;">
     Для бакалавров в соответствии с их названиями вступительных экзаменов
    </div>

    <div class="row" style="text-align:center; font-size: 12px;">(название экзамена)</div>

   <div class="row" style="padding-left: 20mm; margin-top: 6mm;">
    Направление подготовки (специальность)
    <!-- Если будешь тянуть сюда данные из БД убери &nbsp, если данные приходят пустые, то вставляй  &nbsp -->
    <div style="border-bottom: 1px solid black; width: 90mm;float:right;  margin-right: 44mm;"> &nbsp &nbsp &nbsp</div>
   </div>

    <div class="row" style="padding-left: 20mm; margin-top: 6mm;">
     Дата проведения вступительного экзамена
     <div style="float:right; margin-right: 50mm;">
      «<span style="border-bottom:1px solid black;">
      &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp
      </span>»
      <span style="border-bottom:1px solid black;">
      &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp
      </span>
      <span>2020 год</span>
     </div>
    </div>

   <div class="row" style="padding-left: 20mm; margin-top: 3mm;">
    Фамилии и инициалы экзаменаторов
    <!-- Если будешь тянуть сюда данные из БД убери &nbsp, если данные приходят пустые, то вставляй  &nbsp -->
   <div style="border-bottom: 1px solid black; width: 90mm;float:right;  margin-right: 44mm;"> &nbsp &nbsp &nbsp</div>
   </div>


   <table border="1" cellspacing="0" style="margin-left: 20mm; margin-top: 3mm; width: 166mm; max-width: 166mm;">
    <thead>
     <tr>
      <th rowspan="2">№ </br>п/п</th>
      <th rowspan="2">Шифр</th>
      <th rowspan="2">Фамилия, имя, отчество поступающего</th>
      <th rowspan="1" colspan="2">Количество баллов</th>
     </tr>
     <tr>
      <th>цифрами</th>
      <th>буквами</th>
     </tr>
    </thead>
    <tbody>
     <tr>
      <td>1.</td>
      <td></td>
      <td></td>
      <td>впечатано</td>
      <td>впечатано</td>
     </tr>
     <tr>
      <td>2.</td>
      <td></td>
      <td></td>
      <td>впечатано</td>
      <td>впечатано</td>
     </tr>
     <tr>
      <td>3.</td>
      <td></td>
      <td></td>
      <td>впечатано</td>
      <td>впечатано</td>
     </tr>
    </tbody>
   </table>
   <div class="row" style="margin-left: 20mm; margin-top: 3mm;">
    Ответственный секретарь </br>
    приёмной комиссии
    <div style="float:right; margin-right: 45mm;">И. В. Хорошевская</div>
   </div>
    <div class="row" style="margin-left: 20mm; margin-top: 10mm; max-width: 162mm;">Председатель предметной комиссии (для бакалавров) </div>
    <div class="row" style="margin-left: 20mm; margin-top: 3mm; max-width: 162mm;">Председатель профессиональной аттестационной комиссии (для магистров и бакалавров на базе СПО)</div>

   <div class="row" style="margin-left: 20mm; margin-top: 3mm; max-width: 162mm;">
    <span style="border-bottom:1px solid black">
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     &nbsp&nbsp&nbsp&nbsp
    </span>
    &nbsp&nbsp&nbsp
    <span style="border-bottom:1px solid black">
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    </span>
   </div>
   <div class="row" style="margin-left: 22mm; font-size: 12px;">
     (подпись)
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     (фамилия, инициалы)
   </div>

    <div class="row" style="margin-left: 20mm; margin-top: 7mm;">Экзаменаторы:</div>

    <div class="row" style="margin-left: 20mm; margin-top: 3mm; max-width: 162mm;">
     <span style="border-bottom:1px solid black">
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp
     </span>
     &nbsp&nbsp&nbsp
     <span style="border-bottom:1px solid black">
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     </span>
    </div>

    <div class="row" style="margin-left: 22mm; font-size: 12px;">
      (подпись)
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      (фамилия, инициалы)
    </div>

    <div class="row" style="margin-left: 20mm; margin-top: 3mm; max-width: 162mm;">
     <span style="border-bottom:1px solid black">
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp
     </span>
     &nbsp&nbsp&nbsp
     <span style="border-bottom:1px solid black">
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     </span>
    </div>

    <div class="row" style="margin-left: 22mm; font-size: 12px;">
      (подпись)
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      (фамилия, инициалы)
    </div>
</div>
 </body>
</html>
