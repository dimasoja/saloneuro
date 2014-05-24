<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Edit images of work samples</h1>
<?php if (count($images) > 0): ?>
    <div>
        <input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
        <input type="button" class="submit" value="Sort" onclick="saveSort();" />
    </div>
    <form action="<?php echo URL::base(); ?>admin/servicesworksamples" name="sortForm" method="POST" >
        <?php foreach ($images as $image): ?>
            <div class="sws_img_block">
                <div class="chk_block">
                    <input type="checkbox" class="chk" rel="<?php echo $image->id_image; ?>" />
                </div>
                <div class="img_block">
                    <img src="<?php echo URL::base(); ?>uploads/images/<?php echo $image->path; ?>" style="max-width: 194px;" />
                </div>
                <div class="del_block">
                    <input type="text" class="sort_vid" value="<?php echo $image->sort; ?>" onfocus="clearThisFocus(this, <?php echo $image->sort; ?>)" onblur="clearThisBlur(this, <?php echo $image->sort; ?>)" name="sort[<?php echo $image->id_image; ?>]" />
                    <a href="javascript:void:(0);" class="del_vid" onclick="deleteImg(<?php echo $image->id_image; ?>);">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </form>
    <div class="clear"></div>
    <?php if ($pages > 1): ?>
        <div id="sws_pages">
            <?php
            $str_pages = "";
            for ($pg = 1; $pg <= $pages; $pg++) {
                if ($page == $pg) {
                    $str_pages .= $pg . " | ";
                } elseif ($pg == 1) {
                    $str_pages .= '<a href="' . URL::base() . 'admin/servicesworksamples">' . $pg . '</a> | ';
                } else {
                    $str_pages .= '<a href="' . URL::base() . 'admin/servicesworksamples/page/' . $pg . '">' . $pg . '</a> | ';
                }
            }
            $str_pages = substr($str_pages, 0, -3);
            echo $str_pages;
            ?>
        </div>
    <?php endif; ?>
    <div>
        <input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
        <input type="button" class="submit" value="Sort" onclick="saveSort();" />
    </div>
    <div class="clear" style="margin-bottom: 20px;"></div>
<?php endif; ?>
<form method="post" action="<?php echo URL::base(); ?>admin/servicesworksamples" enctype="multipart/form-data">
    Add image: <input type="file" name="image_file" />
    <input type="submit" value="Upload" />
</form><br/>
<input type="button" class="submit" value="Back" onclick="javascript:history.back();" />
<!--a href="javascript:history.back();"><< Back</a-->

<script type="text/javascript">
    var chk_ = false;
    function deleteImg(id_img) {
        if (confirm('Do you really want to delete this image?')) {
            location.href="<?php echo URL::base(); ?>admin/servicesworksamples/delete/" + id_img;
        }
    }
    
    function clearThisFocus(obj, old_value) {
        if (obj.value == "")
            obj.value = old_value;
        else 
            obj.value = "";
    }
    
    function clearThisBlur(obj, old_value) {
        if (obj.value == "")
            obj.value = old_value;
    }
    
    function saveSort() {
        document.forms.sortForm.submit();
    }
    
    function deleteChecked() {
        if (chk_) {
            if (confirm('Do you really want to delete this checked images?')) {
                var ids = "";
                jQuery('.chk').each(function(){
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '|';
                    }

                });
                location.href = "<?php echo URL::base(); ?>admin/servicesworksamples/deleteall/" + ids;
            }
        }
    }
    
    jQuery(document).ready(function(){
        jQuery('.check_all').click(function(){
            var checked_status = this.checked;
            chk_ = checked_status;
            jQuery('.chk').each(function(){
                this.checked = checked_status;
            });
            jQuery('.check_all').each(function(){
                this.checked = checked_status;
            });
        });
        
        jQuery('.chk').click(function(){
            chk_ = false;
            jQuery('.chk').each(function(){
                if (this.checked) {
                    chk_ = true;
                }
            });
        });
        
        setTimeout(function(){ jQuery('#adminMessage').hide('slow'); }, 3000);
    })
</script>