@extends('layout.layout-2')

@section('styles')
<style>
 .card.mb-4{
   padding: 20px;
 }
</style>
@endsection

@section('scripts')
<script type="text/javascript">

function fill_facult()
{
 var bid = $('#abit_branch').val();
 $.ajax({
  url: '/vedomost/get_facultet',
  method: 'post',
  data: { bid : bid },
  headers: {
   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  },
  success: function(data) {
   $('#abit_facultet').html(data);
  },
  error: function(msg) {
   $('#abit_facultet').html(msg.responseText);
  }
 });
 $('#abit_stlevel').html('<option value="null">Выберите элемент</option>');
 $('#abit_formobuch').html('<option value="null">Выберите элемент</option>');
 $('#abit_group').html('<option value="null">Выберите элемент</option>');
}


function fill_formobuch()
{
 var fkid = $('#abit_facultet').val();
 var stid = 3;
 $.ajax({
  url: '/vedomost/get_form_obuch',
  method: 'post',
  data: { fkid : fkid, stid : stid },
  headers: {
   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  },
  success: function(data) {
   $('#abit_formobuch').html(data);
  },
  error: function(msg) {
   $('#abit_formobuch').html(msg.responseText);
  }
 });
 $('#abit_group').html('<option value="null">Выберите элемент</option>');
}
function fill_group()
{
 var fkid = $('#abit_facultet').val();
 var stid = 1;
 var foid = $('#abit_formobuch').val();
 $.ajax({
  url: '/vedomost/get_group',
  method: 'post',
  data: {
   fkid : fkid,
   stid : stid,
   foid : foid
  },
  headers: {
   'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  },
  success: function(data) {
   $('#abit_group').html(data);
  },
  error: function(msg) {
   $('#abit_group').html(msg.responseText);
  }
 });

}
function PrepRep(){
    var stid = 1;
    var gid = $('#abit_group').val();
    var fkid = $('#abit_facultet').val();
    var foid = $('#abit_formobuch').val();
    if(gid != "null" && fkid != "null" && foid != "null"){
    window.location = "/reitmag/report_reit_mag?gid=" + gid + '&fkid=' + fkid + '&foid=' + foid + '&stid=' + stid;
 }
}
</script>
@endsection

@section('content')
<h4>Рейтинг бакалавриат</h4>
<div class="card mb-4">
 <div class="form-group">
  <input type="button"  class="btn btn-secondary" onClick="PrepRep();"value="Распечатать">
 </div>
 <div class="form-group">
 	<label class="form-label">Выбор структуры</label>
 	<select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark"
   name="abit_branch" id="abit_branch" onchange="fill_facult();">
    <option value="null">Выберите элемент</option>
    @foreach ($abit_branch as $ab)
     <option value="{{ $ab->id }}">{{ $ab->short_name }}</option>
    @endforeach
  </select>
 </div>
 <div class="form-row" id="abit_facultet_block">
  <div class="form-group col-md-9">
   <label class="form-label">Институт/Факультет</label>
   <select id="abit_facultet" name="abit_facultet" onchange="fill_formobuch();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
    <option value="null">Выберите элемент</option>
   </select>
  </div>
  <div class="form-group col-md-3">
   <label class="form-label">Форма обучения</label>
   <select id="abit_formobuch" name="abit_formobuch" onchange="fill_group();" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" >
    <option value="null">Выберите элемент</option>
   </select>
  </div>
 </div>
 <div class="form-row">
  <div class="form-group col-md-12">
   <label class="form-label">Направление подготовки</label>
   <select id="abit_group" name="abit_group" class="form-control " data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark">
    <option value="null">Выберите элемент</option>
   </select>
  </div>
 </div>
</div>
@endsection
