@extends('layout.layout-2-flex')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/clients.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style type="text/css" media="print">
    @page {
 				size: auto;   /* auto is the initial value */
 				margin-top: 0;  /* this affects the margin in the printer settings */
 			}
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{asset('js/statisticks.js')}}"></script>
@endsection

@section('content')
<div class="ds-st-wrap">
 <div class="title-block">
  <h3>Статистика поданных заявлений с учетом абитуриентов</h3>
 </div>
 <div class="st-table-block">
  <table id="table_statistic" class="clients-table table table-hover m-0">
      <thead>
      <tr>
          <th></th>
          <th>№</th>
          <th>Образовательный уровень</th>
          <th>Направление</th>
          <th>Очная</th>
          <th>Заочная</th>
          <th>Очная возврат</th>
          <th>Заочная возврат</th>
          <th>Всего поданно</th>
          <th>Всего вернули</th>
          <th></th>
      </tr>
      </thead>
      <tfoot>
       <tr>
        <th></th>
        <th></th>
        <th>ВСЕГО:</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
       </tr>
      </tfoot>
  </table>
 </div>
</div>
<script>
$(function() {
 statistic_table('T');
 var dataTable = $('#table_statistic').dataTable();
 function format ( data ) {
  var tr = '',
      tr_o = '',
      tr_z = '',
      th = '',
      td_ex_ball,
      exam_name_str,
      exam_ball_str,
      exam_name_arr,
      exam_ball_arr,
      th_ochka = '',
      th_zaochka = '';

  jQuery.each(data.data, function(i, el) {
        i++;
     el[3] == null ? el[3] = '' : el[3] = el[3];
     el[4] == 0 ? el[4] = '' : el[4] = '&#10003';
     el[5] == 0 ? el[5] = '' : el[5] = '&#10003';
     el[6] == 0 ? el[6] = '' : el[6] = '&#10003';
     el[7] == null ? el[7] = '' : el[7] = el[7];
     el[8] == 0 ? el[8] = '' : el[8] = '&#10003';
     el[12] == null ? el[12] = '' : el[12] = el[12];
     el[13] === 'F' ? el[13] = '' : el[13] = '&#10003';
     exam_ball_str = el[11];
     exam_ball_arr = exam_ball_str.split('|');
     td_ex_ball = '';
     for (let j = 0; j < exam_ball_arr.length; j++) {
        exam_ball_arr[j] == 0 ? exam_ball_arr[j] = '' : exam_ball_arr[j] = exam_ball_arr[j];
        td_ex_ball+= '<td>' + exam_ball_arr[j] + '</td>';
     }

     if(parseInt(el[14]) == 1){
       th_ochka = "<tr><td class='st-title-fo' colspan = " + (parseInt(9) + parseInt(el[9])) +" >Очная форма обучения</td></tr>";
       tr_o+='<tr><td>'+ el[0] + ' ' + el[1] + ' ' + el[2] +'</td><td>' + el[3] + '</td>' +
       '<td>' + el[4] + '</td><td>' + el[5] + '</td><td>' + el[6] + '</td><td>' + el[7] + '</td>' +
       '<td>' + el[8] + '</td>' + td_ex_ball + '<td>' + el[12] + '</td>' +
       '<td>' + el[13] + '</td>' +'</tr>';
     }else if(parseInt(el[14]) == 2){
       th_zaochka = "<tr><td class='st-title-fo' colspan = 11 >Зочная форма обучения</td></tr>";
       tr_z+='<tr><td>'+ el[0] + ' ' + el[1] + ' ' + el[2] +'</td><td>' + el[3] + '</td>' +
       '<td>' + el[4] + '</td><td>' + el[5] + '</td><td>' + el[6] + '</td><td>' + el[7] + '</td>' +
       '<td>' + el[8] + '</td>' + td_ex_ball + '<td>' + el[12] + '</td>' +
       '<td>' + el[13] + '</td>' +'</tr>';
     }

      exam_name_str = el[10];

   });
   console.log(data);
    if(data.data.length != 0){
     exam_name_arr = exam_name_str.split('|');
     for (let j = 0; j < exam_name_arr.length; j++) {
        th+= '<th>' + exam_name_arr[j] + '</th>';
     }
   }


  return '<table class="ss">' +
         '<thead class="tfix">' +
         '<th>ФИО</th>' +
         '<th>Средний балл документа об образовании</th>' +
         '<th>Медаль</th>' +
         '<th>Льготы</th>' +
         '<th>Награды</th>' +
         '<th>Подготовительные курсы</th>' +
         '<th>Право первоочередного зачисления</th>' +
          th+
         '<th>Сумма баллов</th>' +
         '<th>Наличие документа об образовании</th>' +
         '</thead>' +
         '<tbody>' +
          th_ochka +
          tr_o +
          th_zaochka +
          tr_z +
         '</tbody>' +
         '</table>';
}



 $('#table_statistic tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = dataTable.api().row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        var d = row.data();
        var ff = '';
        $.ajax({
            dataType: 'json',
            url: '/GetStudentsStamentStatistic',
            type: 'GET',
            data: {
                gip_o: d[11],
                gip_z: d[12]
            },
            success: function(data) {
              row.child( format(data) ).show();
              tr.addClass('shown');
            },
        });

    }
 });
});
</script>
@endsection
