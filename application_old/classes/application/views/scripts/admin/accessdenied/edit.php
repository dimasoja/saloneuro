<?php echo ViewMessage::renderMessages(); ?>
<h2>Edit supply:</h2>
<form method="post" action="<?php echo URL::base(); ?>admin/supplies/edit/<?php echo $supplies->id_supplies; ?>" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="0" class="edit-user">
    <tr>
        <td width="150">Title:</td>
        <td><input type="text" name="title" value="<?php echo $supplies->title; ?>" /></td>
    </tr>
    <tr>
        <td width="150">Product code:</td>
        <td><input type="text" name="code" value="<?php echo $supplies->code; ?>" /></td>
    </tr>
    <tr>
        <td>Price £:</td>
        <td><input type="text" name="price" value="<?php echo number_format($supplies->price, 2); ?>" /></td>
    </tr>
    <tr>
        <td>Manufacturer:</td>
        <td>
            <select name="manufacturer">
                <option value="0">Please, select...</option>
                <?php if (count($manufacturers) > 0): ?>
                <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?php echo $manufacturer->id_manufacturer; ?>"<?php if ($manufacturer->id_manufacturer == $supplies->id_manufacturer) echo " selected=\"selected\""; ?>><?php echo $manufacturer->title; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <div id="new_manufacturer" style="display: inline-block;">or <a href="javascript:void(0);" onclick="addManufacturer()">add new</a></div>
        </td>
    </tr>
    <tr>
        <td valign="top">Keywords:</td>
        <td>
            <textarea name="keywords" style="width: 300px; height: 100px;"><?php echo $supplies->keywords; ?></textarea><br />
            <sup>Enter words separated by commas</sup>
        </td>
    </tr>
    <tr>
        <td>Type of star:</td>
        <td>
            <ul style="list-style-type:none;">
                <li><input type="radio" name="type_of_star" value="less_than_half_price" <?php if ($supplies->type_star == "less_than_half_price") echo "checked=\"checked\""; ?> /> Less than half price</li>
                <li><input type="radio" name="type_of_star" value="new_product" <?php if ($supplies->type_star == "new_product") echo "checked=\"checked\""; ?> /> New product</li>
                <li><input type="radio" name="type_of_star" value="trade_buster" <?php if ($supplies->type_star == "trade_buster") echo "checked=\"checked\""; ?> /> Trade buster</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td>Type of column:</td>
        <td>
            <select name="type_column">
                <option value="miscellaneous"<?php if ($supplies->type_column == "miscellaneous") echo " selected=\"selected\"" ?>>Miscellaneous</option>
                <option value="abrasives"<?php if ($supplies->type_column == "abrasives") echo " selected=\"selected\"" ?>>Abrasives</option>
                <option value="varnishes"<?php if ($supplies->type_column == "varnishes") echo " selected=\"selected\"" ?>>Varnisens & Adhesives</option>
                <option value="tools"<?php if ($supplies->type_column == "tools") echo " selected=\"selected\"" ?>>Tools & Machinery</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Image:</td>
        <td>
            <p>
                <?php if (isset($image['path'])): ?>
            <div id="img">
                <img src="<?php echo URL::base(); ?>uploads/images/<?php echo $image['path']; ?>" style="max-height: 90px;" /><br />
                <a href="javascript:void(0);" onclick="delImg(<?php echo $image['id_image']; ?>)">Delete</a> or
                <input type="hidden" name="old_img" value="<?php echo $image['id_image']; ?>" />
            </div>
                <?php endif; ?>
            </p>
            <input type="file" name="image" />
        </td>
    </tr>
    <tr>
        <td>Info:</td>
        <td>
            <textarea id="info" name="info" style="width: 300px; height: 200px;"><?php echo $supplies->info; ?></textarea>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Save" /></td>
    </tr>
</table>
</form>

<script type="text/javascript">
    jQuery(document).ready(function(){
        CKEDITOR.replace('info',
        {
            uiColor : 'orange',
            language: 'en'
        });
    });
    
    function delImg(id) {
        if (confirm("Do you really delete this image?")) {
            jQuery.post(baseurl + 'admin/supplies/delimg', {id_image: id}, function(data) {
                 jQuery('#img').html("");
            });
        }
    }
    
    function addManufacturer() {
        jQuery('#new_manufacturer').html('<input type="text" name="manufacturer_new" value="" />');
    }
</script>