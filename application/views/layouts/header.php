<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo $site_name . $page_title_split . $page_title ?></title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="Description" content="<?php echo $description; ?>" />
        <meta name="robots" content="index, follow" />
        <meta name="re-visit" content="7 Days" />
        <meta name="google-site-verification" content="znE2dpGVjGausumvigsadeKudUSe_rv0DDYESm6z6eI" />
        <link rel='stylesheet' href='<?php echo URL::base() ?>css/popbox.css' type='text/css' media='screen' charset='utf-8'/>
        <link href='http://fonts.googleapis.com/css?family=Bigelow+Rules|Stint+Ultra+Condensed' rel='stylesheet' type='text/css'/>
        <link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700,400italic,700italic|Arimo:400,700,400italic,700italic|Didact+Gothic|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'/>
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base() ?>css/captcha.css" media="screen" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link href="<?php echo URL::base(); ?>css/main.css" rel="stylesheet" type="text/css" />
        <!--[if IE 6]>
        <link href="<?php echo URL::base(); ?>css/htmls-ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <?php if (ViewHead::hasStyles()): ?>
            <?php while ($headStyle = ViewHead::getNextStyle()): ?>
                <link href="<?php echo URL::base() ?>css/<?php echo $headStyle ?>" rel="stylesheet" type="text/css" />
            <?php endwhile; ?>
        <?php endif; ?>

        <!--// ---- FANCYBOX V2 ---->

        <link rel="stylesheet" type="text/css" href="/css/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <!--// ---- FANCYBOX V2 ---->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />          
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo URL::base(); ?>css/jquery-ui-timepicker-addon.css" />	
        
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/admin/jquery-1.8.3.js"></script>
    <script src="/js/admin/ui/jquery-ui-1.9.2.custom.js"></script>

    <script src="/js/admin/uniform/jquery.uniform.js"></script>



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
    

    <script>
        $(window).load(function() {
            $('.loading').hide();

        });

        $(document).ready(function() {

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
        
        
        
        
        
        
        
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/jquery-ui-sliderAccess.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/admin/uniform/jquery.uniform.js"></script>

        <?php if (ViewHead::hasScripts()): ?>
            <?php while ($headScript = ViewHead::getNextScript()): ?>
                <script type="text/javascript" src="<?php echo URL::base() ?>js/<?php echo $headScript ?>"></script>
            <?php endwhile; ?>
        <?php endif; ?>



        <!--// ---- FANCYBOX V2 ---->

        <script type="text/javascript" src="/js/source/jquery.fancybox.js?v=2.1.5"></script>
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/footerLogin.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/slider/index.js"></script>

        <script type="text/javascript" src="<?php echo URL::base(); ?>js/index.js"></script>                
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/jquery.ui.touch.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/QapTcha.jquery.js"></script>        
        <script type="text/javascript" src="<?php echo URL::base(); ?>js/jquery.mask.min.js"></script>        

        
        
        <script type='text/javascript' charset='utf-8' src='<?php echo URL::base(); ?>js/popbox.js'></script>




<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
        <!--// ---- FANCYBOX V2 ---->

    </head>
    <body text="#000000" style="background: url(../images/bg-romb-top.png) repeat;" >

    <script type="text/javascript">
        ymaps.ready(init);
        var myMap, 
            myPlacemark;

        function init(){ 
            myMap = new ymaps.Map ("map", {
                center: [55.76, 37.64],
                zoom: 7
            }); 
            
            myPlacemark = new ymaps.Placemark([55.76, 37.64], {
                content: 'Москва!',
                balloonContent: 'Столица России'
            });
            
            myMap.geoObjects.add(myPlacemark);
        }
    </script>

        <div id="container">
            <div id="page_holder">
                <!--Start Logo Holder -->

                <!--End Logo Holder -->
                <!--Start Navigation Block -->
                <div id="navigation_block1">
                    <div id="nav-to1p">
                        <div id="topmenu1">
                            <div class="home"><a href="/"><img src="/images/house.png"/></a></div>
                            <?php
                            $top_menu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'topmenu')->order_by('position', 'asc')->find_all()->as_array();
                            foreach ($top_menu as $topmenu) {
                                ?>
                                <div class="top-item"><a href="<?php echo URL::base() . "" . $topmenu->uri; ?>"><?php echo $topmenu->title; ?></a>                                
                                </div>
                            <?php }
                            ?>
                            <!--<div class="services">
                                <a href="#">Сервисы</a>
                            </div>-->
                            <div class='popbox'>
                                <a class='open' href='#'>
                                    Сервисы
                                </a>
                                <script type='text/javascript' charset='utf-8'>
                                    jQuery(document).ready(function() {
                                        jQuery('.popbox').popbox();
                                    });
                                </script>
                                <div class='collapse'>
                                    <div class='box'>
                                        <div class='arrow'></div>
                                        <div class='arrow-border'></div>

                                        <div class="popUp">
                                            <font class="popup-phone"><?php echo ORM::factory('settings')->getSetting('company_phone'); ?></font><br/><br/><br/>
<a href="/callback">Заказать звонок</a><br/><br/>
<a href="/consult">Консультация</a><br/><br/>
<a href="/response">Оставить отзыв</a><br/><br/>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <div class="zabor">&nbsp;</div>
        <div class="header-romb">
            <div class="header-center-romb">
                <a href="/">
                    <div class="col-logo">
                        <img src="/images/logo.png" class="logo-header"/>
                    </div>
                </a>
                <div class="header-phone">
                    8 (863) 226-72-76
                    <div>
                  
                                         <a href="/callback">
                        <img src="/images/blues-callback.png">
                        </a>
  <!--<div class='backg-phone'><img src="/images/back-phone.png" height="15px"></div>-->
                    </div>
                </div>
                <div class="blueable-button">
                    <?php $type = Session::instance()->get('type', '');  ?>                                    
                    <div class="for-business <?php
                    if (($type == 'business') or ($type == ''))
                        echo 'active';
                    else
                        echo 'not-active';
                    ?>" onclick="changeSlider('home', 'business')">
                        <div class="for-home-child">
                            Для бизнеса
                        </div>
                    </div>
                    <div class="for-home <?php
                    if ($type == 'home')
                        echo 'active';
                    else
                        echo 'not-active';
                    ?>">
                        <div class="for-business-child" onclick="changeSlider('business', 'home')">
                            Для дома
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="bg-header-grey">
            <div class="header-center-romb">
                <div class="all-services" onClick="getVisible()">
                    <div class="all-services-with-block">
                        <img class="block-services" src="/images/red-block.png"/>Все услуги                    
                    </div>
                    <div class="border-services">
                        &nbsp;
                    </div>
                </div>
                <div class="search">
                    <form action="/search/find" method="GET" id="search-form">
                        <div id="search-hidden">&nbsp;</div>
                        <input class="input-search" name="word" type="text" placeholder="Я ищу..."/>
                    </form>
                </div>

            </div>
            <div id="main-nav-home" class="<?php
            if (($type == 'home') or ($type == ''))
                echo 'active';
            else
                echo 'not-active';
            ?>">
                <div id="nav-top-home">
                    <div id="mainmenu-item">                            
                        <?php
                        $count = 0;
                        $top_menu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_home')->order_by('position', 'asc')->limit(5)->find_all()->as_array();
                        foreach ($top_menu as $topmenu) {
                            ?>
                            <div class="main-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $topmenu->uri; ?>"><?php echo $topmenu->title; ?></a>                                
                            </div>
                            <?php
                            $count++;
                        }
                        ?>
                    </div>
                    <div id="hidemenu-item-home" style="display:none;">
<div class="col2-home">
<div class="col1-home-label"><span>Для дома</span></div>
<?php
                        $count = 0;
                        $hidemenu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_home')->order_by('position', 'asc')->limit(50)->find_all()->as_array();
                        foreach ($hidemenu as $hide) {
                            ?>
                            <div class="menu-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $hide->uri; ?>"><?php echo $hide->title; ?></a>                                
                            </div>
    <?php
    $count++;
}
?>
</div> 
<div class="menu-razdel">&nbsp;</div>
                    <div class="col1-business">
                    <div class="col1-business-label"><span>Для бизнеса</span></div>
                        <?php
                        $count = 0;
                        $hidemenu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_business')->order_by('position', 'asc')->limit(50)->find_all()->as_array();
                        foreach ($hidemenu as $hide) {
                            ?>
                            <div class="menu-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $hide->uri; ?>"><?php echo $hide->title; ?></a>                                
                            </div>
    <?php
    $count++;
}
?>
</div>                   
                    </div>
                </div>  
            </div>
            <div id="main-nav-business" class="<?php
                 if ($type == 'business')
                     echo 'active';
                 else
                     echo 'not-active';
                 ?>">
                <div id="nav-top-business">
                    <div id="mainmenu-item" style="display:block">                            
                        <?php
                        $count = 0;
                        $top_menu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_business')->order_by('position', 'asc')->limit(5)->find_all()->as_array();
                        foreach ($top_menu as $topmenu) {
                            ?>
                            <div class="main-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $topmenu->uri; ?>"><?php echo $topmenu->title; ?></a>                                
                            </div>
    <?php
    $count++;
}
?>
                    </div>
                    <div id="hidemenu-item-business" style="display:none;">
<div class="col2-home">
<div class="col1-home-label"><span>Для дома</span></div>
<?php
                        $count = 0;
                        $hidemenu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_home')->order_by('position', 'asc')->limit(50)->find_all()->as_array();
                        foreach ($hidemenu as $hide) {
                            ?>
                            <div class="menu-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $hide->uri; ?>"><?php echo $hide->title; ?></a>                                
                            </div>
    <?php
    $count++;
}
?>
</div> 
<div class="menu-razdel">&nbsp;</div>
                    <div class="col1-business">
                    <div class="col1-business-label"><span>Для бизнеса</span></div>
                        <?php
                        $count = 0;
                        $hidemenu = ORM::factory('menu')->where('parent', '=', '0')->where('published', '=', 'on')->where('type', '=', 'mainmenu')->where('for', '=', 'for_business')->order_by('position', 'asc')->limit(50)->find_all()->as_array();
                        foreach ($hidemenu as $hide) {
                            ?>
                            <div class="menu-item item-<?php echo $count; ?>"><a href="<?php echo URL::base() . "" . $hide->uri; ?>"><?php echo $hide->title; ?></a>                                
                            </div>
    <?php
    $count++;
}
?>
</div>
                    </div>
                </div>                                  
            </div>
            <div class="bg-header-bottom">&nbsp;</div>
        </div>
        </div>
<?php // if($type=='home') $type='business'; else $type='home'; ?>
        <input type="hidden" id="type-slider" value="<?php
echo $type;
if ($type == '')
    echo 'business';
?>"/>
