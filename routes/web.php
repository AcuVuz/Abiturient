<?php

/*
|--------------------------------------------------------------------------
| ВЕБ-РОУТИНГ
|--------------------------------------------------------------------------
|
|	Здесь вы можете зарегистрировать веб-маршруты для вашего приложения. Эти
| 	маршруты загружаются RouteServiceProvider в группе, которая
| 	содержит группу промежуточного программного обеспечения "web" Теперь создайте что-то великое!
|
*/
//=============== ГРУППА РОУТОВ ДЛЯ ПРОВЕРКИ ВРЕМЕНИ РАБОТЫ ================================//
Route::get('/timeout', 'Error\ErrorsController@Timeout');
Route::get('/reset_pwd/reset', 'ResetPasswordController@resetPassword');
Route::middleware(['timeout'])->group(function () {
    Route::post('register', 'RegisterController@create')->name('register');
});

 //=============== ГРУППА РОУТОВ ДЛЯ ПРОВЕРКИ АВТОРИЗАЦИИ И ВРЕМЕНИ РАБОТЫ ================================//
Route::middleware(['check','timeout'])->group(function () {
    //=============== Заполнение информации о направлении абитуриента(нового) ================================//
    Route::get('/insert_abit', 'ProfileController@index_InsertAbit');
    //=============== Заполнение информации о направлении абитуриента(уже создан) ================================//
    Route::get('/success_insert_abit', 'ProfileController@index_Success_Abit');
    Route::post('/statement/get_facultet', 'ProfileController@get_facultet');
    Route::post('/statement/get_stlevel', 'ProfileController@get_stlevel');
    Route::post('/statement/get_form_obuch', 'ProfileController@get_form_obuch');
    Route::post('/statement/get_group', 'ProfileController@get_group');
    Route::post('/statement/create', 'ProfileController@statement_create');
    Route::get('/statement/return', 'ProfileController@statement_return');
    Route::get('/statement/del_return', 'ProfileController@statement_del_return');
    Route::get('/statement/set_orig', 'ProfileController@statement_set_orig');
    Route::get('/statement/del_orig', 'ProfileController@statement_del_orig');
    Route::get('/checked_abit', 'ProfileController@checked_abit');
    Route::get('/checked_all_abit', 'ProfileController@checked_all_abit');
    Route::get('/scanPhoto', 'ScanController@index');
    Route::get('/statement/dop_ball', 'ProfileController@statement_dop_ball');
    Route::post('/statement/dop_ball_save', 'ProfileController@statement_dop_ball_save');
    Route::post('/profile/is_home/update', 'ProfileController@is_home_upd');
});

Route::get('/', 'LoginController@check');
//=============== Отображение страницы Авторизация ================================//
Route::post('login', 'LoginController@login')->name('login');
//=============== Отображение страницы Регистрация ================================//

//=============== Процесс регистрации нового пользователя =========================//
Route::get('/register', 'RegisterController@index')->middleware('timeout');
//=============== Проверка на существующий логин =========================//
Route::post('/Check_login', 'RegisterController@check_login');
//=============== Проверка на существующий email =========================//
Route::post('/Check_email', 'RegisterController@check_email');
//=============== Процесс верификации (переходит из письма) =========================//
Route::get('/verificate', 'RegisterController@verificate');
//=============== Отображение страницы dashboard ==================================//
Route::get('/dashboard', 'DashboardController@index')->name('dashboards.dashboard-1')->middleware('check');
//=============== Вызгрузка данных json в таблицу dashboard ================================//
Route::get('/loadTable', 'DashboardController@loadTable');

Route::get('/StaticTable', 'DashboardController@StaticTable');
//=============== Вызгрузка данных json в sidebar dashboard ================================//
Route::get('/loadSidebar', 'DashboardController@loadSidebar');
//=============== Вызгрузка данных json в sidebar таблицу поданных заявлений dashboard ================================//
Route::get('/PersonsStatmentTable', 'DashboardController@PersonsStatmentTable');
//=============== Вызгрузка данных json в sidebar таблицу экзаменов dashboard ================================//
Route::get('/PersonsExamsTable', 'DashboardController@PersonsExamsTable');
//=============== Отображение шаблона Направления ================================//
Route::get('/direction', 'DirectionController@index');
//=============== Отображение факультетот в шаблоне Направления ================================//
Route::post('/direction/get_facultet', 'DirectionController@get_facultet');
Route::post('/direction/get_group', 'DirectionController@get_group');
Route::post('/direction/get_predmet', 'DirectionController@get_predmet');
Route::post('/direction/search_predmet', 'DirectionController@search_predmet');

Route::get('/MovePrikaz', 'MovePrikaz@index')->name('dashboards.dashboard-MovePrikaz')->middleware('check');
Route::post('/getStatgroup', 'MovePrikaz@GetGroupStat');
Route::post('/getStatgroupWithPrikaz', 'MovePrikaz@GetStatgroupWithPrikaz');
Route::post('/MovePrikaz/UpdateZach', 'MovePrikaz@UpdateZach');
Route::get('/grafik', 'GrafikController@index')->name('dashboards.dashboard-grafik')->middleware('check');
Route::get('/prikaz', 'PrikazController@index')->name('dashboards.dashboard-prikaz')->middleware('check');
Route::post('/prikaz/save', 'PrikazController@save')->name('dashboards.dashboard-prikaz')->middleware('check');
Route::post('/prikaz/delete', 'PrikazController@delete')->name('dashboards.dashboard-prikaz')->middleware('check');
Route::post('/grafik/get_predmet', 'GrafikController@get_predmet')->middleware('check');
Route::post('/grafik/save', 'GrafikController@save')->middleware('check');
Route::get('/vedomost', 'VedomostController@index')->name('dashboards.dashboard-vedomost')->middleware('check');
Route::get('/reitmag', 'Reting\RetingController@reitmag')->name('dashboards.dashboard-reitmag')->middleware('check');
Route::get('/reitbak', 'Reting\RetingController@reitbak')->name('dashboards.dashboard-reitbak')->middleware('check');
Route::get('/print/test/form', 'PrintController@printtest_show')->name('dashboards.dashboard-printtest')->middleware('check');
Route::post('/print/test/search_predmet', 'PrintController@search_predmet')->name('dashboards.dashboard-printtest')->middleware('check');
Route::get('/reitmag/report_reit_mag', 'Reting\RetingController@PrepareReport')->middleware('check');

Route::post('/vedomost/create', 'VedomostController@create')->middleware('check');
Route::post('/vedomost/delete', 'VedomostController@delete_vedomost')->middleware('check');
Route::get('/vedomost/print', 'PrintController@vedomost')->middleware('check');
Route::post('/vedomost/get_facultet', 'VedomostController@get_facultet')->middleware('check');
Route::post('/vedomost/get_stlevel', 'VedomostController@get_stlevel')->middleware('check');
Route::post('/vedomost/get_form_obuch', 'VedomostController@get_form_obuch')->middleware('check');
Route::post('/vedomost/get_group', 'VedomostController@get_group')->middleware('check');
Route::post('/vedomost/get_predmet', 'VedomostController@get_predmet')->middleware('check');
Route::post('/vedomost/get_predmet_no_spec', 'VedomostController@get_predmet_no_spec')->middleware('check');
Route::post('/vedomost/get_vedomost', 'VedomostController@get_vedomost')->middleware('check');
Route::get('/vedomost/fill_vedomost', 'VedomostController@fill_vedomost')->middleware('check');
Route::post('/vedomost/get_vedPers', 'VedomostController@get_vedPers')->middleware('check');
Route::post('/vedomost/save_vedPers', 'VedomostController@save_vedPers')->middleware('check');
//=============== Сохрание данных направления и теста ================================//
Route::post('/direction/save', 'DirectionController@save');
//=============== Отображение шаблона Направления ================================//

Route::post('/upload_scan_photo', 'ScanController@Upload_Scan_Photo');

Route::get('/print/lich_card', 'PrintController@lich_card')->name('print.lich_card')->middleware('check');
Route::get('/print/opis', 'PrintController@opis')->name('print.opis')->middleware('check');
Route::get('/print/statement', 'PrintController@statement')->name('print.statement')->middleware('check');
Route::get('/print/examSheet', 'PrintController@examSheet')->name('print.examSheet')->middleware('check');
Route::post('/print/test', 'PrintController@test')->name('print.test')/*->middleware('check')*/;

//=============== Разрыв сессии ================================//
Route::get('logout', 'DashboardController@logout')->name('logout');
//=============== Отображение страницы Личной карты абитуриента ================================//
Route::get('/profile', 'ProfileController@index_Profile')->name('profile')->middleware('check');

//=============== Отображение страницы Личной карты абитуриента ================================//
Route::post('/profilesave', 'ProfileController@save_Profile')->middleware('check');
//=============== Удаление сертификата абитуриента ================================//
Route::post('/sert/del', 'ProfileController@delete_sertificate')->middleware('check');

Route::post('/upload/dock', 'ProjectsController@uploadDOCUMENTS')->name('updlode.dock');
//=============== Загрузка фотографии абитуриента ================================//
Route::post('/upload/photo', 'ProfileController@upload_Photo')->middleware('check');


//=============== КАК-ТО ПОТОМ =================================================//
//=============== Отображение страницы Графиков ================================//
Route::get('charts/chartjs', 'ChartsController@index')->name('charts.chartjs')->middleware('check');
//=============== Отображение страницы Рейтингов ================================//
Route::get('reting/reting_phone', 'Reting\RetingController@index')->name('reting.reting_phone')->middleware('check');
//=============== Отображение страницы Отчетов Специальности ================================//
Route::get('reports/rep_spesial','Reports\Report_SpesialController@index')->name('reports.rep_spesial')->middleware('check');
//=============== Отображение страницы Восстановление пароля ======================//
Route::get('/reset-password', 'ResetPasswordController@index');
//=============== Отображение страницы Контактов  ================================//
Route::get('/contact', 'Contact\ContactController@index')->middleware('check');
//=============== Отображение страницы Тех.поддержки  ============================//
Route::get('/support', 'Support\SupportController@index')->middleware('check');
Route::get('/jurnal', 'JurnalController@index')->middleware('check');
Route::post('/jurnal/get_facultet', 'JurnalController@get_facultet')->middleware('check');
Route::post('/jurnal/get_stlevel', 'JurnalController@get_stlevel')->middleware('check');
Route::post('/jurnal/get_form_obuch', 'JurnalController@get_form_obuch')->middleware('check');
Route::post('/jurnal/get_group', 'JurnalController@get_group')->middleware('check');
Route::get('/jurnal/print_titul', 'JurnalController@print_titul')->middleware('check');
Route::get('/jurnal/print_jurnal', 'JurnalController@print_jurnal')->middleware('check');

Route::post('/discard_checked_abit', 'ProfileController@DiscardCheckedAbit');


Route::get('/repzajav', function(){
 return view('ReportPages.Report_Zajav');
});

Route::get('/reprasp', function(){
 return view('ReportPages.Report_Raspiska');
});

Route::get('/replichkart', function(){
 return view('ReportPages.Report_LichKarta');
});
Route::get('/repmag', function(){
 return view('ReportPages.Report_vedomost');
});
Route::get('/repekzcart', function(){
 return view('ReportPages.Report_Ekzcart');
});

Route::get('/repjournaltit', function(){
    return view('ReportPages.Report_Journal_Tit');
   });
   
Route::get('/repjournal', function(){
    return view('ReportPages.Report_Journal');
});

Route::get('/AbitForMon', "PrintController@abitformon");

Route::get('/statistic', function(){
 return view('DashboardPage.dashboardStatistic', [
  'username' => session('user_name'),
  'title' => 'Статистика поданных заявлений',
  'role' => session('role_id')
 ]);
})->name('Report.dashboards-statistic')->middleware('check');

Route::get('/fullstatistic', function(){
 return view('DashboardPage.dashboardStatisticFull', [
  'username' => session('user_name'),
  'title' => 'Статистика поданных заявлений с учетом абитуриентов',
  'role' => session('role_id')
 ]);
})->name('Report.dashboards-statisticFull')->middleware('check');

Route::get('/stats', function(){
 return view('DashboardPage.dashboardStatisticFullPublic', [
    'title' => 'Статистика поданных заявлений'
 ]);
});

Route::get('/GetStudentsStamentStatistic', 'DashboardController@PerStatTable');
