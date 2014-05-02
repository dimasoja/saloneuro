<?php require_once('header.php'); ?>
<?php
function transliterate($string) {
    $roman = array("Sch", "sch", 'Yo', 'Zh', 'Kh', 'Ts', 'Ch', 'Sh', 'Yu', 'ya', 'yo', 'zh', 'kh', 'ts', 'ch', 'sh', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', '', 'Y', '', 'E', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', '', 'y', '', 'e','_');
    $cyrillic = array("Щ", "щ", 'Ё', 'Ж', 'Х', 'Ц', 'Ч', 'Ш', 'Ю', 'я', 'ё', 'ж', 'х', 'ц', 'ч', 'ш', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ь', 'Ы', 'Ъ', 'Э', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ь', 'ы', 'ъ', 'э',' ');
    return str_replace($cyrillic, $roman, $string);
}
?>
<div class="information">
<?php $city_geo = (array)$city; ?>
<?php $city_geo = $city[0]; ?>
<div class="geocity" style="display:none">
    <?php echo $city_geo; ?>
</div>
<div class="darker-stripe blocks-spacer more-space latest-news with-shadows">
    <div class="bread-center">
        <?php echo $breadcrumbs; ?>
    </div>
</div>
<div class="with-borders">
    <div class="oncenter">

    </div>
</div>
<div class="common">
    <div class="container">
        <div class="rightblock">
            <div class="category-right-wrapper">
                <div class="wheretobuyblock">
                    <div class="aqua-header">Полезная информация</div>
                    <br/>

                    <div class="cities">
                        <div class="cat-info">
                            <?php foreach ($categories as $value) { ?>
                                <?php $current_url = strtolower(transliterate($value->name)); ?>
                                <a href="/information/<?php echo $current_url; ?>">
                                    <div class="address <?php if($current_url==$current) echo 'current'; ?>"><span><?php echo $value->name; ?></span></div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <br/>
                </div>
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
                            <?php echo $city_geo; ?>
                        </div>
                    </div>
                    <div class="cities">
                        <?php $i = 0;
                        foreach ($cities as $value) {
                            if ($i % 2 == 0) {
                                ?>
                                <div class="address"><?php echo $value->city . ', ' . $value->address; ?></div>
                            <?php } else { ?>
                                <div class="blue-address"><?php echo $value->city . ', ' . $value->address; ?></div>
                            <?php
                            }
                            $i++;
                        } ?>
                    </div>
                    <div class="other">
                        <a class="fancybox" href="#fancy-body.second">
                            <input type="button" class="green floatright" value="Подробнее...">
                        </a>
                    </div>
                    <div class="other lightgreytext">
                        <a href="/news">
                            Хочу купить онлайн!
                        </a>
                    </div>
                </div>
                <?php echo ORM::factory('settings')->getSetting('callus'); ?>
            </div>
        </div>
        <div class="width755">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<div class="fancy-address" style="display:none">
    <div id="fancy-body" class="second">
        <h2>Где купить?</h2>

        <div class="change-city">
            <select class="change-city-select">
                <?php foreach ($order_cities as $city) { ?>
                    <option value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="cities-all">
            <?php foreach ($all_cities as $value) { ?>
                <div class="city-item rel<?php echo $value->id; ?>" rel="<?php echo $value->id; ?>">
                    <span><?php echo $value->city . ', ' . $value->address; ?></span><br/>
                    <i><?php echo $value->phone; ?></i>
                </div>
            <?php } ?>
        </div>
        <div class="maps">
            <?php foreach ($all_cities as $value) { ?>
                <div class="map-item rel<?php echo $value->id; ?>" style="display:none">
                    <?php echo $value->map; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="fancy-ways" style="display:none">
    <div id="ways">
        <div class="ways-header">
            <a href="#" class="consult">Онлайн-консультант</a>
        </div>
        <div class="ways-text">
            Задать вопросы с помощью <br/>чата в режиме реального времени
        </div>
        <div class="ways-header order-call">
            <a href="#">Заказать обратный звонок</a>
        </div>
        <div class="ways-text">
            Выберите удобное для звонка<br/> время и мы перезвоним Вам
        </div>
        <div class="ways-header order-link">
            <a href="#">Форма обратной связи</a>
        </div>
        <div class="ways-text">
            Задать вопрос нам <br/> на адрес электронной почты
        </div>
    </div>
</div>
<div class="fancy-call" style="display:none">
    <form action="/callback/new" id="callback-form" method="POST">
        <div class="resp">
            <h3>Заказать обратный звонок</h3>

            <div class="input-name">
                <input type="text" id="response-name1" class="name_call" name="name" placeholder="Имя">
            </div>
            <div class="input-phone">
                <input type="text" id="response-phone1" class="name_phone" name="phone" placeholder="Телефон">
            </div>
            <!-- <div class="input-question">
                 <textarea id="response-question" name="response" placeholder="Сообщение..."></textarea>
                 <div class="response-err-question error"></div>
             </div> -->
            <div class="choose-time">
                <font class="form-font">Выбрать время звонка:</font>
            </div>
            <div class="time-container-from">
                <div>
                    <font class="form-font">c</font>
                    <input type="text" name="time_from" id="time_from" value="09:00" class="hasDatepicker">
                </div>
                <div>
                    <font class="form-font">до</font>
                    <input type="text" name="time_to" id="time_to" class="input-time"
                           value="17:59"/></div>
            </div>
            <div class="order-submit">
                <input type="button" class="order-button green ways-call-submit" value="Заказать звонок"
                       style="margin-left:0px">
            </div>
        </div>
    </form>
</div>
<div class="fancy-link" style="display:none">
    <form action="/consult/new" id="response-form" method="POST">
        <div class="resp">
            <h3>Консультация</h3>

            <div class="input-name">
                <input type="text" id="response-name" class="link-name" name="name" placeholder="Имя">

                <div class="response-err-name error"></div>
            </div>
            <div class="input-email">
                <input type="text" id="response-email" class="link-email" name="email" placeholder="E-mail">

                <div class="response-err-email error"></div>
            </div>
            <div class="input-question">
                <textarea id="response-question" class="link-response" name="response"
                          placeholder="Ваш вопрос..."></textarea>

                <div class="response-err-question error"></div>
            </div>
        </div>
        <br>

        <div class="order-submit">
            <input type="button" class="order-button green ways-call-submit" value="Отправить" style="margin-left:0px;">
        </div>
        <div class="clearboth">&nbsp;</div>
    </form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.cat-info .address').mouseover(function(){
            jQuery('.cat-info .address').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.cat-info .address .right-cat').remove();
            jQuery(this).find('span').after('<span class="right-cat" style="float:right">      ></span>');
        });

        jQuery(".fancybox").fancybox({
            'beforeShow': function () {
                var city = jQuery('.geocity').html();
                if (city != '') {
                    jQuery('.second .change-city-select option').each(function () {
                        if (jQuery.trim(city) == jQuery(this).html()) {
                            jQuery(this).attr('selected', 'selected');
                            var id = jQuery(this).html();
                            changeCity(id);
                        }
                    });

                    jQuery('.second .change-city-select :contains("' + city + '")').attr('selected', 'selected');
                }
            },
            'afterShow': function () {
                jQuery('.second .change-city-select').change(function () {
                    jQuery('.second .map-item').css('display', 'none');
                    var id = jQuery(this).children('option:selected').html();
                    changeCity(id);
                });
                jQuery('.second .city-item').click(function () {
                    jQuery('.second .city-item').removeClass('active');
                    jQuery(this).addClass('active');
                    var id = jQuery(this).attr('rel');
                    jQuery('.second .map-item').css('display', 'none');
                    jQuery('.second .map-item.rel' + id).css('display', 'block');
                    jQuery.fancybox.update();
                });
            }
        });
        jQuery('.ways-call').fancybox({
            'beforeShow': function () {
                jQuery('.consult').click(function () {
                    jQuery.fancybox.close();
                    jQuery('#sh_button').trigger('click');
                });
                jQuery('.order-call').click(function () {
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
                jQuery('.order-link').click(function () {
                    jQuery.fancybox.close();
                    jQuery.fancybox(jQuery('.fancy-link').html(), {
                        //'content': jQuery(".fancy-call").html(),
                        beforeShow: function () {
                            jQuery('.order-button.green.ways-call-submit').click(function () {
                                var name = jQuery('.fancybox-outer .link-name').val();
                                var email = jQuery('.fancybox-outer .link-email').val();
                                var response = jQuery('.fancybox-outer .link-response').val();
                                jQuery.post('/consult/new', {name: name, email: email, response: response}, function (response) {
                                    console.log(response);
                                    if (response == 'success') {
                                        jQuery.fancybox.close();
                                        jQuery.fancybox('<h3 style="width:315px">Ваш заказ успешно отправлен!</h3>');
                                        jQuery.fancybox.update();
                                    }
                                });
                            });
                        }
                    });
                });
            }
        })
        ;
        var city = jQuery('.geocity').html();
        if (city != '') {
            jQuery('.fancy-address-block .change-city-select option').each(function () {
                if (jQuery.trim(city) == jQuery(this).html()) {
                    jQuery(this).attr('selected', 'selected');
                    var id = jQuery(this).html();
                    changeCityBlock(id);
                }
            });
            jQuery('.fancy-address-block .change-city-select :contains("' + city + '")').attr('selected', 'selected');
        }
        jQuery('.fancy-address-block .change-city-select').change(function () {
            jQuery('.fancy-address-block .map-item').css('display', 'none');
            var id = jQuery(this).children('option:selected').html();
            changeCityBlock(id);
        });
        jQuery('.fancy-address-block .city-item').click(function () {
            jQuery('.fancy-address-block .city-item').removeClass('active');
            jQuery(this).addClass('active');
            var id = jQuery(this).attr('rel');
            jQuery('.fancy-address-block .map-item').css('display', 'none');
            jQuery('.fancy-address-block .map-item.rel' + id).css('display', 'block');
            jQuery.fancybox.update();
        });
    })
    ;

    function changeCityBlock(city) {
        jQuery('.fancy-address-block .city-item').css('display', 'none');
        var city = jQuery.trim(city);
        jQuery('.fancy-address-block .city-item span:contains("' + city + '")').parents().each(function () {
            jQuery(this).css('display', 'block');
        });
        console.log(jQuery('.fancy-address-block span:contains("' + city + '")').html());
        jQuery('.fancy-address-block .city-item span:contains("' + city + '")').parents().css('display', 'block');
    }

    function changeCity(city) {
        jQuery('.second .city-item').css('display', 'none');
        var city = jQuery.trim(city);
        jQuery('.second .city-item span:contains("' + city + '")').parents().each(function () {
            jQuery(this).css('display', 'block');
        });
        jQuery('.second .city-item span:contains("' + city + '")').parents().css('display', 'block');
    }
</script>
</div>
<?php require_once 'footer.php'; ?>
