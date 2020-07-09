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
    <script>$(function() {statistic_table('F');});</script>
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
@endsection
