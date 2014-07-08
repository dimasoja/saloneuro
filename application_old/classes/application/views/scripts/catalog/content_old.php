<input type="hidden" class="product-id" value="<?php echo $page->id; ?>"/>
<h2><?php echo $page->name; ?></h2>

<hr/>

<div class="connected-carousels">
    <div class="stage">
        <div class="carousel carousel-stage">
            <ul>
                <?php foreach ($related_images as $rimage) { ?>
                    <li><a href="<?php echo $rimage->path; ?>" class="carouselfancy" rel="groupfancy"><?php echo FrontHelper::output($rimage->path, 420, 400, 420, 400); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <p class="photo-credits">

        </p>
        <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
        <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
    </div>

    <div class="navigation">
        <a href="#" class="prev prev-navigation">&lsaquo;</a>
        <a href="#" class="next next-navigation">&rsaquo;</a>

        <div class="carousel carousel-navigation">
            <ul>
                <?php foreach ($related_images as $rimage) { ?>
                    <li><?php echo FrontHelper::outputRender($rimage->path, 60, 60, 60, 60); ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="information-item">
    <?php if (isset($page->image)) { ?>
        <div class="information-image">
            <?php if (file_exists('.' . $page->image)) { ?>
                <?php $sizes = ImageWork::getImageSize('.' . $page->image, '200', '200', '200', '200'); ?>
                <?php if ($page->image != '') { ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $page->image; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'
                             style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"/>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="product-text">
        <div class="technical">Технические характеристики</div>
        <br/>

        <div class="information-title">
        </div>
        <div class="attributes">
            <div class="form-row">
                <?php $options = ORM::factory('options')->where('type', '=', 'custom')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
            </div>
            <div class="options">
                <div class="form-row">
                    <b>Тип</b> : <?php
                    if ($page->type == 'angular') {
                        echo 'Угловая';
                    }
                    if ($page->type == 'rectangular') {
                        echo 'Прямоугольная';
                    }
                    if ($page->type == 'increased') {
                        echo 'Увеличенного объема';
                    }

                    ?><br/>
                    <b>Ширина</b> : <?php echo $page->width; ?><br/>
                    <b>Длина</b> : <?php echo $page->length; ?><br/>
                </div>
                <?php $count = 0; ?>
                <?php foreach ($options as $option) { ?>
                    <div class="form-row">
                        <?php if ($option->name != '') { ?>
                            <b><?php echo $option->name; ?></b> : <?php echo $option->value; ?><br/>
                        <?php } ?>
                    </div>
                    <?php $count++; ?>
                <?php } ?>
            </div>
            <div class="order">
                <span class="your-order">Ваш заказ:</span><br/>
                <span class="floatleft"><?php echo $page->name; ?></span>
                <span class="floatright">
                    <?php if ($category_product->grade_on == 'on') { ?>
                        <?php $priceglobal = $bath->price + $frame->price; ?>
                        <span class="global-price"
                              data-value="<?php echo $priceglobal; ?>"><?php echo number_format((double)$priceglobal, 0, ' ', ' '); ?></span>
                        <br/>
                    <?php } else { ?>
                        <span class="global-price"
                              data-value="<?php echo $page->price; ?>"><?php echo number_format((double)$page->price, 0, ' ', ' '); ?></span>
                    <?php } ?>

                    <a href="#order-ways" class="order-form">
                        <span class="order-button"> Заказать</span>
                    </a>
                </span>
            </div>
        </div>
        <br/>
    </div>
</div>

<?php if ($category_product->grade_on == 'on') {
    ?>
    <div class="grade-product">
        <div class="grade-title">В комплектацию входит</div>
        <div class="grade-item required">
            <div class="grade-first-col">
                <div class="grade-image">
                    <img src="<?php echo $bath->image; ?>">
                </div>
                <div class="grade-name">
                    <?php echo $bath->name; ?>                    </div>
            </div>
            <div class="grade-second-col">
                <div class="grade-price active padding415" style="padding: 15px 15px;">
                                        <span class="grade-price-value"
                                              rel="<?php echo $bath->price; ?>"><?php echo number_format($bath->price, 0, ' ', ' '); ?></span>
                    <br>
                </div>
            </div>
        </div>
        <div class="grade-item">
            <div class="grade-first-col">
                <div class="grade-image">
                    <img src="<?php echo $frame->image; ?>">
                </div>
                <div class="grade-name">
                    <?php echo $frame->name; ?>                    </div>
            </div>
            <div class="grade-second-col">
                <div class="grade-price active padding415">
                                        <span class="grade-price-value"
                                              rel="<?php echo $frame->price; ?>"><?php echo number_format($frame->price, 0, ' ', ' '); ?></span>
                    <br>
                                        <span class="add-grade" data-grade="<?php echo $frame->price; ?>"
                                              data-price="<?php echo $frame->price; ?>" data-image="">Убрать комплектацию</span>
                </div>
            </div>
        </div>
        <?php $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
        <div class="field" style="text-align:left;">
            <?php foreach ($options as $option) {
                if (($option->value != '1') && ($option->value != '2')) {
                    $grades = ORM::factory('grade')->where('id', '=', $option->value)->find(); ?>
                    <div class="grade-item">
                        <div class="grade-first-col">
                            <div class="grade-image">
                                <img src="<?php echo $grades->image; ?>"/>
                            </div>
                            <div class="grade-name">
                                <?php echo $grades->name; ?>
                            </div>
                        </div>
                        <div class="grade-second-col">
                            <div class="grade-price padding415">
                            <span class="grade-price-value"
                                  rel="<?php echo $grades->price; ?>"><?php echo number_format($grades->price, 0, ' ', ' '); ?></span>
                                <br/>
                            <span class="add-grade" data-grade="<?php echo $grades->id; ?>"
                                  data-price="<?php echo $grades->price; ?>" data-image="<?php echo $grades->image; ?>">Добавить комплектацию</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>
</div>
<?php if ($category_product->massage_on == 'on') { ?>
    <div class="boxed-area blocks-spacer">
        <div class="container">
            <div class="massage-container">
                <div class="massage-title">
                    <span class="massage-title-inner">МАССАЖНЫЕ ОПЦИИ <?php echo $page->id; ?></span>
                    <?php if ($category_product->type == 'massage') { ?>
                    <span class="switch-massage">(Скрыть список)</span></div>
                <?php } else { ?>
                <span class="switch-massage">(Раскрыть список)</span></div>
            <?php } ?>
            <?php $options = ORM::factory('options')->where('type', '=', 'massage')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
            <?php if ($category_product->type == 'massage') { ?>
                <?php $class_display = 'block'; ?>
            <?php } else { ?>
                <?php $class_display = 'none'; ?>
            <?php } ?>
            <div class="field" style="text-align:left; display:<?php echo $class_display; ?>">
                <div class="grade-item">
                    <div class="grade-first-col">
                        <div class="massage-image" data-image="<?php echo $gidromassage->image; ?>">
                            <img src="<?php echo $gidromassage->image; ?>">

                            <div class="lookonthis"><a href="<?php echo $gidromassage->image; ?>">Посмотреть</a></div>
                        </div>
                        <div class="massage-info">
                            <div class="grade-name">
                                <?php echo $gidromassage->name; ?> <!-- (<span class="switch-gidro">Раскрыть</span>)-->
                            </div>
                            <div class="massage-descr">
                                <?php echo FrontHelper::maxsite_str_word($gidromassage->description, 40); ?>...
                            </div>
                        </div>
                    </div>
                    <div class="grade-second-col">
                        <?php if ($category_product->type == 'massage') {
                            $class = "active";
                        } else {
                            $class = "";
                        } ?>
                        <div class="grade-price <?php echo $class; ?> first">
                                <span class="grade-price-value"
                                      rel="<?php echo $gidromassage->price; ?>"><?php echo number_format($gidromassage->price, 0, ' ', ' '); ?></span><br/>
                            <?php if ($category_product->type != 'massage') { ?>
                                <span class="add-massage" data-massage="<?php echo $gidromassage->id; ?>"
                                      data-price="<?php echo $gidromassage->price; ?>"
                                      data-image="<?php echo $gidromassage->image; ?>">Добавить опцию</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="gidro" style="display:block">
                    <div class="grade-item">
                        <div class="grade-first-col massage-special">
                            <div class="massage-image" data-image="<?php echo $backmassage->image; ?>">
                                <img src="<?php echo $backmassage->image; ?>">

                                <div class="lookonthis"><a href="<?php echo $backmassage->image; ?>">Посмотреть</a>
                                </div>
                            </div>
                            <div class="massage-info">
                                <div class="grade-name">
                                    <?php echo $backmassage->name; ?> <!--(<span class="switch-gidro">Раскрыть</span>)-->
                                </div>
                                <div class="massage-descr">
                                    <?php echo FrontHelper::maxsite_str_word($backmassage->description, 40); ?>...
                                </div>
                            </div>
                        </div>
                        <div class="grade-second-col massage-special-price">
                            <div class="grade-price first">
                                <span class="grade-price-value"
                                      rel="<?php echo $backmassage->price; ?>"><?php echo number_format($backmassage->price, 0, ' ', ' '); ?></span><br/>
                            <span class="add-massage" data-massage="<?php echo $backmassage->id; ?>"
                                  data-price="<?php echo $backmassage->price; ?>"
                                  data-image="<?php echo $backmassage->image; ?>">Добавить опцию</span>
                            </div>
                        </div>
                    </div>
                    <div class="grade-item">
                        <div class="grade-first-col massage-special">
                            <div class="massage-image" data-image="<?php echo $feetmassage->image; ?>">
                                <img src="<?php echo $feetmassage->image; ?>">

                                <div class="lookonthis"><a href="<?php echo $feetmassage->image; ?>">Посмотреть</a>
                                </div>
                            </div>
                            <div class="massage-info">
                                <div class="grade-name">
                                    <?php echo $feetmassage->name; ?> <!--(<span class="switch-gidro">Раскрыть</span>)-->
                                </div>
                                <div class="massage-descr">
                                    <?php echo FrontHelper::maxsite_str_word($feetmassage->description, 40); ?>...
                                </div>
                            </div>
                        </div>
                        <div class="grade-second-col massage-special-price">
                            <div class="grade-price first">
                                <span class="grade-price-value"
                                      rel="<?php echo $feetmassage->price; ?>"><?php echo number_format($feetmassage->price, 0, ' ', ' '); ?></span><br/>
                            <span class="add-massage" data-massage="<?php echo $feetmassage->id; ?>"
                                  data-price="<?php echo $feetmassage->price; ?>"
                                  data-image="<?php echo $feetmassage->image; ?>">Добавить опцию</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($options as $option) {
                    $option = json_decode($option->value);
                    $massage = ORM::factory('massage')->where('id', '=', $option[1])->find();
                    $image = ORM::factory('images')->where('id_image', '=', $option[0])->find();
                    ?>
                    <div class="grade-item">
                        <div class="grade-first-col">
                            <div class="massage-image" data-image="<?php echo $massage->image; ?>">
                                <img src="<?php echo $image->path; ?>"/>

                                <div class="lookonthis"><a href="<?php echo $massage->image; ?>">Посмотреть</a></div>
                            </div>
                            <div class="massage-info">
                                <div class="grade-name">
                                    <?php echo $massage->name; ?>
                                </div>
                                <div class="massage-descr">
                                    <?php echo FrontHelper::maxsite_str_word($massage->description, 40); ?>...
                                </div>
                            </div>
                        </div>
                        <div class="grade-second-col">
                            <div class="massage-price padding415">
                            <span class="massage-price-value"
                                  rel="<?php echo $massage->price; ?>"><?php echo number_format($massage->price, 0, ' ', ' '); ?></span>
                                <br/>
                                <span class="add-massage" data-massage="<?php echo $massage->id; ?>"
                                      data-price="<?php echo $massage->price; ?>"
                                      data-image="<?php echo $massage->image; ?>">Добавить опцию</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
<?php } ?>

<div class="product-pretext">
    <div class="container">
        <div class="product-description">
            <br/>
            <?php //echo $page->description; ?>
            <div style="border: 1px solid rgb(204,204,204);padding:10px;">
                <div style="font-style: italic;text-transform: uppercase;font-size: 20px;">Описание товара</div>
                <br/>

                <p>Текстовое описание товара.Текстовое описание
                    товара.Текстовое описание товара.Текстовое описание товара.Текстовое описание товара.Текстовое
                    описание товара.Текстовое описание товара.
                    Текстовое описание товара.Текстовое описание товара.Текстовое описание товара.Текстовое описание
                    товара.Текстовое описание товара.Текстовое описание товара.Текстовое описание товара.
                    Текстовое описание товара.Текстовое описание товара.Текстовое описание товара.Текстовое описание
                    товара.Текстовое описание товара.Текстовое описание товара.Текстовое описание товара.
                </p>
            </div>
            <div
                style="border: 1px solid rgb(204,204,204);padding:10px;background-color: rgb(227, 239,244); margin-top:-1px; font-size: 16px;">
                <p><i>Мы заботимся о наших клиентах, поэтому, массажные ванны Thermolux всегда снабжены специальными
                        механизмами безопасности. </i><br/><br/>
                    <b>Важно! Мы не берем за данный функционал деньги (перефразировать)</b>
                </p>
            </div>
            <?php if ($page->scheme != '') { ?>
                <div class="product-downloads">
                    <!--                <a href="javascript:window.print()"><img src="/images/print.png"/></a>-->
                    <a href="/<?php echo $page->scheme; ?>" class="width32"><img src="/images/download.png"/></a>
                    Схема монтажа
                </div>
            <?php } ?>
            <?php if ($page->instruction != '') { ?>
                <div class="product-downloads">
                    <!--                <a href="javascript:window.print()"><img src="/images/print.png"/></a>-->
                    <a href="/<?php echo $page->instruction; ?>" class="width32"><img src="/images/download.png"/></a>
                    Инструкция по эксплуатации
                </div>
            <?php } ?>
        </div>
    </div>
    <br/><br/>

    <div class="container">
        <div class="product-description">
            <?php //echo $page->technologies; ?>
            <div class="technologies">
                Технологии
            </div>
            <div class="lenta">
                <br/>

                <?php foreach ($technologies as $techn) { ?>
                    <?php $pagei = ORM::factory('information')->where('id', '=', $techn->value)->find(); ?>
                    <?php if (file_exists('.' . $pagei->image)) { ?>
                        <?php $sizes = ImageWork::getImageSize('.' . $pagei->image, '100', '100', '100', '100'); ?>
                        <?php if ($pagei->image != '') { ?>
                            <div class="category-image-technologies-information">
                                <?php $category = ORM::factory('information')->where('id', '=', $pagei->parent_id)->find(); ?>
                                <a href="/information/<?php echo strtolower(FrontHelper::transliterate($category->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($techn->name)); ?>">
                                    <img src='<?php echo $pagei->image; ?>' width='<?php echo $sizes['newwidth']; ?>'
                                         height='<?php echo $sizes['newheight']; ?>'
                                         style="margin-top:<?php echo (102 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (102 - $sizes['newheight']) / 2; ?>px;"/>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

            </div>
            <?php $options = ORM::factory('options')->where('type', '=', 'products')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
            <?php if (count($options) > 0) { ?>
                <div class="technologies">
                    Аксессуары к товару
                </div>
                <br/>
                <ul class="bxslider">

                    <?php $access = array_chunk($options, 3);
                    for ($i = 0; $i < count($access); $i++) {
                        ?>
                        <li>
                            <?php for ($j = 0; $j < count($access[$i]); $j++) { ?>
                                <?php $image_related = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $access[$i][$j]->value)->find(); ?>
                                <?php $image = ORM::factory('images')->where('id_image', '=', $image_related->value)->find(); ?>
                                <?php $related_product = ORM::factory('catalog')->where('id', '=', $access[$i][$j]->value)->find(); ?>
                                <?php if (isset($image->id_image)) { ?>

                                    <div class="related-product">
                                        <div class="product-name">
                                            <?php echo $related_product->name; ?>
                                        </div>
                                        <div class="related-product-image">
                                            <?php if (file_exists('.' . $image->path)) { ?>
                                                <?php $sizes = ImageWork::getImageSize('.' . $image->path, '240', '240', '240', '240'); ?>
                                                <?php if ($image->path != '') { ?>
                                                    <img src='<?php echo $image->path; ?>'
                                                         width='<?php echo $sizes['newwidth']; ?>'
                                                         height='<?php echo $sizes['newheight']; ?>'
                                                         style="margin-top:<?php echo (240 - $sizes['newheight']) / 2; ?>px;margin-left:<?php echo (240 - $sizes['newwidth']) / 2; ?>px;"/>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="product-price">
                                            <?php echo number_format($related_product->price, 0, ' ', ' '); ?> руб.
                                        </div>
                                        <div class="product-related-add"
                                             data-accessory="<?php echo $related_product->id; ?>"
                                             data-price="<?php echo $related_product->price; ?>">
                                            Добавить в комплектацию
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div class="reviews" style="clear:both">
                <div class="reviews-title">
                    ОТЗЫВЫ О ТОВАРЕ <a href="#review-form" class="fancybox-review">
                        <input type="button" class="button-reviews" value="НАПИСАТЬ"
                            />
                    </a>
                </div>
                <?php if (count($responses) > 0) { ?>
                    <div class="reviews-body">
                        <?php $count = 0; ?>
                        <?php foreach ($responses as $response) { ?>
                            <div class="clearboth overflowauto margin15">
                                <div class="review-user">
                                    <?php echo $response->name; ?> (<?php echo date('Y-m-d', $response->created); ?>)
                                </div>
                                <div class="raty<?php echo $count; ?> rating"></div>
                                <br/>

                                <div class="clearboth"><?php echo $response->response; ?></div>
                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        jQuery('.raty<?php echo $count; ?>').raty({
                                            'score': <?php echo $response->rating; ?>,
                                            readOnly: true,
                                            size: 23,
                                            starOff: '/images/star-empty.png',
                                            starOn: '/images/star-full.png'
                                        });
                                    });
                                </script>
                            </div>
                            <?php $count++; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <br/><br/>

    <div class="dn">
        <div id="review-form">
            <form action="/index/sendreview" id="review-formus" method="POST">
                <div class="resp">
                    <h3>Оставить отзыв</h3>

                    <div class="input-name">
                        <input type="text" id="response-name" class="name_call name-review" name="name"
                               placeholder="Имя">
                    </div>
                    <div class="input-phone">
                        <input type="text" id="response-email" class="name_phone email-review" name="email"
                               placeholder="Email">
                    </div>
                    <div class="input-review">
                        <textarea name="response" class="review-body" placeholder="Отзыв"></textarea>
                    </div>
                    <div class="raty"></div>
                    <div class="order-submit">
                        <input type="button" class="send-review green ways-call-submit" value="Отправить"
                               style="margin-left:0px">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="dn">
    <div class="review-success">
        <h3 style="width:315px">Ваш отзыв успешно отправлен!</h3>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {

    jQuery('.carouselfancy').fancybox();
    var order = {};

    order['grades'] = {};
    order['massages'] = {};
    <?php if($category_product->massage_on=='on') { ?>
    <?php if($category_product->type=='massage') { ?>
    order['massages'][<?php echo $gidromassage->id; ?>] = "<?php echo $gidromassage->price; ?>";
    <?php } ?>
    <?php } ?>
    <?php if($category_product->grade_on=='on') { ?>
    order['grades'][<?php echo $bath->id; ?>] = "<?php echo $bath->price; ?>";
    order['grades'][<?php echo $frame->id; ?>] = "<?php echo $frame->price; ?>";
    <?php } ?>
    order['accessories'] = {};
    $('.bxslider').bxSlider({autoControls: true});
    jQuery('.raty').raty({
        path: null,
        halfShow: false,
        starOff: '/images/star-empty.png',
        starOn: '/images/star-full.png'
    });
    jQuery('.fancybox-review').fancybox({
        'afterShow': function () {
            jQuery('.send-review').click(function () {
                var name = jQuery('.name-review').val();
                var email = jQuery('.email-review').val();
                var review = jQuery('.review-body').val();
                var score = jQuery('input[name=score]').val();
                var to = jQuery('.product-id').val();
                jQuery.post('/index/reviewsave', {name: name, email: email, rating: score, response: review, to: to}, function (response) {
                    if (response == 'saved') {
                        jQuery.fancybox.close();
                        jQuery.fancybox(jQuery('.review-success').html());
                    }
                });
            });
        }
    });
    jQuery('.switch-massage').click(function () {
        var display = jQuery('.massage-container .field').css('display');
        if (display == 'block') {
            jQuery(".massage-container .field").slideUp("slow", function () {
                jQuery('.switch-massage').html('(Раскрыть список)');
            });
        } else {
            jQuery(".massage-container .field").slideDown("slow", function () {
                jQuery('.switch-massage').html('(Скрыть список)');
            });
        }
    });
    jQuery('.add-grade').not('.required').click(function (e) {
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var e = jQuery(this);
        var grade = e.attr('data-grade');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить комплектацию');
            delete order['grades'][grade];
            globalprice = parseInt(globalprice) - parseInt(price);
        } else {
            e.parent().addClass('active');
            e.html('Убрать комплектацию');
            order['grades'][grade] = price;
            globalprice = parseInt(globalprice) + parseInt(price);
        }
        priceproduct.html(number_format(globalprice, 0, ' ', ' '));
        priceproduct.attr('data-value', globalprice);
    });
    jQuery('.product-related-add').click(function () {
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var e = jQuery(this);
        var accessory = e.attr('data-accessory');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить в комплектацию');
            delete order['accessories'][accessory];
            globalprice = parseInt(globalprice) - parseInt(price);
        } else {
            e.parent().addClass('active');
            e.html('Убрать из комплектации');
            order['accessories'][accessory] = price;
            globalprice = parseInt(globalprice) + parseInt(price);
        }
        priceproduct.html(number_format(globalprice, 0, ' ', ' '));
        priceproduct.attr('data-value', globalprice);
    });
//        jQuery('.order-button').click(function () {
//            var order_string = JSON.stringify(order);
//            jQuery.post('/index/writeorder', {order: order_string}, function (response) {
//                console.log(response);
//            });
//        });
    jQuery('.switch-gidro').click(function (event) {
        event.preventDefault();
        var is_active = jQuery('.gidro').css('display');
        if (is_active == 'block') {
            jQuery(".gidro").slideUp("slow", function () {
                jQuery('.switch-gidro').html('Раскрыть');
            });
        } else {
            jQuery(".gidro").slideDown("slow", function () {
                jQuery('.switch-gidro').html('Скрыть');
            });
        }
    });
    jQuery('.add-massage').click(function () {

        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var image_carousel = jQuery('.hidden-carousel-image').html();
        var big_image = jQuery('.hidden-carousel-image img');
        var carousel_big = jQuery('.carousel.carousel-stage ul');
        var carousel_small = jQuery('.carousel.carousel-navigation ul');
        var e = jQuery(this);
        var massage = e.attr('data-massage');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        var image = e.attr('data-image');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить опцию');
            delete order['massages'][massage];
            globalprice = parseInt(globalprice) - parseInt(price);
            carousel_small.children('.changed-image-small').html('');
            carousel_big.children('.changed-image-big').html('');
        } else {
            e.parent().addClass('active');
            e.html('Убрать опцию');
            order['massages'][massage] = price;
            globalprice = parseInt(globalprice) + parseInt(price);
            var check = jQuery('.changed-image-big').length;
            if (check == 1) {
                jQuery.post('/index/generateimages', {image: image}, function (response) {
                    var images = JSON.parse(response);
                    if (images['small'].length) {
                        carousel_small.children('.changed-image-small').html('');
                        carousel_small.children('.changed-image-small').html(images['small']);
                        //carousel_small.append(images['small']);
                    }
                    if (images['big'].length) {
                        carousel_big.children('.changed-image-big').html('');
                        carousel_big.children('.changed-image-big').html(images['big']);
                    }
                    jcarouselreload();
                });
            } else {
                jQuery.post('/index/generateimagesli', {image: image}, function (response) {
                    var images = JSON.parse(response);
                    if (images['small'].length) {
                        carousel_small.append(images['small']);
                    }
                    if (images['big'].length) {
                        carousel_big.append(images['big']);
                    }
                    jcarouselreload();
                });
            }
        }
        priceproduct.html(number_format(globalprice, 0, ' ', ' '));
        priceproduct.attr('data-value', globalprice);
    });
    jQuery('.massage-image').mouseover(function () {
        jQuery(this).children('.lookonthis').css('display', 'block');
    });
    jQuery('.massage-image').mouseout(function () {
        jQuery(this).children('.lookonthis').css('display', 'none');
    });
    jQuery('.lookonthis a').fancybox();
    jQuery('.order-form').fancybox({
        'afterShow': function () {
            jQuery('.fancy').fancybox({
                'beforeShow': function () {
                    jQuery.fancybox.update();
                    jQuery('.order-finish').val(JSON.stringify(order));
                }
            });
        }
    });
    jQuery('.grade-product .grade-item').mouseenter(function () {
        jQuery(this).css('background-color', 'rgb(227,239,244)');
    });
    jQuery('.grade-product .grade-item').mouseleave(function () {
        jQuery(this).css('background-color', 'white');
    });
    jQuery('.grade-product .grade-item').not('.required').click(function () {
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var e = jQuery(this).find('.add-grade');
        var grade = e.attr('data-grade');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить комплектацию');
            delete order['grades'][grade];
            globalprice = parseInt(globalprice) - parseInt(price);
        } else {
            e.parent().addClass('active');
            e.html('Убрать комплектацию');
            order['grades'][grade] = price;
            globalprice = parseInt(globalprice) + parseInt(price);
        }
        priceproduct.html(number_format(globalprice, 0, ' ', ' '));
        priceproduct.attr('data-value', globalprice);
    });
    jQuery('.massage-container .grade-item').mouseenter(function () {
        jQuery(this).addClass('active');
    });
    jQuery('.massage-container .grade-item').mouseleave(function () {
        jQuery(this).removeClass('active');
    });
    jQuery('.massage-container .grade-item').not('.required').click(function () {

        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var image_carousel = jQuery('.hidden-carousel-image').html();
        var big_image = jQuery('.hidden-carousel-image img');
        var carousel_big = jQuery('.carousel.carousel-stage ul');
        var carousel_small = jQuery('.carousel.carousel-navigation ul');
        var e = jQuery(this).find('.add-massage');
        var massage = e.attr('data-massage');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        var image = e.attr('data-image');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить опцию');
            delete order['massages'][massage];
            globalprice = parseInt(globalprice) - parseInt(price);
            carousel_small.children('.changed-image-small').html('');
            carousel_big.children('.changed-image-big').html('');
        } else {
            e.parent().addClass('active');
            e.html('Убрать опцию');
            order['massages'][massage] = price;
            globalprice = parseInt(globalprice) + parseInt(price);
            var check = jQuery('.changed-image-big').length;
            if (check == 1) {
                jQuery.post('/index/generateimages', {image: image}, function (response) {
                    var images = JSON.parse(response);
                    if (images['small'].length) {
                        carousel_small.children('.changed-image-small').html('');
                        carousel_small.children('.changed-image-small').html(images['small']);
                        //carousel_small.append(images['small']);
                    }
                    if (images['big'].length) {
                        carousel_big.children('.changed-image-big').html('');
                        carousel_big.children('.changed-image-big').html(images['big']);
                    }
                    jcarouselreload();
                });
            } else {
                jQuery.post('/index/generateimagesli', {image: image}, function (response) {
                    var images = JSON.parse(response);
                    if (images['small'].length) {
                        carousel_small.append(images['small']);
                    }
                    if (images['big'].length) {
                        carousel_big.append(images['big']);
                    }
                    jcarouselreload();
                });
            }
        }
        priceproduct.html(number_format(globalprice, 0, ' ', ' '));
        priceproduct.attr('data-value', globalprice);
    });
});

</script>
<div class="dn">
    <div id="order-ways">
        <h3>Выберите способ:</h3>
        <a href="#manufacturer-form" class="fancy"><input type="button" class="green big-green manufacturer"
                                                          value="У производителя"></a><br/>
        <a href="#oficial-form" class="fancy"><input type="button" class="green big-green oficial"
                                                     value="В офиц. интернет-магазине"><br/>
            <a href="#yourcity-form" class="fancy"><input type="button" class="green big-green yourcity"
                                                          value="В своем городе"><br/>
    </div>
</div>
<div class="dn">
    <div id="manufacturer-form">
        Производитель
    </div>
</div>
<div class="dn">
    <div id="oficial-form">
        Официальный интернет-магазин
    </div>
</div>
<div class="dn">
    <div id="yourcity-form">
        <form action="/orders/new" id="callback-form" method="POST">
            <div class="resp">
                <h3>Форма заказа</h3>

                <div class="input-name">
                    <input type="text" id="response-name1" class="name_call" name="name" placeholder="Имя">
                </div>
                <div class="input-phone">
                    <input type="text" id="response-phone1" class="name_phone" name="phone" placeholder="Телефон">
                </div>
                <div class="input-phone">
                    <input type="text" id="response-phone1" class="name_phone" name="email" placeholder="Email">
                </div>
                <input type="hidden" name="order" class="order-finish" value=""/>
                <input type="hidden" name="url" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"/>

                <div class="order-submit">
                    <input type="submit" class="order-button green ways-call-submit" value="Заказать"
                           style="margin-left:0px">
                </div>
            </div>
        </form>
    </div>
</div>




