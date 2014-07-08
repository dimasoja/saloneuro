<?php $total = 0; ?>
<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Confirmed Bookings</h1>
<div id="responce"></div>
<input type="button" value="EXCEL EXPORT" class="submit" onclick="showExcelExport()" />
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
        <form method="post" action="<?php echo URL::base(); ?>admin/confirmedbooking/excelexport">
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
    jQuery(document).ready(function() {
        changeConfirmed(0,1);
    })
    function showExcelExport() {
        jQuery('#modal_block_hidden').show();
        jQuery('#modal_block_admin').show();
    }
    
    function closeSubmitForm() {
        jQuery('#modal_block_hidden').hide();
        jQuery('#modal_block_admin').hide();
    }
    
    function changeWorkStatus(obj, id) {
        var total = jQuery(obj).attr('rel');
        var total_price = jQuery('#total').html();
        var work_status;
        if (jQuery(obj).is(':checked')) {
            total_price = parseFloat(total_price) - parseFloat(total);
            work_status = 1;
        } else {
            total_price = parseFloat(total_price) + parseFloat(total);
            work_status = 0;
        }
        jQuery.post('<?php echo URL::base(); ?>admin/confirmedbooking/savestatus', {id_quotation: id, status: work_status}, function() {
            jQuery('#total').html(total_price);
        })
    }
    
    function changeConfirmed(data, page) {
        jQuery.post(baseurl + 'admin/confirmedbooking/changeconfirmed', {d: data, p: page}, function(responce) {
            jQuery('#responce').html(responce);
        });
    }
</script>