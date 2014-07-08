<input type="hidden" class="product-id" value="<?php echo $page->id; ?>"/>
<input type="hidden" class="baseimage" value="<?php echo $baseemptyimage; ?>"/>
<h2><?php echo $page->name; ?></h2>
<?php $prodid = $page->id; ?>
<hr/>
<?php $count = count($related_images); ?>
<div class="connected-carousels">
    <div class="stage">
        <div class="carousel carousel-stage">
            <ul>
                <li><a href="<?php if(isset($mainimage)) echo $mainimage; else echo ''; ?>" class="carouselfancy "
                       rel="groupfancy"><?php echo FrontHelper::output($mainimage, 420, 400, 420, 400); ?></a>
                    <!--                <li><a href="--><?php //echo $baseemptyimage; ?><!--" class="carouselfancy"
                       rel="groupfancy"><?php echo FrontHelper::output($baseemptyimage, 420, 400, 420, 400); ?></a></li>-->
                <li><a href="<?php echo $baseimage; ?>" class="carouselfancy maincarousel"
                       rel="groupfancy"><?php echo FrontHelper::output($baseimage, 420, 400, 420, 400); ?></a></li>
                <?php foreach ($related_images as $rimage) { ?>
                    <?php if ($baseimageid != $rimage->id_image) { ?>
                        <?php if ($page->featured != $rimage->id_image) { ?>

                            <li><a href="<?php echo $rimage->path; ?>" class="carouselfancy"
                                   rel="groupfancy"><?php echo FrontHelper::output($rimage->path, 420, 400, 420, 400); ?>
                                    <input type="hidden" class="mainimage" value="<?php echo $rimage->path; ?>"/></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <p class="photo-credits">

        </p>
        <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
        <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
    </div>

    <div class="navigation">
        <?php if($count>3) { ?>
            <a href="#" class="prev prev-navigation">&lsaquo;</a>
            <a href="#" class="next next-navigation">&rsaquo;</a>
        <?php } ?>
        <div class="carousel carousel-navigation">
            <ul>
                <li class=""><?php if(isset($mainimage)) echo FrontHelper::outputRender($mainimage, 50, 50, 50, 50); else echo ""; ?></li>
                <!--                <li class="">-->
                <?php //echo FrontHelper::outputRender($baseemptyimage, 50, 50, 50, 50); ?><!--</li>-->
                <li class="maincarouselsmall"><?php echo FrontHelper::output($baseimage, 50, 50, 50, 50); ?></li>
                <?php //$options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
                <?php //if (count($options) > 0) { ?>
                <?php foreach ($related_images as $rimage) { ?>
                    <?php if ($baseimageid != $rimage->id_image) { ?>
                        <?php if ($page->featured != $rimage->id_image) { ?>
                            <li><?php echo FrontHelper::outputRender($rimage->path, 50, 50, 50, 50); ?></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php //} ?>
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
        <?php if ($page->leftright == 'on') { ?>
            <span class="leftchoise lrchoise"><img src="/images/left.png"/></span>
            <span class="rightchoise lrchoise active"><img src="/images/right.png"/></span>
        <?php } ?>
        <br/>

        <div class="information-title">
        </div>
        <div class="attributes">
            <div class="form-row">
                <?php $options = ORM::factory('options')->where('type', '=', 'directory')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
                <?php foreach ($options as $option) {
                    $directory = ORM::factory('directory')->where('id', '=', $option->name)->find();
                    $directory_value = ORM::factory('directory')->where('id', '=', $option->value)->find();
                    if ($directory->type == 'select') {
                        $dir_value = $directory_value->name;
                    } else {
                        $dir_value = $option->value;
                    }
                    ?>
                    <b><?php echo $directory->name; ?></b> : <?php echo $dir_value; ?><br/>
                <?php
                } ?>
                <?php $options = ORM::factory('options')->where('type', '=', 'custom')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
            </div>
            <div class="options">
                <div class="form-row">
                    <!--<b>Тип</b> : <?php
                    if ($page->type == 'angular') {
                        echo 'Угловая';
                    }
                    if ($page->type == 'rectangular') {
                        echo 'Прямоугольная';
                    }
                    if ($page->type == 'increased') {
                        echo 'Увеличенного объема';
                    }
                    ?><br/>-->
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
            <div class="order fixed">
                <a href="<?php echo $baseimage; ?>" class="order-image button buzz-out"
                   rel="groupfancy"><?php echo FrontHelper::output($baseimage, 50, 50, 50, 50); ?></a>
                <span class="your-order">Ваш заказ:</span><br/>
                <span class="floatleft"><?php echo $page->name; ?>
                    <?php if ($page->leftright == 'on') { ?>
                        <b><span class="leftright">(R)</span></b>
                    <?php } ?>
                </span>

                <span class="floatright block-price">
                    <?php $massage_price = 0; ?>
                    <?php if ($category_product->massage_on == 'on') { ?>
                        <?php if (count($gidromassage) > 0) { ?>
                            <?php if ($gidromassage['required'] == '1') { ?>
                                <?php $massage_price = $gidromassage['price']; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($category_product->grade_on == 'on') { ?>
                        <?php $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
                        <?php $grade_price = 0; ?>

                        <?php foreach ($options as $option) {
                            $grade_opt = json_decode($option->value);
                            $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find();
                            if (isset($grade_opt[2])) {
                                if (($grade_opt[2] == 1) || ($grade_opt[1] == 1)) {
                                    $grade_price += $grades->price;
                                }
                            }
                        } ?>
                        <?php
                        if (isset($grade_price)) {
                            if (count($options) > 0) {
                                $priceglobal = $massage_price + $grade_price;
                            } else {
                                $priceglobal = $product->price;
                            }
                        } else {
                            $priceglobal = $product->price;
                        } ?>
                        <span class="global-price"
                              data-value="<?php echo $priceglobal; ?>"><?php echo number_format((double)$priceglobal, 0, ' ', ' '); ?>
                            руб.</span>
                        <br/>
                    <?php } else { ?>
                        <span class="global-price"
                              data-value="<?php echo $page->price; ?>"><?php echo number_format((double)$page->price, 0, ' ', ' '); ?>
                            руб.</span>
                    <?php } ?>
                    <span class="order-details-show" style="display:none"> Просмотреть заказ</span>
                    <a href="#order-ways" class="order-form">
                        <span class="order-button"> Заказать</span>
                    </a>
                </span>

                <div class="clearboth order-details" style="display:none">
                    <span class="floatleft accessory"></span>

                    <div class="grade-details-header"><b>Комплектация</b></div>
                    <div class="grade-details"></div>
                    <div class="massage-details-header"><b>Массажные опции</b></div>
                    <div class="massage-details"></div>
                    <div class="accessory-details-header"><b>Аксессуары</b></div>
                    <div class="accessory-details"></div>
                </div>
            </div>
        </div>
        <br/>
    </div>
</div>

<?php if ($category_product->grade_on == 'on') { ?>
    <?php $bath_id = ''; ?>
    <div class="grade-product">
        <?php $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>
        <?php if ((count($options) > 0) || (isset($bath->name))) { ?>
        <div class="grade-title">В комплектацию входит</div>

        <?php if (isset($bath->name)) { ?>
            <?php $bath_id = $bath->id; ?>
            <div class="grade-item required">
                <div class="grade-first-col">
                    <div class="grade-image">
                        <img src="<?php echo $bath->image; ?>">
                    </div>
                    <div class="grade-name">
                        <?php echo $bath->name; ?>                    </div>
                </div>
                <div class="grade-second-col">
                    <div class="grade-price active padding415 required" style="padding: 15px 15px;">
                                        <span class="grade-price-value" data-grade="<?php echo $bath->id; ?>"
                                              rel="<?php echo $bath->price; ?>"><?php echo number_format((double)$bath->price, 0, ' ', ' '); ?>
                                            руб.</span>
                        <br>
                    </div>
                </div>
            </div>
        <?php } ?>



        <div class="field" style="text-align:left;">
            <?php foreach ($options as $option) {
                $grade_opt = json_decode($option->value);

                if ($grade_opt[0] != $bath_id) {
                    $grades = ORM::factory('grade')->where('id', '=', $grade_opt[0])->find(); ?>
                    <div class="grade-item <?php if (isset($grade_opt[2])) {
                        if ($grade_opt[2] == '1') {
                            ?>
                    <?php if ($grade_opt[1] == '1') { ?>
                    required
                        <?php } ?>
                <?php
                        }
                    } ?>">
                        <div class="grade-first-col">
                            <div class="grade-image">
                                <img src="<?php echo $grades->image; ?>"/>
                            </div>
                            <div class="grade-name">
                                <?php echo $grades->name; ?>
                            </div>
                        </div>
                        <div class="grade-second-col">
                            <div class="grade-price <?php if (isset($grade_opt[2])) {
                                if ($grade_opt[2] == '1') {
                                    echo 'active';
                                }
                            }  ?> padding415 <?php if (isset($grade_opt[2])) {
                                if ($grade_opt[2] == '1') {
                                    ?>
                    <?php if ($grade_opt[1] == '1') { ?>
                    required
                        <?php } ?>
                <?php
                                }
                            } ?>">
            <span class="grade-price-value"
                  rel="<?php echo $grades->price; ?>"><?php echo number_format((double)$grades->price, 0, ' ', ' '); ?>
                руб.</span>
                                <br/>
        <span class="add-grade" data-grade="<?php echo $grades->id; ?>"
              data-price="<?php echo $grades->price; ?>" data-image="<?php echo $grades->image; ?>">
            <?php if (isset($grade_opt[2])) {
                if ($grade_opt[2] == '1') {
                    ?>
                    <?php if ($grade_opt[1] != '1') { ?>
                        Убрать комплектацию
                    <?php } ?>
                <?php } else { ?>
                    Добавить комплектацию
                <?php
                }
            } ?>
                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</div>
</div>
<?php if ($category_product->massage_on == 'on') { ?>
    <div class="boxed-area blocks-spacer">
        <div class="container inner-narrow">
            <div class="massage-container">
                <div class="massage-title">
                    <span class="massage-title-inner">МАССАЖНЫЕ ОПЦИИ</span>
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
                <?php if (count($gidromassage) > 0) { ?>
                    <?php if ($gidromassage['required'] == '1') {
                        $class_required = 'required';
                    } else {
                        $class_required = '';
                    } ?>

                    <div class="grade-item gidromassage <?php echo $class_required; ?>">
                        <div class="grade-first-col">
                            <?php $image = ORM::factory('images')->where('id_image', '=', $gidromassage['image'])->find(); ?>
                            <?php $gidrooption = ORM::factory('massage')->where('id', '=', $gidromassage['option_id'])->find(); ?>
                            <?php $gidroimage = $image->path; ?>
                            <div class="massage-image" data-image="<?php echo $gidroimage; ?>">
                                <img src="<?php echo $gidrooption->image; ?>">

                                <div class="lookonthis"><a href="<?php echo $image->path; ?>">Посмотреть</a></div>
                            </div>

                            <div class="massage-info">
                                <div class="grade-name">
                                    <?php echo $gidrooption->name; ?>
                                </div>
                                <div class="massage-descr">
                                    <?php echo FrontHelper::maxsite_str_word($gidrooption->description, 40); ?>...
                                    <?php if ($gidromassage['forsun'] != '') { ?>
                                        <br/>
                                        <div><b>Форсунок</b>: <?php echo $gidromassage['forsun']; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="grade-second-col">
                            <?php if ($gidromassage['required'] == '1') {
                                $class = "active";
                            } else {
                                $class = "";
                            } ?>
                            <div class="grade-price <?php echo $class; ?> first">
                                <span class="grade-price-value"
                                      rel="<?php echo $gidromassage['price']; ?>"><?php echo number_format($gidromassage['price'], 0, ' ', ' '); ?>
                                    руб.</span><br/>
                                <?php if ($gidromassage['required'] != '1') { ?>
                                    <span class="add-massage" data-massage="<?php echo $gidromassage['option_id']; ?>"
                                          data-price="<?php echo $gidromassage['price']; ?>"
                                          data-image="<?php echo $gidromassage['image']; ?>">Добавить опцию</span>
                                <?php } else { ?>
                                    <span class="add-massage" data-massage="<?php echo $gidromassage['option_id']; ?>"
                                          data-price="<?php echo $gidromassage['price']; ?>"
                                          data-image="<?php echo $gidromassage['image']; ?>">Убрать опцию</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="gidro" style="display:block">
                        <?php foreach ($underoptions as $underoption) { ?>
                            <?php $image = ORM::factory('images')->where('id_image', '=', $underoption['image'])->find(); ?>
                            <?php $gidrooption = ORM::factory('massage')->where('id', '=', $underoption['option_id'])->find(); ?>
                            <?php $underimage = $image->path; ?>
                            <div class="grade-item gidrooption">
                                <div class="grade-first-col massage-special">
                                    <div class="massage-image" data-image="<?php echo $underimage; ?>">
                                        <img src="<?php echo $gidrooption->image; ?>">

                                        <div class="lookonthis"><a href="<?php $image->path; ?>">Посмотреть</a>
                                        </div>
                                    </div>

                                    <div class="massage-info">
                                        <div class="grade-name">
                                            <?php echo $gidrooption->name; ?>
                                            <!--(<span class="switch-gidro">Раскрыть</span>)-->
                                        </div>
                                        <div class="massage-descr">
                                            <?php echo FrontHelper::maxsite_str_word($gidrooption->description, 40); ?>
                                            ...
                                            <?php if ($underoption['forsun'] != '') { ?>
                                                <br/>
                                                <div><b>Форсунок</b>: <?php echo $underoption['forsun']; ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="grade-second-col massage-special-price">
                                    <div class="grade-price first">
                                <span class="grade-price-value"
                                      rel="<?php echo $underoption['price']; ?>"><?php echo number_format($underoption['price'], 0, ' ', ' '); ?></span>
                                        руб.<br/>
                            <span class="add-massage" data-massage="<?php echo $underoption['option_id']; ?>"
                                  data-price="<?php echo $underoption['price']; ?>"
                                  data-image="<?php echo $underoption['image']; ?>">Добавить опцию</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php foreach ($othersoptions as $option) {
                //$option = json_decode($option->value);
                $massage = ORM::factory('massage')->where('id', '=', $option['option_id'])->find();
                $image = ORM::factory('images')->where('id_image', '=', $option['image'])->find();
                ?>
                <div class="grade-item <?php if ($massage->electronic == 'on') {
                    echo 'electronic';
                } ?>">
                    <div class="grade-first-col">
                        <div class="massage-image" data-image="<?php echo $image->path; ?>">
                            <img src="<?php echo $massage->image; ?>"/>

                            <div class="lookonthis"><a href="<?php echo $image->path; ?>">Посмотреть</a></div>
                        </div>
                        <div class="massage-info">
                            <div class="grade-name">
                                <?php echo $massage->name; ?>
                            </div>
                            <div class="massage-descr">
                                <?php echo FrontHelper::maxsite_str_word($massage->description, 40); ?>...
                                <?php if ($option['forsun'] != '') { ?>
                                    <br/>
                                    <div><b>Форсунок</b>: <?php echo $option['forsun']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="grade-second-col">
                        <div class="massage-price padding415" <?php if ($massage->electronic == 'on') {
                            echo 'electronic';
                        } ?>">
                            <span class="massage-price-value"
                                  rel="<?php echo $option['price']; ?>"><?php echo number_format((double)$option['price'], 0, ' ', ' '); ?></span>
                        руб.
                        <br/>
                                <span class="add-massage" data-massage="<?php echo $option['option_id']; ?>"
                                      data-price="<?php echo $option['price']; ?>"
                                      data-image="<?php echo $option['image']; ?>">Добавить опцию</span>
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

            <div style="border: 1px solid rgb(204,204,204);padding:10px;">
                <div style="font-style: italic;text-transform: uppercase;font-size: 20px;">
                    Описание товара
                </div>
                <br/>
                <?php echo $page->description; ?>


            </div>
            <?php if ($page->scheme != '') { ?>
                <div class="product-downloads">
                    <!--                <a href="javascript:window.print()"><img src="/images/print.png"/></a>-->
                    <a href="/<?php echo $page->scheme; ?>" class="width32"><img src="/images/download.png"/>
                        Схема монтажа
                    </a>
                </div>
            <?php } ?>
            <?php if ($page->instruction != '') { ?>
                <div class="product-downloads">
                    <a href="/<?php echo $page->instruction; ?>" class="width32"><img src="/images/download.png"/>
                        Инструкция по эксплуатации
                    </a>
                </div>
            <?php } ?>
            <?php if ($page->passport != '') { ?>
                <div class="product-downloads">
                    <a href="/<?php echo $page->passport; ?>" class="width32"><img src="/images/download.png"/>
                                                Инструкция по сборке рамы
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <br/><br/>

    <div class="container">
        <div class="product-description">
            <?php //echo $page->technologies; ?>
            <?php if (count($technologies) > 0) { ?>
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
                                    <a href="/information/<?php echo strtolower(FrontHelper::transliterate($category->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($pagei->name)); ?>">
                                        <img src='<?php echo $pagei->image; ?>'
                                             width='<?php echo $sizes['newwidth']; ?>'
                                             height='<?php echo $sizes['newheight']; ?>'
                                             style="margin-top:<?php echo (102 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (102 - $sizes['newheight']) / 2; ?>px;"/>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
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
                                <?php $image_related = ORM::factory('catalog')->where('id', '=', $access[$i][$j]->value)->find(); ?>
                                <?php $image = ORM::factory('images')->where('id_image', '=', $image_related->featured)->find(); ?>
                                <?php $related_product = ORM::factory('catalog')->where('id', '=', $access[$i][$j]->value)->find(); ?>
                                <?php if (isset($image->id_image)) { ?>

                                    <div class="related-product">
                                        <div class="product-name">
                                            <a target="_blank"
                                               href="/catalog/<?php echo strtolower(FrontHelper::transliterate($category_product->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($related_product->name)); ?>"><?php echo $related_product->name; ?></a>
                                            <?php //echo $related_product->name; ?>
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
                                            <?php echo number_format((int)$related_product->price, 0, ' ', ' '); ?> руб.
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
var order_place = {

    detailsButton: jQuery('.order-details-show'),
    order: {},
    gradesCount: 0,
    massageCount: 0,
    accessoryCount: 0,
    gradeHeader: jQuery('.grade-details-header'),
    massageHeader: jQuery('.massage-details-header'),
    accessoryHeader: jQuery('.accessory-details-header'),
    visibleGrade: 'none',
    visibleMassage: 'none',
    visibleAccessory: 'none',

    //init on document ready
    init: function (order) {
        this.order = order;
        this.initializationVars();
        this.placeGrade();
        this.placeMassage();
        this.placeAccessories();
        this.removeUnwanted();
    },

    //switch headers in order place
    switchHeaders: function (order) {
        this.order = order;
        this.initializationVars();
        this.removeUnwanted();
    },

    //init count options vars
    initializationVars: function () {
        this.gradesCount = Object.keys(this.order.grades).length;
        this.massageCount = Object.keys(this.order.massages).length;
        this.accessoryCount = Object.keys(this.order.accessories).length;
    },

    buttonSwitch: function (order) {
        this.order = order;
        this.initializationVars();
        this.switchButton();
    },

    //place grades into orders
    placeGrade: function () {
        jQuery.each(this.order.grades, function (index, value) {
            var name = jQuery('[data-grade=' + index + ']').parents('.grade-item').find('.grade-name').html();
            var image = jQuery('[data-grade=' + index + ']').parents('.grade-item').find('.grade-image').html();
            jQuery('.order .grade-details').append("<span class='order-grade floatleft' data-id='" + index + "'><span class='pl'>" + image + "</span>" + name + "</span>");
        });
    },

    //place massages into orders
    placeMassage: function () {
        jQuery.each(this.order.massages, function (index, value) {
            var name = jQuery('[data-massage=' + index + ']').parents('.grade-item').find('.grade-name').html();
            var image = jQuery('[data-massage=' + index + ']').parents('.grade-item').find('.massage-image').html();
            jQuery('.order .massage-details').append("<span class='order-massage floatleft' data-id='" + index + "'><span class='pl'>" + image + "</span>" + name + "</span>");
        });
    },

    // place accessories into orders
    placeAccessories: function () {
        jQuery.each(this.order.accessories, function (index, value) {
            var name = jQuery('[data-accessory=' + index + ']').parents('.massage-item').find('.grade-name').html();
            var image = jQuery('[data-grade=' + index + ']').parents('.related-product').find('.related-product-image').html();
            console.log(image);
            jQuery('.order .accessory-details').append("<span class='order-accessory floatleft' data-id='" + index + "'><span class='pl'>" + image + "</span>" + name + "</span>");
        });
    },

    //switch details show button
    switchButton: function () {
        if ((this.gradesCount > 0) || (this.massageCount > 0) || (this.accessoryCount > 0))
            this.detailsButton.css('display', 'block');
        else
            this.detailsButton.css('display', 'none');
    },

    //remove unwanted headers into orders
    removeUnwanted: function (order) {
        if (this.gradesCount != 0) this.visibleGrade = 'block'; else this.visibleGrade = 'none';
        if (this.massageCount != 0) this.visibleMassage = 'block'; else this.visibleMassage = 'none';
        if (this.accessoryCount != 0) this.visibleAccessory = 'block'; else this.visibleAccessory = 'none';

        this.gradeHeader.css('display', this.visibleGrade);
        this.massageHeader.css('display', this.visibleMassage);
        this.accessoryHeader.css('display', this.visibleAccessory);
    }
}


$(document).ready(function () {

    jQuery('.order-details-show').click(function () {
        var vis = jQuery('.order-details').css('display');
        if (vis == 'none') {
            jQuery('.order-details').slideDown();
            jQuery(this).html(' Скрыть заказ');
        } else {
            jQuery('.order-details').slideUp();
            jQuery(this).html(' Посмотреть заказ');
        }
    });
    jQuery('.carouselfancy').fancybox({'beforeShow': function () {
        jQuery('.fancybox-wrap').addClass('certif-fancybox');
    }});
    jQuery('.order-image').fancybox({
        'beforeShow': function () {
            jQuery('.fancybox-wrap').addClass('certif-fancybox');
            if(jQuery('.lrchoise.leftchoise').hasClass('active')) {
                jQuery('.fancybox-image').addClass('reflection');
            }
        }
    });
    var order = {};

    order['grades'] = {};
    order['lr'] = 'right';
    order['massages'] = {};
    <?php if($category_product->massage_on=='on') { ?>
    <?php if(count($gidromassage)>1) { ?>
    <?php if ($gidromassage['required'] == '1') { ?>
    order['massages'][<?php echo $gidromassage['option_id']; ?>] = "<?php echo $gidromassage['price']; ?>";
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php if($category_product->grade_on=='on') { ?>
    <?php if(isset($bath->id)) { ?>
    order['grades'][<?php echo $bath->id; ?>] = "<?php echo $bath->price; ?>";
    <?php } ?>
    <?php $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $page->id)->find_all()->as_array(); ?>

    <?php foreach ($options as $option) {
        $grade_opt = json_decode($option->value);
        if(isset($grade_opt[2])) {
        if($grade_opt[2]=='1') { ?>
    order['grades'][<?php echo $grade_opt[0]; ?>] = "0";
    <?php }
}
    }
} ?>
    order['accessories'] = {};
    order_place.init(order);
    order_place.buttonSwitch(order);
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

    jQuery('.product-related-add').click(function () {
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var e = jQuery(this);
        var name = jQuery.trim(e.parent().find('.product-name').html());
        var accessory = e.attr('data-accessory');
        var image = jQuery('[data-accessory=' + accessory + ']').parents('.related-product').find('.related-product-image').html();
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить в комплектацию');
            delete order['accessories'][accessory];
            jQuery('.order-accessory[data-id=' + accessory + ']').remove();
            globalprice = parseInt(globalprice) - parseInt(price);
        } else {
            e.parent().addClass('active');
            e.html('Убрать из комплектации');
            order['accessories'][accessory] = price;
            jQuery('.order .accessory-details').append("<span class='order-accessory floatleft' data-id='" + accessory + "'><span class='pl'>" + image + "</span>" + name + "</span>");
            globalprice = parseInt(globalprice) + parseInt(price);
        }
        order_place.buttonSwitch(order);
        order_place.switchHeaders(order);
        priceproduct.html(number_format(globalprice, 0, ' ', ' ') + ' руб.');
        priceproduct.attr('data-value', globalprice);
    });

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

    jQuery('.massage-image').mouseover(function () {
        jQuery(this).children('.lookonthis').css('display', 'block');
    });

    jQuery('.massage-image').mouseout(function () {
        jQuery(this).children('.lookonthis').css('display', 'none');
    });

    jQuery('.lookonthis a').fancybox();

    jQuery('.order-form').fancybox({
        'beforeShow': function () {
            jQuery('.fancybox-wrap').addClass('certif-fancybox');
        },
        'afterShow': function () {
            jQuery('.fancy').fancybox({
                'beforeShow': function () {
                    jQuery('.fancybox-wrap').addClass('certif-fancybox');
                    jQuery.fancybox.update();
                    jQuery('.order-finish').val(JSON.stringify(order));
                }
            });
        }
    });
    jQuery('.grade-product .grade-item').mouseenter(function () {
        jQuery(this).css('background-color', 'rgb(227,239,244)');
        jQuery(this).find('.add-grade').css('text-decoration', 'underline');
        jQuery(this).find('.add-grade').css('color', '#00becc');
    });

    jQuery('.grade-product .grade-item').mouseleave(function () {
        jQuery(this).css('background-color', 'white');
        jQuery(this).find('.add-grade').css('text-decoration', 'none');
        jQuery(this).find('.add-grade').css('color', 'rgb(189,189,189)');
    });

    jQuery('.grade-product .grade-item').not('.required').not('.grade-price').not('.first').click(function (e) {
        var className = e.target.className;

        if ((className !== 'add-grade') && (className !== 'grade-price-value') && (className !== 'grade-price padding415 active')) {
            var priceproduct = jQuery('.global-price')
            var globalprice = priceproduct.attr('data-value');
            var e = jQuery(this).find('.add-grade');
            var name = jQuery.trim(e.parents('.grade-item').find('.grade-name').html());
            var grade = e.attr('data-grade');
            var image = jQuery('[data-grade=' + grade + ']').parents('.grade-item').find('.grade-image').html();
            var price = e.attr('data-price');
            var hasActive = e.parent().hasClass('active');

            if (hasActive) {
                e.parent().removeClass('active');
                e.html('Добавить комплектацию');
                delete order['grades'][grade];
                jQuery('.order-grade[data-id=' + grade + ']').remove();
                globalprice = parseInt(globalprice) - parseInt(price);
            } else {
                e.parent().addClass('active');
                e.html('Убрать комплектацию');
                order['grades'][grade] = price;
                jQuery('.order .grade-details').append("<span class='order-grade floatleft' data-id='" + grade + "'><span class='pl'>" + image + "</span>" + name + "</span>");
                globalprice = parseInt(globalprice) + parseInt(price);
            }
            order_place.buttonSwitch(order);
            order_place.switchHeaders(order);
            priceproduct.html(number_format(globalprice, 0, ' ', ' ') + ' руб.');
            priceproduct.attr('data-value', globalprice);
        }
    });
    jQuery('.grade-price').not('.required').not('.first').click(function (e) {
        console.log('------');
        console.log(e.target.className);
        console.log('------');
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var e = jQuery(this).find('.add-grade');
        var name = jQuery.trim(e.parents('.grade-item').find('.grade-name').html());
        var grade = e.attr('data-grade');
        var image = jQuery('[data-grade=' + grade + ']').parents('.grade-item').find('.grade-image').html();
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');

        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить комплектацию');
            delete order['grades'][grade];
            jQuery('.order-grade[data-id=' + grade + ']').remove();
            globalprice = parseInt(globalprice) - parseInt(price);
        } else {

            e.parent().addClass('active');
            e.html('Убрать комплектацию');
            order['grades'][grade] = price;
            jQuery('.order .grade-details').append("<span class='order-grade floatleft' data-id='" + grade + "'><span class='pl'>" + image + "</span>" + name + "</span>");
            globalprice = parseInt(globalprice) + parseInt(price);

        }
        order_place.buttonSwitch(order);
        order_place.switchHeaders(order);
        priceproduct.html(number_format(globalprice, 0, ' ', ' ') + ' руб.');
        priceproduct.attr('data-value', globalprice);
        //alert(hasActive);
        //$('.grade-item').unbind('click');
    });
    jQuery('.massage-container .grade-item').mouseenter(function () {
        jQuery(this).addClass('active');
        jQuery(this).find('.add-massage').css('text-decoration', 'underline');
        jQuery(this).find('.add-massage').css('color', '#00becc');
    });
    jQuery('.massage-container .grade-item').mouseleave(function () {
        jQuery(this).removeClass('active');
        jQuery(this).find('.add-massage').css('text-decoration', 'none');
        jQuery(this).find('.add-massage').css('color', 'rgb(189,189,189)');
    });
    jQuery('.massage-container .grade-item').click(function (e) {
        var className = e.target.className;
        var mainimage = jQuery('.baseimage').val();
        var isElectronic = jQuery(this).hasClass('electronic');
        var product_id = jQuery('.product-id').val();
        var priceproduct = jQuery('.global-price')
        var globalprice = priceproduct.attr('data-value');
        var image_carousel = jQuery('.hidden-carousel-image').html();
        var big_image = jQuery('.hidden-carousel-image img');
        var carousel_big = jQuery('.carousel.carousel-stage ul');
        var carousel_small = jQuery('.carousel.carousel-navigation ul');
        var e = jQuery(this).find('.add-massage');
        var name = jQuery.trim(e.parents('.grade-item').find('.grade-name').html());
        var checkgidrooption = jQuery(this).hasClass('gidrooption');
        var checkgidromassage = jQuery('.gidromassage .grade-price').hasClass('active');
        var gidromassage_price = jQuery('.gidromassage .grade-price');
        var gidromassage_name = jQuery('.gidromassage .grade-name').html();
        var gidromassage_image = jQuery('.gidromassage .massage-image').html();
        var gidromassage = jQuery('.gidromassage .add-massage');
        var gidroprice = gidromassage.attr('data-price');
        var gidromas = gidromassage.attr('data-massage');
        var massage = e.attr('data-massage');
        var price = e.attr('data-price');
        var hasActive = e.parent().hasClass('active');
        var image_small = jQuery('[data-massage=' + massage + ']').parents('.grade-item').find('.massage-image').html();
        var image = e.attr('data-image');
        if (checkgidrooption == true) {
            if (checkgidromassage != true) {
                gidromassage_price.addClass('active');
                gidromassage.html('Убрать опцию');
                order['massages'][gidromas] = gidroprice;
                jQuery('.order-massage[data-id=' + gidromas + ']').remove();
                globalprice = parseInt(globalprice) + parseInt(gidroprice);
            }
        }
        if (hasActive) {
            e.parent().removeClass('active');
            e.html('Добавить опцию');
            if (jQuery(this).hasClass('gidromassage') == true) {
                if (jQuery('.gidro .gidrooption .grade-price').hasClass('active')) {
                    jQuery('.gidro .gidrooption .grade-price.active').each(function (index) {
                        var elem = jQuery(this).find('.add-massage');
                        var elemmassage = elem.attr('data-massage');
                        var elemprice = elem.attr('data-price');
                        jQuery('.order-massage[data-id=' + elemmassage + ']').remove();
                        delete order['massages'][elemmassage];
                        globalprice = parseInt(globalprice) - parseInt(elemprice);
                        priceproduct.html(number_format(globalprice, 0, ' ', ' ') + ' руб.');
                        priceproduct.attr('data-value', globalprice);
                    });
                    jQuery('.gidro .gidrooption .grade-price').removeClass('active');
                }
            }
            delete order['massages'][massage];
            jQuery('.order-massage[data-id=' + massage + ']').remove();
            globalprice = parseInt(globalprice) - parseInt(price);
            carousel_small.children('.changed-image-small').html('');
            carousel_big.children('.changed-image-big').html('');
        } else {
            e.parent().addClass('active');
            e.html('Убрать опцию');
            order['massages'][massage] = price;
            if (jQuery('.order-massage[data-id=' + gidromas + ']').length == 0) {
                jQuery('.order .massage-details').append("<span class='order-massage floatleft' data-id='" + gidromas + "'><span class='pl'>" + gidromassage_image + "</span>" + gidromassage_name + "</span>");
            }
            if (massage != gidromas)
                jQuery('.order .massage-details').append("<span class='order-massage floatleft' data-id='" + massage + "'><span class='pl'>" + image_small + "</span>" + name + "</span>");
            globalprice = parseInt(globalprice) + parseInt(price);

            var check = jQuery('.changed-image-big').length;
            if (check == 1) {
                jQuery.post('/index/generateimages', {image: image, electronic: isElectronic}, function (response) {
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
                jQuery.post('/index/generateimagesli', {image: image, electronic: isElectronic}, function (response) {
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
        order_place.buttonSwitch(order);
        order_place.switchHeaders(order);
        priceproduct.html(number_format(globalprice, 0, ' ', ' ') + ' руб.');
        priceproduct.attr('data-value', globalprice);

        var resp_order = JSON.stringify(order);
        jQuery.post('/index/generatesimages', {id: product_id, image: mainimage, order: resp_order, electronic: isElectronic}, function (response) {

            var images = jQuery.parseJSON(response);

            var mainimage = images[0];
            var thumb = images[1];

            jQuery('.order-image').css('display', 'none');
            jQuery('.order-image').attr('href', images[0]);

            jQuery('.order-image').html(images[1]);
            jQuery('.maincarousel').html(images[2]);
            jQuery('.maincarousel').attr('href', images[0]);
            jQuery('.maincarouselsmall').html(images[1]);
            jQuery('.order-image').css('display', 'block');
            jQuery('.order-image').addClass('buzz-out');
            setTimeout(function () {
                jQuery('.order-image').removeClass('buzz-out');
            }, 1000)
        });
        $('.carousel-stage').jcarousel('scroll', 1, true);
    });
    jQuery('.gidro .grade-item').click(function () {

        if (!jQuery('.gidromassage .grade-price').hasClass('active')) {
            jQuery(this).addClass('active');
            var priceproduct = jQuery('.global-price');
            var globalprice = priceproduct.attr('data-value');
            var e = jQuery(this).find('.add-massage');
            var massage = e.attr('data-massage');
            var price = e.attr('data-price');
            e.parent().addClass('active');
            e.html('Убрать опцию');
            order['massages'][massage] = price;
            order_place.buttonSwitch(order);
            order_place.switchHeaders(order);
            globalprice = parseInt(globalprice) + parseInt(price);
        }
    });
    jQuery('.lrchoise').click(function () {
        jQuery('.lrchoise').removeClass('active');
        if (jQuery(this).hasClass('leftchoise')) {
            var type_lr = 'left';
            jQuery('.order img').addClass('reflection');
            jQuery('.order-image').addClass('reflection');
            jQuery('.connected-carousels img').addClass('reflection');
            var mes = '(L)';
        } else {
            var type_lr = 'right';
            var mes = '(R)';
            jQuery('.order img').removeClass('reflection');
            jQuery('.order-image').removeClass('reflection');
            jQuery('.connected-carousels img').removeClass('reflection');
        }
        jQuery('.leftright').html(mes);
        order['lr'] = type_lr;
        jQuery(this).addClass('active');
    });

    $("#callback-form").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });


});


function redirect() {
    window.location = '<?php echo $page->manufacturer; ?>';
}

</script>
<div class="dn">
    <div id="order-ways">
        <h3>Выберите способ:</h3>
        <!--        <a href="#manufacturer-form" class="fancy"><input type="button" class="green big-green manufacturer"-->
        <!--                                                          value="У производителя"></a><br/>-->
        <a href="#yourcity-form" class="fancy"><input type="button" class="green big-green manufacturer"
                                                      value="У производителя" style="width:300px"></a><br/>
        <?php if ($page->manufacturer != '') { ?>
            <span onclick="redirect()"><input type="button" class="green big-green oficial"
                                              value="В офиц. интернет-магазине" style="width:300px"></span>
        <?php } ?>
        <br/>
        <a href="#yourcity-form" class="fancy"><input type="button" class="green big-green yourcity"
                                                      value="В своем городе" style="width:300px"><br/>
            <a href="javascript:window.print()" class="fancyaa"><input type="button" class="green big-green yourcity"
                                                                       value="Распечатать товар"
                                                                       style="width:300px"><br/>
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
        <form action="/orders" id="callback-form" method="POST">
            <div class="resp">
                <h3>Форма заказа</h3>

                <div class="input-name">
                    <input type="text" id="response-name1" class="name_call" name="name" placeholder="Имя" required>
                </div>
                <div class="input-phone">
                    <input type="text" id="response-phone1" class="name_phone" name="phone" placeholder="Телефон"
                           required>
                </div>
                <div class="input-phone">
                    <input type="text" id="response-phone1" id="email" class="name_phone" name="email"
                           placeholder="Email"
                           email>
                </div>
                <div class="input-name">
                    <input type="text" id="response-phone11" class="name_phone" name="city" placeholder="Город"
                           required>
                </div>
                <input type="hidden" name="order" class="order-finish" value=""/>
                <input type="hidden" name="productid" class="rder-finish" value="<?php echo $prodid; ?>"/>
                <input type="hidden" name="url" value="<?php //echo $_SERVER['HTTP_REFERER']; ?>"/>

                <div class="order-submit">
                    <input type="submit" class="order-button green ways-call-submit" value="Заказать"
                           style="margin-left:0px">
                </div>
            </div>
        </form>
    </div>
</div>




