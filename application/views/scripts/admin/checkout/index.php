<?php echo ViewMessage::renderMessages(); ?>
<h1>All Sales page</h1>
<div id="searchcode">
    <form method="post">
        Search code: <input type="text" name="code" value="<?php if($type=='code') echo $code; ?>" />
        <input type="hidden" name="type" value="key"/>
        <input type="submit" value="Search" />
    </form>
</div>
<div id="searchname">
    <form method="post">
        Search name: <input type="text" name="code" value="<?php if($type=='name') echo $code; ?>" />
        <input type="hidden" name="type" value="name"/>
        <input type="submit" value="Search" />
    </form>
</div>
<?php if (!empty($checkouts)): ?>
<table class="quotation-user" cellpadding="0" cellspacing="0">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Address</th>
        <th>Alt. Address</th>
        <th>Amount &pound;</th>
        <th>Date</th>
		<th>Area</th>
    </tr>
<?php foreach ($checkouts as $checkout): ?>
    <tr>
        <td><?php echo $checkout->key; ?></td>
        <td><?php echo $checkout->name . " " . $checkout->surname; ?></td>
        <td><?php echo $checkout->email; ?></td>
        <td><?php echo $checkout->address . "<br />" . $checkout->town . "<br />" . $checkout->postcode; ?></td>
        <td><?php echo $checkout->alternative_address . "<br />" . $checkout->alternative_town . "<br />" . $checkout->alternative_postcode; ?></td>
        <td><?php echo $checkout->total; ?></td>
        <td><?php echo date("d/m/Y", $checkout->date); ?></td>
		<td><?php echo $checkout->Area; ?></td>
    </tr>
<?php endforeach; ?>
</table>
<input type="button" value="EXCEL EXPORT" class="submit" onclick="showExcelExport()">
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
        <form method="post" action="<?php echo URL::base(); ?>admin/checkout/excelexport">
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
<?php else: ?>
<div style="clear:both">No results;</div>
<?php endif; ?>