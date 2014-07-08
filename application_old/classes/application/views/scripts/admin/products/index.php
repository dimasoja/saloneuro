<?php echo ViewMessage::renderMessages(); ?>

<?php
    ?>
    <input class="button-turquoise button page-new-add" type="button" value="Создать услугу" onclick="redirectToNew()"/><br/>
    <div id="searchname">
        <form method ="get" action="<?php echo URL::base(); ?>admin/products/">
            Искать в имени: <input type="text" name="code" value="<?php if (isset($code)) echo $code; ?>">
            <input type="hidden" name="type" value="name">
            <input type="submit" class="button button-turquoise" value="Поиск">
        </form>
    </div>
    <table id="adm_users" cellpadding="0" cellspacing="0">
        <tr>
            <th></th>
            <th>Имя услуги</th>
            <th>Тип услуги</th>
            <th>Опубликовано &nbsp;<a href="/admin/products/index/0/asc?order_by=published<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_asc.png"></a><a href="/admin/products/index/0/desc?order_by=published<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_desc.png"></a></th>
            <th>Создана &nbsp;<a href="/admin/products/index/0/asc?order_by=created_at<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_asc.png"></a><a href="/admin/products/index/0/desc?order_by=created_at<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_desc.png"></a></th>
            <th>Обновлена &nbsp;<a href="/admin/products/index/0/asc?order_by=updated_at<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_asc.png"></a><a href="/admin/products/index/0/desc?order_by=updated_at<?php if (isset($code)) echo '&code=' . $code; ?>"><img src="/images/s_desc.png"></a></th>        
            <th></th>   
            <th></th>
        </tr>
        <?php foreach ($top_pages as $page) { ?>
            <tr>
                <td align="center" style="width: 30px;"><input type="checkbox" class="chk" rel="<?php echo $page->id_product; ?>" /></td>
                <td><?php echo $page->title; ?></td>
                <td><?php if($page->type=='for_business') echo "Для бизнеса"; else echo 'Для дома'; ?></td>
                <td align="center">
                    <?php
                    if ($page->published == 'on') {
                        echo "<div class='publish-ico' id='publ" . $page->id_product . "' onclick='changepublish(" . $page->id_product . ")'><img id='on' src='/images/button_on.png'/></div>";
                    } else {
                        echo "<div class='publish-ico' id='publ" . $page->id_product . "' onclick='changepublish(" . $page->id_product . ")'><img id='off' src='/images/button_off.png'/></div>";
                    }
                    ?>
                </td>
              
                    <td align="center">
                        <?php if($page->created_at!='') {
                            echo date("H:i:s", $page->created_at);
                            echo " - <font class='orange-text'>" . date("y.m.d", $page->created_at) . "</font>";                             
                        } ?></td>               
                    <td align="center"><?php if($page->updated_at!='') { echo date("H:i:s", $page->updated_at);
                    echo " - <font class='orange-text'>" . date("y.m.d", $page->updated_at) . "</font>"; } ?></td>                
                <td align="center"><a href="<?php echo URL::base(); ?>admin/products/edit/<?php echo $page->id_product; ?>">Редактировать</a></td>
                <td align="center"><a href="javascript:void(0);" onclick="deletePage(<?php echo $page->id_product; ?>)">Удалить</a></td>
            </tr>   
            
<?php } ?>
    </table>
    <div class="clear"></div>
    <div>
        <input type="button" class="button button-red small-button" value="Удалить выбранные" onclick="deleteChecked();" />
    </div>
    <div class="clear" style="margin-bottom: 20px;"></div>
    <?php if ((isset($return) and ($return == 'yes'))) { ?>
        <br/><input type="button" onclick="redirectToproducts()" value="Вернуться" class="submit" style="margin-top: 20px;">
    <?php } ?>
    <script type="text/javascript">
        var chk_ = false;
        function redirectToproducts() {
            location.href = '/admin/products/';
        }
        function deletePage(id_product) {
            if (confirm('Вы действительно хотите удалить эту страницу?')) {
                location.href="<?php echo URL::base(); ?>admin/products/deletechecked/" + id_product+"~";
            }
        }
                        
        function deleteChecked() {        
            if (confirm('Вы действительно хотите удалить выбранные записи?')) {
                var ids = "";
                jQuery('.chk').each(function() {
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '~';                        
                    }

                });
                location.href = "/admin/products/deletechecked/" + ids;
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
                            
            setTimeout(function(){ jQuery('#adminMessage').hide('slow'); }, 5000);
        }); 
        function changepublish(id) {       
            var yes_no = jQuery('#publ'+id+' img').attr('id');
            if(yes_no=='on') {
                var change='off';
            } else {
                var change='on';
            }
            jQuery.get(baseurl + 'admin/products/changepublished?id='+id+'&change='+change,
            function(data) {
                if(data=='ok') {
                    jQuery('#publ'+id).html("<img id='"+change+"' src='/images/button_"+change+".png'/>");
                }

            }        
        );
        }
    </script>























<script type="text/javascript">
    function redirectToNew() {
        window.location = '/admin/products/add';
    }
</script>