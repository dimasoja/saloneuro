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
                                                                   alt=""> Добавить сертификат</a>
        <br/>
        <br/>

        <div class="category-toggle" style="display: none;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/certificates/new" method="POST" enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Описание:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="description"
                                           style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить в блок:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" class="uniform" name="featured"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Сертификат:</label>
                                <div class="field">
                                    <input type="file" name="image"/>
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
                <th>Описание</th>
                <th>Дата добавления</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            <?php foreach ($certificates as $item) { ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $item->description; ?></td>
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
                window.location = '/admin/certificates/delete/' + id;
            }
        }

        function edit(id) {
            window.location = '/admin/certificates/edit/' + id;
        }

        jQuery(document).ready(function () {
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