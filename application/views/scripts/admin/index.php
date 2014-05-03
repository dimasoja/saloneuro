<div class="inner-content">
    <script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>

    <div class="row-fluid" style="display:none">
        <div class="widget">
            <form class="form-horizontal" id='asdf' style="text-align:center;">
                <div class="widget-header">
                    <h5>Статические страницы:</h5>
                </div>
                <div class="widget-content no-padding">
                    <div class="form-row">
                        <label class="field-name" for="standard">Приветствие:</label>

                        <div class="field">
                            <textarea name="content" id="complex_content"
                                      style="width: 100%; height: 600px;"><?php if (isset($complex_content)) {
                                    echo $complex_content;
                                } ?></textarea>
                        </div>
                    </div>

                    <br/>
                    <a href="#" class=" tutu button button-turquoise small-button configuration-button"
                       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                    <br/><br/>
                </div>
            </form>
        </div>
    </div>
    <div class="row-fluid">
        <div class="widget">
            <form class="form-horizontal" method="post" action="/admin/index/savelogo" id='logo-form'
                  style="text-align:center;" enctype="multipart/form-data">

                <div class="widget-header">
                    <h5>Хедер:</h5>
                </div>
                <div class="widget-content no-padding">
                    <div class="form-row">
                        <label class="field-name" for="standard">Блок (позвоните нам) в хедере:</label>

                        <div class="field">
                            <textarea name="call_us" id="call_us"
                                      style="width: 100%; height: 600px;"><?php if (isset($call_us)) {
                                    echo $call_us;
                                } ?></textarea>
                        </div>
                    </div>
                    <?php foreach ($settings as $setting) {
                        if (($setting->short_name == 'logo') or ($setting->short_name == 'logotext')) {
                            ?>
                            <div class="form-row">
                                <label class="field-name" for="standard"><?php echo $setting->name_setting; ?></label>

                                <div class="field">
                                    <input type="text" class="span12 <?php echo $setting->short_name; ?>"
                                           name="standard"
                                           id="standard" value='<?php echo $setting->value; ?>'>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="form-row">

                        <label class="field-name" for="standard">Загрузить логотип:</label>

                        <div class="field">
                            <!--                            <textarea name="mo_content" id="makeorder_content" style="width: 100%; height: 600px;">-->
                            <?php //if(isset($makeorder_content)) echo $makeorder_content; ?><!--</textarea>-->
                            <input type="file" class="logo" name="logo"/>
                            <?php if (file_exists('./uploads/images/' . $logo)) { ?>
                                <img src="<?php echo '/uploads/images/' . $logo; ?>" width="200"/>
                            <?php } ?>
                        </div>
                    </div>
                    <br/>
                    <a href="#" class=" tutucall button button-turquoise small-button configuration-button"
                       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                    <br/><br/>
                </div>

        </div>
        </form>
    </div>

    <div class="row-fluid">
        <div class="widget">
            <form class="form-horizontal" style="text-align:center;">
                <div class="widget-header">
                    <h5>Системы аналитики:</h5>
                </div>
                <div class="widget-content no-padding">
                    <?php foreach ($settings as $setting) {
                        if (($setting->short_name == 'goole_analytics') or ($setting->short_name == 'yandex_metrika')) {
                            ?>
                            <div class="form-row">
                                <label class="field-name" for="standard"><?php echo $setting->name_setting; ?></label>

                                <div class="field">
                                    <input type="text" class="span12 <?php echo $setting->short_name; ?>"
                                           name="standard"
                                           id="standard" value='<?php echo $setting->value; ?>'>
                                </div>
                            </div>
                        <?php
                        } else {
                            if ($setting->short_name == 'complex_content') {
                                $complex_content = $setting->value;
                            }
                            if ($setting->short_name == 'makeorder_content') {
                                $makeorder_content = $setting->value;
                            }
                            if ($setting->short_name == 'call_us') {
                                $call_us = $setting->value;
                            }
                        }
                    } ?>
                    <br/>
                    <a href="#" onclick="saveConf()" class="button button-turquoise small-button configuration-button"
                       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                    <br/><br/>
                </div>
            </form>
        </div>
    </div>






<div class="row-fluid">
    <div class="widget">
        <form class="form-horizontal" style="text-align:center;">
            <div class="widget-header">
                <h5>Системы аналитики:</h5>
            </div>
            <div class="widget-content no-padding">
                <?php foreach ($settings as $setting) {
                    if (($setting->short_name != 'complex_content') and ($setting->short_name != 'call_us') and ($setting->short_name != 'map_code') and ($setting->short_name != 'company_phone') and ($setting->short_name != 'yandex_metrika') and ($setting->short_name != 'goole_analytics') and ($setting->short_name != 'logotext') and ($setting->short_name != 'keywerds') and ($setting->short_name != 'title') and ($setting->short_name != 'description') and ($setting->short_name != 'benefits') and ($setting->short_name != 'production') and ($setting->short_name != 'addr_num') and ($setting->short_name != 'grade') and ($setting->short_name != 'callus') and ($setting->short_name != 'makeorder_content')) {
                        ?>
                        <div class="form-row">
                            <label class="field-name" for="standard"><?php echo $setting->name_setting; ?></label>

                            <div class="field">
                                <input type="text" class="span12 <?php echo $setting->short_name; ?>" name="standard"
                                       id="standard" value='<?php echo $setting->value; ?>'>
                            </div>
                        </div>
                    <?php
                    } else {
                        if ($setting->short_name == 'complex_content') {
                            $complex_content = $setting->value;
                        }
                        if ($setting->short_name == 'makeorder_content') {
                            $makeorder_content = $setting->value;
                        }
                        if ($setting->short_name == 'call_us') {
                            $call_us = $setting->value;
                        }
                    }
                } ?>
                <br/>
                <a href="#" onclick="saveConf()" class="button button-turquoise small-button configuration-button"
                   style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                <br/><br/>
            </div>
        </form>
    </div>
</div>
</div>

<script type="">
    function saveConf() {
        var admin_email = jQuery('.admin_email').val();
        var title = jQuery('.title').val();
        var description = jQuery('.description').val();
        var keywerds = jQuery('.keywerds').val();
        var map_code = jQuery('.map_code').val();
        var company_phone = jQuery('.company_phone').val();
        var copyright = jQuery('.copyright').val();
        var logotext = jQuery('.logotext').val();
        var vk = jQuery('.vk').val();
        var twitter = jQuery('.twitter').val();
        var facebook = jQuery('.facebook').val();
        var odnoklassniki = jQuery('.odnoklassniki').val();
        var yandex_metrika = jQuery('.yandex_metrika').val();
        var goole_analytics = jQuery('.goole_analytics').val();
        jQuery.post('/admin/index/saveconf', {admin_email: admin_email, vk: vk, twitter: twitter, facebook: facebook, odnoklassniki: odnoklassniki, logotext: logotext, map_code: map_code, company_phone: company_phone, copyright: copyright, yandex_metrika: yandex_metrika, goole_analytics: goole_analytics, title: title, description: description, keywerds: keywerds}, function (data) {
            jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
            jQuery('.alert.alert-info.noMargin').css('display', 'block');
            jQuery('.alert.alert-info.noMargin').fadeOut(3000);
        });
    }
    function saveConf1() {

    }
    jQuery(document).ready(function () {
        var editor = CKEDITOR.replace('content',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        var editor = CKEDITOR.replace('call_us',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
//        var editor = CKEDITOR.replace('strength',
//            {
//                uiColor: 'lightgrey',
//                language: 'en'
//            });
//        var editor = CKEDITOR.replace('noise',
//            {
//                uiColor: 'lightgrey',
//                language: 'en'
//            });
//        var editor = CKEDITOR.replace('heat',
//            {
//                uiColor: 'lightgrey',
//                language: 'en'
//            });
//        var editor = CKEDITOR.replace('mo_content',
//            {
//                uiColor: 'lightgrey',
//                language: 'en'
//            });
        CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');

        jQuery('.tutu').click(function () {
            CKEDITOR.instances['complex_content'].updateElement();
            var complex_content = jQuery('#complex_content').val();
            jQuery.post('/admin/index/savestatic', {complex_content: complex_content}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });

        jQuery('.strength-button').click(function () {
            CKEDITOR.instances['strength'].updateElement();
            var strength = jQuery('#strength').val();
            jQuery.post('/admin/index/savestrength', {strength: strength}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });

        jQuery('.noise-button').click(function () {
            CKEDITOR.instances['noise'].updateElement();
            var noise = jQuery('#noise').val();
            jQuery.post('/admin/index/savenoise', {noise: noise}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });

        jQuery('.heat-button').click(function () {
            CKEDITOR.instances['heat'].updateElement();
            var heat = jQuery('#heat').val();
            jQuery.post('/admin/index/saveheat', {heat: heat}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });


        jQuery('.tutumo').click(function () {
            CKEDITOR.instances['makeorder_content'].updateElement();
            var complex_content = jQuery('#makeorder_content').val();
            jQuery.post('/admin/index/savemakeorder', {makeorder_content: complex_content}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });
        jQuery('.tutucall').click(function () {
            CKEDITOR.instances['call_us'].updateElement();
            var call_us = jQuery('#call_us').val();
            var logotext = jQuery('.logotext').val();
            jQuery.post('/admin/index/callus', {call_us: call_us, logotext: logotext}, function (data) {
                console.log(data);
                jQuery('.alert.alert-info.noMargin font').html('Конфигурация сайта успешно сохранена');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
                jQuery('#logo-form').submit();
            });
        });

    });
    jQuery('.savelogo').click(function () {

    });

</script>
      