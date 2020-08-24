<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Рейтинг бакалавриат</title>
 <style>
   .body-report{
    padding: 0px;
    margin: 0px;
   }
   .mtable td{
    text-align: center;
    padding: 7px;
   }
   .wrap-list{
				width: 210mm;
				height: 297mm;
				font-family: "Times New Roman", Times, serif;
			}
 </style>
</head>
<body class="body-report">
 <div class="wrap-list">
 <div class="row" style="text-align:center; font-size: 20px; margin-left: 40px;"><h3>Рейтинг по бакалавриату</h3></div>
 <div class="row" style="font-size: 18px; max-width: 176mm; text-align: center; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 5mm;">{{$facultet}}</div>
 <div class="row" style="text-align:center; font-size: 14px; margin-left: 18mm;">(Институт/Факультет)</div>
 <div class="row" style="font-size: 18px; max-width: 176mm; text-align: center; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 5mm;">{{$foname}}</div>
 <div class="row" style="text-align:center; font-size: 14px; margin-left: 18mm;">(Форма обучения)</div>
 <div class="row" style="font-size: 18px; max-width: 176mm; text-align: center; margin-left: 20mm;border-bottom: 1px solid black; margin-top: 5mm;">{{$group_name}}</div>
 <div class="row" style="text-align:center; font-size: 14px; margin-left: 18mm;">(Направление)</div>
 <table class="mtable" border="1" cellspacing="0" style="margin-left: 6mm; margin-top: 3mm; width: 150mm; max-width: 204mm; margin-bottom: 10mm;">
  <tfooter>
  <th>№ пп</th>
  <th>Фамилия</th>
  <th>Имя</th>
  <th>Отчество</th>
  <th>Средний балл</th>
  <th>Медаль</th>
  <th>Довуз</th>
  @foreach($query as $q)
     @if ($q->name_exam != "")
       @foreach(explode('|', $q->name_exam) as $exs)
         <th>{{$exs}}</th>
       @endforeach
        @break
    @endif
  @endforeach
  <th>Сумма баллов</th>
  <th>Телефон</th>
  </tfooter>
  <tbody>
   @php ($i = 0)
    @foreach($query as $q)
    @php ($i = $i + 1)
     <tr>
      <td>{{$i}}</td>
      <td>{{$q->famil}}</td>
      <td>{{$q->Pname}}</td>
      <td>{{$q->otch}}</td>
      <td>{{$q->srbal}}</td>
      @if ($q->sum_priv_ball == 0)
        <td>&nbsp;</td>
      @else
        <td>{{$q->sum_priv_ball}}</td>
      @endif
      @if ($q->sum_dovuz_ball == 0)
        <td>&nbsp;</td>
      @else
      <td>{{$q->sum_dovuz_ball}}</td>
      @endif     
      @if ($q->exam_ball != "")
        @foreach(explode('|', $q->exam_ball) as $exs)
          <td>{{$exs}}</td>
        @endforeach
      @endif
      <td>{{$q->sum_all_ball}}</td>
      <td>
        @if ($q->phone_result != "")  
          @foreach(explode('|', $q->phone_result) as $phone)
            {{$phone}}
            @if (count(explode('|', $q->phone_result)) > 1)
              </br>
            @endif          
          @endforeach
        @endif
      </td>
     </tr>
    @endforeach
  </tbody>
 </table>
</div>
</body>
</html>
