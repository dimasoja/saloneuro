<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Maintenance contracts</h1>
<p>
    <input type="button" value="Create New" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/maintenance/details/0'" />
    <!--a href="<?php echo URL::base(); ?>admin/maintenance/details/0">Create new</a-->
    <input type="button" value="Edit info" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/maintenance/editinfo'" />
    <!--a href="<?php echo URL::base(); ?>admin/maintenance/editinfo">Edit info</a-->
</p>
<?php if (count($contracts) > 0): ?>
<table class="quotation-user" cellpadding="0" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Address</th>
        <th>Landline</th>
        <th>Mobile</th>
        <th>Enquiry date</th>
        <th>Status</th>
        <th>Amount &pound;</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($contracts as $contract): ?>
    <tr>
        <td><?php echo $contract->name; ?> <?php echo $contract->surname; ?></td>
        <td><?php echo $contract->email; ?></td>
        <td><?php echo $contract->address; ?><br />
            <?php echo $contract->town; ?><br />
            <?php echo $contract->postcode; ?></td>
        <td><?php echo $contract->phone; ?></td>
        <td><?php echo $contract->mphone; ?></td>
        <td><?php echo date("d/m/Y", $contract->registration_date); ?></td>
        <td style="font-weight: bold;">
            <?php if ($contract->is_complete == 0): ?>
            <span style="color:red">Potential</span>
            <?php elseif ($contract->payment_status == 0): ?>
            <span style="color:#FF6819">Not Paid</span>
            <?php else: ?>
            <span style="color:#00ff00">Confirmed</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($contract->option_price) echo $contract->option_price; ?>
        </td>
        <td align="center"><a href="<?php echo URL::base(); ?>admin/maintenance/details/<?php echo $contract->id_maintenance; ?>">Details</a></td>
        <td><a href="javascript:void(0);" onclick="deleteThis(<?php echo $contract->id_maintenance; ?>);">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="clear"></div>
<script type="text/javascript">
    function showExcelExport() {
        jQuery('#modal_block_hidden').show();
        jQuery('#modal_block_admin').show();
    }
    
    function closeSubmitForm() {
        jQuery('#modal_block_hidden').hide();
        jQuery('#modal_block_admin').hide();
    }
    
    function deleteThis(id) {
        if (confirm("Do you really want to delete this item?")) {
            location.href=baseurl + "admin/maintenance/delete/" + id;
        }
    }
</script>
<input type="button" value="EXCEL EXPORT" class="submit" onclick="showExcelExport()" />
<?php endif; ?>
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
        <form method="post" action="<?php echo URL::base(); ?>admin/maintenance/excelexport">
        <select name="columns[]" multiple="multiple" multiselect="true" style="width: 380px; height: 150px;">
            <?php foreach ($columns as $key => $column): ?>
            <option value="<?php echo $key; ?>"><?php echo $column; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="EXPORT" class="submit" style="margin-top: 10px;" onclick="closeSubmitForm();" />
        </form>
    </div>
</div>