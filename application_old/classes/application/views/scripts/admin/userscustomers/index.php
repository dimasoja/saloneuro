<?php echo ViewMessage::renderMessages(); ?>
<!--a href="<?php echo URL::base(); ?>admin/users/adduser">Add new user</a><br /><br /-->
<?php if (count($users) > 0): ?>
<br/>
<br/>
<div>
<input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
</div>
<table id="adm_users" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th>Name&nbsp;<a href="<?php echo URL::base(); ?>admin/userscustomers/<?php echo $controller. "/" . $page; ?>/asc"><img src="<?php echo URL::base(); ?>images/s_asc.png" /></a><a href="<?php echo URL::base(); ?>admin/userscustomers/<?php echo $controller. "/" . $page; ?>/desc"><img src="<?php echo URL::base(); ?>images/s_desc.png" /></a></th>
        <th>Email</th>
        <th>Address</th>
        <th>Town</th>
        <th>Postcode</th>
        <th>Phone</th>
        <th>Mobile</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($users as $user): if(trim($user->email)!=""): ?>
    <tr>
        <td align="center" style="width: 30px;"><input type="checkbox" class="chk" rel="<?php echo $user->id_user; ?>" /></td>
        <td><?php echo $user->surname. " " . $user->name; ?></td>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->address; ?></td>
        <td><?php echo $user->town; ?></td>
        <td><?php echo $user->postcode; ?></td>
        <td><?php echo $user->phone; ?></td>
        <td><?php echo $user->mphone; ?></td>
        <td align="center"><a href="<?php echo URL::base(); ?>admin/userscustomers/edit/<?php echo $user->id_user; ?>">Edit</a></td>
        <td align="center"><a href="javascript:void(0);" onclick="deleteUser(<?php echo $user->id_user; ?>)">Delete</a></td>
    </tr>
    <?php endif; endforeach; ?>
</table>
<div class="clear"></div>
<?php if ($pages > 1): ?>
<div id="sws_pages">
    <?php
        $str_pages = "";
        for ($pg = 1; $pg <= $pages; $pg++) {
            if ($page == $pg) {
                $str_pages .= $pg . " | ";
            } elseif ($pg == 1) {
                $str_pages .= '<a href="' . URL::base() . 'admin/userscustomers/' . $controller . '">' . $pg . '</a> | ';
            } else {
                $str_pages .= '<a href="' . URL::base() . 'admin/userscustomers/' . $controller . '/' . $pg . '">' . $pg . '</a> | ';
            }
        }
        $str_pages = substr($str_pages, 0, -3);
        echo $str_pages;
    ?>
</div>
<?php endif; ?>
<div>
<input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
</div>
<div class="clear" style="margin-bottom: 20px;"></div>
<?php endif; ?>
<br/><input type="button" onclick="javascript:history.back();" value="Back" class="submit" style="margin-top: 20px;">
<script type="text/javascript">
    var chk_ = false;
    function deleteUser(id_user) {
        if (confirm('Do you really want to delete this user?')) {
            location.href="<?php echo URL::base(); ?>admin/userscustomers/delete/" + id_user;
        }
    }
    
    function deleteChecked() {
        if (chk_) {
            if (confirm('Do you really want to delete this checked users?')) {
                var ids = "";
                jQuery('.chk').each(function() {
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '|';
                    }

                });
                location.href = "<?php echo URL::base(); ?>admin/userscustomers/deleteall/" + ids;
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
        
        setTimeout(function(){ jQuery('#adminMessage').hide('slow'); }, 5000);
    })
</script>