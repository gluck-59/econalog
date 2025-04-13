<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <!-- Logo icon -->
                <b>
                    <!-- Dark Logo icon -->
                    <img src="img/logo.png" alt="В начало" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="img/logo.png" alt="В начало" class="light-logo" />
                </b>
                <!-- Logo text -->
<!--                <span>-->
<!--                     <img src="/include/img/logo-text-gradient.png" alt="В начало" class="dark-logo" />-->
<!--                     <img src="/include/img/logo-text-white.png" class="light-logo" alt="В начало" />-->
<!--                </span>-->
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item 1hidden-sm-up">
                    <a class="nav-link nav-toggler waves-effect waves-light hidden-sm-up" href="#"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
                </li>
                <li class="text-center nav-item">
                    <a class="nav-link" href="/users/profile"><?=$sess->fio?>&nbsp;<span class="small text-muted">—&nbsp;Филиал</span>
                        <?php if (1)
                            echo '<span class="hidden-sm-down small text-muted">'.$sess->role.'</span>';
                        ?>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!--li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="fa fa-times"></i></a>
                    </form>
                </li-->
            </ul>
        </div>
    </nav>
</header>

<aside class="left-sidebar">
        <div class="d-flex no-block nav-text-box align-items-end">
            <span><img src="img/logo.png" alt=""></span>
            <a class="nav-toggler waves-effect waves-dark hidden-sm-up togglerFix" href="javascript:void(0)"><i class="ti-menu fa fa-close"></i></a>
            <a class="waves-effect waves-dark 1ml-auto hidden-sm-down nav-lock togglerFix" href="javascript:void(0)"><i id="nav-lock" class="ti-menu fa fa-exchange"></i></a>
        </div>
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <?php
$items = [];
                    // Массив модулей [[id, name, url]] приходит из обработки ошибок,
                    // массив [(stdClass)[module_id, mod_name, mod_url]] - из других мест.
                    foreach ($items as $module) {
                        switch ($module['id']) {
                            case 1: $icon = 'wrench'; break; // заявки
                            case 2: $icon = 'truck'; break; // Автопарки
                            case 3: $icon = 'building-o'; break; // Клиенты
                            case 4: $icon = 'user'; break; // Пользователи
                            case 5: $icon = 'money'; break; // Бюджет
                            case 8: $icon = 'edit'; break; // Договоры
                            case 11: $icon = 'pie-chart'; break; // Отчёты
                            case 12: $icon = 'envelope-open-o'; break; // Контракты
                            case 13: $icon = 'check-square-o'; break; // ACL
                            case 15: $icon = 'check'; break; // Процессы
                            case 16: $icon = 'envelope-o'; break; // Уведомления
                            case 17: $icon = 'train'; break; // Аренда
                            case 19: $icon = 'barcode'; break; // штрафы
                            case 21: $icon = 'cog'; break; // Запчаcти
                            case 22: $icon = 'table'; break; // План ТО
                            case 23: $icon = 'calendar-check-o'; break; // Интервалы ТО
                            case 24: $icon = 'tachometer'; break; // КТГ
                            case 25: $icon = 'lock'; break; // админ
                            case 26: $icon = 'list-alt'; break; // табель водителей
                            default: $icon = 'info-circle'; break;
                        }

                        $name = is_array($module) ? $module['name'] : $module->mod_name;
                        $url = is_array($module) ? $module['url'] : $module->mod_url;
                        echo '<li> <a class="waves-effect waves-dark" href="'.$url.'" aria-expanded="false"><i class="fa fa-'.$icon.'"></i><span class="hide-menu">'.$name.'</span></a></li>';
                    }

                    ?>
                    <li><hr></li>
                    <li> <a class="waves-effect waves-dark" href="/ticket/ost" target="_blank" aria-expanded="false"><i class="fa fa-question-circle"></i><span class="hide-menu"></span>Помощь</a></li>
                    <li> <a class="waves-effect waves-dark" href="/help" aria-expanded="false"><i class="fa fa-code"></i><span class="hide-menu"></span>API</a></li>
                    <li> <a class="waves-effect waves-dark" href="/user/profile" aria-expanded="false"><i class="fa fa-user-o"></i><span class="hide-menu"></span>Профиль</a></li>
                    <li> <a class="waves-effect waves-dark" href="/logout" aria-expanded="false"><i class="fa fa-sign-out"></i><span class="hide-menu"></span>Выход</a></li>
    <!--                <li style="background: #404040; margin-top: 20%" class="text-center">-->
    <!--                    <a class="waves-effect waves-dark" aria-expanded="false" onclick="scrollUpDn('main-wrapper')"><img src="/include/img/to_top.png" style="zoom: 60%;"></a>-->
    <!--                    <a class="waves-effect waves-dark" aria-expanded="false" onclick="scrollUpDn('copyright')"><img style="transform: rotate(180deg); zoom: 60%;" src="/include/img/to_top.png"></a>-->
    <!--                </li>-->
                </ul>



            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>

    <h1>header <?=esc($title)?></h1>





<?php
prettyDump($sess);
?>