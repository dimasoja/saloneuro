<?php $message = ViewMessage::renderMessages(); ?>
<?php if( $message != '' ) {  ?>
<div class="alert alert-info noMargin" style="display:block">
    <button type="button" class="close" data-dismiss="alert">×</button>
     <?php echo $message; ?>
</div>
<br/>
    <?php } ?>

<a href="#" class="page-new-add button button-turquoise" onclick="redirectToAdd()">Добавить пункт меню</a>
<br/>
<br/>

<div class="widget">
    <div class="widget-header">
        <h5>Меню</h5>
    </div>
    <div class="widget-content">
<?php 
if(isset($menus)) {
    echo $menus;
}
?>
        </div>
    </div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.alert').fadeOut(10000);
    });
</script>