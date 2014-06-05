<!DOCTYPE html>
<!--[if lt IE 8]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <meta name="Description" content="<?php echo $description; ?>"/>
    <!--  = Google Fonts =  -->
    <script type="text/javascript">
        WebFontConfig = {
            google: {
                families: ['Open+Sans:400,700,400italic,700italic:latin,latin-ext,cyrillic', 'Pacifico::latin']
            }
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <link href="/css/jquery-ui-timepicker-addon.css" rel="stylesheet">
    <link href="/js/webmarket/fancy/jquery.fancybox.css" rel="stylesheet">

    <!-- Twitter Bootstrap -->
    <link href="/css/webmarket/bootstrap.css" rel="stylesheet">
    <link href="/css/webmarket/responsive.css" rel="stylesheet">
    <!-- Slider Revolution -->
    <link rel="stylesheet" href="/js/webmarket/rs-plugin/css/settings.css" type="text/css"/>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="/js/webmarket/jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css"
          type="text/css"/>
    <!-- PrettyPhoto -->
    <link rel="stylesheet" href="/js/webmarket/prettyphoto/css/prettyPhoto.css" type="text/css"/>
    <!-- main styles -->
    <link href="/css/webmarket/main.css" rel="stylesheet">
    <link href="/css/webmarket/jcarousel.css" rel="stylesheet">


    <!-- Modernizr -->
    <script src="/js/webmarket/modernizr.custom.56918.js"></script>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/webmarket/apple-touch/144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/webmarket/apple-touch/114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/webmarket/apple-touch/72.png">
    <link rel="apple-touch-icon-precomposed" href="/images/webmarket/apple-touch/57.png">
    <link rel="shortcut icon" href="/images/webmarket/apple-touch/57.png">
    <script type="text/javascript" src="/js/webmarket/jquery.js"></script>
    <script src="/js/webmarket/underscore/underscore-min.js" type="text/javascript"></script>
    <script src="/js/webmarket/jquery.bxslider.js"></script>
    <script src="/js/webmarket/jquery.validation.js"></script>
    <!-- bxSlider CSS file -->
    <link href="/css/webmarket/jquery.bxslider.css" rel="stylesheet"/>
    <!--  = Bootstrap =  -->
    <script src="/js/webmarket/bootstrap.min.js" type="text/javascript"></script>

    <!--  = Slider Revolution =  -->
    <script src="/js/webmarket/rs-plugin/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
    <script src="/js/webmarket/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>

    <!--  = CarouFredSel =  -->
    <script src="/js/webmarket/jquery.carouFredSel-6.2.1-packed.js" type="text/javascript"></script>

    <!--  = jQuery UI =  -->
    <script src="/js/webmarket/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="/js/webmarket/jquery-ui-1.10.3/touch-fix.min.js" type="text/javascript"></script>
    <script src="/js/webmarket/jcarousel.js" type="text/javascript"></script>
    <script src="/js/webmarket/jcarousel-connected.js" type="text/javascript"></script>
    <!--  = Isotope =  -->
    <script src="/js/webmarket/isotope/jquery.isotope.min.js" type="text/javascript"></script>

    <!--  = Tour =  -->
    <script src="/js/webmarket/bootstrap-tour/build/js/bootstrap-tour.min.js" type="text/javascript"></script>

    <!--  = PrettyPhoto =  -->
    <script src="/js/webmarket/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>

    <!--  = Google Maps API =  -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="/js/webmarket/goMap/js/jquery.gomap-1.3.2.min.js"></script>

    <!--  = Custom JS =  -->
    <script src="/js/webmarket/custom.js" type="text/javascript"></script>
    <script src="/js/webmarket/raty.js" type="text/javascript"></script>

    <script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript" src="/js/webmarket/fancy/jquery.fancybox.js"></script>
    <style type="text/css">
        <?php echo $css; ?>
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.category-image-wrapper').mouseover(function () {
                jQuery(this).children('.production-hidden').css('display', 'block');
            });
            jQuery('.category-image-wrapper').mouseout(function () {
                jQuery(this).children('.production-hidden').css('display', 'none');
            });
            jQuery('.order-call-header').click(function () {
                jQuery.fancybox.close();
                jQuery.fancybox(jQuery('.fancy-call').html(), {
                    //'content': jQuery(".fancy-call").html(),
                    beforeShow: function () {
                        jQuery('.order-button.green.ways-call-submit').click(function () {
                            var name = jQuery('.fancybox-outer #response-name1').val();
                            var phone = jQuery('.fancybox-outer #response-phone1').val();
                            var time_from = jQuery('#time_from').val();
                            var time_to = jQuery('#time_to').val();
                            jQuery.post('/callback/new', {name: name, phone: phone, time_from: time_from, time_to: time_to}, function (response) {
                                if (response == 'success') {
                                    jQuery.fancybox.close();
                                    jQuery.fancybox('<h3 style="width:315px">Ваш вопрос успешно отправлен!</h3>');
                                    jQuery.fancybox.update();
                                }
                            });
                        });
                    }
                });
            });
            jQuery('.order-call1').click(function () {
                jQuery.fancybox.close();
                jQuery.fancybox(jQuery('.fancy-call').html(), {
                    //'content': jQuery(".fancy-call").html(),
                    beforeShow: function () {
                        jQuery('.fancybox-wrap').addClass('certif-fancybox');
                        jQuery('.order-button.green.ways-call-submit').click(function () {
                            var name = jQuery('.fancybox-outer #response-name1').val();
                            var phone = jQuery('.fancybox-outer #response-phone1').val();
                            var time_from = jQuery('#time_from').val();
                            var time_to = jQuery('#time_to').val();
                            var send = '1';
                            if (name == '') {
                                send = 0;
                                jQuery('.fancybox-outer #response-name1').addClass('error');
                            }
                            if (phone == '') {
                                send = 0;
                                jQuery('.fancybox-outer #response-phone1').addClass('error');
                            }
                            if (time_from == '') {
                                send = 0;
                                jQuery('#time_from').addClass('error');
                            }
                            if (time_to == '') {
                                send = 0;
                                jQuery('#time_to').addClass('error');
                            }
                            if (send == '1') {
                                jQuery.post('/callback/new', {name: name, phone: phone, time_from: time_from, time_to: time_to}, function (response) {
                                    if (response == 'success') {
                                        jQuery.fancybox.close();
                                        jQuery.fancybox('<h3 style="width:315px">Ваш запрос успешно отправлен!</h3>');
                                        jQuery.fancybox.update();
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.fancyboximage').fancybox({
                'beforeShow': function() {
                    jQuery('.fancybox-wrap').addClass('certif-fancybox');
                }
            });
        });
    </script>
    <link rel="alternate" media="print" href="file.pdf">
</head>

<body class="">

<div class="master-wrapper">
    <!--  ==========  -->
    <!--  = Header =  -->
    <!--  ==========  -->
    <header id="header">
        <div class="darker-row">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <div class="higher-line">

                        </div>
                    </div>
                    <div class="span8">
                        <div class="topmost-line">
                            <div class="higher-line">
                                <!--                                <a href="my-account.html" class="gray-link">My account</a>-->
                                <!--                                &nbsp; | &nbsp;-->
                                <!--                                <a href="my-account.html" class="gray-link">Wishlist (2)</a>-->
                                <!--                                &nbsp; | &nbsp;-->
                                <a href="#" class="gray-link"><i>Вход для партнеров</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <!--  ==========  -->
                <!--  = Logo =  -->
                <!--  ==========  -->
                <div class="span7 logo">
                    <a class="brand" href="/">
                        <!--                        <img src="/images/webmarket/logo.png" alt="Webmarket Logo" width="48" height="48"/>-->
                        <img src="/uploads/images/<?php echo ORM::factory('settings')->getSetting('logo'); ?>"
                             width="48" height="48" alt="logo"/>
                        <!--                        <span class="tagline">Really Cool e-Commerce HTML Template</span>-->
                    </a>
                </div>
                <div class="logotext"><?php echo ORM::factory('settings')->getSetting('logotext'); ?></div>

                <!--  ==========  -->
                <!--  = Social Icons =  -->
                <!--  ==========  -->
                <div class="span5">
                    <div class="top-right">
                        <div class="tac width222 fr">
                            <?php echo ORM::factory('settings')->getSetting('call_us'); ?>
                        </div>
                    </div>
                </div>
                <!-- /social icons -->
            </div>
        </div>
    </header>

    <!--  ==========  -->
    <!--  = Main Menu / navbar =  -->
    <!--  ==========  -->
    <div class="navbar navbar-static-top" id="stickyNavbar">
        <div class="navbar-inner">
            <div class="container">
                <div class="row">
                    <div class="span9">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!--  ==========  -->
                        <!--  = Menu =  -->
                        <!--  ==========  -->
                        <div class="nav-collapse collapse">
                            <ul class="nav" id="mainNavigation">
                                <li class="<?php if (isset($front_name)) {
                                    if ($front_name == '/') {
                                        echo 'active';
                                    }
                                } ?>"><a href="/">Главная</a></li>
                                <?php foreach ($menu as $item) { ?>
                                    <?php $childrens = ORM::factory('menu')->where('type', '=', 'topmenu')->where('published', '=', 'on')->where('parent', '=', $item->id)->find_all()->as_array(); ?>
                                    <li class="<?php if (count($childrens) > 0) {
                                        echo 'dropdown';
                                    } ?> <?php if (isset($front_name)) {
                                        if ($front_name == $item->uri) {
                                            echo 'active';
                                        }
                                    } ?>">
                                        <a href="<?php echo $item->uri; ?>"
                                           class="<?php echo $item->classes; ?> "><?php echo $item->title; ?></a>
                                        <?php if (count($childrens) > 0) { ?>
                                            <ul class="dropdown-menu">
                                                <?php foreach ($childrens as $child) { ?>
                                                    <li><a href="<?php echo $child->uri; ?>" class="<?php echo $child->classes; ?> "><?php echo $child->title; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>

                            </ul>

                            <!--  ==========  -->
                            <!--  = Search form =  -->
                            <!--  ==========  -->


                        </div>
                        <!-- /.nav-collapse -->
                    </div>

                    <!--  ==========  -->
                    <!--  = Cart =  -->
                    <!--  ==========  -->
                    <div class="span3">
                        <form class="navbar-form pull-right" action="/search/find" method="get">
                            <button type="submit"><span class="icon-search"></span></button>
                            <input type="text" class="span1" name="word" id="navSearchInput">
                        </form>
                    </div>
                    <!-- /cart -->
                </div>
            </div>
        </div>
    </div>