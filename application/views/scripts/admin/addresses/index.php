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
<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="row-fluid">
    <div class="widget">
        <form class="form-horizontal" style="text-align:center;">
            <div class="widget-header">
                <h5>Настройки блока:</h5>
            </div>
            <div class="widget-content no-padding">
                <div class="form-row">
                    <label class="field-name" for="standard">Количество выводимых пунктов:</label>

                    <div class="field">
                        <input type="text" class="span12 addr_num" name="standard" id="standard" value="<?php echo $addr_num; ?>">
                    </div>
                </div>
                <br>
                <a href="#" onclick="saveConf()" class="button button-turquoise small-button configuration-button" style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                <br><br>
            </div>
        </form>
    </div>
</div>



<script type="">
    function saveConf() {
        var addr_num = jQuery('.addr_num').val();
        jQuery.post('/admin/index/saveconf', {addr_num:addr_num}, function (data) {
            console.log(data);
            jQuery('.alert.alert-info.noMargin font').html('Настройки блока "Где купить" успешно сохранены!');
            jQuery('.alert.alert-info.noMargin').css('display', 'block');
            jQuery('.alert.alert-info.noMargin').fadeOut(3000);
        });
    }
</script>
</div>


<div class="row-fluid">
<div class="span6" style="width:100%">
<div class="widget">
    <div class="table-container">

            <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise dataTable"  id="dynamic2">
                <thead>
                <tr align="left">
                    <th>Номер</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Город</th>
                    <th>Время добавления</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                <?php foreach ($addresses as $item) { ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $item->address; ?></td>
                        <td><?php echo $item->phone; ?></td>
                        <td><?php echo $item->city; ?></td>
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
</div>
</div>
</div>



<div class="inner-content">
    <div class="widget-content" align="center">
        <a href="#" class="button button-blue marginbottom30"><img src="/images/admin/icon/14x14/white/download4.png"
                                                                   alt=""> Добавить адрес</a>
        <br/>
        <br/>

        <div class="category-toggle" style="display: none;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/addresses/new" method="POST">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Город:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="city"
                                           style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Адрес:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="address"
                                           style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Телефон:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="phone"
                                           style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Яндекс карты (<a target="_blank" href="http://api.yandex.ru/maps/tools/constructor/">Generator</a>)</label>
                                <div class="field">
                                    <input type="text" class="span12 map_code" name="map" id="standard" value="">
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
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Город</th>
                <th>Время добавления</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($addresses as $item) { ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $item->address; ?></td>
                    <td><?php echo $item->phone; ?></td>
                    <td><?php echo $item->city; ?></td>
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
                window.location = '/admin/addresses/delete/' + id;
            }
        }

        function edit(id) {
            window.location = '/admin/addresses/edit/' + id;
        }

        jQuery(document).ready(function () {



                $('#dynamic2').dataTable({
                    "sPaginationType": "full_numbers",
                    "sDom": "<'tableHeader'<l><'clearfix'f>r>t<'tableFooter'<i><'clearfix'p>>",
                    "iDisplayLength": 10,
                    "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }]
                });
                $('.dataTables_length select').chosen();



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