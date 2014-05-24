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
<?php if (!empty($user)): ?>
<h1>Maintenance contract details</h1>
<form method="post" action="<?php echo URL::base(); ?>admin/maintenance/changedetails">
    <input id="id_maintenance" type="hidden" name="id_maintenance" value="<?php echo $user['id_maintenance']; ?>" />
<ul class="user-details">
    <li><strong>First Name:</strong> <input type="text" name="name" value="<?php echo $user['name']; ?>" /></li>
    <li><strong>Last Name:</strong> <input type="text" name="surname" value="<?php echo $user['surname']; ?>" /></li>
     <li><strong>Company:</strong> <input type="text" name="company" value="<?php echo $user['company']; ?>" /></li>
    <li><strong>Email:</strong> <input type="text" name="email" value="<?php echo $user['email']; ?>" /></li>
    <li><strong>Address:</strong> <input type="text" name="address" value="<?php echo $user['address']; ?>" /></li>
    <li><strong>Town:</strong> <input type="text" name="town" value="<?php echo $user['town']; ?>" /></li>
    <li><strong>Postcode:</strong> <input type="text" name="postcode" value="<?php echo $user['postcode']; ?>" /></li>
    <li><strong>Alternative address:</strong> <input type="text" name="alternative_address" value="<?php echo $user['alternative_address']; ?>" /></li>
    <li><strong>Alternative town:</strong> <input type="text" name="alternative_town" value="<?php echo $user['alternative_town']; ?>" /></li>
    <li><strong>Alternative postcode:</strong> <input type="text" name="alternative_postcode" value="<?php echo $user['alternative_postcode']; ?>" /></li>
    <li><strong>Landline tel. no.:</strong> <input type="text" name="phone" value="<?php echo $user['phone']; ?>" /></li>
    <li><strong>Mobile tel. no.:</strong> <input type="text" name="mphone" value="<?php echo $user['mphone']; ?>" /></li>
    <li><strong>Special Notes:</strong> <input type="text" name="special_notes" style="width:650px" value="<?php echo $user['special_notes']; ?>" /></li>
    <li><strong>Enquiry date:</strong> <?php echo date("d/m/Y", $user['registration_date']); ?></li>
    <li><strong>Daily clean:</strong> Daily <input type="checkbox" name="daily_clean" value="daily" class="radio_price1" rel="365"<?php echo ($user['daily_clean'] == "daily") ? " checked='checked'" : ""; ?> /> Monthly <input type="checkbox" name="daily_clean" value="monthly" class="radio_price1" rel="12"<?php echo ($user['daily_clean'] == "monthly") ? " checked='checked'" : ""; ?> /> Quarterly <input type="checkbox" name="daily_clean" value="quarterly" class="radio_price1" rel="4"<?php echo ($user['daily_clean'] == "quarterly") ? " checked='checked'" : ""; ?> /></li>
    <li><strong>Deep cleaning & Protector:</strong> Daily <input type="checkbox" name="deep_clean" value="daily" class="radio_price2" rel="365"<?php echo ($user['deep_clean'] == "daily") ? " checked='checked'" : ""; ?> /> Monthly <input type="checkbox" name="deep_clean" value="monthly" class="radio_price2" rel="12"<?php echo ($user['deep_clean'] == "monthly") ? " checked='checked'" : ""; ?> /> Quarterly <input type="checkbox" name="deep_clean" value="quarterly" class="radio_price2" rel="4"<?php echo ($user['deep_clean'] == "quarterly") ? " checked='checked'" : ""; ?> /></li>
    <li><strong>Buff'n'Coat:</strong>
        <ul class="buff">
            <li>Daily <input type="checkbox" value="daily" name="buff_n_coat" class="radio_price3" rel="365"<?php echo ($user['buff_n_coat'] == "daily") ? " checked='checked'" : ""; ?> /></li>
            <li>Weekly <input type="checkbox" value="weekly" name="buff_n_coat" class="radio_price3" rel="52"<?php echo ($user['buff_n_coat'] == "weekly") ? " checked='checked'" : ""; ?> /></li>
            <li>Monthly <input type="checkbox" value="monthly" name="buff_n_coat" class="radio_price3" rel="12"<?php echo ($user['buff_n_coat'] == "monthly") ? " checked='checked'" : ""; ?> /></li>
            <li>Quarterly  <input type="checkbox" value="quarterly" name="buff_n_coat" class="radio_price3" rel="4"<?php echo ($user['buff_n_coat'] == "quarterly") ? " checked='checked'" : ""; ?> /></li>
            <li>6 Monthly <input type="checkbox" value="6 monthly" name="buff_n_coat" class="radio_price3" rel="2"<?php echo ($user['buff_n_coat'] == "6 monthly") ? " checked='checked'" : ""; ?> /></li>
            <li>Annually <input type="checkbox" value="annually" name="buff_n_coat" class="radio_price3" rel="1"<?php echo ($user['buff_n_coat'] == "annually") ? " checked='checked'" : ""; ?> /></li>
            <li>3 Yearly <input type="checkbox" value="3 yearly" name="buff_n_coat" class="radio_price3" rel="1"<?php echo ($user['buff_n_coat'] == "3 yearly") ? " checked='checked'" : ""; ?> /></li>
            <li>5 Yearly <input type="checkbox" value="5 yearly" name="buff_n_coat" class="radio_price3" rel="1"<?php echo ($user['buff_n_coat'] == "5 yearly") ? " checked='checked'" : ""; ?> /></li>
        </ul>
    </li>
    <li><strong>Floor type:</strong>
        <ul class="buff">
            <li>Floorboards <input type="radio" value="floorboards" name="type_of_floor"<?php echo ($user['type_of_floor'] == "floorboards") ? " checked='checked'" : ""; ?> /></li>
            <li>Parquet <input type="radio" value="parquet" name="type_of_floor"<?php echo ($user['type_of_floor'] == "parquet") ? " checked='checked'" : ""; ?> /></li>
            <li>Engineered <input type="radio" value="engineered" name="type_of_floor"<?php echo ($user['type_of_floor'] == "engineered") ? " checked='checked'" : ""; ?> /></li>
            <li>Other  <input id="other_radio" type="radio" value="other" name="type_of_floor"<?php echo ($user['type_of_floor'] != "floorboards" && $user['type_of_floor'] != "parquet" && $user['type_of_floor'] != "engineered") ? " checked='checked'" : ""; ?> /></li>
            <li id="other_text" <?php echo ($user['type_of_floor'] == "floorboards" || $user['type_of_floor'] == "parquet" || $user['type_of_floor'] == "engineered") ? "style='display:none;'" : ""; ?>>
                <input type="text" name="type_of_floor_other" value="<?php echo $user['type_of_floor']; ?>" class="meter-field" maxlength="20" /></li>
        </ul>
    </li>
    <li><strong>Day of week:</strong>
        <ul class="buff">
            <li>Monday <input type="checkbox" value="Monday" name="day_of_week"<?php echo ($user['day_of_week'] == "Monday") ? " checked='checked'" : ""; ?> /></li>
            <li>Tuesday <input type="checkbox" value="Tuesday" name="day_of_week"<?php echo ($user['day_of_week'] == "Tuesday") ? " checked='checked'" : ""; ?> /></li>
            <li>Wednesday <input type="checkbox" value="Wednesday" name="day_of_week"<?php echo ($user['day_of_week'] == "Wednesday") ? " checked='checked'" : ""; ?> /></li>
            <li>Thursday <input type="checkbox" value="Thursday" name="day_of_week"<?php echo ($user['day_of_week'] == "Thursday") ? " checked='checked'" : ""; ?> /></li>
            <li>Friday <input type="checkbox" value="Friday" name="day_of_week"<?php echo ($user['day_of_week'] == "Friday") ? " checked='checked'" : ""; ?> /></li>
            <li>(Weekend/out of hours work by request only) <input type="checkbox" value="(Weekend/out of hours work by request only)" name="day_of_week"<?php echo ($user['day_of_week'] == "(Weekend/out of hours work by request only)") ? " checked='checked'" : ""; ?> /></li>
        </ul>
    </li>
    <li><strong>Find about us:</strong> <?php echo $user['find_about_us']; ?></li>
    <li><strong>Room measurements:</strong> Metres <input class="measurements" type="radio" checked="checked" value="metres" name="room_dimentions" /> Feet <input id="room_dimentions" class="measurements" type="radio" value="feet" name="room_dimentions"<?php if ($user['room_dimentions'] == "feet") echo " checked=\"checked\""; ?>></li>
    <li><strong>Amount of rooms:</strong> <input id="rooms_count" type="text" name="rooms_count" value="<?php echo $user['rooms_count']; ?>" id="rooms_count" class="date-field" style="text-align: center" /></li>
    <li><strong>Rooms:</strong>
        <div id="ul_rooms">
            <?php
            $rooms_settings = unserialize($user['rooms_settings']);
            if (isset($rooms_settings)) {
                $html = "<ul style='list-style-type: none;'>";
                $cnt = count($rooms_settings['room_w']);
                if ($user['room_dimentions'] == "feet") {
                    for ($i = 1; $i <= $cnt; $i++) {
                        $html .= "<li>";
                        $html .= "<span>Room " . $i . ":&nbsp;&nbsp; </span> ";
                        $html .= "Width ";
                        $html .= "<input type=\"text\" name=\"room_w[" . $i . "]\" id=\"room_w_" . $i . "\" value=\"" . $rooms_settings['room_w'][$i] . "\"  class=\"date-field numb inches\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Feet &nbsp;";
                        $html .= "<input type=\"text\" name=\"room_w_i[" . $i . "]\" id=\"room_w_i_" . $i . "\" value=\"" . $rooms_settings['room_w_i'][$i] . "\"  class=\"date-field inches\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Inches&nbsp;";
                        $html .= "&nbsp;   x&nbsp;&nbsp;   Length ";
                        $html .= "<input type=\"text\" name=\"room_l[" . $i . "]\" id=\"room_l_" . $i . "\" value=\"" . $rooms_settings['room_l'][$i] . "\"  class=\"date-field numb inches\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Feet &nbsp;";
                        $html .= "<input type=\"text\" name=\"room_l_i[" . $i . "]\" id=\"room_l_i_" . $i . "\" value=\"" . $rooms_settings['room_l_i'][$i] . "\"  class=\"date-field inches\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Inches = ";
                        $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                        $html .= "Total Sq Feet&nbsp;&nbsp;&nbsp; Price £ ";
                        $html .= "<input type=\"text\" name=\"price[" . $i . "]\" id=\"price_" . $i . "\" value=\"" . $rooms_settings['price'][$i] . "\" class=\"date-field total_price\" />";
                        $html .= "</li>";
                    }
                } else {
                    for ($i = 1; $i <= $cnt; $i++) {
                        $html .= "<li>";
                        $html .= "<span>Room " . $i . ":&nbsp;&nbsp; </span> ";
                        $html .= "Width ";
                        $html .= "<input type=\"text\" name=\"room_w[" . $i . "]\" id=\"room_w_" . $i . "\" value=\"" . $rooms_settings['room_w'][$i] . "\"  class=\"date-field numb\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Metres&nbsp;&nbsp;   x&nbsp;&nbsp;   Length ";
                        $html .= "<input type=\"text\" name=\"room_l[" . $i . "]\" id=\"room_l_" . $i . "\" value=\"" . $rooms_settings['room_l'][$i] . "\"  class=\"date-field numb\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                        $html .= "Metres = ";
                        $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                        $html .= "Total Sq Metres&nbsp;&nbsp;&nbsp; Price £ ";
                        $html .= "<input type=\"text\" name=\"price[" . $i . "]\" id=\"price_" . $i . "\" value=\"" . $rooms_settings['price'][$i] . "\" class=\"date-field total_price\" />";
                        $html .= "</li>";
                    }
                }
                $html .= "</ul>";
                echo $html;
            }
            ?>
        </div>
        
    </li>
	<?php echo $user['option_type']; ?>
    <li><strong>Total price £:</strong> <input id="total_price_for_job" type="text" value="<?php echo $user['total_price_for_job']; ?>" name="total_price_for_job" class="meter-field1"  /></li>
    <li>
		<strong>Option type:</strong>
		<select name="option_type" id="option_type">
			<option value="<?php echo $user['option_type']; ?>"><?php echo $user['option_type']; ?></option>
			<?php
			if( $user['option_type']=="option 1"){
				?>
				<option value="option 2">option 2</option>
				<option value="option 3">option 3</option>
				<?
			}
			?>
			<?php
			if( $user['option_type']=="option 2"){
				?>
				<option value="option 1">option 1</option>
				<option value="option 3">option 3</option>
				<?
			}
			?>
			<?php
			if( $user['option_type']=="option 3"){
				?>
				<option value="option 1">option 1</option>
				<option value="option 2">option 2</option>
				<?
			}
			?>
		</select>
	</li>
    <li><strong>Option price:</strong> <input type="text" id="option_price" name="option_price" value="<?php echo $user['option_price']; ?>" /></li>
    <li><strong>Payment status: </strong> <select id="payment_status" name="payment_status">
                                          <option <?php if (($user['payment_status']==0) and ($user['is_complete']==0)) echo "selected"; else echo ""; ?> value="1">Potential</option> 
                                          <option <?php if (($user['payment_status']==0) and ($user['is_complete']==1))  echo "selected"; else echo ""; ?> value="2">Not Paid</option>
                                          <option <?php if (($user['payment_status']==1) and ($user['is_complete']==1))  echo "selected"; else echo ""; ?> value="3">Confirmed</option>
        </select></li>
    <li><strong>Work dates:</strong> <div id="work_dates">
            <?php if (!empty($work_dates)): ?>
            <?php foreach ($work_dates as $wd): ?>
            <span id="d<?php echo date("jnY", $wd->datetime); ?>" class="d<?php echo date("jnY", $wd->datetime); ?>"><?php echo date("j/n/Y", $wd->datetime); ?>
                <?php if(isset($types[$wd->datetime])) 
                         $check_type = $types[$wd->datetime];
                      if (isset($check_type) and ($check_type=='busy')) echo "booked";
                ?>
                <?php if(in_array($wd->datetime, $partials)) echo "(half)"; ?> 
                <a href="javascript:void(0);" onclick="removeDate(<?php echo date("j", $wd->datetime); ?>,<?php echo date("n", $wd->datetime); ?>,<?php echo date("Y", $wd->datetime); ?>);">
                    <img src="<?php echo URL:: base(); ?>images/closeicon.png" alt='' />
                </a>;
            </span> 
            <?php endforeach; ?>
            <?php endif; ?>
        </div> <br/>[ <a href="javascript:void(0);" onclick="changeWorkDates();">Change</a> ]</li>
</ul>
<?php
    $images = unserialize($user['photos']);
    if (!empty($images)):
    ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        
            jQuery(".lightbox").lightbox();
    });
</script>
<div>
    <table width="708" align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td valign="top" width="1" class="arrow">
                    <div class="left_arrow">
                        <a onmouseup="dw_scrollObj.resetSpeed('wn')" onmousedown="dw_scrollObj.doubleSpeed('wn')" onmouseover="dw_scrollObj.initScroll('wn','left')" onclick="return false" onmouseout="dw_scrollObj.stopScroll('wn')" href="javascript:void(0);">
                            <img src="<?php echo URL::base(); ?>images/left-arrow.gif" border="0" />
                        </a>
                    </div>
                </td>
                <td>
                    <div id="hold">
                        <div id="wn">
                            <div style="top: 0pt; left: 0pt; visibility: visible;" class="content" id="lyr1">
                                <table id="t1" border="0" cellpadding="0" cellspacing="6">
                                    <tbody>
                                        <tr id="thumbs" >
                                            <?php foreach ($images as $image): ?>
                                            <td>
                                                <div class="service-sample-main" style="width: 193px;">
                                                <ul>
                                                    <li>
                                                    <img src="<?php echo URL::base(); ?>uploads/users/<?php echo $image; ?>" style="max-height: 193px;" alt="" />
                                                    <p>
                                                        <a href="<?php echo URL::base(); ?>uploads/users/<?php echo $image; ?>" class="lightbox">
                                                            <img src="<?php echo URL::base(); ?>images/zoom-icon.jpg" alt="" border="0" />
                                                        </a>
                                                    </p>
                                                </li>
                                                </ul>
                                            </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </td>
                <td valign="top" width="1" class="arrow">
                    <div class="right_arrow">
                        <a onmouseup="dw_scrollObj.resetSpeed('wn')" onmousedown="dw_scrollObj.doubleSpeed('wn')" onmouseover="dw_scrollObj.initScroll('wn','right')" onclick="return false" onmouseout="dw_scrollObj.stopScroll('wn')" href="javascript:void(0);">
                            <img src="<?php echo URL::base(); ?>images/right-arrow.gif" border="0" />
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="clear"></div>
</div>
                    <br />
    <?php endif; ?>
                    
                    <input type="submit" value="SAVE" class="submit" /> <input type="button" value="EXPORT TO EXCEL" onclick="showExcelExport()" class="submit" />
                    </form>
<?php endif; ?>
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