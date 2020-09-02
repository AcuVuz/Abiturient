<?php $routeName = Route::currentRouteName(); ?>

<!-- Layout sidenav -->
<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">
    @empty($layout_sidenav_horizontal)
    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand demo">
        <span class="app-brand-logo demo bg-primary">
            <img src="{{ asset("images/logo.png") }}" alt="" style="width: 30px; height: auto;">
        </span>
        <a href="/" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Абитуриент</a>
        <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>

    <div class="sidenav-divider mt-0"></div>
    @endempty
    <!-- Links -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <!-- Основная страница -->
        <li class="sidenav-item{{ strpos($routeName, 'dashboards.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-grid"></i><div>Основное</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-1' ? ' active' : '' }}">
                    <a href="/dashboard" class="sidenav-link"><div>Список абитуриентов</div></a>
                </li>
            </ul>
            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-vedomost' ? ' active' : '' }}">
                    <a href="/vedomost" class="sidenav-link"><div>Ведомости</div></a>
                </li>
            </ul>
            @if ($role == 1 || $role == 2)
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-reitmag' ? ' active' : '' }}">
                        <a href="/reitmag" class="sidenav-link"><div>Рейтинг магистратура</div></a>
                    </li>
                </ul>
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-reitbak' ? ' active' : '' }}">
                        <a href="/reitbak" class="sidenav-link"><div>Рейтинг бакалавриат</div></a>
                    </li>
                </ul>
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-printtest' ? ' active' : '' }}">
                        <a href="/print/test/form" class="sidenav-link"><div>Распечатать тесты</div></a>
                    </li>
                </ul>
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-grafik' ? ' active' : '' }}">
                        <a href="/grafik" class="sidenav-link"><div>График экзаменов</div></a>
                    </li>
                </ul>
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-prikaz' ? ' active' : '' }}">
                        <a href="/prikaz" class="sidenav-link"><div>Приказы</div></a>
                    </li>
                </ul>
                <ul class="sidenav-menu">
                    <li class="sidenav-item{{ $routeName == 'dashboards.dashboard-MovePrikaz' ? ' active' : '' }}">
                        <a href="/MovePrikaz" class="sidenav-link"><div>Перенос людей в приказы</div></a>
                    </li>
                </ul>
            @endif
        </li>
        <!-- Печать документов -->
        @if ($routeName == 'profile')
        <li class="sidenav-item{{ $routeName == 'profile' ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-document"></i><div>Печать документов</div></a>
            <ul class="sidenav-menu" id="print_lich_card_menu" style="display: none;">
                <li class="sidenav-item{{ $routeName == 'print.lich_card' ? ' active' : '' }}">
                    <a href="#" id="print_lich_card" target="_blank" class="sidenav-link"><div>Личная карта</div></a>
                </li>
            </ul>
            <ul class="sidenav-menu" id="print_opis_menu" style="display: none;">
                <li class="sidenav-item{{ $routeName == 'print.opis' ? ' active' : '' }}">
                    <a href="#" id="print_opis" target="_blank" class="sidenav-link"><div>Опись (расписка)</div></a>
                </li>
            </ul>
            <ul class="sidenav-menu" id="print_statement_menu" style="display: none;">
                <li class="sidenav-item{{ $routeName == 'print.statement' ? ' active' : '' }}">
                    <a href="#" id="print_statement"target="_blank" class="sidenav-link"><div>Заявление</div></a>
                </li>
            </ul>
            <ul class="sidenav-menu" id="print_examSheet_menu" style="display: none;">
                <li class="sidenav-item{{ $routeName == 'print.examSheet' ? ' active' : '' }}">
                    <a href="#" id="print_examSheet" target="_blank" class="sidenav-link"><div>Экзаменационный лист</div></a>
                </li>
            </ul>
            <ul class="sidenav-menu" id="print_fullReport_menu" style="display: none;">
                <li class="sidenav-item{{ $routeName == 'print.fullReport' ? ' active' : '' }}">
                    <a href="#" onclick="fullResult();" id="print_fullReport" class="sidenav-link"><div>Полный отчет тестирования</div></a>
                </li>
            </ul>
        </li>
        @endif
        <!-- Основная страница -->
        <li class="sidenav-item{{ strpos($routeName, 'Report.') === 0 ?  ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-ios-paper"></i><div>Отчеты</div></a>
            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'Report.dashboards-statistic' ? ' active' : '' }}">
                    <a href="/statistic" class="sidenav-link"><div>Статистика заявлений</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'Report.dashboards-statisticFull' ? ' active' : '' }}">
                    <a href="/fullstatistic" class="sidenav-link"><div>Статистика заявлений(Полная)</div></a>
                </li>
            </ul>
        </li>
             <!--  Графики данных
        <li class="sidenav-item{{ strpos($routeName, 'charts.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-pie"></i><div>Тестовый вариант</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Второй вариант </div></a>
                </li>
            </ul>
        </li> -->
         <!--   Ведомости
        <li class="sidenav-item{{ strpos($routeName, 'charts.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-switch"></i><div>Ведомости</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Формирование печати (экзамены)</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Формирование печати (собесодание)</div></a>
                </li>
            </ul>
        </li> -->
       <!--   Журналы
        <li class="sidenav-item{{ strpos($routeName, 'charts.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-logo-buffer"></i><div>Журналы</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Печать журнала</div></a>
                </li>
            </ul>
        </li>  -->
       <!--   Рейтинги
        <li class="sidenav-item{{ strpos($routeName, 'reting.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-ios-podium"></i><div>Рейтинги</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'reting.reting_phone' ? ' active' : '' }}">
                    <a href="{{ route('reting.reting_phone') }}" class="sidenav-link"><div>Предварительный рейтинг</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'reting.reting_phone' ? ' active' : '' }}">
                    <a href="{{ route('reting.reting_phone') }}" class="sidenav-link"><div>Расчет рейтинга</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'reting.reting_phone' ? ' active' : '' }}">
                    <a href="{{ route('reting.reting_phone') }}" class="sidenav-link"><div>Рейтинг с телефонами</div></a>
                </li>
            </ul>
        </li>  -->
     <!--   Приказы
        <li class="sidenav-item{{ strpos($routeName, 'charts.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-pie"></i><div>Приказы</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Данные о приказе</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Перенос людей в приказ</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Печать приказов</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Перенос гос. заказа в приказы</div></a>
                </li>
            </ul>
        </li>  -->
       <!--   Отчеты
        <li class="sidenav-item{{ strpos($routeName, 'reports.') === 0 ? ' active open' : '' }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon ion ion-md-document"></i><div>Отчеты</div></a>

            <ul class="sidenav-menu">
                <li class="sidenav-item{{ $routeName == 'reports.rep_spesial' ? ' active' : '' }}">
                    <a href="{{ route('reports.rep_spesial') }}" class="sidenav-link"><div>Заявлений по специальности</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Заявлений по факультету</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Количество предметных мест</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Предметы + все люди</div></a>
                </li>
                <li class="sidenav-item{{ $routeName == 'charts.chartjs' ? ' active' : '' }}">
                    <a href="{{ route('charts.chartjs') }}" class="sidenav-link"><div>Предметы + все люди(МС)</div></a>
                </li>
            </ul>
        </li>
         -->


    </ul>
</div>
<!-- / Layout sidenav -->
