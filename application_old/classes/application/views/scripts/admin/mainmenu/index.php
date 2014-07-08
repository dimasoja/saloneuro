<?php echo ViewMessage::renderMessages(); ?>
<input class="submit page-new-add button button-turquoise small-button" type="button" value="Добавить пункт меню" onclick="redirectToAddMain()">
<div class="row-fluid">
<?php 
if(isset($menus)) {
    echo $menus;
}
?>
</div>