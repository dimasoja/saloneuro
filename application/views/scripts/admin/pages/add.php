<?php echo ViewMessage::renderMessages(); ?>
<div id="messages">
    <?php
    if (isset($success)) {
        if ($success == 'ok') {
            $text = "<div class='success-text'>Сохранено успешно</div>";
        }
        if ($success == 'found_url') {
            $text = "<div class='error-text'>Такой адрес страницы уже существует. Пожалуйста, введите другой.</div>";
        }
        ?>
        <div class="success-mess">
            <?php echo '<img class="success-img" src="/images/check_no.png"/>';
            echo $text; ?>
        </div>

    <?php } ?>
</div>
<form method="post" action="<?php echo URL::base(); ?>admin/pages/new/" id="edit-form-submit" class="form-horizontal">
    <button class="button submit button-blue small-button" onclick="validate()">Сохранить страницу</button>
    <br/><br/>
    <div class="widget">
        <div class="widget-header">
            <h5>Добавить новую страницу:</h5>

        </div>
        <div class="widget-content no-padding">
            <div class="form-row">
                <label class="field-name" for="standard">Имя страницы:</label>

                <div class="field">
                    <input type="text" name="title" style="width: 652px !important;" id="title"
                           value="<?php if (isset($title)) {
                               echo $title;
                           } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Ключевые слова (мета тэг):</label>

                <div class="field">
                    <input type="text" name="keywords" style="width: 652px !important;"
                           id="keywords" value="<?php if (isset($kewwords)) {
                        echo $keywords;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Описание (мета тэг):</label>

                <div class="field">
                    <textarea id="description" name="description" cols="90"
                              rows="5"><?php if (isset($description)) {
                            echo $description;
                        } ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Адрес страницы (от корня):</label>

                <div class="field">
                    <input type="text" name="browser_name" style="width: 652px !important;"
                           id="alias" value="<?php if (isset($browser_name)) {
                        echo $browser_name;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Контент:</label>

                <div class="field">
                    <textarea name="content" style="width: 100%; height: 600px;"><?php if (isset($text)) {
                            echo $text;
                        } ?></textarea>
                </div>
            </div>
<!--            <div class="form-row">-->
<!--                <label class="field-name" for="standard">Тип:</label>-->
<!---->
<!--                <div class="field">-->
<!--                    <select name="type" class="uniform">-->
<!--                        <option value="simple" selected>Обычная</option>-->
<!--                        <option value="news">Новости/Статьи</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
            <div class="form-row">
                <label class="field-name" for="standard">Опубликовано?</label>

                <div class="field">
                    <input type="checkbox"
                           name="published" <?php if ((isset($published)) and ($published == 'on')) {
                        echo "checked='checked'";
                    } ?>/>
                </div>
            </div>
        </div>

    </div>
    <button class="button submit button-blue small-button" onclick="validate()">Сохранить страницу</button>
    <br/><br/>
</form>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var editor = CKEDITOR.replace('content',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');
    });
    function editTemplate(obj) {
        var id = obj.value;
        location.href = baseurl + 'admin/emails/index/' + id;
    }
    function deleteTemplate(id) {
        if (confirm("Do you want to delete this template?")) {
            location.href = baseurl + 'admin/emails/delete/' + id;
        }
    }
    function validate() {
        if (jQuery('input[name=title]').val() == '') {
            jQuery('#messages').html('<div class="success-mess"><img class="error-img" src="/images/close-icon.gif"/><div class="error-mess">Имя страницы обязательно.</div></div>');
        } else {
            jQuery('#edit-form-submit').submit();
        }
    }
</script>