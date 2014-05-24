<h1>Edit office</h1>
<form method="post" action="<?php echo URL::base(); ?>admin/postcodes/edit/<?php echo $office['id_office']; ?>">
    <table cellpadding="0" cellspacing="0" class="edit-user">
        <tr>
            <td>Name of office</td>
            <td><input type="text" name="name" value="<?php echo $office['name']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type="text" name="address" value="<?php echo $office['address']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Town</td>
            <td><input type="text" name="town" value="<?php echo $office['town']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Postcode</td>
            <td><input type="text" name="postcode" value="<?php echo $office['postcode']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $office['email']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Mobile tel. no.</td>
            <td><input type="text" name="mphone" value="<?php echo $office['mphone']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td>Landline tel. no.</td>
            <td><input type="text" name="phone" value="<?php echo $office['phone']; ?>" class="franchisee-name" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="checkbox" id="check_all" /> Check all</td>
        </tr>
        <tr>
            <td valign="top">Post Codes</td>
            <td>
                <div class="postcodes_block">
                    <?php if (count($postcodes) > 0): ?>
                    <table cellpadding="0" cellspacing="0" style="width: 450px;" id="vp_users">
                        <?php foreach ($postcodes as $postcode): ?>
                        <tr>
                            <td>
                                <input class="postcodes" type="checkbox" name="postcodes[]" value="<?php echo $postcode->id_postcode; ?>" <?php echo (isset($used_postcodes[$postcode->id_postcode])) ? "checked=\"checked\"" : ""; ?> />
                            </td>
                            <td>
                                <?php echo $postcode->district; ?>
                            </td>
                            <td>
                                <input type="text" id="postsubcode_<?php echo $postcode->id_postcode; ?>" name="postsubcode_<?php echo $postcode->id_postcode; ?>" value="<?php echo (isset($used_postcodes[$postcode->id_postcode])) ? $used_postcodes[$postcode->id_postcode] : ""; ?>" <?php echo (isset($used_postcodes[$postcode->id_postcode])) ? "" : "disabled=\"disabled\""; ?> />
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </table>
    <input type="submit" class="submit" value="Save" />
</form>
<script type="text/javascript">
    jQuery(document).ready(function(){
    jQuery('.postcodes').each(function(){
        jQuery(this).click(function(){
            if (jQuery(this).is(':checked')) {
                jQuery('#postsubcode_' + jQuery(this).val()).removeAttr('disabled');
            } else {
                jQuery('#postsubcode_' + jQuery(this).val()).attr('disabled', 'disabled');
            }
        })
    })    
    
    jQuery('#check_all').live('click', function() {
        var is_checked = jQuery('#check_all').is(':checked');
        jQuery('.postcodes').each(function() {
            jQuery(this).attr('checked', is_checked);
        })
    })
    })
    
</script>