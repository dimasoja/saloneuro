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
<form method ="post" action="<?php echo URL::base(); ?>admin/mainmenu/new/" id="topmenu-form-submit">
    <h1>Добавить новый пункт меню:</h1><br/>
        <p>       
        <input class="button button-turquoise small-button" type="button" value="Сохранить пункт меню" onclick="validateAndSubmit()" />   
    </p>
    <div id="meta_tag" style="display: block;">
        <h3>Имя пункта меню:</h3><input type="text" name="title" style="width: 652px !important;" id="title" value="<?php if (isset($title)) echo $title; ?>"><br>
        <h3>Тип услуги:</h3>
        <select name="for" id="type">
            <option value="for_home" <?php if (isset($type)) {
    if ($type == 'for_home') echo 'selected';
} ?>>Для дома</option>
            <option value="for_business" <?php if (isset($type)) {
    if ($type == 'for_business') echo 'selected';
} ?>>Для бизнеса</option>        
        </select>
        <br>
        <h3>Родитель</h3>
        <input type="hidden" name="parent" id="parent" value="<?php if (isset($parent)) echo $parent; ?>"/><div class="parent"><?php if (isset($parent_title)) echo $parent_title; ?></div>
        <a id="diary-fancy" href="#menu">
            <input class="submit" type="button" value="Выбрать родителя">
        </a>
        <h3>Позиция:</h3><input type="text" name="position" style="width: 652px !important;" id="position" value="<?php if (isset($position)) echo $position; ?>"><br>
        <h3>URL - адрес <a id="diary-fancy" href="#pages">
                <input class="submit" type="button" value="Выбрать страницы">
            </a></h3><input type="text" name="uri" style="width: 652px !important;" id="uri" value="<?php if (isset($uri)) echo $uri; ?>"><br>
        <h3>Классы css (через запятую):</h3><input type="text" name="classes" style="width: 652px !important;" id="classes" value="<?php if (isset($classes)) echo $classes; ?>"><br>
        <br/><h3>Опубликовано? <input type="checkbox" name="published" <?php if ((isset($published)) and ($published == 'on')) echo "checked='checked'"; ?>/></h3>
    </div><br/>
    <br/>
    <p>       
        <input class="submit" type="button" value="Сохранить пункт меню" onclick="validateAndSubmit()" />   
    </p>
</form>
<div id="add-entry-fancy" style="display:none">
    <div id="pages">
        <h3 style="color: white">Страницы</h3>
        <?php
        foreach ($pages as $page) {
            echo "<font class='title-pages' onClick=putToUri('" . $page->browser_name . "')>" . $page->title . "</font><br/>";
        }
        ?>
        <h3 style="color: white">Услуги</h3>
        <?php $types = array('for_home'=>'Для дома', 'for_business'=>'Для бизнеса'); ?>
<?php
foreach ($products as $product) {
    echo "<font class='title-pages' onClick=putToUri('" . $product->browser_name . "')>" . $product->title . " [".$types[$product->type]."]</font><br/>";
}
?>
    </div>
</div>
<div id="add-entry-fancy1" style="display:none">
    <div id="menu">
<?php if (isset($menu)) echo $menu; ?>
    </div>
</div>
