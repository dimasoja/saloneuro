<script type="text/javascript">
<?php
    foreach ($settings as $key => $val) {
        echo "var " . $key . ' = ' . $val . ";\n";
    }
?>
    jQuery("body :input").live('change', function(event){
        calcPrice();
    });
    
    var room_ws = new Array();
    var room_i_ws = new Array();
    var room_ls = new Array();
    var room_i_ls = new Array();
    var tsm = new Array();
    var tpr = new Array();
    var set = new Object;
    var set2 = new Object;
    
    jQuery(document).ready(function() {
        total_square = jQuery('#total_sq').val();
        if (jQuery('#room_dimentions').is(':checked')) {
            jQuery('.room_w').each(function() {
                room_ws.push(jQuery(this).val());
            });
            jQuery('.room_w_i').each(function() {
                room_i_ws.push(jQuery(this).val());
            });
            jQuery('.room_l').each(function() {
                room_ls.push(jQuery(this).val());
            });
            jQuery('.room_l_i').each(function() {
                room_i_ls.push(jQuery(this).val());
            });
            jQuery('.total_square_m').each(function() {
                tsm.push(jQuery(this).val());
            });
            jQuery('.total_price').each(function() {
                tpr.push(jQuery(this).val());
            });
            set2.room_w = room_ws;
            set2.room_w_i = room_i_ws;
            set2.room_l = room_ls;
            set2.room_l_i = room_i_ls;
            set2.total_square_m = tsm;
            set2.tp = tpr;
        } else {
            jQuery('.room_w').each(function() {
                room_ws.push(jQuery(this).val());
            });
            jQuery('.room_l').each(function() {
                room_ls.push(jQuery(this).val());
            });
            jQuery('.total_square_m').each(function() {
                tsm.push(jQuery(this).val());
            });
            jQuery('.total_price').each(function() {
                tpr.push(jQuery(this).val());
            });
            set.room_w = room_ws;
            set.room_l = room_ls;
            set.total_square_m = tsm;
            set.tp = tpr;
        }
        
    });
</script>
<div id="adminMessage">
    <?php echo ViewMessage::renderMessages(); ?>
</div>
<form id="ddform" method="post" action="<?php echo URL::base(); ?>admin/quotation/changedetails">
<input id="id_quotation" type="hidden" name="id_quotation" value="-1" />
<h1>Create quotation</h1>
<ul class="user-details">
    <li><strong>First Name:</strong> <input type="text" name="name" value="" /></li>
    <li><strong>Last Name:</strong> <input type="text" name="surname" value="" /></li>
    <li><strong>Email:</strong> <input type="text" name="email" value="" /></li>
    <li><strong>Address:</strong> <input type="text" name="address" value="" /></li>
    <li><strong>Town:</strong> <input type="text" name="town" value="" /></li>
    <li><strong>Postcode:</strong> <input type="text" name="postcode" value="" /></li>
    <li><strong>Alternative Address:</strong> <input type="text" name="alternative_address" value="" /></li>
    <li><strong>Alternative Town:</strong> <input type="text" name="alternative_town" value="" /></li>
    <li><strong>Alternative Postcode:</strong> <input type="text" name="alternative_postcode" value="" /></li>
    <li><strong>Landline tel. no.:</strong> <input type="text" name="phone" value="" /></li>
    <li><strong>Mobile tel. no.:</strong> <input type="text" name="mphone" value="" /></li>
    <li><strong>Type of flooring:</strong> Parquet <input id="parquet_area" type="radio" name="area_type" value="parquet" /> Plank <input id="plank_area" type="radio" name="area_type" value="plank" checked="checked" /></li>
    <li><strong>Staining required:</strong> Yes <input id="staining_area" type="checkbox" name="staining_area" value="yes" /> No <input type="checkbox" name="staining_area" value="no" /> Not sure <input type="checkbox" name="staining_area" value="not_sure" /></li>
    <li><strong>Carpet lift & removal required:</strong> Yes <input type="checkbox" name="lift_removal" value="yes" /> No <input type="checkbox" name="lift_removal" value="no" /></li>
    <li><strong>Gap filling required:</strong> Yes <input type="checkbox" name="gap_filling" value="yes" /> No <input type="checkbox" name="gap_filling" value="no" /> Not sure <input type="checkbox" name="gap_filling" value="not_sure" /></li>
    <li><strong>Which finish would you like?</strong> Matt <input type="checkbox" name="which_finish" value="matt" /> Satin <input type="checkbox" name="which_finish" value="satin" /> Gloss <input type="checkbox" name="which_finish" value="gloss" /></li>
    <li><strong>Is there any black/brown bitumen or paint on your floor (if present, this is usually around the perimeters of the room, 1-3ft wide)?</strong> Yes <input id="bitumen" type="checkbox" name="bitumen" value="yes" /> No <input type="checkbox" name="bitumen" value="no"  /></li>
    <li><strong>Room measurements:</strong> Metres <input type="radio" name="room_dimentions" value="metres" checked="checked" /> Feet <input id="room_dimentions" type="radio" name="room_dimentions" value="feet" /></li>
    <li><strong>Amount of rooms:</strong> <input id="rooms_count" type="text" class="date-field" name="rooms_count" value="" style="text-align: center;" /></li>
    <li><strong>Rooms:</strong>
        <div id="ul_rooms"></div>
        
    </li>
    <li><strong>Total Sq Metres:</strong> <input type="text" id="total_sq" value="" style="width: 50px" /></li>
    <li><strong>Total price £:</strong> <input type="text" id="tpfj" name="total_price_for_job" value="" style="width: 50px" /></li>
	<li><strong>Discount:</strong> <input type="text" id="tpfjdiscount" name="discount" value="" style="width: 50px" /></li>
	<li><strong>Total price £(discount):</strong> <input type="text" id="tpfjtotal" name="total_price_for_job_discount" value="" style="width: 50px" /></li>
    <li><strong>Total price with options £:</strong> <input type="text" id="tpfj" name="payment" value="" style="width: 50px" /></li>
	<li>
        <strong>Booking date:</strong> <span id="book_date">00/00/00</span>
        &emsp;[ <a href="javascript:void(0);" onclick="submitForm()">Change</a> ]
    </li>
    <li><strong>Further option 1:</strong> <span id="further_option_1"></span></li>
    <input type="hidden" id="fu1" value="" />
    <li><strong>Further option 2:</strong> <span id="further_option_2"></span></li>
    <input type="hidden" id="fu2" value="" />
    <li><strong>Description:</strong><textarea name="discribe_work" class="textarea"></textarea></li>
</ul>
<input type="submit" value="SAVE" class="submit" />&emsp;<input type="button" value="BACK" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/quotation'" />
</form>
<!--a href="<?php echo URL::base(); ?>admin/quotation"><< Back</a-->
<div id="modal_block_hidden2"></div>
<div id="modal_block2"></div>