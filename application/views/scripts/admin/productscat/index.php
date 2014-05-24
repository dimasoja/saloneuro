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
        <a href="#" class="button button-blue marginbottom30"><img src="/images/admin/icon/14x14/white/download4.png"
                                                                   alt=""> Добавить категорию</a>
        <br/>
        <br/>

        <div class="category-toggle" style="display: none;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/productscat/new" method="POST" enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новый:</h5>
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
                                    <input type="text" class="input-large name-edit" name="keywords" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Description (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="description" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Текст:</label>
                                <div class="field">
                                    <textarea name="content" id="add-answer" class="input-large name-edit"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить массажные опции:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="massage_on" class="uniform"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить комплектацию:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="grade_on" class="uniform"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Изображение категории:</label>
                                <div class="field">
                                    <input type="file" name="image"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Тип товаров в категории (если ванны):</label>
                                <div class="field" style="text-align:left;">
                                    <select name="type" class="uniform">
                                        <option value=""></option>
                                        <option value="acrylic">Массажные опции скрыты, гидромассажная опция не выбрана</option>
                                        <option value="massage">Массажные опции раскрыты, гидромассажная опция выбрана</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Тип (для фильтров):</label>

                                <div class="field" style="text-align: left;">
                                    <select class="form-control uniform" name="type_filter">
                                        <option value="bath">Ванна</option>
                                        <option value="accessory">Аксессуар</option>
                                        <option value="shower">Душевая Кабинаы</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Порядок:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="order"
                                           style="float: left;width: 100%;">
                                </div>
                            </div>
                            <br/>
                            <input type="submit" class="button button-blue small-button margintop18 marginleft128"
                                       value="Добавить">
                            <br/>
                            <br/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table blue">
            <thead>
            <tr align="left">
                <th>Номер</th>
                <th>Наименование</th>
                <th>Массажные опции</th>
                <th>Комплектация</th>
                <th>Порядок</th>
                <th>Дата добавления</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($productscat as $item) { ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $item->name; ?></td>
                    <td><?php if($item->massage_on=='off') {
                            echo 'Нет';
                        } else {
                            echo 'Да';
                        } ?></td>
                    <td><?php if($item->grade_on=='off') {
                            echo 'Нет';
                        } else {
                            echo 'Да';
                        } ?></td>
                    <td><?php echo $item->order; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $item->time); ?></td>
                    <td><input class="button-turquoise button" value="Редактировать"
                               onclick="edit(<?php echo $item->id; ?>)"/></td>
                    <td><input class="button-turquoise button" value="Удалить"
                               onclick="deletecat(<?php echo $item->id; ?>)"/></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        function deletecat(id) {
            if (confirm('Вы уверены?')) {
                window.location = '/admin/productscat/delete/' + id;
            }
        }

        function edit(id) {
            window.location = '/admin/productscat/edit/' + id;
        }

        jQuery(document).ready(function () {
            var editor = CKEDITOR.replace('add-answer',
                {
                    uiColor : 'lightgrey',
                    language: 'en'
                });
            CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
            jQuery('.bs-callout.bs-callout-info, .bs-callout.bs-callout-danger').fadeOut(10000);

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


    </script>
</div>