<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Vital Points</h1>
<form method="post" action="<?php echo URL::base(); ?>admin/vitalpoints/send">
    <h3>Subject:</h3>
    <p><input type="text" name="email_subject" style="width: 99%" /></p><br />
    <h3>Body message:</h3>
    <p>
        <textarea id="email_body" name="email_body"></textarea>
    </p>
<p style="margin: 10px 0 30px 0">
    <input type="submit" value="Send emails to all members" />
</p>
</form>
<?php if (count($users) > 0): ?>
<div>
<input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
</div>
<table id="vp_users" cellpadding="0" cellspacing="0">
    <tr>
        <th></th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Town</th>
        <th>Address</th>
        <th>Postcode</th>
        <th>Mobile tel. number</th>
        <th>Landline tel. number</th>
        <th></th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td align="center" style="width: 30px;"><input type="checkbox" class="chk" rel="<?php echo $user->id; ?>" /></td>
        <td><?php echo $user->name; ?></td>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->town; ?></td>
        <td><?php echo $user->address; ?></td>
        <td><?php echo $user->postcode; ?></td>
        <td><?php echo $user->mphone; ?></td>
        <td><?php echo $user->phone; ?></td>
        <td align="center"><a href="javascript:void(0);" onclick="deleteUser(<?php echo $user->id; ?>)">Delete</a></td>
    </tr>
    <?php endforeach; ?>
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
                $str_pages .= '<a href="' . URL::base() . 'admin/vitalpoints">' . $pg . '</a> | ';
            } else {
                $str_pages .= '<a href="' . URL::base() . 'admin/vitalpoints/page/' . $pg . '">' . $pg . '</a> | ';
            }
        }
        $str_pages = substr($str_pages, 0, -3);
        echo $str_pages;
    ?>
</div>
<?php endif; ?>
<div>
<div id="modal_block_hidden"></div>
<div id="modal_block_admin">
    <div style="margin: auto; width: 380px; background: #000; padding: 10px">
        <a href="javascript:void(0);" onclick="closeSubmitForm();" style="float: right; font-size: 14px;">Close[X]</a>
        <h1>Excel Export</h1>
        <p>
            Please, choose columns, which you want to export:
        </p>
        <p>
            <sup>(Hold Ctrl for multiple choice)</sup>
        </p>
        <form method="post" action="<?php echo URL::base(); ?>admin/vitalpoints/excelexport">
        <select name="columns[]" multiple="multiple" multiselect="true" style="width: 380px; height: 150px;">
            <?php foreach ($columns as $key => $column): ?>
            <option value="<?php echo $key; ?>"><?php echo $column; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="EXPORT" class="submit" style="margin-top: 10px;" onclick="closeSubmitForm();" />
        </form>
    </div>
</div>
<script>
 function showExcelExport() {
        jQuery('#modal_block_hidden').show();
        jQuery('#modal_block_admin').show();
    }
    
    function closeSubmitForm() {
        jQuery('#modal_block_hidden').hide();
        jQuery('#modal_block_admin').hide();
    }
</script>	
<input type="checkbox" class="check_all" /> Check all &emsp; <input type="button" class="submit" value="Delete Checked" onclick="deleteChecked();" />
<input type="button" value="EXCEL EXPORT" class="submit" onclick="showExcelExport()">
</div>
<div class="clear" style="margin-bottom: 20px;"></div>
<?php endif; ?>
<a href="javascript:history.back();"><< Back</a>

<script type="text/javascript">
    var chk_ = false;
    function deleteUser(id_user) {
        if (confirm('Do you really want to delete this user?')) {
            location.href="<?php echo URL::base(); ?>admin/vitalpoints/delete/" + id_user;
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
                location.href = "<?php echo URL::base(); ?>admin/vitalpoints/deleteall/" + ids;
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
        
       var editor = CKEDITOR.replace('email_body',
        {
            uiColor : 'orange',
            language: 'en'
        });
        CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
    })
</script>