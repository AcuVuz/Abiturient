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
@endsection

@section('content')
<div class="ds-st-wrap">
 <div class="title-block">
  <h3>Статистика поданных заявлений</h3>
 </div>
  <div class="st-table-block">
   <table id="table_statistic" class="clients-table table table-hover m-0">
       <thead>
       <tr>
           <th></th>
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
   </table>
  </div>
</div>
<script>
$(function() {
 /* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+ d[2] +'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}

  var groupColumn = 9;
var dataTable = $('#table_statistic').dataTable({
    processing: true,
    ajax: {
        url: '/StaticTable'
    },
    'columns': [
            {
                'className':      'details-control',
                'orderable':      false,
                'data':           null,
                'defaultContent': ''
            }],


    searching: true,
    columnDefs: [
                { "visible": false, "targets": groupColumn }
            ],
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    language: {
        "processing": "Подождите...",
        "search": "Поиск:",
        "lengthMenu": "Показать _MENU_ записей",
        "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
        "infoEmpty": "Записи с 0 до 0 из 0 записей",
        "infoFiltered": "(отфильтровано из _MAX_ записей)",
        "infoPostFix": "",
        "loadingRecords": "Загрузка записей...",
        "zeroRecords": "Записи отсутствуют.",
        "emptyTable": "В таблице отсутствуют данные",
        "paginate": {
            "first": "Первая",
            "previous": "Предыдущая",
            "next": "Следующая",
            "last": "Последняя"
        },
        "select": {
            "rows": {
                "_": "Выбрано записей: %d",
                "0": "Кликните по записи для выбора",
                "1": "Выбрана одна запись"
            }
        }
    },

    fnRowCallback: function(oSettings) {
            var table = $('#table_statistic').dataTable(), // получаем таблицу
                  rows = table.fnGetNodes(); // получаем все строки, а не только на текущей страниц

            $(rows).each(function () {
                $(this).find('td:first').text(this._DT_RowIndex + 1);
                var col1 = $(this).find('td:nth-child(4)').text();
                var col2 = $(this).find('td:nth-child(5)').text();

                var col3 = $(this).find('td:nth-child(6)').text();
                var col4 = $(this).find('td:nth-child(7)').text();

                $(this).find('td:nth-child(8)').text(parseInt(col1) + parseInt(col2));

                $(this).find('td:nth-child(9)').text(parseInt(col3) + parseInt(col4));

            });

    },

    drawCallback: function ( settings, data ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;

              api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                  if ( last !== group ) {
                      $(rows).eq( i ).before(
                          '<tr class="group"><td colspan="10" style="text-align:center; background-color:#ddd; font-weight: bold;">'+group+'</td></tr>'
                      );

                      last = group;
                  }
              } );
          },
 });


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
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

});
</script>
@endsection
