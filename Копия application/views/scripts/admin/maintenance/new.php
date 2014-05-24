<script type="text/javascript">
<?php
    foreach ($settings as $key => $val) {
        echo "var " . $key . ' = ' . $val . ";\n";
    }
    echo "var fs_max_count_rooms = " . $settings2['fs_max_count_rooms'] . ";\n";
?>
    
</script>

<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<h1>Maintenance contract details</h1>
<form method="post" action="<?php echo URL::base(); ?>admin/maintenance/changedetails">
     <input id="id_maintenance" type="hidden" name="id_maintenance" value="<?php echo $new; ?>" />
<ul class="user-details">
    <li><strong>First Name:</strong> <input type="text" name="name" value="" /></li>
    <li><strong>Last Name:</strong> <input type="text" name="surname" value="" /></li>
    <li><strong>Email:</strong> <input type="text" name="email" value="" /></li>
    <li><strong>Address:</strong> <input type="text" name="address" value="" /></li>
    <li><strong>Town:</strong> <input type="text" name="town" value="" /></li>
    <li><strong>Postcode:</strong> <input type="text" name="postcode" value="" /></li>
    <li><strong>Alternative address:</strong> <input type="text" name="alternative_address" value="" /></li>
    <li><strong>Alternative town:</strong> <input type="text" name="alternative_town" value="" /></li>
    <li><strong>Alternative postcode:</strong> <input type="text" name="alternative_postcode" value="" /></li>
    <li><strong>Landline tel. no.:</strong> <input type="text" name="phone" value="" /></li>
    <li><strong>Mobile tel. no.:</strong> <input type="text" name="mphone" value="" /></li>
    <li><strong>Daily clean:</strong> Daily <input type="checkbox" name="daily_clean" value="daily" class="radio_price1" rel="365" /> Monthly <input type="checkbox" name="daily_clean" value="monthly" class="radio_price1" rel="12" /> Quarterly <input type="checkbox" name="daily_clean" value="quarterly" class="radio_price1" rel="4" /></li>
    <li><strong>Deep cleaning & Protector:</strong> Daily <input type="checkbox" name="deep_clean" value="daily" class="radio_price2" rel="365" /> Monthly <input type="checkbox" name="deep_clean" value="monthly" class="radio_price2" rel="12" /> Quarterly <input type="checkbox" name="deep_clean" value="quarterly" class="radio_price2" rel="4" /></li>
    <li><strong>Buff'n'Coat:</strong>
        <ul class="buff">
            <li>Daily <input type="checkbox" value="daily" name="buff_n_coat" class="radio_price3" rel="365" /></li>
            <li>Weekly <input type="checkbox" value="weekly" name="buff_n_coat" class="radio_price3" rel="52" /></li>
            <li>Monthly <input type="checkbox" value="monthly" name="buff_n_coat" class="radio_price3" rel="12" /></li>
            <li>Quarterly  <input type="checkbox" value="quarterly" name="buff_n_coat" class="radio_price3" rel="4" /></li>
            <li>6 Monthly <input type="checkbox" value="6 monthly" name="buff_n_coat" class="radio_price3" rel="2" /></li>
            <li>Annually <input type="checkbox" value="annually" name="buff_n_coat" class="radio_price3" rel="1" /></li>
            <li>3 Yearly <input type="checkbox" value="3 yearly" name="buff_n_coat" class="radio_price3" rel="1" /></li>
            <li>5 Yearly <input type="checkbox" value="5 yearly" name="buff_n_coat" class="radio_price3" rel="1" /></li>
        </ul>
    </li>
    <li><strong>Floor type:</strong>
        <ul class="buff">
            <li>Floorboards <input type="radio" value="floorboards" name="type_of_floor" /></li>
            <li>Parquet <input type="radio" value="parquet" name="type_of_floor" /></li>
            <li>Engineered <input type="radio" value="engineered" name="type_of_floor" /></li>
            <li>Other  <input id="other_radio" type="radio" value="other" name="type_of_floor" /></li>
            <li id="other_text" style='display:none;'>
                <input type="text" name="type_of_floor_other" value="" class="meter-field" maxlength="20" /></li>
        </ul>
    </li>
    <li><strong>Day of week:</strong>
        <ul class="buff">
            <li>Monday <input type="checkbox" value="Monday" name="day_of_week" /></li>
            <li>Tuesday <input type="checkbox" value="Tuesday" name="day_of_week" /></li>
            <li>Wednesday <input type="checkbox" value="Wednesday" name="day_of_week" /></li>
            <li>Thursday <input type="checkbox" value="Thursday" name="day_of_week" /></li>
            <li>Friday <input type="checkbox" value="Friday" name="day_of_week" /></li>
            <li>(Weekend/out of hours work by request only) <input type="checkbox" value="(Weekend/out of hours work by request only)" name="day_of_week" /></li>
        </ul>
    </li>
    <li><strong>Room measurements:</strong> Metres <input class="measurements" type="radio" checked="checked" value="metres" name="room_dimentions" /> Feet <input id="room_dimentions" class="measurements" type="radio" value="feet" name="room_dimentions" /></li>
    <li><strong>Amount of rooms:</strong> <input id="rooms_count" type="text" name="rooms_count" value="<?php echo $user['rooms_count']; ?>" id="rooms_count" class="date-field" style="text-align: center" /></li>
    <li><strong>Rooms:</strong>
        <div id="ul_rooms">
        </div>
        
    </li>
    <li><strong>Total price £:</strong> <input id="total_price_for_job" type="text" value="" name="total_price_for_job" class="meter-field1"  /></li>
    <li><strong>Option price:</strong> <input type="text" name="option_price" value="" /></li>
    <li><strong>Payment status: </strong> <select name="payment_status"><option value="1">Yes</option><option value="0">No</option></select></li>
    <li><strong>Work dates:</strong> <div id="work_dates"></div> <br/>[ <a href="javascript:void(0);" onclick="changeWorkDates();">Change</a> ]</li>
</ul>
                    
<input type="submit" value="SAVE" class="submit" />
</form>
<div id="modal_block_hidden"></div>
<div id="modal_block_admin">
    <div style="margin: auto; width: 380px; background: #000; padding: 10px">
        <a href="javascript:void(0);" onclick="closeSubmitForm2();" style="float: right; font-size: 14px;">Close[X]</a>
        <h1>Excel Export</h1>
        <p>
            Please, choose columns, which you want to export:
        </p>
        <p>
            <sup>(Hold Ctrl for multiple choice)</sup>
        </p>
        <form method="post" action="<?php echo URL::base(); ?>admin/maintenance/detailsexport">
            <input type="hidden" name="id_maintenance" value="<?php echo $user['id_maintenance']; ?>" />
        <select name="columns[]" multiple="multiple" multiselect="true" style="width: 380px; height: 150px;">
            <?php foreach ($columns as $key => $column): ?>
            <option value="<?php echo $key; ?>"><?php echo $column; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="EXPORT" class="submit" style="margin-top: 10px;" onclick="closeSubmitForm();" />
        </form>
    </div>
</div>
<div id="modal_block_hidden2"></div>
<div id="modal_block2"></div>
<script type="text/javascript">
    function showExcelExport() {
        jQuery('#modal_block_hidden').show();
        jQuery('#modal_block_admin').show();
    }
    
    function closeSubmitForm2() {
        jQuery('#modal_block_hidden').hide();
        jQuery('#modal_block_admin').hide();
    }
</script>