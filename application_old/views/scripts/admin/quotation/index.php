<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Quotations</h1>
<input type="button" value="Create new" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/quotation/details/0'" />
<input type="button" value="Edit Info" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/quotation/editinfo'" />
<!--a href="<?php echo URL::base(); ?>admin/quotation/details/0">Create new</a><br />
<a href="<?php echo URL::base(); ?>admin/quotation/editinfo">Edit Info</a-->
<?php if (count($quotations) > 0): ?>
<table class="quotation-user" cellpadding="0" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Address</th>
        <th>Landline</th>
        <th>Mobile</th>
        <th>Enquiry date</th>
        <th>Status</th>
        <th>Transaction ID</th>
        <th>Code(Sale)</th>
        <th>Amount &pound;</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($quotations as $quotation): ?>
    <tr>
        <td><?php echo $quotation->name; ?> <?php echo $quotation->surname; ?></td>
        <td><?php echo $quotation->email; ?></td>
        <td>
            <?php echo $quotation->address; ?><br />
            <?php echo $quotation->town; ?><br />
            <?php echo $quotation->postcode; ?>
        </td>
        <td><?php echo $quotation->phone; ?></td>
        <td><?php echo $quotation->mphone; ?></td>
        <td><?php echo date("d/m/Y", $quotation->registration_date); ?></td>
        <td style="font-weight: bold;">
            <?php if ($quotation->is_complete == 0): ?>
            <span style="color:red">Potential</span>
            <?php elseif ($quotation->payment_status == 0): ?>
            <span style="color:#FF6819">Not Paid</span>
            <?php else: ?>
            <span style="color:#00ff00">Confirmed</span>
            <?php endif; ?>
        </td>
        <td><?php echo $quotation->payment_id; ?></td>
        <td style="text-align: center"><?php if(isset($sales[$quotation->code])) echo $quotation->code."(".$sales[$quotation->code]."%)"; else echo "-"; ?></td>
        <td align="center">
            <?php if ($quotation->total_price_for_job != 0): ?>
            <?php echo $quotation->total_price_for_job; ?>
            <?php endif; ?>
        </td>
        <td align="center"><a href="<?php echo URL::base(); ?>admin/quotation/details/<?php echo $quotation->id_quotation; ?>">Details</a></td>
        <td><a href="javascript:void(0);" onclick="deleteThis(<?php echo $quotation->id_quotation; ?>);">Delete</a></td>
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
                $str_pages .= '<a href="' . URL::base() . 'admin/quotation">' . $pg . '</a> | ';
            } else {
                $str_pages .= '<a href="' . URL::base() . 'admin/quotation/page/' . $pg . '">' . $pg . '</a> | ';
            }
        }
        $str_pages = substr($str_pages, 0, -3);
        echo $str_pages;
    ?>
</div>
<?php endif; ?>
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
        <form method="post" action="<?php echo URL::base(); ?>admin/quotation/excelexport">
        <select name="columns[]" multiple="multiple" multiselect="true" style="width: 380px; height: 150px;">
            <?php foreach ($columns as $key => $column): ?>
            <option value="<?php echo $key; ?>"><?php echo $column; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="EXPORT" class="submit" style="margin-top: 10px;" onclick="closeSubmitForm();" />
        </form>
    </div>
</div>
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
            location.href=baseurl + "admin/quotation/delete/" + id;
        }
    }
</script>