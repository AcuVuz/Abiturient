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
  var tr = '';
  jQuery.each(data.data, function(i, el) {
                i++;
     el[3] == null ? el[3] = 'не указан' : el[3] = el[3];
     tr+='<tr><td>'+ el[0] + ' ' + el[1] + ' ' + el[2] +'</td><td>' + el[3] + '</td></tr>';

   });

  return '<table class="ss">' +
         '<thead>' +
         '<th>ФИО</th>' +
         '<th>Средний балл документа об образовании</th>' +
         '</thead>' +
         '<tbody>' +
          tr +
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
