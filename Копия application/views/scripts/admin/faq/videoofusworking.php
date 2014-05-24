<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>

<h1>Videos of us working</h1>
<div id="add_video_block">
    <form method="post" action="<?php echo URL::base(); ?>admin/videoofusworking" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Please, choose the thumbnail:</td>
                <td><input type="file" name="thumbnail" /></td>
            </tr>
            <tr>
                <td>Please, choose the videofile<sup>*</sup> :</td>
                <td><input type="file" name="videofile" /></td>
            </tr>
        </table> 
        <div class="admin_note">
            <sup>*</sup> Accepted file formats: MP4, FLV, F4V, MOV, 3GP, 3G2
        </div>
        <br />
        <input type="submit" value="upload" />
    </form>
</div>

<?php if (count($videos) > 0): ?>
    <form action="<?php echo URL::base(); ?>admin/videoofusworking" name="sortForm" method="POST" >
        <div id="videos_block">
            <div>
                <input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
                <input type="button" class="submit" value="Sort" onclick="saveSort();" />
            </div>
            <?php foreach ($videos as $video): ?>
                <div class="sws_img_block">
                    <div class="chk_block">
                        <input type="checkbox" class="chk" rel="<?php echo $video->id_video; ?>" />
                    </div>
                    <div class="img_block">
                        <img src="<?php echo URL::base(); ?>uploads/images/<?php echo $video->thumbnail; ?>" style="max-width: 194px;" />
                    </div>
                    <div class="del_block">
                        <input type="text" class="sort_vid" value="<?php echo $video->sort; ?>" onfocus="clearThisFocus(this, <?php echo $video->sort; ?>)" onblur="clearThisBlur(this, <?php echo $video->sort; ?>)" name="sort[<?php echo $video->id_video; ?>]" />
                        <a href="javascript:void:(0);" class="del_vid" onclick="deleteImg(<?php echo $video->id_video; ?>);">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="clear"></div>
            <?php if ($pages > 1): ?>
                <div id="sws_pages">
                    <?php
                    $str_pages = "";
                    for ($pg = 1; $pg <= $pages; $pg++) {
                        if ($page == $pg) {
                            $str_pages .= $pg . " | ";
                        } elseif ($pg == 1) {
                            $str_pages .= '<a href="' . URL::base() . 'admin/videoofusworking">' . $pg . '</a> | ';
                        } else {
                            $str_pages .= '<a href="' . URL::base() . 'admin/videoofusworking/page/' . $pg . '">' . $pg . '</a> | ';
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
        </div>
    </form>
<?php endif; ?>
<input type="button" class="submit" value="Back" onclick="javascript:history.back();" />
<!--a href="javascript:history.back();"><< Back</a-->

<script type="text/javascript">
    var chk_ = false;
    function deleteImg(id_img) {
        if (confirm('Do you really want to delete this video?')) {
            location.href="<?php echo URL::base(); ?>admin/videoofusworking/delete/" + id_img;
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
            if (confirm('Do you really want to delete this checked videos?')) {
                var ids = "";
                jQuery('.chk').each(function(){
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '|';
                    }

                });
                location.href = "<?php echo URL::base(); ?>admin/videoofusworking/deleteall/" + ids;
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