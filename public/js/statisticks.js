
var groupColumn = 10;
function statistic_table(full){
 var btn_p;
 full === 'T' ? btn_p = '+' : btn_p = '';
 var dataTable = $('#table_statistic').dataTable({
     processing: true,
     ajax: {
         url: '/StaticTable'
     },
     bSort:false,
     searching: true,
     columnDefs: [
                 { "visible": false, "targets": groupColumn }
             ],
    columns: [
           {
               'className':      'details-control',
               'orderable':      false,
               'data':           null,
               'defaultContent': btn_p
           }],
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
      /*
             var table = $('#table_statistic').dataTable(),
                   rows = table.fnGetNodes();

             $(rows).each(function () {
                 $(this).find('td:first').text(this._DT_RowIndex + 1);
                 var col1 = $(this).find('td:nth-child(4)').text();
                 var col2 = $(this).find('td:nth-child(5)').text();

                 var col3 = $(this).find('td:nth-child(6)').text();
                 var col4 = $(this).find('td:nth-child(7)').text();

                 $(this).find('td:nth-child(8)').text(parseInt(col1) + parseInt(col2));

                 $(this).find('td:nth-child(9)').text(parseInt(col3) + parseInt(col4));

             });
      */
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

           "footerCallback": function ( row, data, start, end, display ) {
                   var api = this.api(), data;

                   total_ochka = api
                       .column( 4 )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );


                   pageTotal_ochka = api
                       .column( 4, { page: 'current'} )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );

                   total_zaochka = api
                       .column( 5 )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );


                   pageTotal_zaochka = api
                       .column( 5, { page: 'current'} )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );

                   total_return_ochka = api
                       .column( 6 )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );


                   pageTotal_return_ochka = api
                       .column( 6, { page: 'current'} )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );

                   total_return_zaochka = api
                       .column( 7 )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );


                   pageTotal_return_zaochka = api
                       .column( 7, { page: 'current'} )
                       .data()
                       .reduce( function (a, b) {
                           return parseInt(a) + parseInt(b);
                       }, 0 );


                  total_statments = api
                      .column( 8 )
                      .data()
                      .reduce( function (a, b) {
                          return parseInt(a) + parseInt(b);
                      }, 0 );


                  pageTotal_statments = api
                      .column( 8, { page: 'current'} )
                      .data()
                      .reduce( function (a, b) {
                          return parseInt(a) + parseInt(b);
                      }, 0 );

                 total_return_statments = api
                     .column( 9 )
                     .data()
                     .reduce( function (a, b) {
                         return parseInt(a) + parseInt(b);
                     }, 0 );


                 pageTotal_return_statments = api
                     .column( 9, { page: 'current'} )
                     .data()
                     .reduce( function (a, b) {
                         return parseInt(a) + parseInt(b);
                     }, 0 );

                   $( api.column( 4 ).footer() ).html(
                       pageTotal_ochka + '('+ total_ochka +')'
                   );

                   $( api.column( 5 ).footer() ).html(
                       pageTotal_zaochka + '('+ total_zaochka +')'
                   );
                   $( api.column( 6 ).footer() ).html(
                       pageTotal_return_ochka + '('+ total_return_ochka +')'
                   );
                   $( api.column( 7 ).footer() ).html(
                       pageTotal_return_zaochka + '('+ total_return_zaochka +')'
                   );
                   $( api.column( 8 ).footer() ).html(
                       pageTotal_statments + '('+ total_statments +')'
                   );
                   $( api.column( 9 ).footer() ).html(
                       pageTotal_return_statments + '('+ total_return_statments +')'
                   );

               },

  });
}
