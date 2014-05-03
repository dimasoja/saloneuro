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
            <?php
            echo '<img class="success-img" src="/images/check_no.png"/>';
            echo $text;
            ?>
        </div>

    <?php } ?>
</div>


<a href="#" class="button submit button-blue small-button" onclick="validateAndSubmit()">Сохранить пункт меню</a><br/>
<br/>
<div class="widget">
        <form method ="post" action="<?php echo URL::base(); ?>admin/topmenu/new/" class="form-horizontal" id="topmenu-form-submit">
        <div class="widget-header">
            <h5>Добавить новый пункт меню:</h5>

        </div>
        <div class="widget-content no-padding">
            <div class="form-row">
                <label class="field-name" for="standard">Имя пункта меню:</label>

                <div class="field">
                    <input type="text" id="title" name="title" class="span12"
                           value="<?php if (isset($title)) {
                               echo $title;
                           } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="password">Родитель:</label>

                <div class="field">
                    <input type="hidden" name="parent" id="parent" value="<?php if (isset($parent)) {
                        echo $parent;
                    } ?>"/>
                    <span class="parent label"><?php if (isset($parent_title)) {
                            echo $parent_title;
                        } ?></span><br/>
                    <a href='#menu' id='diary-fancy' class="button submit button-turquoise" style='margin-top: 4px;'>Выбрать
                        родителя</a>
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="placeholder">Позиция:</label>

                <div class="field">
                    <input type="text" name="position" class="span12" id="position" value="<?php if (isset($position)) {
                        echo $position;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="predefine">Статическая страница: <br/><br/><br/>URL - адрес:<br/></label>

                <div class="field">
                    <a href='#pages' id='diary-fancy' class="button submit button-turquoise" style='margin-top: 4px;'>Выбрать
                        страницы</a><br/><br/>
                    <input type="text" name="uri" class="span12" id="uri" value="<?php if (isset($uri)) {
                        echo $uri;
                    } ?>"><br>
                </div>
            </div>
            <div class="form-row">
                <label class="field-name">Классы css (через запятую):</label>

                <div class="field">
                    <input type="text" name="classes" class="span12" id="classes" value="<?php if (isset($classes)) {
                        echo $classes;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name">Опубликовано?</label>

                <div class="field">
                    <input type="checkbox" name="published" <?php if ((isset($published)) and ($published == 'on')) {
                        echo "checked='checked'";
                    } ?>/>
                </div>
            </div>

        </div>
    </form>
</div>
<br/>
<a href="#" class="button submit button-blue small-button" onclick="validateAndSubmit()">Сохранить пункт меню</a>


<div id="add-entry-fancy" style="display:none">
    <div id="pages" style='width: 700px;'>
        <h3>Страницы</h3>
        <?php
        foreach ($pages as $page) {
            echo "<font class='title-pages' onClick=putToUri('" . $page->browser_name . "')>" . $page->title . "</font><br/>";
        }
        ?>
        <!--<h3>Услуги</h3>
        <?php $types = array('for_home' => 'Для дома', 'for_business' => 'Для бизнеса'); ?>
        <?php
        foreach ($products as $product) {
            echo "<font class='title-pages' onClick=putToUri('" . $product->browser_name . "')>" . $product->title . " [" . $types[$product->type] . "]</font><br/>";
        }
        ?>-->
    </div>
</div>
<div id="add-entry-fancy1" style="display:none">
    <div id="menu">
        <?php if (isset($menu)) {
            echo $menu;
        } ?>
    </div>
</div>
