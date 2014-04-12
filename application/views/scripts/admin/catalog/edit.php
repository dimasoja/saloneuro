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
<div class="inner-content">
<div class="widget-content" align="center">


    <div class="category-toggle" style="display: block;overflow:auto">
        <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
            <div class="widget">
                <form class="form-horizontal" action="/admin/catalog/editpage/<?php echo $product->id; ?>"
                      method="POST"
                      enctype="multipart/form-data">
                    <div class="widget-header">
                        <div style="display:none"><?php echo $category->name; ?></div>
                        <h5>Товар <?php if (isset($category->name)) { ?>(<?php echo $category->name; ?>) <?php } ?>
                            :</h5>
                    </div>
                    <div class="widget-content no-padding">
                        <div class="form-row">
                            <label class="field-name" for="standard">Наименование:</label>

                            <div class="field">
                                <input type="text" class="input-large name-edit" name="name"
                                       style="float: left;width: 100%;" value="<?php echo $product->name; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="field-name" for="standard">Описание:</label>

                            <div class="field">
                                <textarea name="description" id="add-answer"
                                          class="input-large name-edit"><?php echo $product->description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="field-name" for="standard">Цена:</label>

                            <div class="field">
                                <input type="text" class="input-large name-edit" name="price"
                                       style="float: left;width: 100%;" value="<?php echo $product->price; ?>">
                            </div>
                        </div>
                        <!--                            <div class="form-row">-->
                        <!--                                <label class="field-name" for="standard">Изображение:</label>-->
                        <!--                                <div class="field">-->
                        <!--                                    <input type="file" class="input-large name-edit" name="image" style="float: left;width: 100%;">-->
                        <!--                                </div>-->
                        <!--                                <input type="submit" class="button button-blue small-button margintop18 marginleft128" value="Добавить">-->
                        <!--                            </div>-->
                        <?php foreach ($directory as $dir) { ?>
                            <?php $option = ORM::factory('options')->where('name', '=', $dir->id)->where('type', '=', 'directory')->where('id_product', '=', $product->id)->find(); ?>
                            <div class="form-row">
                                <label class="field-name" for="standard"><?php echo $dir->name; ?>:</label>

                                <div class="field" style="text-align:left;">
                                    <?php if($dir->type=='select') { ?>
                                    <select name="dir-<?php echo $dir->id; ?>" class="uniform">
                                        <?php $all_children = ORM::factory('directory')->where('parent_id', '=', $dir->id)->find_all()->as_array(); ?>

                                        <option value=""></option>
                                        <?php foreach ($all_children as $ac) { ?>
                                            <option
                                                value="<?php echo $ac->id; ?>" <?php if ($ac->id == $option->value) {
                                                echo 'selected';
                                            } ?>><?php echo $ac->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } else { ?>
                                        <input type="text" name="dir-<?php echo $dir->id; ?>" class="input-large name-edit" style="float:left; width:100%" value="<?php echo $option->value; ?>"/>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($massage_on)) { ?>
                            <?php if ($massage_on == 'on') { ?>
                                <div class="form-row">
                                    <?php $options = ORM::factory('options')->where('type', '=', 'massage')->where('id_product', '=', $product->id)->find_all()->as_array(); ?>
                                    <label class="field-name" for="standard">Массажные опции:</label>

                                    <div class="field" style="text-align:left;">
                                        <select multiple name="massage[]" style="height: 100%">
                                            <option value=""></option>
                                            <?php foreach ($massages as $ac) { ?>
                                                <?php $selected = ''; ?>
                                                <?php foreach ($options as $option) {
                                                    if ($ac->id == $option->value) {
                                                        $selected = 'selected';
                                                    }
                                                } ?>
                                                <option
                                                    value="<?php echo $ac->id; ?>" <?php echo $selected; ?>><?php echo $ac->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (isset($grade_on)) { ?>
                            <?php if ($grade_on == 'on') { ?>
                                <div class="form-row">
                                    <label class="field-name" for="standard">Комплектация:</label>
                                    <?php $options = ORM::factory('options')->where('type', '=', 'grade')->where('id_product', '=', $product->id)->find_all()->as_array(); ?>
                                    <div class="field" style="text-align:left;">
                                        <select multiple name="grade[]" style="height: 100%">
                                            <option value=""></option>
                                            <?php foreach ($grades as $ac) { ?>
                                                <?php $selected = ''; ?>
                                                <?php foreach ($options as $option) {
                                                    if ($ac->id == $option->value) {
                                                        $selected = 'selected';
                                                    }
                                                } ?>
                                                <option
                                                    value="<?php echo $ac->id; ?>" <?php echo $selected; ?>><?php echo $ac->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="form-row">
                            <?php $options = ORM::factory('options')->where('type', '=', 'products')->where('id_product', '=', $product->id)->find_all()->as_array(); ?>
                            <label class="field-name" for="standard">С этим товаром часто покупают (акссесуары):</label>

                            <div class="field" style="text-align:left;">
                                <select multiple name="products[]" style="height: 100%">
                                    <option value=""></option>
                                    <?php foreach ($products as $ac) { ?>
                                        <?php $selected = ''; ?>
                                        <?php foreach ($options as $option) {
                                            if ($ac->id == $option->value) {
                                                $selected = 'selected';
                                            }
                                        } ?>
                                        <?php if($ac->id != $product->id) { ?>
                                        <option
                                            value="<?php echo $ac->id; ?>" <?php echo $selected; ?>><?php echo $ac->name; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="field-name" for="standard">Изображения:</label>
                            <?php $options = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $product->id)->find_all()->as_array(); ?>
                            <div class="field" style="text-align: left;">
                                <a id="upload3">
                                    Загрузить изображение для портфолио
                                </a>

                                <div class="images">
                                    <?php foreach ($options as $option) { ?>
                                        <?php $image = ORM::factory('images')->where('id_image', '=', $option->value)->find(); ?>
                                        <div class="sws_img_block imagerel<?php echo $option->value; ?>">
                                            <div class="img_block">
                                                <img src="<?php echo $image->path; ?>" style="max-width: 194px;">
                                            </div>
                                            <div class="del_block">
                                                <a href="javascript:void:(0);" class="del_vid"
                                                   onclick="deletePortfolio(<?php echo $image->id_image; ?>);">Удалить</a>
                                            </div>
                                        </div>
                                        <input type="hidden" class="image<?php echo $image->id_image; ?>"
                                               name="image[<?php echo $image->id_image; ?>]"
                                               rel="<?php echo $image->id_image; ?>"/>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="field-name" for="standard">Схема монтажа:</label>

                            <div class="field" style="text-align: left;">
                                <input type="file" name="scheme"/>
                                <?php if ($product->scheme != "") { ?>
                                    <a href="/<?php echo $product->scheme; ?>">Схема</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-row" style="text-align: left">
                            <label class="field-name" for="standard">Инструкция по эксплуатации:</label>

                            <div class="field" style="text-align: left;">
                                <input type="file" name="instruction"/>
                            </div>
                            <?php if ($product->instruction != "") { ?>
                                <a href="/<?php echo $product->instruction; ?>">Инструкция</a>
                            <?php } ?>
                        </div>
                        <div class="form-row">
                            <?php $options = ORM::factory('options')->where('type', '=', 'custom')->where('id_product', '=', $product->id)->find_all()->as_array(); ?>
                            <label class="field-name" for="standard">Технические характеристики:</label>

                            <div class="field" style="text-align: left;">
                                <input class="button-turquoise button" value="Добавить характеристику"
                                       onclick="addOption()" style="width: 200px"/>
                            </div>
                        </div>
                        <div class="options">
                            <?php $count = 0; ?>
                            <?php foreach ($options as $option) { ?>
                                <div class="form-row">
                                    <input type="text" class="input-large name-edit"
                                           name="customname-<?php echo $count; ?>"
                                           style="float: left;width:183px;" value="<?php echo $option->name; ?>">

                                    <div class="field">
                                        <input type="text" class="input-large name-edit"
                                               name="custom-<?php echo $count; ?>"
                                               style="float: left;width: 100%;" value="<?php echo $option->value; ?>">
                                    </div>
                                </div>
                                <?php $count++; ?>
                            <?php } ?>
                        </div>
                        <input type="hidden" class="num_options" value="<?php echo $count; ?>"/>
                        <input type="hidden" name="category" value="<?php if(isset($product->category)) echo $product->category; ?>"/>
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
        var btnUpload = jQuery('#upload3');
        var status = jQuery('#status');
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
                                   </div>';
                var hidden = '<input type="hidden" class="image' + id_image + '"  name="image[' + id_image + ']" rel="' + id_image + '"/> ';
                portfolio.append(image_html);
                portfolio.append(hidden);
            }
        });


    });

    function deletePortfolio(id) {
        jQuery('.image' + id).remove();
        jQuery('.imagerel' + id).remove();
    }
</script>


<script type="text/javascript">
    function deletecat(id) {
        if (confirm('Вы уверены?')) {
            window.location = '/admin/catalog/delete/' + id;
        }
    }

    function edit(id) {
        window.location = '/admin/catalog/editpage/' + id;
    }

    jQuery(document).ready(function () {
        jQuery('.bs-callout.bs-callout-info, .bs-callout.bs-callout-danger').fadeOut(10000);
        var editor = CKEDITOR.replace('add-answer',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');
        jQuery('.button.button-blue.marginbottom30').click(function () {
            if (jQuery('.category-toggle').css('display') == 'none') {
                jQuery('.category-toggle').slideDown('slow', function () {
                    jQuery(this).css('display', 'block');
                });
            } else {
                jQuery('.category-toggle').slideUp('slow', function () {
                    jQuery(this).css('display', 'none');
                });
            }
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