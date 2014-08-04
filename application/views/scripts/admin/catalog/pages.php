<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<?php if ($success != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $success; ?>
    </div>
<?php } ?>
<?php if ($error != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $error; ?>
    </div>
<?php } ?>
<div class="inner-content producttable" style="margin: 30px 0px 0px 0px !important;">
<div class="widget-content" align="center">
<?php if (!isset($add_product)) { ?>
    <a href="#" class="button button-blue marginbottom30"><img src="/images/admin/icon/14x14/white/download4.png"
                                                               alt=""> Добавить товар</a>
<?php } ?>
<br/>
<br/>

<div class="category-toggle" style="display: none;overflow:auto">
<div class="span4" style="float: none !important; width:100%; margin-left:0px ">
<div class="widget">
<form class="form-horizontal" action="/admin/catalog/newproduct" method="POST"
      enctype="multipart/form-data">
<div class="widget-header">
    <h5>Новый товар <?php if (isset($add_product)) { ?>(<?php echo $category->name; ?>) <?php } ?>:</h5>
</div>
<div class="widget-content no-padding">
<div class="form-row">
    <label class="field-name" for="standard">Наименование:</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="name"
               style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Title (мета тэг):</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="title_meta" style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Keywords (мета тэг):</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="keywords_meta" style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Description (мета тэг):</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="description_meta" style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Описание:</label>

    <div class="field">
        <textarea name="description" id="add-answer"
                  class="input-large name-edit"></textarea>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Краткое описание:</label>

    <div class="field">
        <textarea name="short_description" id="add-short"
                  class="input-large name-edit"></textarea>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Цена:</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="price"
               style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Ширина:</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="length"
               style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Длина:</label>

    <div class="field">
        <input type="text" class="input-large name-edit" name="width"
               style="float: left;width: 100%;">
    </div>
</div>
<?php if (isset($category)) { ?>
    <?php if ($category->type_filter == 'shower') { ?>
        <div class="form-row">
            <label class="field-name" for="standard">Высота:</label>

            <div class="field">
                <input type="text" class="input-large name-edit" name="height"
                       style="float: left;width: 100%;">
            </div>
        </div>
        <div class="form-row">
            <label class="field-name" for="standard">Форма кабины:</label>

            <div class="field" style="text-align: left;">
                <select class="form-control uniform" name="form">
                    <option value="angular">Угловая Полукруглая</option>
                    <option value="rectangular">Прямоугольная</option>
                    <option value="pentagon">Пятиугольная</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <label class="field-name" for="standard">Тип кабины:</label>

            <div class="field" style="text-align: left;">
                <select class="form-control uniform" name="type_shower">
                    <option value="cabin">Кабинка</option>
                    <option value="doors">Дверки</option>
                </select>
            </div>
        </div>

    <?php } ?>
    <?php if ($category->type_filter == 'accessory') { ?>
        <div class="form-row">
            <label class="field-name" for="standard">Тип аксессуаров:</label>

            <div class="field" style="text-align: left;">
                <select class="form-control uniform" name="type_accessory">
                    <option value="blinds"><?php echo ORM::factory('settings')->getSetting('blinds'); ?></option>
                    <option value="mixer"><?php echo ORM::factory('settings')->getSetting('mixer'); ?></option>
                    <option value="accessory"><?php echo ORM::factory('settings')->getSetting('accessory'); ?></option>
                    <option value="rod"><?php echo ORM::factory('settings')->getSetting('rod'); ?></option>
                    <option value="bede"><?php echo ORM::factory('settings')->getSetting('bede'); ?></option>
                </select>
            </div>
        </div>

    <?php } ?>
<?php } ?>
<?php if ((isset($massage_on) && (isset($grade_on)))) { ?>
    <div class="form-row">
        <label class="field-name" for="standard">Разделение левая/правая?</label>

        <div class="field" style="text-align: left;">
            <select class="form-control uniform" name="leftright">
                <option value="off">Нет</option>
                <option value="on">Да</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <label class="field-name" for="standard">Тип:</label>

        <div class="field" style="text-align: left;">
            <select class="form-control uniform" name="type">
                <option value="angular">Угловая</option>
                <option value="rectangular">Прямоугольная</option>
                <option value="increased">Увеличенного объема</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <label class="field-name" for="standard">Дополнительный Тип:</label>

        <div class="field" style="text-align: left;">
            <select class="form-control uniform" name="additional_type">
                <option value=""></option>
                <option value="angular">Угловая</option>
                <option value="rectangular">Прямоугольная</option>
                <option value="increased">Увеличенного объема</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <label class="field-name" for="standard">Дополнительный Тип:</label>

        <div class="field" style="text-align: left;">
            <select class="form-control uniform" name="additional_type2">
                <option value=""></option>
                <option value="angular">Угловая</option>
                <option value="rectangular">Прямоугольная</option>
                <option value="increased">Увеличенного объема</option>
            </select>
        </div>
    </div>
<?php } ?>


<!--                            <div class="form-row">-->
<!--                                <label class="field-name" for="standard">Изображение:</label>-->
<!--                                <div class="field">-->
<!--                                    <input type="file" class="input-large name-edit" name="image" style="float: left;width: 100%;">-->
<!--                                </div>-->
<!--                                <input type="submit" class="button button-blue small-button margintop18 marginleft128" value="Добавить">-->
<!--                            </div>-->
<?php foreach ($directory as $dir) { ?>
    <div class="form-row">
        <label class="field-name" for="standard"><?php echo $dir->name; ?>:</label>

        <div class="field" style="text-align:left;">
            <?php if ($dir->type == 'select') { ?>
                <select name="dir-<?php echo $dir->id; ?>" class="uniform">
                    <?php $all_children = ORM::factory('directory')->where('parent_id', '=', $dir->id)->find_all()->as_array(); ?>
                    <option value=""></option>
                    <?php foreach ($all_children as $ac) { ?>
                        <option value="<?php echo $ac->id; ?>"><?php echo $ac->name; ?></option>
                    <?php } ?>
                </select>
            <?php } else { ?>
                <input type="text" name="dir-<?php echo $dir->id; ?>" class="input-large name-edit"
                       style="float:left; width:100%"/>
            <?php } ?>

        </div>
    </div>
<?php } ?>
<?php if (isset($add_product)) { ?>
    <?php if ($massage_on == 'on') { ?>
        <div class="form-row">
            <label class="field-name" for="standard">Массажные опции:</label>

            <!--                                    <div class="field" style="text-align:left;">-->
            <!--                                        <select multiple name="massage[]" style="height: 100%">-->
            <!--                                            <option value=""></option>-->
            <!--                                            --><?php //foreach ($massages as $ac) { ?>
            <!--                                                <option value="--><?php //echo $ac->id; ?><!--">-->
            <?php //echo $ac->name; ?><!--</option>-->
            <!--                                            --><?php //} ?>
            <!--                                        </select>-->
            <!--                                    </div>-->
            <div style="text-align:left;">
                <a id="upload4">
                    Загрузить изображение для массажа
                </a>

                <div class="massage-options"></div>
            </div>
        </div>
        <div style="display:none" class="select_for_massage">
            <select class="massage-select" name="option_massage[]" style="height: auto">
                <option value=""></option>
                <?php foreach ($massages as $ac) { ?>
                    <option value="<?php echo $ac->id; ?>"><?php echo $ac->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div style="display:none" class="forsun_for_massage">
            <br/><input type="text" name="forsun[]" style="width: 100%;margin-top: 8px;" placeholder="Форсунок"/>
        </div>
        <div style="display:none" class="price_for_massage">
            <br/><input type="text" name="price_for_massage[]" style="width: 100%;margin-top: 8px;" placeholder="Цена"/>
        </div>
        <div style="display:none" class="default_for_massage">
            <label>По умолчанию?</label>
            <select class="by_default not-uniform" name="default_for_massage[]">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
        </div>
        <div style="display:none" class="required_for_massage">
            <label>Обязательно?</label>
            <select class="by_required not-uniform" name="required_for_massage[]">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
        </div>
        <div style="display:none" class="underoption_for_massage" name="underoption_for_massage[]">
            <label>Подопция?</label>
            <select class="by_underoption not-uniform" name="underoption_for_massage[]">
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
        </div>



    <?php } ?>
<?php } ?>
<!--<?php if (isset($add_product)) { ?>
    <?php if ($grade_on == 'on') { ?>
        <div class="form-row">
            <label class="field-name" for="standard">Комплектация:</label>

            <div class="field" style="text-align:left;">
                <select multiple name="grade[]" style="height: 100%">
                    <option value=""></option>
                    <?php foreach ($grades as $ac) { ?>
                        <option value="<?php echo $ac->id; ?>"><?php echo $ac->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <?php } ?>
<?php } ?>-->
<?php if (isset($add_product)) { ?>
    <?php if ($grade_on == 'on') { ?>
        <div class="form-row complekt">
            <label class="field-name" for="standard">Комплектация:</label>

            <div class="row-fluid" style="width: 82%;float: left;clear:none">
                <div class="span6" style="width:100%">
                    <div class="widget">
                        <div class="table-container">

                            <table cellpading="0" cellspacing="0" border="0"
                                   class="default-table stripped turquoise dataTable" id="dynamic2">
                                <thead>
                                <tr align="left">
                                    <th></th>
                                    <th></th>
                                    <th>Наименование</th>
                                    <th>Группировка</th>
                                    <th>Ванна?</th>
                                    <th>Предопределено?</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($grades as $item) { ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><input type="checkbox" value="<?php echo $item->id; ?>" name="grade[]"/>
                                        </td>
                                        <td><?php echo $item->name; ?></td>
                                        <td>
                                            <?php $product = ORM::factory('catalog')->where('id', '=', $item->group)->find(); ?>
                                            <?php if (isset($product->name)) {
                                                ;
                                            } ?>
                                            <?php echo $product->name; ?>

                                        </td>
                                        <td><input type="checkbox" value="<?php echo $item->id; ?>" name="bath[]"/>
                                        <td><input type="checkbox" value="<?php echo $item->id; ?>"
                                                   name="bath_required[]"/>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<!--<div class="form-row">
    <label class="field-name" for="standard">Выбрать технологии:</label>

    <div class="field" style="text-align:left;">
        <select multiple name="techn[]" style="height: 100%">
            <option value=""></option>
            <?php foreach ($techn as $ac) { ?>
                <option value="<?php echo $ac->id; ?>"><?php echo $ac->name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>-->
<div class="form-row complekt">
    <label class="field-name" for="standard">Выбрать технологии:</label>

    <div class="row-fluid" style="width: 82%;float: left;clear:none">
        <div class="span6" style="width:100%">
            <div class="widget">
                <div class="table-container">

                    <table cellpading="0" cellspacing="0" border="0"
                           class="default-table stripped turquoise dataTable" id="dynamic3">
                        <thead>
                        <tr align="left">
                            <th></th>
                            <th></th>
                            <th>Наименование</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($techn as $item) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><input type="checkbox" value="<?php echo $item->id; ?>" name="techn[]"/>
                                </td>
                                <td><?php echo $item->name; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="form-row">
    <label class="field-name" for="standard">С этим товаром покупают (аксессуары):</label>

    <div class="field" style="text-align:left;">
        <select multiple name="products[]" style="height: 100%">
            <option value=""></option>
            <?php foreach ($products as $ac) { ?>
                <option value="<?php echo $ac->id; ?>"><?php echo $ac->name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>-->
<div class="form-row">
    <label class="field-name" for="standard">С этим товаром покупают (аксессуары):</label>

    <div class="row-fluid" style="width: 82%;float: left;clear:none">
        <div class="span6" style="width:100%">
            <div class="widget">
                <div class="table-container">

                    <table cellpading="0" cellspacing="0" border="0"
                           class="default-table stripped turquoise dataTable" id="dynamic4">
                        <thead>
                        <tr align="left">
                            <th></th>
                            <th></th>
                            <th>Наименование</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($products as $item) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><input type="checkbox" value="<?php echo $item->id; ?>" name="products[]"/>
                                </td>
                                <td><?php echo $item->name; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Изображения:</label>

    <div class="field" style="text-align: left;">
        <a id="upload3">
            Загрузить изображение
        </a>

        <div class="images massage-images">

        </div>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Схема монтажа:</label>

    <div class="field" style="text-align: left;">
        <input type="file" name="scheme"/>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Инструкция по эксплуатации:</label>

    <div class="field" style="text-align: left;">
        <input type="file" name="instruction"/>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Паспорт:</label>

    <div class="field" style="text-align: left;">
        <input type="file" name="passport"/>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Ссылка на производителя:</label>

    <div class="field" style="text-align: left;">
        <input type="text" class="input-large name-edit" name="manufacturer"
               style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Порядок вывода:</label>

    <div class="field" style="text-align: left;">
        <input type="text" class="input-large name-edit" name="order"
               style="float: left;width: 100%;">
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Включен?:</label>

    <div class="field" style="text-align: left;">
        <select class="form-control uniform" name="published">
            <option value="on" >Да</option>
            <option value="off">Нет</option>
        </select>
    </div>
</div>
<div class="form-row">
    <label class="field-name" for="standard">Технические характеристики:</label>

    <div class="field" style="text-align: left;">

        <input class="button-turquoise button" value="Добавить характеристику"
               onclick="addOption()" style="width: 200px"/>
    </div>
</div>
<!--                        <div class="form-row">-->
<!--                            <label class="field-name" for="standard">Технологии:</label>-->
<!---->
<!--                            <div class="field">-->
<!--                                <textarea name="technologies" id="technologies"-->
<!--                                          class="input-large name-edit"></textarea>-->
<!--                            </div>-->
<!--                        </div>-->
<div class="options">

</div>
<input type="hidden" class="num_options" value="0"/>
<input type="hidden" class="" name="category" value="<?php if (isset($add_product)) {
    echo $category->id;
} ?>"/>
<br/>
<input type="submit" class="button-turquoise button" value="Отправить"/>
<br/><br/>
</div>

</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="/js/admin/fileupload.js"></script>

<br/>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var uploadsB = [];
        var btnUpload = jQuery('#upload3');
        if (btnUpload.length) {
            var status = jQuery('#status');
            if (btnUpload != undefined) {
                var upload = new AjaxUpload(btnUpload, {
                    action: '/admin/catalog/uploadimage',
                    name: 'uploadfile',
                    data: {id: '123'},
                    onSubmit: function (file, ext) {
                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                            status.text('Поддерживаемые форматы JPG, PNG или GIF');
                            return false;
                        }
//status.text('Загрузка...');
                    },
                    onComplete: function (file, response) {
                        console.log(response);
                        var response_image = response.split("~");
                        var id_image = response_image[0];
                        var path = response_image[1];
                        var portfolio = jQuery('.images');
                        var image_html = '<div class="sws_img_block imagerel' + id_image + '">\n\
                                           <div class="img_block">\n\
                                                <img src="' + path + '" style="max-width: 194px;">\n\
                                           </div>\n\
                                           <div class="del_block">\n\
                                                <a href="javascript:void:(0);" class="del_vid" onclick="deletePortfolio(' + id_image + ');">Удалить</a>\n\
                                           </div>\n\
                                           <input type="radio" name="featured[]" value="' + id_image + '"/>Обложка товара\n\
                                   </div>';
                        var hidden = '<input type="hidden" class="image' + id_image + '" name="image[' + id_image + ']" rel="' + id_image + '"/> ';
                        portfolio.append(image_html);
                        portfolio.append(hidden);
                    }
                });
            }
        }
        <?php if(isset($_GET['type'])) { ?>
        var btnUpload2 = jQuery('#upload4');
        if (btnUpload2.length) {


            var status = jQuery('#status');
            console.log(btnUpload2);
            var upload1 = new AjaxUpload(btnUpload2, {
                action: '/admin/catalog/uploadmassage',
                name: 'uploadfile',
                data: {id: '123'},
                onSubmit: function (file, ext) {
                    if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                        status.text('Поддерживаемые форматы JPG, PNG или GIF');
                        return false;
                    }
//status.text('Загрузка...');
                },
                onComplete: function (file, response) {
                    var response_image = response.split("~");
                    var id_image = response_image[0];
                    var ids_image = id_image;
                    var path = response_image[1];
                    var select_html = jQuery('.select_for_massage').html();
                    var forsun_html = jQuery('.forsun_for_massage').html();
                    var price_for_massage = jQuery('.price_for_massage').html();
                    var default_for_massage = jQuery('.default_for_massage').html();
                    var required_for_massage = jQuery('.required_for_massage').html();
                    var underoption_for_massage = jQuery('.underoption_for_massage').html();
                    var portfolio = jQuery('.massage-options');
                    var image_html = '<div class="sws_img_block imagerel' + id_image + '">\n\
                                           <div class="img_block">\n\
                                                <img src="' + path + '" style="height:136px !important;clear:both">\n\
                                           </div><a id="upload'+id_image+'">Загрузить изображение пневмо</a>\n\
                                           <div class="del_block">\n\
                                                <a href="javascript:void:(0);" class="del_vid" onclick="deletePortfolio(' + id_image + ');">Удалить</a>\n\
                                           </div>' + select_html + forsun_html + price_for_massage + default_for_massage + required_for_massage + underoption_for_massage + '\n\
                                   </div>';
                    var hidden = '<input type="hidden" class="image' + id_image + '" name="massage[' + id_image + ']" rel="' + id_image + '"/> ';
                    //var uploadsB = jQuery('#upload'+id_image);

                    portfolio.append(image_html);

                    portfolio.append(hidden);
                    var upload1 = new AjaxUpload(jQuery('#upload'+id_image), {
                        action: '/admin/catalog/uploadmassage',
                        name: 'uploadfile',
                        data: {id: '123'},
                        onSubmit: function (file, ext) {
                            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                status.text('Поддерживаемые форматы JPG, PNG или GIF');
                                return false;
                            }
//status.text('Загрузка...');
                        },
                        onComplete: function (file, response) {
                            var response_image = response.split("~");
                            var id_image = response_image[0];
                            var path = response_image[1];
                            var select_html = jQuery('.select_for_massage').html();
                            var forsun_html = jQuery('.forsun_for_massage').html();
                            var price_for_massage = jQuery('.price_for_massage').html();
                            var default_for_massage = jQuery('.default_for_massage').html();
                            var required_for_massage = jQuery('.required_for_massage').html();
                            var underoption_for_massage = jQuery('.underoption_for_massage').html();
                            var portfolio = jQuery('.massage-options');
                            var image_html = '<img src="' + path + '" style="height: 136px !important;">';
                            var hidden = '<input type="hidden" class="image' + id_image + '" name="pnevmo['+ids_image+']" value="' + id_image + '" rel="' + id_image + '"/> ';
                            console.log(image_html);
                            jQuery('.del_block').append('<a href="javascript:void:(0);" class="del_vid del_vid'+id_image+'" onclick="deletePnevmo('+id_image+', '+ids_image+');">Удалить Пневмо</a>');
                            jQuery('#upload'+ids_image).css('display','none');
                            jQuery('#upload'+ids_image).parent().find('.img_block').append(image_html).append(hidden).css('height','137px').parent().css('height','538px');
                        }
                    });
                }
            });

        }
        <?php } ?>


    });

    function deletePortfolio(id) {
        jQuery('.image' + id).remove();
        jQuery('.imagerel' + id).remove();
    }
    function deletePnevmo(id, ids) {
        jQuery('.image' + id).remove();
        jQuery('.imagerel' + id).remove();
        jQuery('.img_block img:eq(1)').remove();
        jQuery('.del_vid'+id).remove();
        jQuery('#upload'+ids).css('display','block');
    }
</script>

<div class="table-container">
    <table cellpading="0" cellspacing="0" border="0" class="default-table blue">
        <thead>
        <tr align="left">
            <th>Номер</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Вкл?</th>
            <th>Дата изменения</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 1; ?>
        <?php foreach ($catalog as $item) { ?>
            <tr style="line-height: 24px">
                <td><?php echo $count++; ?></td>
                <td><?php echo $item->name; ?></td>
                <td><?php echo $item->price; ?></td>
                <?php $categorys = ORM::factory('productscat', $item->category); ?>
                <?php if (isset($categorys->id)) {
                    $category = $categorys->name;
                } else {
                    $category = '';
                } ?>

                <td style="text-align: left;"><i><?php echo $category; ?></i></td>
                <td><?php if($item->published) {
                        echo 'Да';
                    } else {
                        echo 'Нет';
                    } ?></td>
                <td><?php echo date("Y-m-d H:i:s", $item->time); ?></td>
                <td style="padding-left: 0px !important;padding-right: 0px !important;"><a href="/admin/catalog/editpage/<?php echo $item->id; ?>"><input
                            class="button-turquoise button" style="width:120px;" value="Редактировать"
                            /></a>
                </td>

                <td style="padding-left: 0px !important;padding-right: 0px !important;"><input
                        class="button-turquoise button" value="Удалить"
                        onclick="deletecat(<?php echo $item->id; ?>)" style="width:82px;" /></td>
                <td style="padding-left: 0px !important;padding-right: 0px !important;"><input
                        class="button-turquoise button" value="Копировать"
                        onclick="copy(<?php echo $item->id; ?>)" style="width:102px;" /></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div style="display:none">
    <div class="category" style="width:100%; text-align: center;">
        <select class="categories" class="uniform" onchange="writeValue(jQuery(this))">
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
            <?php } ?>
        </select><br/><br/>
        <input type="hidden" class="valueselect" value=""/>
        <input type="submit" class="button-turquoise button sendcategory" value="Отправить" style="margin-left:59px;"/>
    </div>
</div>

<script type="text/javascript">
    function deletecat(id) {
        if (confirm('Вы уверены?')) {
            window.location = '/admin/catalog/delete/' + id;
        }
    }

    function writeValue(val) {
        jQuery('.valueselect').val(val.val());
    }

    function edit(id) {
        window.location = '/admin/catalog/editpage/' + id;
    }

    function copy(id) {
        window.location = '/admin/catalog/copy/' + id;
    }

    jQuery(document).ready(function () {
        $('#dynamic2, #dynamic3, #dynamic4').dataTable({
            "sPaginationType": "full_numbers",
            "sDom": "<'tableHeader'<l><'clearfix'f>r>t<'tableFooter'<i><'clearfix'p>>",
            "iDisplayLength": 10,
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                }
            ]
        });
        <?php if(isset($add_product)) { ?>
        jQuery('.category-toggle').slideDown('slow', function () {
            jQuery(this).css('display', 'block');
        });
        <?php } ?>

        jQuery('.bs-callout.bs-callout-info, .bs-callout.bs-callout-danger').fadeOut(10000);
        var editor = CKEDITOR.replace('add-answer',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        var editor = CKEDITOR.replace('add-short',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');

        jQuery('.button.button-blue.marginbottom30').click(function () {
            jQuery.fancybox(jQuery('.category').html(), {
                afterShow: function () {
                    jQuery('.valueselect').val(jQuery('.categories').val());
                    jQuery('.sendcategory').click(function () {
                        var type = jQuery('.valueselect').val();
                        window.location = '/admin/catalog/?type=' + type;
                    });
                }
            });
        });
        jQuery('.tabitem').click(function () {
            jQuery(this).parents(5).children().children('.displayblock').removeClass('displayblock');
        });
        jQuery('.fancybox').fancybox({
            beforeShow: function () {
                var id = jQuery(this)[0].element.attr('rel_id');
                var group_name = jQuery('.group-name-' + id + ' a').html();
                var question = jQuery('#tabs' + id + ' .span12').val();
                jQuery('#form-edit .group-edit').val(id);
                jQuery('#form-edit .question-edit').val(question);
                jQuery('#form-edit .name-edit').val(group_name);
                jQuery('#form-edit').css('margin-left', '15px').css('margin-top', '26px');
            }
        });
    });

    function addOption() {
        var num = parseInt(jQuery('.num_options').val());

        jQuery('.options').append('<div class="form-row"><input type="text" class="input-large name-edit" name="customname-' + num + '" style="float: left;width:183px;"><div class="field"><input type="text" class="input-large name-edit" name="custom-' + num + '" style="float: left;width: 100%;"></div></div>');
        var num = parseInt(num) + 1;
        jQuery('.num_options').val(num);
    }


</script>
</div>