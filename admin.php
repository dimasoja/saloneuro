<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap, from Twitter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="/css/admin/bootstrap.css" rel="stylesheet">
        <link href="/css/admin/bootstrap-responsive.css" rel="stylesheet">
        <link href="/css/admin/main.css" rel="stylesheet">    
        <?php
        if (isset($styles)) {
            foreach ($styles as $style) {
                echo '<link href="' . $style . '" rel="stylesheet">';
            }
        }
        ?>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <link href="/css/admin/ie.css" rel="stylesheet">
        <![endif]-->
        <script src="/js/admin/jquery-1.8.3.js"></script>
        <script src="/js/admin/ui/jquery-ui-1.9.2.custom.js"></script>

        <script src="/js/admin/uniform/jquery.uniform.js"></script>

    <!--<script src="/js/admin/flot/excanvas.min.js"></script>
    <script src="/js/admin/flot/jquery.flot.js"></script>    
    <script src="/js/admin/flot/jquery.flot.pie.min.js"></script>
    <script src="/js/admin/flot/jquery.flot.resize.js"></script>
    <script src="/js/admin/flot/jquery.flot.orderBars.js"></script>-->

        <script src="/js/admin/sparkline/jquery.sparkline.js"></script>
        <script src="/js/admin/datatable/jquery.dataTables.js"></script>
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

  <!--  <script src="/js/admin/gritter/jquery.gritter.min.js"></script>-->

        <script src="/js/admin/bootstrap-wizards/jquery.bootstrap.wizard.js"></script>

        <script src="/js/admin/rating/jquery.rating.js"></script>

        <script src="/js/admin/bootstrap.js"></script>

        <script src="/js/admin/chosen/chosen.jquery.js"></script>

        <script src="/js/admin/main.js"></script>
        <script src="/js/admin/forms.js"></script>
        <script src="/js/admin/dashboard.js"></script>
    </head>

    <body>

        <div class="loading"><img src="/images/admin/loaders/loader01.gif" alt=""></div>

        <header>
            <!--<a href="#" class="logo">Административная Панель</a>-->

            <span id="mobileNav"><img src="/images/admin/mobile-icon.png" alt=""></span>
            <span id="phoneNav"><img src="/images/admin/mobile-icon.png" alt=""></span>

            <div class="phone-menu">
                <ul>
                    <li class="active"><a href="/"><span></span>Main</a></li>
                    <li><a href="#"><span></span> Forms <div class="subchild-arrow"></div></a>
                        <ul>
                            <li><a href="forms.html"><span></span> Form elements</a></li>
                            <li><a href="form-wizards.html"><span></span> Form wizards</a></li>
                            <li><a href="forms-validate.html"><span></span> Form validate</a></li>
                            <li><a href="input-grid.html"><span></span> Input grid</a></li>
                        </ul>
                    </li>
                    <li><a href="index.html"><span></span> Charts</a></li>
                    <li><a href="#"><span></span> UI elements <div class="subchild-arrow"></div></a>
                        <ul>
                            <li><a href="ui.html"><span></span> Main UI elements</a></li>
                            <li><a href="buttons.html"><span></span> Buttons</a></li>
                            <li><a href="typography.html"><span></span> Typography</a></li>
                            <li><a href="gallery.html"><span></span> Gallery</a></li>
                        </ul>
                    </li>
                    <li><a href="index.html"><span></span> Chat</a></li>
                    <li><a href="#"><span></span> Tables <div class="subchild-arrow"></div></a>
                        <ul>
                            <li><a href="standard-tables.html"><span></span> Standard tables</a></li>
                            <li><a href="dynamic-tables.html"><span></span> Dynamic tables</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span></span> Errors <div class="subchild-arrow"></div></a>
                        <ul>
                            <li><a href="403.html"><span></span> 403</a></li>
                            <li><a href="404.html"><span></span> 404</a></li>
                            <li><a href="405.html"><span></span> 405</a></li>
                            <li><a href="500.html"><span></span> 500</a></li>
                            <li><a href="502.html"><span></span> 502</a></li>
                            <li><a href="offline.html"><span></span> Offline</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span></span> Other <div class="subchild-arrow"></div></a>
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

            <ul class="header-actions" style="display:none">
                <li><a href="#"><img src="/images/admin/icon/14x14/header/messages.png" alt=""></a>
                    <!-- Messages drop down -->
                    <div class="dropdown">
                        <div class="dropdown-inner">
                            <div class="summary">
                                <span><strong>Messages</strong> (6) emails and (2) PM</span>
                            </div>
                            <a href="#" class="dropdown-block clearfix">
                                <img class="avatar" src="/images/admin/avatar_01.png" alt="Profile image">
                                <div class="result">
                                    <span class="head"><strong>Jason Bourne</strong> <i>1 hour ago</i></span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                </div>
                            </a>
                            <a href="#" class="dropdown-block clearfix">
                                <img class="avatar" src="/images/logo.png" alt="Profile image">
                                <div class="result">
                                    <span class="head"><strong>Adamova Sharapova</strong> <i>3 hour ago</i></span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                </div>
                            </a>
                            <a href="#" class="dropdown-block clearfix">
                                <img class="avatar" src="/images/admin/avatar_03.png" alt="Profile image">
                                <div class="result">
                                    <span class="head"><strong>Angelina Jozek</strong> <i>1 day ago</i></span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                </div>
                            </a>
                            <a href="#" class="dropdown-block clearfix">
                                <img class="avatar" src="/images/admin/avatar_04.png" alt="Profile image">
                                <div class="result">
                                    <span class="head"><strong>Maria Gomez</strong> <i>2 days ago</i></span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                                </div>
                            </a>
                            <div class="dropdown-footer" align="right">
                                <a href="#" class="all-messages">View all messages</a>
                            </div>
                        </div>
                    </div>
                    <!-- Messages drop down -->
                </li>
                <li><a href="#"><img src="/images/admin/icon/14x14/header/notification.png" alt=""></a>
                    <!-- Notification drop down -->
                    <div class="dropdown">
                        <div class="dropdown-inner">
                            <div class="summary">
                                <span><strong>Notifications</strong> (2) alerts and (1) info</span>
                            </div>
                            <div class="dropdown-block clearfix">
                                <div class="result">
                                    <p>You are reaching your server diskspace. Please make sure you arrange more diskspace for your security...</p>
                                </div>
                            </div>
                            <div class="dropdown-block clearfix">
                                <div class="result">
                                    <p>Scheduled system back-up on 02 February 2013 at 00:00...</p>
                                </div>
                            </div>
                            <div class="dropdown-block clearfix">
                                <img class="avatar" src="/images/admin/avatar_04.png" alt="Profile image">
                                <div class="result">
                                    <span class="head"><strong>Maria Gomez</strong> <i>2 days ago</i></span>
                                    <p>has updated her profile...</p>
                                </div>
                            </div>
                            <div class="dropdown-footer" align="right">
                                <a href="#" class="all-messages">View all notifications</a>
                            </div>
                        </div>
                    </div>
                    <!-- Notification drop down -->
                </li>
                <li><a href="#"><img src="/images/admin/icon/14x14/header/settings.png" alt=""></a>
                    <!-- Settings drop down -->
                    <div class="dropdown">
                        <div class="dropdown-inner">
                            <div class="summary">
                                <strong>Settings</strong> for your site</span>
                            </div>
                            <a href="#" class="dropdown-block clearfix">
                                <span class="head"><img src="/images/admin/icon/14x14/light/cog.png" alt=""> Change site settings</span>
                            </a>
                            <a href="#" class="dropdown-block dropdown-block clearfix">
                                <span class="head"><img src="/images/admin/icon/14x14/light/box1.png" alt=""> Plugins</span>
                            </a>
                            <a href="#" class="dropdown-block clearfix">
                                <span class="head"><img src="/images/admin/icon/14x14/light/grid.png" alt=""> Change theme</span>
                            </a>
                        </div>
                    </div>
                    <!-- Settings drop down -->
                </li>
                <li><a href="/admin/logout"><img src="/images/admin/icon/14x14/header/out.png" alt=""></a></li>
            </ul> 
        </header>

        <div class="mainNavigation">
            <div class="innerNavigation">
                <div class="profile clearfix">
                    <a href="#"><img src="/images/logo.png" alt="Profile image"></a>
                </div> 
                <ul class="mainNav">   
                                                       
                    <li class="dropdown"><a href="/admin/tests/all"><span><img src="/images/admin/icon/mainNav/ui.png"> События</span></a>
                        <ul>
                            <li><a href="/admin/reports"><span></span> Фотоотчеты</a></li>
                            <li><a href="/admin/concerts"><span></span> Концерты</a></li>                                   
                        </ul>
                    </li>                    
                    <li><a href="/admin/points"><span><img src="/images/admin/icon/mainNav/ui.png"> Баллы конкурс 1</span></a></li>
                    <li><a href="/admin/points2"><span><img src="/images/admin/icon/mainNav/ui.png"> Баллы конкурс 2</span></a></li>
                    <li><a href="/admin/games"><span><img src="/images/admin/icon/mainNav/ui.png"> Конфигурация</span></a></li>
                    <li><a href="/admin/cities"><span><img src="/images/admin/icon/mainNav/ui.png"> Города</span></a></li>
                    
                    
                    <!--<li class="dropdown"><a href="/admin/tests/all"><span><img src="/images/admin/icon/mainNav/ui.png"> Тесты</span></a>
                        <ul>
                            <li><a href="/admin/tests/show/all"><span></span> Все тесты</a></li>
                            <li><a href="/admin/tests/show/test1"><span></span> Тест 1</a></li>
                            <li><a href="/admin/tests/show/test2"><span></span> Тест 2</a></li>
                            <li><a href="/admin/tests/show/test3"><span></span> Тест 3</a></li>
                            <li><a href="/admin/tests/show/test4"><span></span> Тест 4</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/chat.png"> Уведомления</span></a>
                        <ul>
                           <!-- <li><a href="/admin/notifications/check"><span></span> Модерация чека</a></li>
                            <li><a href="/admin/notifications/like"><span></span> Уведомления лайки</a></li>
                            <li><a href="/admin/notifications/moderation"><span></span> Модерация работы</a></li>
                            <li><a href="/admin/notifications/start"><span></span> Анонс запуска</a></li>
                            <li><a href="/admin/notifications/tests"><span></span> Анонс опросника</a></li>
                           <!-- <li><a href="#"><span></span> Уведомления ТОП'ов <div class="subchild-arrow"></div></a>
                                <ul>
                                    <li><a href="/admin/notifications/top1"><span></span> Топ1</a></li>
                                    <li><a href="/admin/notifications/top3"><span></span> Топ3</a></li>
                                    <li><a href="/admin/notifications/top20"><span></span> Топ20</a></li>
                                    <li><a href="/admin/notifications/top100"><span></span> Топ100</a></li>
                                </ul>
                            </li>
                            <li><a href="/admin/notifications/winner"><span></span> Объявление победителя</a></li>
                            <li><a href="/admin/notifications/competition"><span></span> Анонс конкурса</a></li>
                            <li><a href="/admin/notifications/end"><span></span> Анонс окончания конкурса</a></li>                            
                        </ul>
                    </li>
                    <li><a href="/admin/checks/all"><span><img src="/images/admin/icon/mainNav/ui.png"> Чеки</span></a></li>
                    <li class="dropdown"><a href="/admin/tests/all"><span><img src="/images/admin/icon/mainNav/ui.png"> Бейджи</span></a>
                        <ul>
                            <li><a href="/admin/badges/competition1"><span></span> Конкурс 1</a></li>
                            <li><a href="/admin/badges/competition2"><span></span> Конкурс 2</a></li>
                            <li><a href="/admin/badges/competition3"><span></span> Конкурс 3</a></li>
                            <li><a href="/admin/badges/competition4"><span></span> Конкурс 4</a></li>                            
                        </ul>
                    </li>                    
                    <li><a href="/admin/parameters"><span><img src="/images/admin/icon/mainNav/other.png"> Параметры</span></a></li>

                    <li class="dropdown"><a href="#"><span><img src="/images/admin/icon/mainNav/error.png"> Errors</span></a>
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
                    <li><a href="/admin/logout"><span><img src="/images/admin/icon/mainNav/error.png">Выйти</span></a></li>

                    <!--<div class="nav-widget" align="center">
                      <div class="chart" id="sales-current"></div>
                      <h4>$52.384 <span><a href="#">March 2013</a></span></h4>
                    </div>
          
                    <div class="nav-widget">
                      <h5>Diskspace usage:</h5>
                      <div class="progress diskspace progress-info thin progress-striped">
                        <div class="bar"></div>
                      </div>
                      <h5>Monthly bandwidth:</h5>
                      <div class="progress bandwidth progress-danger thin progress-striped">
                        <div class="bar"></div>
                      </div>
                      <h5>Sql databases:</h5>
                      <div class="progress sql progress-success thin progress-striped">
                        <div class="bar"></div>
                      </div>
                    </div>
          
                    <div class="nav-widget" align="center">
                      <div class="chart" id="sales-current2"></div>
                      <h4>$352.384 <span><a href="#">April 2013</a></span></h4>
                    </div>
          
                    <div class="nav-widget" align="center">
                      <a href="#" class="mainNav-button"><img src="/images/admin/icon/24x24/cog.png" alt=""></a>
                      <a href="#" class="mainNav-button"><img src="/images/admin/icon/24x24/calendar.png" alt=""></a>
                      <a href="#" class="mainNav-button"><img src="/images/admin/icon/24x24/folder.png" alt=""></a>
                      <a href="#" class="mainNav-button"><img src="/images/admin/icon/24x24/plus.png" alt=""></a>
                    </div>
          
                    <div class="nav-widget">
                      <div class="flexslider-nav">
                        <ul class="slides">
                          <li>
                            <div class="download-report">
                              <img src="/images/admin/icon/icon_PDF.png" alt="">
                              <span>April 2013</span>
                              <a href="#">Download</a>
                            </div>
                          </li>
                          <li>
                            <div class="download-report">
                              <img src="/images/admin/icon/table-excel-icon.png" alt="">
                              <span>March 2013</span>
                              <a href="#">Download</a>
                            </div>
                          </li>
                          <li>
                            <div class="download-report">
                              <img src="/images/admin/icon/word.png" alt="">
                              <span>February 2013</span>
                              <a href="#">Download</a>
                            </div>
                          </li>
                    <!-- items mirrored twice, total of 12 -->
                </ul>
            </div>
        </div>
    </ul>
</div>
</div>
</div>

<div class="content">
    <div class="top-bar">
        <div class="breadcrumbs fLeft">
            <ul class="breadcrumb">
                <li class="active"><a href="/"><img src="/images/admin/icon/14x14/light/home5.png" alt=""> Administration panel ChesterField</a></li>
            </ul>
        </div>

       <!-- <ul class="bar-actions">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="/images/admin/icon/14x14/light/plus.png" alt=""> Работы<img class="arrow" src="/images/admin/arrow-down.png" alt=""></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="/admin/items/competition4"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Все</a></li>
                    <li><a href="/admin/items/competition4new"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Новые</a></li>
                    <li><a href="/admin/items/competition4newtoday"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Новые за сегодня</a></li>
                    <li><a href="/admin/items/competition4approve"><img src="/images/admin/icon/14x14/light/plus.png" alt=""> Подтвержденные</a></li>
                    <li class="last-child"><a href="/admin/items/competition4notshure"><img src="/images/admin/icon/14x14/light/trash.png" alt=""> Сомнительные</a></li>
                    <li class="last-child"><a href="/admin/items/competition4decline"><img src="/images/admin/icon/14x14/light/trash.png" alt=""> Отклоненные</a></li>
                </ul>
            </li>
            <!--<li><a href="#"><img src="/images/admin/icon/14x14/light/box2.png" alt=""> New orders</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="/images/admin/icon/14x14/light/plus.png" alt=""> Чеки<img class="arrow" src="/images/admin/arrow-down.png" alt=""></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="/admin/checks/all"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Все</a></li>
                    <li><a href="/admin/checks/check1new"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Новые</a></li>
                    <li><a href="/admin/checks/check1newtoday"><img src="/images/admin/icon/14x14/light/download4.png" alt=""> Новые за сегодня</a></li>
                    <li><a href="/admin/checks/check1approve"><img src="/images/admin/icon/14x14/light/plus.png" alt=""> Подтвержденные</a></li>
                    <li class="last-child"><a href="/admin/checks/check1notshure"><img src="/images/admin/icon/14x14/light/trash.png" alt=""> Сомнительные</a></li>
                    <li class="last-child"><a href="/admin/checks/check1decline"><img src="/images/admin/icon/14x14/light/trash.png" alt=""> Отклоненные</a></li>
                </ul>
            </li>
            <li class="range"><a id="reportrange" href="#"><img src="/images/admin/icon/14x14/light/calendar.png" alt=""> <span></span></a></li>
        </ul>-->
    </div>

    <div class="page-info clearfix">
        <img src="/images/admin/icon/32x32/Desktop.png" alt="">
        <h5><?php echo $page_name; ?></h5>



        <!--<img src="/images/admin/point/point01.png" alt="" class="point" style="float: right; margin-top: 8px;">-->
    </div>

    <div class="alert alert-info noMargin" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Information!</strong> You have changed personal info, but some input fields are still empty.
    </div>
    <?php if (isset($information)) {
        if ($information != '') {
            ?>
            <div class="alert alert-info noMargin">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $information; ?></strong>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('.alert.alert-info.noMargin').fadeOut(10000);
                });
            </script>
        <?php }
    }
    ?>
    <div class="inner-content">
<?php echo $content; ?>
    </div>
</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script>
    $(window).load(function() {
        $('.loading').hide();
    });

    $(document).ready(function() {
        $('#dynamic, #dynamic2, #dynamic3').dataTable({
            "sPaginationType": "full_numbers",
            "sDom": "<'tableHeader'<l><'clearfix'f>r>t<'tableFooter'<i><'clearfix'p>>",
            "iDisplayLength": 10,
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0]
                }]
        });
        $('.dataTables_length select').chosen();
    });
</script>

</body>
</html>