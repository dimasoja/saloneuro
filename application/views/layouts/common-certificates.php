<?php require_once('header.php'); ?>
<?php $city_geo = (array)$city; ?>
<?php $city_geo = $city[0]; ?>
<div class="geocity" style="display:none">
    <?php echo $session_city; ?>
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
<div class="common inner">
    <div class="container">
        <div class="width755">
            <h2><?php echo $page_title; ?></h2><br/>
            <?php echo $content; ?>
            <?php if ($id_page != '76') { ?>
                <?php //echo ORM::factory('settings')->getSetting('production'); ?>
            <?php } else { ?>
                <div class="fancy-address-block">
                    <div id="fancy-body">
                        <h2>Где купить?</h2>

                        <div class="change-city">
                            <select class="change-city-select">
                                <?php foreach ($order_cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="cities-all" style="overflow:auto">
                            <?php foreach ($all_cities as $value) { ?>
                                <div class="city-item rel<?php echo $value->id; ?>" rel="<?php echo $value->id; ?>">
                                    <div class="ballon-title ball">
                                        <?php if ($value->type == 'address') { ?>
                                            <span><?php echo $value->city . ', ' . $value->address; ?></span><br/>
                                        <?php } else { ?>
                                            <span><?php echo $value->city . ', (все адреса)'; ?></span><br/>
                                        <?php } ?>
                                        <i><?php echo $value->phone; ?></i>
                                        <!--                        <div class="balloon"><img src="/images/webmarket/savelocale.png"/></div>-->
                                    </div>

                                </div>

                            <?php } ?>
                            <script type="text/javascript">
                                jQuery(document).ready(function(){
                                    jQuery('.ball').mouseenter(function(){
                                        jQuery(this).addClass('active');
                                    });
                                    jQuery('.ball').mouseleave(function(){
                                        jQuery(this).removeClass('active');
                                    });
                                    jQuery('.ball').click(function(){
                                        jQuery('.ball').removeClass('byclick');
                                        jQuery(this).addClass('byclick');
                                    });
                                });
                            </script>
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
            <?php } ?>
        </div>
        <div class="rightblock">
            <div class="category-right-wrapper">

                <div class="wheretobuyblock <?php if($session_city=='Санкт-Петербург') echo 'piter'; ?>">
                    <div class="aqua-header">Где купить?</div>
                    <i class="find-store">найти магазин дилера</i><br/>

                    <div class="geo-label">
                        <div class="geo-image">
                            <img src="/images/webmarket/savelocale.png"/>
                        </div>
                        <div class="your-city">
                            Ваш город:
                        </div>
                        <div class="city1">
                            <select class="all_cities" style="width:186px">
                                <?php $all_group_cities = ORM::factory('addresses')->group_by('city')->find_all()->as_array(); ?>
                                <?php foreach ($all_group_cities as $value) { ?>
                                    <option
                                        value="<?php echo $value->city; ?>" <?php if ($value->city == $session_city) {
                                        echo 'selected';
                                    } ?>><?php echo $value->city; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="cities">
                        <?php $i = 0;

                        foreach ($session_cities as $value) {
                            if ($value->type == 'address') {
                                if ($i % 2 == 0) {
                                    ?>
                                    <div class="address"><?php echo $value->city . ', ' . $value->address; ?></div>
                                <?php } else { ?>
                                    <div
                                        class="blue-address"><?php echo $value->city . ', ' . $value->address; ?></div>
                                <?php
                                }
                                $i++;
                            }
                        } ?>
                    </div>
                    <div class="other">
                        <a class="fancybox" href="#fancy-body">
                            <input type="button" class="green floatright enter-partner" value="Подробнее...">
                        </a>
                    </div>
                    <div class="other lightgreytext">
                        <a href="http://salonevro.ru/">
                            Хочу купить онлайн!
                        </a>
                    </div>
                </div>
                <?php echo ORM::factory('settings')->getSetting('callus'); ?>
                <div class="wheretobuyblock">
                    <?php echo ORM::factory('settings')->getSetting('trouble'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fancy-address" style="display:none">
    <div id="fancy-body">
        <h2>Где купить?</h2>

        <div class="change-city">
            <select class="change-city-select">
                <?php foreach ($order_cities as $city) { ?>
                    <option value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="cities-all" style="overflow:auto">
            <?php foreach ($all_cities as $value) { ?>
                <div class="city-item rel<?php echo $value->id; ?>" rel="<?php echo $value->id; ?>">
                    <?php if ($value->type == 'address') { ?>
                        <span><?php echo $value->city . ', ' . $value->address; ?></span><br/>
                    <?php } else { ?>
                        <span><?php echo $value->city . ', (все адреса)'; ?></span><br/>
                    <?php } ?>
                    <i><?php echo $value->phone; ?></i>

                    <div class="balloon"><img src="/images/balloon.png"/></div>
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
        <div class="ways-header" style="cursor:pointer;">
            <a onclick="window.open('http://lk.mango-office.ru/widget/MTIwNDM0', '_blank', 'width=238,height=350,resizable=no,toolbar=no,menubar=no,location=no,status=no'); return false;">Звонок с сайта</a>
        </div>
        <div class="ways-text">
            Воспользуйтесь бесплатной услугой
        </div>
    </div>
</div>
<div class="fancy-call" style="display:none">
    <form action="/callback/new" id="callback-form" method="POST">
        <div class="resp">
            <h3>Заказать обратный звонок</h3>

            <div class="input-name">
                <input type="text" id="response-name1" class="name_call" name="name" placeholder="Имя" required>
            </div>
            <div class="input-phone">
                <input type="text" id="response-phone1" class="name_phone" name="phone" placeholder="Телефон" required>
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
                    <input type="text" name="time_from" id="time_from" value="09:00" class="hasDatepicker" required>
                </div>
                <div>
                    <font class="form-font">до</font>
                    <input type="text" name="time_to" id="time_to" class="input-time"
                           value="17:59" required/></div>
            </div>
            <div class="order-submit">
                <input type="button" class="order-button green ways-call-submit" value="Заказать звонок"
                       style="margin-left:0px">
            </div><br/><br/>
            <div class="ways-header" style="cursor:pointer;text-align:center">
                <a onclick="window.open('http://lk.mango-office.ru/widget/MTIwNDM0', '_blank', 'width=238,height=350,resizable=no,toolbar=no,menubar=no,location=no,status=no'); return false;">Звонок с сайта</a>
            </div>
            <div class="ways-text" style="text-align:center">
                Воспользуйтесь бесплатной услугой
            </div>
        </div>
    </form>
</div>
<div class="fancy-link" style="display:none">
    <form action="/consult/new" id="response-form" method="POST">
        <div class="resp">
            <h3>Консультация</h3>

            <div class="input-name">
                <input type="text" id="response-name" class="link-name" name="name" placeholder="Имя" required>

                <div class="response-err-name error"></div>
            </div>
            <div class="input-email">
                <input type="text" id="response-email" class="link-email" name="email" placeholder="E-mail" required>

                <div class="response-err-email error"></div>
            </div>
            <div class="input-question">
                <textarea id="response-question" class="link-response" name="response"
                          placeholder="Ваш вопрос..." required></textarea>

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

<div class="dn">
    <div id="map_layout">

    </div>
</div>

<script type="text/javascript">
function validateEmail(email) {
    var re =  /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return re.test(email);
}
    jQuery(document).ready(function () {
        jQuery('#response-form').validate();
        jQuery('#callback-form').validate();
        jQuery(".fancybox").fancybox({
            'beforeShow': function () {
                var city = jQuery('.geocity').html();
                jQuery('.city-item').each(function(index, value){
                    var e = $(this);
                    if(e.find('img').length>0) {
                        var id = e.prop('rel');
                        var html = e.clone();
                        e.remove();
                        $('.cities-all').prepend(html);
                    }
                });
                if (city != '') {
                    jQuery('.change-city-select option').each(function () {
                        if (jQuery.trim(city) == jQuery(this).html()) {
                            jQuery(this).attr('selected', 'selected');
                            var id = jQuery(this).html();
                            changeCity(id);
                        }
                    });
                    jQuery('.change-city-select :contains("' + city + '")').attr('selected', 'selected');
                }
            },
            'afterShow': function () {
                jQuery('.change-city-select').change(function () {
                    jQuery('.map-item').css('display', 'none');
                    var id = jQuery(this).children('option:selected').html();
                    changeCity(id);
                });
                jQuery('.city-item').click(function () {
                    jQuery('.city-item').removeClass('active');
                    jQuery(this).addClass('active');
                    var id = jQuery(this).attr('rel');
                    jQuery('.map-item').css('display', 'none');
                    jQuery('.map-item.rel' + id).css('display', 'block');
                    jQuery.fancybox.update();
                });
            }
        });
        jQuery('.ways-call').fancybox({
            'beforeShow': function () {
                jQuery('.fancybox-wrap').addClass('certif-fancybox');
                jQuery('.consult').click(function () {
                    jQuery.fancybox.close();
                    jQuery('#sh_button').trigger('click');
                });
                jQuery('.order-call').click(function () {
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
                jQuery('.order-link').click(function () {
                    jQuery.fancybox.close();
                    jQuery.fancybox(jQuery('.fancy-link').html(), {
                        //'content': jQuery(".fancy-call").html(),
                        beforeShow: function () {
                            jQuery('.fancybox-wrap').addClass('certif-fancybox');
                            var nameelem = jQuery('.fancybox-outer .link-name');
                            var emailelem = jQuery('.fancybox-outer .link-email');
                            var responseelem = jQuery('.fancybox-outer .link-response');
                            nameelem.keypress(function () {
                                if (nameelem.val() == '') {
                                    jQuery(this).addClass('error');
                                } else {
                                    jQuery(this).removeClass('error');
                                }
                            });
                            emailelem.keypress(function () {
                                if (emailelem.val() == '') {
                                    jQuery(this).addClass('error');
                                } else {
                                    if (validateEmail(emailelem.val()))
                                        jQuery(this).removeClass('error');
                                }
                            });
                            responseelem.keypress(function () {
                                if (nameelem.val() == '') {
                                    jQuery(this).addClass('error');
                                } else {
                                    jQuery(this).removeClass('error');
                                }
                            });
                            jQuery('.order-button.green.ways-call-submit').click(function () {
                                var nameelem = jQuery('.fancybox-outer .link-name');
                                var emailelem = jQuery('.fancybox-outer .link-email');
                                var responseelem = jQuery('.fancybox-outer .link-response');
                                var name = nameelem.val();
                                var email = emailelem.val();
                                var response = responseelem.val();

                                var send = '1';
                                if (name == '') {
                                    send = 0;
                                    jQuery('.fancybox-outer .link-name').addClass('error');
                                }
                                if (email == '') {
                                    send = 0;
                                    jQuery('.fancybox-outer .link-email').addClass('error');
                                }
                                if (!validateEmail(email)) {
                                    send = 0;
                                    jQuery('.fancybox-outer .link-email').addClass('error');
                                }
                                if (response == '') {
                                    send = 0;
                                    jQuery('.fancybox-outer .link-response').addClass('error');
                                }
                                if (send == '1') {
                                    jQuery.post('/consult/new', {name: name, email: email, response: response}, function (response) {
                                        console.log(response);
                                        if (response == 'success') {
                                            jQuery.fancybox.close();
                                            jQuery.fancybox('<h3 style="width:315px">Ваш заказ успешно отправлен!</h3>');
                                            jQuery.fancybox.update();
                                        }
                                    });
                                }
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
        jQuery('.all_cities').change(function () {
            $el = jQuery(this).val();
            jQuery.post('/index/changecity', {city: $el}, function (response) {
                window.location = '<?php echo $_SERVER['REQUEST_URI']; ?>';
            })
        });
        jQuery('.fancyboxcert').fancybox();
        jQuery('.fancy-map').fancybox({
            'beforeLoad': function(){
               var map = this.element.attr('data-map');

                //var dynamic_map = jQuery.getScript(map);
                //jQuery('#map_layout').append(dynamic_map);
                //console.log(dynamic_map);
            }
        });
    })
    ;

    function changeCityBlock(city) {
        jQuery('.maps').css('display','none');
        jQuery('.fancy-address-block .city-item').css('display', 'none');
        var city = jQuery.trim(city);
        jQuery('.fancy-address-block .city-item span:contains("' + city + ',")').parents().each(function () {
            jQuery(this).css('display', 'block');
        });
        console.log(jQuery('.fancy-address-block span:contains("' + city + '")').html());
        jQuery('.fancy-address-block .city-item span:contains("' + city + ',")').parents().css('display', 'block');
    }

    function changeCity(city) {
        jQuery('.maps').css('display','none');
        jQuery('.city-item').css('display', 'none');
        var city = jQuery.trim(city);
        jQuery('.city-item span:contains("' + city + ',")').parents().each(function () {
            jQuery(this).css('display', 'block');
        });
        console.log(jQuery('span:contains("' + city + '")').html());
        jQuery('.city-item span:contains("' + city + ',")').parents().css('display', 'block');
    }
</script>
<?php require_once 'footer_catalog.php'; ?>
