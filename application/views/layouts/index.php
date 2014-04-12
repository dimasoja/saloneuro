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
    <title>Webmarket HTML Template - Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ProteusThemes">

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


    <!-- Modernizr -->
    <script src="/js/webmarket/modernizr.custom.56918.js"></script>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/webmarket/apple-touch/144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/webmarket/apple-touch/114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/webmarket/apple-touch/72.png">
    <link rel="apple-touch-icon-precomposed" href="/images/webmarket/apple-touch/57.png">
    <link rel="shortcut icon" href="/images/webmarket/apple-touch/57.png">
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
                            <a href="checkout-step-1.html" class="gray-link"><i>Вход для партнеров</i></a>
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
            <div class="span7">
                <a class="brand" href="index.html">
                    <img src="/images/webmarket/logo.png" alt="Webmarket Logo" width="48" height="48"/>
                    <!--                        <span class="tagline">Really Cool e-Commerce HTML Template</span>-->
                </a>
            </div>

            <!--  ==========  -->
            <!--  = Social Icons =  -->
            <!--  ==========  -->
            <div class="span5">
                <div class="top-right">
                    <div class="tac width222 fr">
                        <div>Позвоните нам!</div>
                        <div class=""><img src="/images/webmarket/call.png"/><span class="phone">8-800-700-00-00</span>
                        </div>
                        <div>или закажите <span class="callback">обратный звонок</span></div>
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
                            <li class="active"><a href="/">Главная</a></li>
                            <?php foreach ($menu as $item) { ?>
                                <li><a href="<?php echo $item->uri; ?>"><?php echo $item->title; ?></a></li>
                            <?php } ?>
                            <li class="shop-backgr">
                                <a class="shop" href="/shop">SHOP</a>
                            </li>
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
                    <form class="navbar-form pull-right" action="#" method="get">
                        <button type="submit"><span class="icon-search"></span></button>
                        <input type="text" class="span1" name="search" id="navSearchInput">
                    </form>
                </div>
                <!-- /cart -->
            </div>
        </div>
    </div>
</div>
<!-- /main menu -->


<!--  ==========  -->
<!--  = Slider Revolution =  -->
<!--  ==========  -->
<div class="slider-full">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <li data-transition="premium-random" data-slotamount="3">
                    <img src="/images/webmarket/dummy/slides/slide1.png" alt="slider img" width="1400" height="377"/>

                </li>
                <!-- /slide -->

                <li data-transition="premium-random" data-slotamount="3">
                    <img src="/images/webmarket/dummy/slides/slide2.png" alt="slider img" width="1400" height="377"/>

                </li>
                <!-- /slide -->

                <li data-transition="premium-random" data-slotamount="3">
                    <img src="/images/webmarket/dummy/slides/slide3.png" alt="slider img" width="1400" height="377"/>

                </li>
                <!-- /slide -->

                <li data-transition="premium-random" data-slotamount="3">
                    <img src="/images/webmarket/dummy/slides/slide4.png" alt="slider img" width="1400" height="377"/>

                </li>
                <!-- /slide -->
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
        <!--  ==========  -->
        <!--  = Nav Arrows =  -->
        <!--  ==========  -->
        <div id="sliderRevLeft"><i class="icon-chevron-left"></i></div>
        <div id="sliderRevRight"><i class="icon-chevron-right"></i></div>
    </div>
    <div class="promo-block">
        <a href="/news">
            <input type="button" class="biruz" value="НОВОСТИ И/ИЛИ АКЦИИ КОМПАНИИ"/>
        </a>
        <br/><br/>
        <i style="font-size:15px">Акция продукции THERMOLUX у ВСЕХ партнеров! <br/>
            Или текст какой-либо одной новости, с<br/>
            ограниченным количеством символов. <br/>
            Блок реализуется с помощью css</i><br/>
        <br/>
        <a href="/news">
            <input type="button" class="green floatright" value="Подробнее..."/>
        </a>
    </div>
</div>
<!-- /slider revolution -->

<!--  ==========  -->
<!--  = Main container =  -->
<!--  ==========  -->
<div class="container">
<!--<div class="row">
    <div class="span12">
        <div class="push-up over-slider blocks-spacer">
            <div class="row">
                <div class="span4">
                    <a href="#" class="btn btn-block banner">
                        <span class="title"><span class="light">SUMMER</span> SALE</span>
                        <em>up to 60% off on all shoes</em>
                    </a>
                </div>
                <div class="span4">
                    <a href="#" class="btn btn-block colored banner">
                        <span class="title"><span class="light">FREE</span> SHIPPING</span>
                        <em>on orders over $69</em>
                    </a>
                </div>
                <div class="span4">
                    <a href="#" class="btn btn-block banner">
                        <span class="title"><span class="light">NEW</span> PRODUCTS</span>
                        <em>for running on lorem ipsum dolor</em>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!--  ==========  -->
<!--  = Featured Items =  -->
<!--  ==========  -->
<div class="row featured-items blocks-spacer">
    <div class="span12">

        <!--  ==========  -->
        <!--  = Title =  -->
        <!--  ==========  -->
        <div class="main-titles">
            <!--        <h2 class="title"><span class="light">Featured</span> Products</h2>-->

            <div class="arrows">
                <a href="#" class="icon-chevron-left" id="featuredItemsLeft"></a>
                <a href="#" class="icon-chevron-right" id="featuredItemsRight"></a>
            </div>
        </div>
    </div>

    <div class="span12">
        <!--  ==========  -->
        <!--  = Carousel =  -->
        <!--  ==========  -->
        <div class="carouFredSel" data-autoplay="false" data-nav="featuredItems">
            <div class="slide">
                <div class="row">
                    <a href="/ekology">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/ecology.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ЭКОЛОГИЧНОСТЬ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/teplo">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/teplo.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ТЕПЛОИЗОЛЯЦИЯ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/proch">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/proch.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ВЫСОКОПРОЧНОСТЬ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/shum">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/shum.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ШУМОИЗОЛЯЦИЯ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Тихий набор воды
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="slide">
                <div class="row">
                    <a href="/ekology">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/ecology.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ЭКОЛОГИЧНОСТЬ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/teplo">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/teplo.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ТЕПЛОИЗОЛЯЦИЯ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/proch">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/proch.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ВЫСОКОПРОЧНОСТЬ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Экологически чистые материалы
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/shum">
                        <div class="span4">
                            <div class="benefit">
                                <div class="inner-benefit">
                                    <div class="inner-benefit-left">
                                        <img src="/images/webmarket/shum.png" class="benefit-image"/>
                                    </div>
                                    <div class="inner-benefit-right">
                                <span class="inner-benefit-title">
                                    ШУМОИЗОЛЯЦИЯ
                                </span><br/>
                                <span class="inner-benefit-text">
                                    Тихий набор воды
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /carousel -->
    </div>

</div>
</div>
<div class="welcome">
    <div class="fullwidthbanner-container" style="overflow: visible;">
        <div class="fullwidthbanner revslider-initialised tp-simpleresponsive" id="revslider-281">
            <h2 class="biruz-title width205">ЗАГОЛОВОК ПРИВЕТСТВИЯ!</h2>
            <br/>
            <i>Текст приветствия со стороны завода по производству акриловых ванн. Текст приветствия нужно придумать.
                <br/>
                Термолюкс</i>
            <br/><br/><br/>
        </div>
    </div>

    <div class="promo-block-welcome">
        <h2 class="biruz-title width286">КАК НЕ ОШИБИТЬСЯ В ВЫБОРЕ ВАННЫ?</h2>
        <br/>
        <i>Вы когда-нибудь задумывались над тем, что
            придется поменять ванну? Если да, то вам не нужно
            объяснять, насколько сложно специалисту сделать правильный выбор. Почему?</i><br/>
        <a href="/news"><br/>
            <input type="button" class="green floatright" value="Подробнее..."/>
        </a>
        <br/><br/><br/>
    </div>
</div>
<div class="boxed-area blocks-spacer">
    <div class="container">
        <div class="welcome">
            <div class="fullwidthbanner-container" style="overflow: visible;">
                <div class="fullwidthbanner revslider-initialised tp-simpleresponsive" id="revslider-281"
                     style="max-height: 900px;">
                    <?php foreach ($productscat as $category) { ?>
                        <?php $sizes = ImageWork::getImageSize('.' . $category->image, '363', '270', '363', '270'); ?>
                        <?php if ($category->image != '') { ?>
                            <div class="category-image-wrapper">
                                <img src='<?php echo $category->image; ?>' width='<?php echo $sizes['newwidth']; ?>'
                                     height='<?php echo $sizes['newheight']; ?>'
                                     style="margin-top:<?php echo (363 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (250 - $sizes['newheight']) / 2; ?>px;"/>
                            </div>
                        <?php } else { ?>

                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <div class="promo-block-welcome">
                <div class="category-right-wrapper">
                    <div class="wheretobuyblock">
                        <div class="aqua-header">Где купить?</div>
                        <i class="find-store">найти магазин дилера</i><br/>

                        <div class="geo-label">
                            <div class="geo-image">
                                <img src="/images/webmarket/savelocale.png"/>
                            </div>
                            <div class="your-city">
                                Ваш город:
                            </div>
                            <div class="city">
                                Ростов-на-Дону
                            </div>
                        </div>
                        <div class="cities">
                            <div class="address">ТРЦ "Горизонт", ул. Нагибина, 1</div>
                            <div class="blue-address">ТРЦ "Горизонт", ул. Нагибина, 1</div>
                            <div class="address">ТРЦ "Горизонт", ул. Нагибина, 1</div>
                            <div class="blue-address">ТРЦ "Горизонт", ул. Нагибина, 1</div>
                            <div class="address">ТРЦ "Горизонт", ул. Нагибина, 1</div>
                        </div>
                        <div class="other">
                            <a href="/news">
                                <input type="button" class="green floatright" value="Подробнее...">
                            </a>
                        </div>
                        <div class="other lightgreytext">
                            <a href="/news">
                                Хочу купить онлайн!
                            </a>
                        </div>
                    </div>
                    <div class="tobuyonline">
                        <div class="aqua-header">Позвоните нам!</div>
                        <div class="call-text">
                            Проконсультируйтесь с нашими специалистами и получите ответы на все вопросы о нашей
                            продукции.
                            Мы всегда рады ответить на все вопросы по сотрудничеству от частных лиц!<br/><br/>
                        </div>
                        <div class="geo-label-blue">
                            <div class="geo-label-blue-call"><img src="/images/webmarket/call.png"></div>
                            <div class="geo-label-call-text">
                                <span class="phone">8-800-700-00-00</span><br/>
                                <span class="under-phone">Звонок по России бесплатный</span>
                            </div>
                        </div>
                        <div class="comment-label-white">
                            <div class="geo-label-blue-call"><img src="/images/webmarket/comment.png"></div>
                            <div class="geo-label-call-text">
                            <span class="comment-text">или свяжитесь с нами другим удобным для Вас <a href="/news">
                                    <input type="button" class="green floatright" value="способом">
                                </a></span>
                            </div>
                        </div>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br/>
    <br/>
</div>
<br/>
</div>
<!--  ==========  -->
<!--  = Lastest News =  -->
<!--  ==========  -->
<div class="darker-stripe blocks-spacer more-space latest-news with-shadows">
    <div class="container">
        <div class="footer-block1">
            <div class="inner-footer-block1">
                <a href="#">О компании</a><br/>
                <a href="#">Сотрудничество</a><br/>
                <a href="#">Частным лицам</a><br/>
                <a href="#">Полезная информация</a><br/>
                <a href="#">Контакты</a>
            </div>
        </div>
        <div class="footer-block2">
            <div class="inner-footer-block1">
                <a href="#">Продукция</a><br/>
                <a href="#">Наши сертификаты</a><br/>
                <a href="#">Новости и акции</a><br/>
                <a href="#">Интернет магазин производителя</a><br/>
                <a href="#">Политика безопасности</a>
            </div>
        </div>
        <div class="footer-block3">
            <div class="inner-footer-block1">
                <a href="#">Заказать обратный звонок</a><br/>
                <a href="#">Онлайн-консультант</a><br/>
                <a href="#">Форма обратной связи</a><br/>
            </div>
        </div>
        <div class="footer-block4">
            <div class="social">
                <a href="#">
                    <img src="/images/webmarket/twitter.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/facebook.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/vkontakte.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/odnoklassniki.png"/>
                </a>

            </div>
        </div>
    </div>
</div>
<!-- /latest news -->


<!--  ==========  -->
<!--  = Footer =  -->
<!--  ==========  -->
<footer>


    <div class="foot-last">
        <a href="#" id="toTheTop">
            <span class="icon-chevron-up"></span>
        </a>

        <div class="container">
            <div class="row">
                <div class="span6">
                    &copy; Все права защищены. Thermolux
                </div>
                <div class="span6">
                    <!--                    <div class="pull-right">Webmarket HTML Template by <a href="http://www.proteusthemes.com">ProteusThemes</a>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /footer -->


<!--  ==========  -->
<!--  = Modal Windows =  -->
<!--  ==========  -->

<!--  = Login =  -->
<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="loginModalLabel"><span class="light">Login</span> To Webmarket</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmail">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputEmail" placeholder="Username" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputPassword">Password</label>

                <div class="controls">
                    <input type="password" class="input-block-level" id="inputPassword" placeholder="Password" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox">
                        Remember me
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary input-block-level bold higher">
                SIGN IN
            </button>
        </form>
        <p class="center-align push-down-0">
            <a data-toggle="modal" role="button" href="#forgotPassModal" data-dismiss="modal">Forgot your password?</a>
        </p>
    </div>
</div>

<!--  = Register =  -->
<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="registerModalLabel"><span class="light">Register</span> To Webmarket</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputUsernameRegister">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputUsernameRegister" placeholder="Username"
                           required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmailRegister">Email</label>

                <div class="controls">
                    <input type="email" class="input-block-level" id="inputEmailRegister" placeholder="Email" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputPasswordRegister">Password</label>

                <div class="controls">
                    <input type="password" class="input-block-level" id="inputPasswordRegister" placeholder="Password"
                           required>
                </div>
            </div>
            <button type="submit" class="btn btn-danger input-block-level bold higher">
                REGISTER
            </button>
        </form>
        <p class="center-align push-down-0">
            <a data-toggle="modal" role="button" href="#loginModal" data-dismiss="modal">Already Registered?</a>
        </p>

    </div>
</div>

<!--  = Forgot your password =  -->
<div id="forgotPassModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="forgotPassModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="forgotPassModalLabel"><span class="light">Forgot</span> your password?</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputUsernameRegister">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputUsernameRegister" placeholder="Username">
                </div>
            </div>
            <p class="center-align">OR</p>

            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmailRegister">Email</label>

                <div class="controls">
                    <input type="email" class="input-block-level" id="inputEmailRegister" placeholder="Email">
                </div>
            </div>
            <button type="submit" class="btn btn-primary input-block-level bold higher">
                SEND ME A NEW PASSWORD
            </button>
        </form>
    </div>
</div>

</div>
<!-- end of master-wrapper -->


<!--  ==========  -->
<!--  = JavaScript =  -->
<!--  ==========  -->

<!--  = FB =  -->

<div id="fb-root"></div>
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=126780447403102";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->


<!--  = jQuery - CDN with local fallback =  -->
<script type="text/javascript" src="/js/webmarket/jquery.js"></script>
<script type="text/javascript">
    if (typeof jQuery == 'undefined') {
        document.write('<script src="js/jquery.min.js"><\/script>');
    }
</script>

<!--  = _ =  -->
<script src="/js/webmarket/underscore/underscore-min.js" type="text/javascript"></script>

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

<!--  = Isotope =  -->
<script src="/js/webmarket/isotope/jquery.isotope.min.js" type="text/javascript"></script>

<!--  = Tour =  -->
<script src="/js/webmarket/bootstrap-tour/build/js/bootstrap-tour.min.js" type="text/javascript"></script>

<!--  = PrettyPhoto =  -->
<script src="/js/webmarket/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>

<!--  = Google Maps API =  -->
<!-- // <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript" src="/js/goMap/js/jquery.gomap-1.3.2.min.js"></script>

<!--  = Custom JS =  -->
<script src="/js/webmarket/custom.js" type="text/javascript"></script>

</body>
</html>












<?php echo $type = ''; ?>
<?php //require_once 'header.php'; ?>
<div id="main-content-wrapper" style="display:none">
    <div id="slider-for-home" <?php if (($type == 'home') || ($type == '')) {
        echo "style='display:block'";
    } else {
        echo 'style="display:none"';
    } ?> >
        <div class="header-center-slider">
            <div class="slider">
                <?php
                $count = 0;
                $postmeta = ORM::factory('postmeta');
                ?>
                <?php foreach ($sliderdata_home as $key => $sd) { ?>
                    <?php $count++; ?>
                    <div class="slider-text-right str-<?php echo $key; ?> <?php if ($count == 1) {
                        echo "active first-text";
                    } else {
                        echo "not-active";
                    } ?>">
                        <div class="slider-security">
                            <a href='<?php echo $postmeta->get_postmeta($sd, 'link'); ?>'><?php echo $postmeta->get_postmeta($sd, 'title'); ?></a>
                        </div>
                        <div class="slider-item-1">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item1'); ?></div>
                        </div>
                        <div class="slider-item-2">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item2'); ?></div>
                        </div>
                        <div class="slider-item-3">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item3'); ?></div>
                        </div>
                        <div class="slider-item-4">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item4'); ?></div>
                        </div>
                        <div class="more-know">
                            <div class="more-known"><a href='<?php echo $postmeta->get_postmeta($sd, 'link'); ?>'><input
                                        type="button" class="more-know-button" value="Узнать больше"/></a></div>
                        </div>
                    </div>

                <div class="slider-<?php echo $key; ?> slider-image <?php if ($count == 1) {
                    echo "active first-image";
                } else {
                    echo "not-active";
                } ?>"><img
                        src="/uploads/images/<?php echo ORM::factory('images')->where('id_image', '=', $key)->find()->path; ?>"
                        width="720" style="margin-left: -5px;margin-top: 15px;"/></div><?php } ?>
            </div>
            <div class="circles">
                <?php $count = 0; ?>
                <?php foreach ($sliderdata_home as $key => $sd) { ?>
                    <?php $count++; ?>
                    <div class="circle-<?php echo $key; ?> circle <?php if ($count == '1') {
                        echo 'active first-cycle';
                    } else {
                        echo 'not-active';
                    } ?>"
                         onclick="getSlider(<?php echo $key; ?>,'home')">&nbsp;</div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="slider-for-business" <?php if ($type == 'business') {
        echo "style='display:block'";
    } else {
        echo 'style="display:none"';
    } ?>>
        <div class="header-center-slider">
            <div class="slider">
                <?php
                $count = 0;
                $postmeta = ORM::factory('postmeta');
                ?>
                <?php foreach ($sliderdata_business as $key => $sd) { ?>
                    <?php $count++; ?>
                    <div class="slider-text-right str-<?php echo $key; ?> <?php if ($count == 1) {
                        echo "active first-text";
                    } else {
                        echo "not-active";
                    } ?>">
                        <div class="slider-security">
                            <a href='<?php echo $postmeta->get_postmeta($sd, 'link'); ?>'><?php echo $postmeta->get_postmeta($sd, 'title'); ?></a>
                        </div>
                        <div class="slider-item-1">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item1'); ?></div>
                        </div>
                        <div class="slider-item-2">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item2'); ?></div>
                        </div>
                        <div class="slider-item-3">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item3'); ?></div>
                        </div>
                        <div class="slider-item-4">
                            <div class="red-label">&nbsp;</div>
                            <div class="slider-text-item"><?php echo $postmeta->get_postmeta($sd, 'item4'); ?></div>
                        </div>
                        <div class="more-know">
                            <div class="more-known"><input type="button" class="more-know-button"
                                                           value="Узнать больше"/></div>
                        </div>
                    </div>

                <div class="slider-<?php echo $key; ?> slider-image <?php if ($count == 1) {
                    echo "active first-image";
                } else {
                    echo "not-active";
                } ?>"><img
                        src="/uploads/images/<?php echo ORM::factory('images')->where('id_image', '=', $key)->find()->path; ?>"
                        width="720" style="margin-left: -5px;margin-top: 15px;"/></div><?php } ?>
            </div>
            <div class="circles">
                <?php $count = 0; ?>
                <?php foreach ($sliderdata_business as $key => $sd) { ?>
                    <?php $count++; ?>
                    <div class="circle-<?php echo $key; ?> circle <?php if ($count == '1') {
                        echo 'active first-cycle';
                    } else {
                        echo 'not-active';
                    } ?>"
                         onclick="getSlider(<?php echo $key; ?>,'business')">&nbsp;</div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        function theRotator() {
            setInterval('rotate()', 3000);
        }
        function rotate() {
            var type = jQuery('#type-slider').val();
            if (jQuery('#slider-for-' + type + ' .slider .slider-image.active').next().next().length == 0) {
                jQuery('#slider-for-' + type + ' .slider .slider-text-right.active').removeClass('active').addClass('not-active');
                jQuery('#slider-for-' + type + ' .slider .slider-image.active').removeClass('active').addClass('not-active');
                jQuery('#slider-for-' + type + ' .slider .first-text').removeClass('not-active').addClass('active');
                jQuery('#slider-for-' + type + ' .slider .first-image').removeClass('not-active').addClass('active');
                jQuery('#slider-for-' + type + ' .circles .active').removeClass('active').addClass('not-active');
                jQuery('#slider-for-' + type + ' .circles .first-cycle').removeClass('not-active').addClass('active');
            } else {
                jQuery('#slider-for-' + type + ' .slider .slider-text-right.active').removeClass('active').addClass('not-active').next().next().addClass('active').removeClass('not-active');
                jQuery('#slider-for-' + type + ' .slider .slider-image.active').removeClass('active').addClass('not-active').next().next().addClass('active').removeClass('not-active').show('slow');
                jQuery('#slider-for-' + type + ' .circles .active').removeClass('active').addClass('not-active').next().removeClass('not-active').addClass('active');
            }
        }
        ;
        jQuery(document).ready(function () {
            theRotator();
        });
    </script>
</div>
<?php //require_once 'footer.php'; ?>
