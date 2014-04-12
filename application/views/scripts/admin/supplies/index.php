<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#tableDND').tableDnD({
            onDragClass: "myDragClass",
            onDrop: function(table, row) {
                var rows = table.rows;
                var w = "";
                for (var i = 1; i < rows.length; i++) {
                    w += jQuery(rows[i]).attr('rel') + ";";
                }
                jQuery.post(baseurl + 'admin/supplies/changetable', {check_type: "<?php echo $id; ?>", sort: w}, function(data) {
                    console.log(data);
                });
            }
        });
    });
    function checkType(obj) {
        location.href=baseurl + "admin/supplies/index/" + obj.value;
    }
    
    function deleteObj(id) {
        if (confirm("Do you really want to delete this item?")) {
            jQuery.post(baseurl + 'admin/supplies/delete', {id_supplies: id}, function() {
                
            });
        }
    }
    function sendNewSupply() {
        jQuery('#add-supply-form').submit();
    }
    function addManufacturer() {
        jQuery('#new_manufacturer').html('<input type="text" name="manufacturer_new" value="" />');
    }

</script>
<?php echo ViewMessage::renderMessages(); ?>
<h1>Supplies</h1>
Check type:<br/>
<div  style="margin-top: 8px;">
    <select class="black" onchange="checkType(this);">
        <option value="abrasives"<?php if ($id == "abrasives") echo " selected=\"selected\"" ?>>Abrasives</option>
        <option value="varnishes"<?php if ($id == "varnishes") echo " selected=\"selected\"" ?>>Varnishes & Adhesives</option>
        <option value="tools"<?php if ($id == "tools") echo " selected=\"selected\"" ?>>Tools & Machinery</option>
        <option value="miscellaneous"<?php if ($id == "miscellaneous") echo " selected=\"selected\"" ?>>Miscellaneous</option>
    </select>
</div>
<br/>
<script type="text/javascript">
    jQuery(document).ready(function(){    
        jQuery('#add-suply-fancy').fancybox({
            'width'        : 900,
            'afterLoad'    : function() {
                var editor = CKEDITOR.replace('info',
                {
                    uiColor : 'orange',
                    language: 'en'
                });
                CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );                    
            }
        });
    }); 
</script>
<input class="submit" type="button" onclick="parent.location='<?php echo URL::base(); ?>admin/supplies/editbuttons/<?php echo $id; ?>'" value="Edit buttons"/><br/><br/>
<a id="add-suply-fancy" href="#add-supply-form">
    <input class="submit" type="button" value="Add Supply"/>
</a>
<br/><br/>
<?php if (count($supplies) > 0): ?>

    <table id="tableDND" cellpadding="0" cellspacing="0" class="quotation-user">
        <tr>
            <!--th></th-->
            <th>Title</th>
            <th>Product code</th>
            <th>Price £</th>
            <th></th>
            <th>Type</th>
            <th>Image</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($supplies as $supply): ?>
            <tr rel="<?php echo $supply['id_supplies']; ?>">
                <!--td align="center"><input type="checkbox" id="supply_<?php echo $supply['id_supplies']; ?>" /></td-->
                <td><?php echo $supply['title']; ?></td>
                <td><?php echo $supply['code']; ?></td>
                <td><?php echo number_format($supply['price'], 2, '.', ''); ?></td>
                <td><img src="<?php echo URL::base(); ?>images/supplies/<?php echo $supply['type_star']; ?>.png" /></td>
                <td><?php echo $supply['type_column']; ?></td>
                <td><img src="<?php echo URL::base(); ?>uploads/images/<?php echo (isset($supply['path'])) ? $supply['path'] : "none.png"; ?>" style="max-height: 90px;" /></td>
                <td><a href="<?php echo URL::base(); ?>admin/supplies/edit/<?php echo $supply['id_supplies']; ?>">Edit</a></td>
                <td><a href="javascript:void(0);" onclick="deleteObj(<?php echo $supply['id_supplies']; ?>)">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<div id="supplies-add"  style="display:none;">
    <form method="post" id="add-supply-form" action="<?php echo URL::base(); ?>admin/supplies" enctype="multipart/form-data">
        <h2>Add supply:</h2>
        <table cellpadding="0" cellspacing="0" class="edit-user-fancy">
            <tr>
                <td width="150">Title:</td>
                <td><input type="text" name="title" value="" /></td>
            </tr>
            <tr>
                <td width="150">Product code:</td>
                <td><input type="text" name="code" value="" /></td>
            </tr>
            <tr>
                <td>Price £:</td>
                <td><input type="text" name="price" value="" /></td>
            </tr>
            <tr>
                <td>Manufacturer:</td>
                <td>
                    <select name="manufacturer">
                        <option value="0">Please, select...</option>
                        <?php if (count($manufacturers) > 0): ?>
                            <?php foreach ($manufacturers as $manufacturer): ?>
                                <option value="<?php echo $manufacturer->id_manufacturer; ?>"><?php echo $manufacturer->title; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div id="new_manufacturer" style="display: inline-block;">or <a href="javascript:void(0);" onclick="addManufacturer()">add new</a></div>
                </td>
            </tr>
            <tr>
                <td valign="top">Keywords:</td>
                <td>
                    <textarea name="keywords" style="width: 300px; height: 100px;"></textarea><br />
                    <sup>Enter words separated by commas</sup>
                </td>
            </tr>
            <tr>
                <td>Type of star:</td>
                <td>
                    <ul style="list-style-type:none;">
                        <li><input type="radio" name="type_of_star" value="less_than_half_price" /> Less than half price</li>
                        <li><input type="radio" name="type_of_star" value="new_product" /> New product</li>
                        <li><input type="radio" name="type_of_star" value="trade_buster" /> Trade buster</li>
                    </ul>
                </td>
            </tr>
            <input type="hidden" name="type_column" value="<?php echo $id; ?>" >
            <tr>
                <td>Image:</td>
                <td><input type="file" name="image" /></td>
            </tr>
            <tr>
                <td valign="top">Info:</td>
                <td>
                    <textarea id="info" name="info" style="width: 600px; height: 200px;"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" class="submit" value="Save" onclick="sendNewSupply()" /></td>
            </tr>
        </table>
    </form>
</div>