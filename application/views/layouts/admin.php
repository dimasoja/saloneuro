<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Административная панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $page_title . $page_title_split . $site_name ?></title>
    <!-- Le styles -->
    <link href="/css/admin/bootstrap.css" rel="stylesheet">
    <link href="/css/admin/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/admin/main.css" rel="stylesheet">
    <!-- <link href="<?php echo URL::base(); ?>css/main-admin.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL::base(); ?>css/main-admin.css" rel="stylesheet" type="text/css" />-->
    <!--[if IE 6]>
    <link href="<?php echo URL::base(); ?>css/htmls-ie.css" rel="stylesheet" type="text/css"/>
    <![endif]-->
    <?php if (ViewHead::hasStyles()): ?>
        <?php while ($headStyle = ViewHead::getNextStyle()): ?>
            <link href="<?php echo URL::base() ?>css/<?php echo $headStyle ?>" rel="stylesheet" type="text/css"/>
        <?php endwhile; ?>
    <?php endif; ?>
    <script type="text/javascript">
        var baseurl = '<?php echo URL::base(); ?>';
    </script>
    <?php if (ViewHead::hasScripts()): ?>
        <?php while ($headScript = ViewHead::getNextScript()): ?>
            <script type="text/javascript" src="<?php echo URL::base() ?>js/<?php echo $headScript ?>"></script>
        <?php endwhile; ?>
    <?php endif; ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link href="/css/admin/ie.css" rel="stylesheet">
    <![endif]-->
</head>

<body>
<?php if (Request::instance()->controller != "login") { ?>




<div class="loading"><img src="/images/admin/loaders/loader01.gif" alt=""></div>

<header>
    <!-- <a href="#" class="logo"><img src="/images/admin/logoImage.png" alt=""></a>-->

    <span id="mobileNav"><img src="/images/admin/mobile-icon.png" alt=""></span>
    <span id="phoneNav"><img src="/images/admin/mobile-icon.png" alt=""></span>

    <div class="phone-menu">
        <ul>
            <li class="active"><a href="index.html"><span></span> </a></li>
            <li><a href="#"><span></span> Forms
                    <div class="subchild-arrow"></div>
                </a>
                <ul>
                    <li><a href="forms.html"><span></span> Form elements</a></li>
                    <li><a href="form-wizards.html"><span></span> Form wizards</a></li>
                    <li><a href="forms-validate.html"><span></span> Form validate</a></li>
                    <li><a href="input-grid.html"><span></span> Input grid</a></li>
                </ul>
            </li>
            <li><a href="index.html"><span></span> Charts</a></li>
            <li><a href="#"><span></span> UI elements
                    <div class="subchild-arrow"></div>
                </a>
                <ul>
                    <li><a href="ui.html"><span></span> Main UI elements</a></li>
                    <li><a href="buttons.html"><span></span> Buttons</a></li>
                    <li><a href="typography.html"><span></span> Typography</a></li>
                    <li><a href="gallery.html"><span></span> Gallery</a></li>
                </ul>
            </li>
            <li><a href="index.html"><span></span> Chat</a></li>
            <li><a href="#"><span></span> Tables
                    <div class="subchild-arrow"></div>
                </a>
                <ul>
                    <li><a href="standard-tables.html"><span></span> Standard tables</a></li>
                    <li><a href="dynamic-tables.html"><span></span> Dynamic tables</a></li>
                </ul>
            </li>
            <li><a href="#"><span></span> Errors
                    <div class="subchild-arrow"></div>
                </a>
                <ul>
                    <li><a href="403.html"><span></span> 403</a></li>
                    <li><a href="404.html"><span></span> 404</a></li>
                    <li><a href="405.html"><span></span> 405</a></li>
                    <li><a href="500.html"><span></span> 500</a></li>
                    <li><a href="502.html"><span></span> 502</a></li>
                    <li><a href="offline.html"><span></span> Offline</a></li>
                </ul>
            </li>
            <li><a href="#"><span></span> Other
                    <div class="subchild-arrow"></div>
                </a>
                <ul>
                    <li><a href="inbox.html"><span></span> Inbox template</a></li>
                    <li><a href="inbox_template.html"><span></span> Inbox template v2</a></li>
                    <li><a href="profile.html"><span></span> Profile page</a></li>
                    <li><a href="search-result.html"><span></span> Search result</a></li>
                    <li><a href="file-manager.html"><span></span> File manager</a></li>
                    <li><a href="invoice.html"><span></span> Invoice</a></li>
                    <li><a href="search-result.html"><span></span> Search results</a></li>
                    <li><a href="tabbed-page.html"><span></span> Tabbed page</a></li>
                    <li><a href="login.html"><span></span> Login</a></li>
                    <li><a href="loginv2.html"><span></span> Login v2</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<div class="mainNavigation">
<div class="innerNavigation">
<div class="profile clearfix">
    <a href="#"><img src="/images/webmarket/logo.png" alt="Profile image"></a>
</div>
<ul class="mainNav">
<?php if (in_array('admin/index', $allowed)) { ?>
    <li><a href="/admin" <?php if (isset($cname)) {
            if ($cname == 'home') {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/dashboard.png"> Конфигурация</span></a></li>
<?php } ?>
<?php if (in_array('admin/topmenu', $allowed)) { ?>
    <li><a href="/admin/topmenu" <?php if (isset($cname)) {
            if ($cname == 'menu') {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/forms.png"> Меню</span></a></li>
<?php } ?>
<!--                    <li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/forms.png"> Меню</span></a>-->
<!--                        <ul>                           -->
<!--                            <li><a href="/admin/topmenu"><span></span> Верхнее меню</a></li>-->
<!--                            <li><a href="/admin/mainmenu"><span></span> Основное меню</a></li>                            -->
<!--                        </ul>-->
<!--                    </li>-->
<!--<li><a href="charts.html"><span><img src="/images/admin/icon/mainNav/chart.png"> Страницы</span></a></li>-->
<?php if ((in_array('admin/pages', $allowed)) || (in_array('admin/news', $allowed)) || (in_array('admin/slider', $allowed))) { ?>
    <li class="dropdown"><a href="#" <?php if (isset($cname)) {
            if (($cname == 'news') || ($cname == 'pages') || ($cname == 'certificates') || ($cname == 'info')) {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/ui.png"> Статические страницы</span></a>
        <ul>
            <!--                                --><?php //if(in_array('admin/benefits', $allowed)) { ?>
            <!--                                    <li><a href="/admin/benefits"><span></span> Преимущества</a></li>-->
            <!--                                --><?php //} ?>
            <?php if (in_array('admin/pages', $allowed)) { ?>
                <li><a href="/admin/pages" <?php if (isset($cname)) {
                        if ($cname == 'pages') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Страницы</a></li>
            <?php } ?>
            <?php if (in_array('admin/news', $allowed)) { ?>
                <li><a href="/admin/news" <?php if (isset($cname)) {
                        if ($cname == 'news') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Новости и Акции</a></li>
            <?php } ?>

            <?php if (in_array('admin/certificates', $allowed)) { ?>
                <li><a href="/admin/certificates" <?php if (isset($cname)) {
                        if ($cname == 'certificates') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Сертификаты</a></li>
            <?php } ?>
            <?php if ((in_array('admin/information/categories', $allowed)) || (in_array('admin/information/pages', $allowed))) { ?>
                <li><a href="#" <?php if (isset($cname)) {
                        if ($cname == 'info') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Полезная информация</span></a>
                    <ul>
                        <?php if (in_array('admin/information/categories', $allowed)) { ?>
                            <li><a href="/admin/information/categories"><span></span> Разделы</a></li>
                        <?php } ?>
                        <?php if (in_array('admin/information/pages', $allowed)) { ?>
                            <li><a href="/admin/information/pages"><span></span> Страницы</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

        </ul>
    </li>
<?php } ?>
<?php if ((in_array('admin/blocks/benefits', $allowed)) || (in_array('admin/blocks/wheretoby', $allowed)) || (in_array('admin/blocks/callus', $allowed)) || (in_array('admin/blocks/grade', $allowed)) || (in_array('admin/blocks/addresses', $allowed))) { ?>
    <li class="dropdown"><a href="#" <?php if (isset($cname)) {
            if (($cname == 'benefits') || ($cname == 'callus') || ($cname == 'gradeblock') || ($cname == 'addresses')) {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/ui.png"> Блоки</span></a>
        <ul>
            <?php if (in_array('admin/blocks/benefits', $allowed)) { ?>
                <li><a href="/admin/blocks/benefits" <?php if (isset($cname)) {
                        if ($cname == 'benefits') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Преимущества</a></li>
            <?php } ?>
            <?php if (in_array('admin/blocks/callus', $allowed)) { ?>
                <li><a href="/admin/blocks/callus" <?php if (isset($cname)) {
                        if ($cname == 'callus') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Позвоните нам</a></li>
            <?php } ?>
            <?php if (in_array('admin/blocks/grade', $allowed)) { ?>
                <li><a href="/admin/blocks/grade" <?php if (isset($cname)) {
                        if ($cname == 'gradeblock') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Скомплектовать ванну</a></li>
            <?php } ?>
            <?php if (in_array('admin/addresses', $allowed)) { ?>
                <li><a href="/admin/addresses" <?php if (isset($cname)) {
                        if ($cname == 'addresses') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Адреса</a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>

<?php if (in_array('admin/slider', $allowed)) { ?>
    <li><a href="/admin/slider" <?php if (isset($cname)) {
            if ($cname == 'slider') {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/forms.png"> Слайдер</span></a></li>
<?php } ?>

<?php if ((in_array('admin/productscat', $allowed)) || (in_array('admin/directory', $allowed)) || (in_array('admin/massage', $allowed)) || (in_array('admin/grade', $allowed)) || (in_array('admin/catalog', $allowed))) { ?>
    <li class="dropdown"><a href="#" <?php if (isset($cname)) {
            if (($cname == 'massage') || ($cname == 'directory') || ($cname == 'grade') || ($cname == 'catalog') || ($cname == 'productscat')) {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/ui.png"> Товары</span></a>
        <ul>
            <?php if (in_array('admin/productscat', $allowed)) { ?>
                <li><a href="/admin/productscat" <?php if (isset($cname)) {
                        if ($cname == 'productscat') {
                            echo 'class="active"';
                        }
                    } ?> ><span></span>Категории товаров</a></li>
            <?php } ?>
            <?php if (in_array('admin/directory', $allowed)) { ?>
                <li><a href="/admin/directory" <?php if (isset($cname)) {
                        if ($cname == 'directory') {
                            echo 'class="active"';
                        }
                    } ?>><span></span>Справочник</a></li>
            <?php } ?>
            <?php if (in_array('admin/massage', $allowed)) { ?>
                <li><a href="/admin/massage" <?php if (isset($cname)) {
                        if ($cname == 'massage') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Массажные опции</a></li>
            <?php } ?>
            <?php if (in_array('admin/grade', $allowed)) { ?>
                <li><a href="/admin/grade" <?php if (isset($cname)) {
                        if ($cname == 'grade') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Комплектация</a></li>
            <?php } ?>
            <?php if (in_array('admin/catalog', $allowed)) { ?>
                <li><a href="/admin/catalog" <?php if (isset($cname)) {
                        if ($cname == 'catalog') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Товары</a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>


<?php if (in_array('admin/internal', $allowed)) { ?>
    <li><a href="/admin/internal" <?php if (isset($cname)) {
            if ($cname == 'internal') {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/chat.png"> Пользователи </span></a></li>
<?php } ?>


<?php if ((in_array('admin/orders', $allowed)) || (in_array('admin/response', $allowed)) || (in_array('admin/callback', $allowed)) || (in_array('admin/searchlog', $allowed)) || (in_array('admin/templates', $allowed))) { ?>
    <li class="dropdown"><a href="#" <?php if (isset($cname)) {
            if (($cname == 'response') || ($cname == 'callback') || ($cname == 'searchlog') || ($cname == 'templates') || ($cname == 'contacts') || ($cname == 'orders')) {
                echo 'class="active"';
            }
        } ?>><span><img src="/images/admin/icon/mainNav/ui.png"> Покупатели</span></a>
        <ul>
            <?php if (in_array('admin/orders', $allowed)) { ?>
                <li><a href="/admin/orders" <?php if (isset($cname)) {
                        if ($cname == 'orders') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Заказы</a></li>
            <?php } ?>
            <?php if (in_array('admin/response', $allowed)) { ?>
                <li><a href="/admin/response" <?php if (isset($cname)) {
                        if ($cname == 'response') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Отзывы</a></li>
            <?php } ?>
            <?php if (in_array('admin/callback', $allowed)) { ?>
                <li><a href="/admin/callback" <?php if (isset($cname)) {
                        if ($cname == 'callback') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Обратные звонки</a></li>
            <?php } ?>
            <?php if (in_array('admin/searchlog', $allowed)) { ?>
                <li><a href="/admin/searchlog" <?php if (isset($cname)) {
                        if ($cname == 'searchlog') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Поисковые фразы</a></li>
            <?php } ?>
            <?php if (in_array('admin/templates', $allowed)) { ?>
                <li><a href="/admin/templates" <?php if (isset($cname)) {
                        if ($cname == 'templates') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Шаблоны</a></li>
            <?php } ?>
            <?php if (in_array('admin/contacts', $allowed)) { ?>
                <li><a href="/admin/contacts" <?php if (isset($cname)) {
                        if ($cname == 'contacts') {
                            echo 'class="active"';
                        }
                    } ?>><span></span> Обратная связь</a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>




<!--                    <li><a href="/admin/consult"><span><img src="/images/admin/icon/mainNav/chat.png"> Консультации</span></a></li>-->

<!--                    <li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/tables.png"> Продажи</span></a>-->
<!--                        <ul>-->
<!--                            <li><a href="/admin/sales"><span></span> Единичные</a></li>-->
<!--                            <li><a href="/admin/manysales"><span></span> Множественные</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a href="/admin/complexorders"><span><img src="/images/admin/icon/mainNav/chat.png"> Комплексные</span></a></li>-->

<li><a href="/admin/logout"><span><img src="/images/admin/icon/mainNav/chat.png"> Выйти</span></a></li>
<!--<li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/error.png"> Errors</span></a>
    <ul>
        <li><a href="403.html"><span></span> 403</a></li>
        <li><a href="404.html"><span></span> 404</a></li>
        <li><a href="405.html"><span></span> 405</a></li>
        <li><a href="500.html"><span></span> 500</a></li>
        <li><a href="502.html"><span></span> 502</a></li>
        <li><a href="offline.html"><span></span> Offline</a></li>
    </ul>
</li>
<li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/other.png"> Other</span></a>
    <ul>
        <li><a href="inbox.html"><span></span> Inbox template</a></li>
        <li><a href="inbox_template.html"><span></span> Inbox template v2</a></li>
        <li><a href="profile.html"><span></span> Profile page</a></li>
        <li><a href="search-result.html"><span></span> Search result</a></li>
        <li><a href="file-manager.html"><span></span> File manager</a></li>
        <li><a href="invoice.html"><span></span> Invoice</a></li>
        <li><a href="search-result.html"><span></span> Search results</a></li>
        <li><a href="tabbed-page.html"><span></span> Tabbed page</a></li>
        <li><a href="login.html"><span></span> Login</a></li>
        <li><a href="loginv2.html"><span></span> Login v2</a></li>
        <li><a href="#.html"><span></span> Third menu <div class="subchild-arrow"></div></a>
            <ul>
                <li><a href="#"><span></span> Third child link</a></li>
                <li><a href="#"><span></span> Third child link 2</a></li>
                <li><a href="#"><span></span> Third child link 3</a></li>
            </ul>
        </li>
    </ul>
</li>-->


</ul>
</div>
</div>
</div>

<div class="content">
    <div class="top-bar">
        <div class="breadcrumbs fLeft">
            <ul class="breadcrumb">
                <li class="active"><img src="/images/admin/icon/14x14/light/home5.png" alt=""> Административная панель
                </li>
            </ul>
        </div>
        <div class="widget-header">
            <ul class="nav nav-tabs task-container">
                <?php
                $count_new_responses = ORM::factory('response')->getNew();
                $count_new_orders = ORM::factory('orders')->getNew();
                $count_new_sales = ORM::factory('sales')->getNew();
                $count_new_callbacks = ORM::factory('callback')->getNew();
                $count_new_contacts = ORM::factory('contactus')->getNew();
                $count_new_consult = ORM::factory('consult')->getNew();
                $count_new_complexorders = ORM::factory('complexorders')->getNew();
                ?>
                <?php $controller = Request::instance()->controller; ?>
                <li class="<?php if ($controller == 'response') {
                    echo 'active';
                } ?>">
                    <a href="/admin/response">Отзывы <?php if ($count_new_responses != 0) { ?><span
                            class="badge label-important"><?php echo '+' . $count_new_responses; ?></span><?php } ?></a>
                </li>
                <li class="<?php if ($controller == 'sales') {
                    echo 'active';
                } ?>">
                    <!--                      <a href="/admin/sales">Продажи (единичные) -->
                    <?php //if($count_new_orders!=0) { ?><!--<span class="badge label-important">-->
                    <?php //echo '+'.$count_new_orders; ?><!--</span>--><?php //} ?><!--</a>-->
                </li>
                <li class="<?php if ($controller == 'manysales') {
                    echo 'active';
                } ?>">
                    <!--                       <a href="/admin/manysales">Продажи (множественные) -->
                    <?php //if($count_new_sales!=0) { ?><!--<span class="badge label-important">-->
                    <?php //echo '+'.$count_new_sales; ?><!--</span>--><?php //} ?><!--</a>-->
                </li>
                <li class="<?php if ($controller == 'callback') {
                    echo 'active';
                } ?>">
                    <a href="/admin/callback">Звонки <?php if ($count_new_callbacks != 0) { ?><span
                            class="badge label-important"><?php echo '+' . $count_new_callbacks; ?></span><?php } ?></a>
                </li>
                <li class="<?php if ($controller == 'contacts') {
                    echo 'active';
                } ?>">
                    <a href="/admin/contacts">Связаться <?php if ($count_new_contacts != 0) { ?><span
                            class="badge label-important"><?php echo '+' . $count_new_contacts; ?></span><?php } ?></a>
                </li>
                <li class="<?php if ($controller == 'consult') {
                    echo 'active';
                } ?>">
                    <!--                      <a href="/admin/consult">Консультации -->
                    <?php //if($count_new_consult!=0) { ?><!--<span class="badge label-important">-->
                    <?php //echo '+'.$count_new_consult; ?><!--</span>--><?php //} ?><!--</a>-->
                </li>
                <li class="<?php if ($controller == 'complexorders') {
                    echo 'active';
                } ?>">
                    <!--                      <a href="/admin/complexorders">Комплексные услуги -->
                    <?php //if($count_new_complexorders!=0) { ?><!--<span class="badge label-important">-->
                    <?php //echo '+'.$count_new_complexorders; ?><!--</span>--><?php //} ?><!--</a>-->
                </li>
            </ul>
        </div>


    </div>

    <div class="page-info clearfix">
        <img src="/images/admin/icon/32x32/Desktop.png" alt="">
        <h5>

            <?php //if (isset($page_title)) {
            // echo $page_title;
            //  } else {
            //    echo '';
            //}
            ?>

        </h5>
        <?php if (isset($cname)) {
            if (($cname == 'news') || ($cname == 'pages') || ($cname == 'certificates') || ($cname == 'info')) {
                ?>
                <h5>Статические страницы ( </h5>
                <?php if ($cname == 'news') { ?>
                    <h5> &nbsp;Новости и акции | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/news"> &nbsp;Новости и акции</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'pages') { ?>
                    <h5> &nbsp;Страницы | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/pages"> &nbsp;Страницы</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'certificates') { ?>
                    <h5> &nbsp;Сертификаты&nbsp;</h5>
                <?php } else { ?>
                    <h5><a href="/admin/certificates"> &nbsp;Сертификаты&nbsp;</a></h5>
                <?php } ?>

                <h5>)</h5>
            <?php } ?>






            <?php if (($cname == 'benefits') || ($cname == 'callus') || ($cname == 'gradeblock') || ($cname == 'addresses')) { ?>
                <h5>Статические страницы ( </h5>
                <?php if ($cname == 'benefits') { ?>
                    <h5> &nbsp;Преимущества | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/blocks/benefits"> &nbsp;Преимущества</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'callus') { ?>
                    <h5> &nbsp;Позвоните нам | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/blocks/callus"> &nbsp;Позвоните нам</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'gradeblock') { ?>
                    <h5> &nbsp;Скомплектовать ванну | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/blocks/grade"> &nbsp;Скомплектовать ванну</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'addresses') { ?>
                    <h5> &nbsp;Адреса&nbsp;</h5>
                <?php } else { ?>
                    <h5><a href="/admin/addresses"> &nbsp;Адреса&nbsp;</a></h5>
                <?php } ?>

                <h5>)</h5>
            <?php } ?>





            <?php if (($cname == 'productscat') || ($cname == 'directory') || ($cname == 'massage') || ($cname == 'grade') || ($cname == 'catalog')) { ?>
                <h5>Статические страницы ( </h5>
                <?php if ($cname == 'productscat') { ?>
                    <h5> &nbsp;Категории товаров | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/productscat"> &nbsp;Категории товаров</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'directory') { ?>
                    <h5> &nbsp;Справочник | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/directory"> &nbsp;Справочник</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'massage') { ?>
                    <h5> &nbsp;Массажные опции | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/massage"> &nbsp;Массажные опции</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'grade') { ?>
                    <h5> &nbsp;Комплектация | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/grade"> &nbsp;Комплектация</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'catalog') { ?>
                    <h5> &nbsp;Товары&nbsp;</h5>
                <?php } else { ?>
                    <h5><a href="/admin/catalog"> &nbsp;Товары&nbsp;</a></h5>
                <?php } ?>

                <h5>)</h5>
            <?php } ?>





            <?php if (($cname == 'orders') || ($cname == 'response') || ($cname == 'callback') || ($cname == 'searchlog') || ($cname == 'templates') || ($cname == 'contacts')) { ?>
                <h5>Статические страницы ( </h5>
                <?php if ($cname == 'orders') { ?>
                    <h5> &nbsp;Заказы | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/productscat"> &nbsp;Заказы</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'response') { ?>
                    <h5> &nbsp;Отзывы | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/response"> &nbsp;Отзывы</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'callback') { ?>
                    <h5> &nbsp;Обратные звонки | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/callback"> &nbsp;Обратные звонки</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'searchlog') { ?>
                    <h5> &nbsp;Поисковые фразы | </h5>
                <?php } else { ?>
                    <h5><a href="/admin/searchlog"> &nbsp;Поисковые фразы</a> | </h5>
                <?php } ?>
                <?php if ($cname == 'contacts') { ?>
                    <h5> &nbsp;Контакты&nbsp;</h5>
                <?php } else { ?>
                    <h5><a href="/admin/contacts"> &nbsp;Контакты&nbsp;</a></h5>
                <?php } ?>

                <h5>)</h5>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="alert alert-info noMargin" style='display:none'>
        <!--             <button type="button" class="close" data-dismiss="alert">&times;</button> -->
        <font><strong>Information!</strong> You have changed personal info, but some input fields are still
            empty.</font>
    </div>
    <?php } ?>
    <div class="inner-content">
        <?php echo $content; ?>
    </div>
</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/admin/jquery-1.8.3.js"></script>
<script src="/js/admin/ui/jquery-ui-1.9.2.custom.js"></script>

<script src="/js/admin/uniform/jquery.uniform.js"></script>

<!-- <script src="/js/admin/flot/excanvas.min.js"></script>
 <script src="/js/admin/flot/jquery.flot.js"></script>
 <script src="/js/admin/flot/jquery.flot.pie.min.js"></script>
 <script src="/js/admin/flot/jquery.flot.resize.js"></script>
 <script src="/js/admin/flot/jquery.flot.orderBars.js"></script>-->

<script src="/js/admin/sparkline/jquery.sparkline.js"></script>

<script src="/js/admin/full-calendar/fullcalendar.js"></script>

<script src="/js/admin/mouse-wheel/jquery.mousewheel.js"></script>

<script src="/js/admin/file-tree/jqueryFileTree.js"></script>

<script src="/js/admin/easy-pie-chart/jquery.easy-pie-chart.js"></script>

<script src="/js/admin/cleditor/jquery.cleditor.js"></script>

<script src="/js/admin/jquery-splitter/splitter.js"></script>

<script src="/js/admin/cookie/jquery.cookie.js"></script>

<script src="/js/admin/masonry/jquery.masonry.js"></script>

<script src="/js/admin/masked/jquery.maskedinput.js"></script>

<script src="/js/admin/powertip/jquery.powertip.js"></script>

<script src="/js/admin/range-picker/daterangepicker.js"></script>
<script src="/js/admin/range-picker/date.js"></script>

<script src="/js/admin/fancybox/jquery.fancybox.js"></script>

<script src="/js/admin/flexslider/jquery.flexslider.js"></script>

<script src="/js/admin/tags-input/jquery.tagsinput.js"></script>

<script src="/js/admin/form-validate/jquery.validate.js"></script>

<script src="/js/admin/scrollbar/jquery.mCustomScrollbar.js"></script>

<script src="/js/admin/debounced/debounced.js"></script>

<script src="/js/admin/ibutton/jquery.ibutton.js"></script>

<script src="/js/admin/password-meter/password_strength.js"></script>

<script src="/js/admin/gritter/jquery.gritter.min.js"></script>

<script src="/js/admin/bootstrap-wizards/jquery.bootstrap.wizard.js"></script>

<script src="/js/admin/rating/jquery.rating.js"></script>

<script src="/js/admin/bootstrap.js"></script>

<script src="/js/admin/chosen/chosen.jquery.js"></script>
<script src="/js/admin/forms.js"></script>
<script src="/js/admin/main.js"></script>
<script src="/js/admin/dashboard.js"></script>

<script>
    $(window).load(function () {
        $('.loading').hide();
    });

    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 70,
            itemMargin: 0,
            minItems: 3,
            directionNav: false,
        });
//            $.gritter.add({
//                image: 'http://themes.tehnoremont-ds.com/infinite//images/admin/avatar_04.png',
//                // (string | mandatory) the heading of the notification
//                title: 'This is a regular notice!!',
//                // (string | mandatory) the text inside the notification
//                text: 'This will fade out after a certain amount of time. Cum sociis natoque penatibus et magnis dis...',
//                time: 4000,
//            });
//
//            $.gritter.add({
//                image: 'http://themes.tehnoremont-ds.com/infinite//images/admin/avatar_03.png',
//                // (string | mandatory) the heading of the notification
//                title: 'This is a sticky!!',
//                // (string | mandatory) the text inside the notification
//                text: 'This will not fade out untill you close it. Vivamus eget tincidunt velit.',
//                position: 'bottom-right',
//                sticky: true
//            });
//
//            $.gritter.add({
//                // (string | mandatory) the heading of the notification
//                title: 'No image!!',
//                // (string | mandatory) the text inside the notification
//                text: 'Notifications without image.',
//                position: 'bottom-right',
//                sticky: true
//            });
    });
</script>

</body>
</html>















