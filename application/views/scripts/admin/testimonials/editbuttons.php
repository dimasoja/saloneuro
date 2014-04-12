<?php echo ViewMessage::renderMessages(); ?>
<br/><h2>Edit buttons for <?php echo $id; ?>:</h2>
<?php if (empty($buttons) || count($buttons) != 5): ?>
<a href="javascript:void(0);" onclick="addButton();">Add button</a><br />
<?php endif; ?>
<?php if (!empty($buttons)): ?>
<div style="margin: 10px 0">
<?php foreach ($buttons as $button): ?>
    <input type="button" class="submit" value="<?php echo $button->title; ?>" onclick="addButton(<?php echo $button->id_button; ?>);" />
<?php endforeach; ?>
</div>
<?php endif; ?>
<div id="editbutton"></div>

<script type="text/javascript">
    function addButton(ident) {
        if (ident == undefined) ident = 0;
        jQuery.post(baseurl + 'admin/supplies/addbutton', {id: ident, type_column: '<?php echo $id; ?>'}, function(data) {
            jQuery('#editbutton').html(data);
        });
    }
    
    function save() {
        var title = jQuery('#title_btn').val();
        var supplies = "";
        jQuery('.supplies_btn').each(function() {
            if (jQuery(this).is(':checked')) {
                supplies += jQuery(this).val() + "|";
            }
            
        });
        jQuery.post(baseurl + 'admin/supplies/add', {t: title, s: supplies, id: jQuery('#id_button').val(), type_column: '<?php echo $id; ?>'}, function(data) {
            if ("1" == data) {
                jQuery('#editbutton').html("<span style='color: red; font-weight: bold;'>Saved!</span>");
                location.href = baseurl + 'admin/supplies/editbuttons/<?php echo $id; ?>';
            }
        })
    }
    function del(ident) {
        jQuery.post(baseurl + 'admin/supplies/del', {id: ident}, function(data) {
            if (data == "1") {
                location.href = baseurl + 'admin/supplies/editbuttons/<?php echo $id; ?>';
            }
        });
    }
</script>