<?php $message = ViewMessage::renderMessages(); ?>
<?php if( $message != '' ) {  ?>
    <div class="alert alert-info noMargin" style="display:block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $message; ?>
    </div>
    <br/>
<?php } ?>

<form method="post" action="<?php echo URL::base(); ?>admin/slider" enctype="multipart/form-data">
    <input type="file" name="image_file" class="input_file" />
    <input type="submit" class=' button small-button button-blue' value="Загрузить" />
</form><br/>
<?php if (count($images) > 0): ?>
    <div>
<!--        <input type="button" class="submit button small-button button-turquoise" value="Удалить выбранные" onclick="deleteChecked();" />-->
<!--        <input type="button" class="submit button small-button button-turquoise" value="Сортировать" onclick="saveSort();" />-->
    </div>
    <form action="<?php echo URL::base(); ?>admin/slider" name="sortForm" method="POST" >
        <?php foreach ($images as $image): ?>
            <?php $postmeta = ORM::factory('postmeta'); ?>
            <div class="sws_img_block image-<?php echo $image->id_image; ?>">
                <div class="success-message success-message-<?php echo $image->id_image; ?>" style="display:none">

                </div>
                <div class="slider-image">
<!--                    <div class="chk_block">-->
<!--                        <input type="checkbox" class="chk" rel="--><?php //echo $image->id_image; ?><!--" />-->
<!--                    </div>-->
                    <div class="img_block" style="margin-bottom: 0px;">
                        <img src="<?php echo URL::base(); ?>uploads/images/<?php echo $image->path; ?>" style="max-width: 194px;" />
                        <br/><br/>                           
<!--                        <input type="radio" id="for-home" name="slider-radio---><?php //echo $image->id_image; ?><!--" value="1" --><?php //if ($postmeta->getValue($image->id_image, 'for_home', 'image') == 'true') echo 'checked="checked"'; ?><!--/> Для дома<br/>                        -->
<!--                        <input type="radio" id="for-business" value="2" name="slider-radio---><?php //echo $image->id_image; ?><!--" --><?php //if ($postmeta->getValue($image->id_image, 'for_business', 'image') == 'true') echo 'checked="checked"'; ?><!-- /> Для бизнеса-->
                    </div>
                    <div>
<!--                        Наименование<br/>-->
                        <input type="text" id="slider-title" style="width:194px" value='<?php echo $postmeta->getValue($image->id_image, 'title', 'image'); ?>'/><br/>

                    </div>
                    <div class="del_block">
                        <input type="text" class="sort_vid" value="<?php echo $image->sort; ?>" onfocus="clearThisFocus(this, <?php echo $image->sort; ?>)" onblur="clearThisBlur(this, <?php echo $image->sort; ?>)" name="sort[<?php echo $image->id_image; ?>]" />
                        <a href="javascript:void:(0);" class="del_vid" onclick="deleteImg(<?php echo $image->id_image; ?>);">Удалить</a>
                    </div>
                    <input type="button" class="submit button small-button button-turquoise" style="width:100%" value="Сохранить" onclick="save(<?php echo $image->id_image; ?>);">

                </div>
                <div class="slider-items">

<!--                    Виды 1<br/>-->
<!--                    <input type="text" id="item1" value='--><?php //echo $postmeta->getValue($image->id_image, 'item1', 'image'); ?><!--'/><br/>-->
<!--                    Виды 2<br/>-->
<!--                    <input type="text" id="item2" value='--><?php //echo $postmeta->getValue($image->id_image, 'item2', 'image'); ?><!--'/><br/>-->
<!--                    Виды 3<br/>-->
<!--                    <input type="text" id="item3"  value='--><?php //echo $postmeta->getValue($image->id_image, 'item3', 'image'); ?><!--'/><br/>-->
<!--                    Виды 4<br/>-->
<!--                    <input type="text" id="item4"  value='--><?php //echo $postmeta->getValue($image->id_image, 'item4', 'image'); ?><!--'/><br/>-->

                </div>
                <div class="clearboth">&nbsp;</div>
<!--                <div class="floatleft">-->
<!--                    <a id='diary-fancy' href="#pages---><?php //echo $image->id_image; ?><!--" style='margin-top: 4px;' class="button small-button button-turquoise">Выбрать услуги</a>-->
<!--                    </div>-->
<!--                <div id="related-page---><?php //echo $image->id_image; ?><!--" class="rel-page label">-->
<!--                    --><?php //
//                         $browser_name =  $postmeta->getValue($image->id_image, 'link', 'image');
//                         echo $post_title = ORM::factory('products')->where('browser_name','=',$browser_name)->find()->title;
//                    ?>
<!--                </div>-->
                <div id="add-entry-fancy" style="display:none">
                    <div id="pages-<?php echo $image->id_image; ?>">
                        <?php $types = array('for_home'=>'Для дома', 'for_business'=>'Для бизнеса'); ?>
                        <h3 style="color: white">Услуги</h3>
                        <?php
                        foreach ($products as $product) {
                            echo "<font class='title-pages' onClick=putToUri('" . $product->id_product . "','" . $image->id_image . "')>" . $product->title . " (".$types[$product->type].")</font><br/>";
                        }
                        ?>
                    </div>
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
                    $str_pages .= '<a href="' . URL::base() . 'admin/slider">' . $pg . '</a> | ';
                } else {
                    $str_pages .= '<a href="' . URL::base() . 'admin/slider/page/' . $pg . '">' . $pg . '</a> | ';
                }
            }
            $str_pages = substr($str_pages, 0, -3);
            echo $str_pages;
            ?>
        </div>
    <?php endif; ?>
    <div class="clear" style="margin-bottom: 20px;clear:both;"></div>
    <div>
<!--        <input type="button" class="submit button small-button button-blue" value="Удалить выбранные" onclick="deleteChecked();" />-->
<!--        <input type="button" class="submit button small-button button-blue" value="Сортировать" onclick="saveSort();" />-->
    </div><br/>
    
<?php endif; ?>

<!--<input type="button" class="submit  button small-button button-blue" value="Вернуться" onclick="javascript:history.back();" />-->
<!--a href="javascript:history.back();"><< Back</a-->

<script type="text/javascript">
    var chk_ = false;
    function deleteImg(id_img) {
        if (confirm('Вы действительно хотите удалить это изображение?')) {
            location.href="<?php echo URL::base(); ?>admin/slider/delete/" + id_img;
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
    
    function save(id) {
        item1 = jQuery('.image-'+id+' #item1').val();
        var sort = jQuery('.image-'+id+' .sort_vid').val();
        item2 = jQuery('.image-'+id+' #item2').val();
        item3 = jQuery('.image-'+id+' #item3').val();
        item4 = jQuery('.image-'+id+' #item4').val();
        title = jQuery('.image-'+id+' #slider-title').val();
        for_home = jQuery('.image-'+id+' #for-home').is(':checked');
        for_business = jQuery('.image-'+id+' #for-business').is(':checked');          
        jQuery.ajax({
            url     : '/admin/slider/savevalues?id='+id+'&item1='+item1+'&item2='+item2+'&item3='+item3+'&item4='+item4+'&title='+title+'&for_home='+for_home+'&for_business='+for_business+'&sort='+sort,
            type    : 'POST',
            dataType: 'html',
            timeout : 9000,
            error   : function() {
                alert('Произошла ошибка!');
            },
            success : function(html) {                
                console.log(html);
                if(html=='1') {                  
                    jQuery('.success-message-'+id).html('Сохранено успешно');
                    jQuery('.success-message-'+id).css('display','block');
                }
            }//success
        });//ajax
        
    }
    
    function deleteChecked() {
        if (chk_) {
            if (confirm('Вы действительно хотите удалить выбранные изображения?')) {
                var ids = "";
                jQuery('.chk').each(function(){
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '|';
                    }

                });
                location.href = "<?php echo URL::base(); ?>admin/slider/deleteall/" + ids;
            }
        }
    }
    
    jQuery(document).ready(function(){
        jQuery('.alert').fadeOut(10000);
        jQuery('.input_file').uniform();
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