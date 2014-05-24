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
<?php if (!empty($user)): ?>
    <form id="ddform" method="post" action="<?php echo URL::base(); ?>admin/quotation/changedetails">
        <input id="id_quotation" type="hidden" name="id_quotation" value="<?php echo $user['id_quotation']; ?>" />
        <h1>Quotations details</h1>
        <ul class="user-details">
            <li><strong>First Name:</strong> <input type="text" name="name" value="<?php echo $user['name']; ?>" /></li>
            <li><strong>Last Name:</strong> <input type="text" name="surname" value="<?php echo $user['surname']; ?>" /></li>
            <li><strong>Company</strong> <input type="text" name="company" value="<?php echo $user['company']; ?>" /></li>
            <li><strong>Email:</strong> <input type="text" name="email" value="<?php echo $user['email']; ?>" /></li>
            <li><strong>Address:</strong> <input type="text" name="address" value="<?php echo $user['address']; ?>" /></li>
            <li><strong>Town:</strong> <input type="text" name="town" value="<?php echo $user['town']; ?>" /></li>
            <li><strong>Postcode:</strong> <input type="text" name="postcode" value="<?php echo $user['postcode']; ?>" /></li>
            <li><strong>Alternative Address:</strong> <input type="text" name="alternative_address" value="<?php echo $user['alternative_address']; ?>" /></li>
            <li><strong>Alternative Town:</strong> <input type="text" name="alternative_town" value="<?php echo $user['alternative_town']; ?>" /></li>
            <li><strong>Alternative Postcode:</strong> <input type="text" name="alternative_postcode" value="<?php echo $user['alternative_postcode']; ?>" /></li>
            <li><strong>Special Notes:</strong> <textarea type="text" name="special_notes" rows ="5" cols="50"><?php echo $user['special_notes']; ?></textarea></li>
            <li><strong>Landline tel. no.:</strong> <input type="text" name="phone" value="<?php echo $user['phone']; ?>" /></li>
            <li><strong>Mobile tel. no.:</strong> <input type="text" name="mphone" value="<?php echo $user['mphone']; ?>" /></li>
            <li><strong>Enquiry date:</strong> <?php echo date("d/m/Y", $user['registration_date']); ?></li>
            <?php //if ($user['is_complete'] == 1): ?>
            <li><strong>Type of flooring:</strong> Parquet <input id="parquet_area" type="radio" name="area_type" value="parquet"<?php if ($user['area_type'] == "parquet")
            echo " checked=\"checked\""; ?> /> Plank <input id="plank_area" type="radio" name="area_type" value="plank"<?php if ($user['area_type'] == "plank")
            echo " checked=\"checked\""; ?> /></li>
            <li><strong>Staining required:</strong><?php if ($user['staining_area'] != "" && $user['staining_area'] != "none") {
            echo substr($user['staining_area'], 0, strlen($user['staining_area']) - 1);
        } else {
            echo "none";
        } ?> </li>
            <li><strong>Carpet lift & removal required:</strong><?php if ($user['lift_removal'] != "" && $user['lift_removal'] != "none") {
            echo substr($user['lift_removal'], 0, strlen($user['lift_removal']) - 1);
        } else {
            echo "none";
        } ?> </li>
            <li><strong>Gap filling required(resin):</strong><?php if ($user['gap_filling'] != "" && $user['gap_filling'] != "none") {
            echo substr($user['gap_filling'], 0, strlen($user['gap_filling']) - 1);
        } else {
            echo "none";
        } ?></li>
            <li><strong>Gap filling required(wood):</strong><?php if ($user['gap_filling_wood'] != "" && $user['gap_filling_wood'] != "none") {
                    echo substr($user['gap_filling_wood'], 0, strlen($user['gap_filling_wood']) - 1);
                } else {
                    echo "none";
                } ?></li>
            <li><strong>Is there any black/brown bitumen or paint on your floor (if present, this is usually around the perimeters of the room, 1-3ft wide)?</strong><?php if ($user['bitumen'] != "" && $user['bitumen'] != "none") {
                    echo substr($user['bitumen'], 0, strlen($user['bitumen']) - 1);
                } else {
                    echo "none";
                } ?></li></li>

            <li><strong>Which finish would you like?</strong> Matt <input type="checkbox" name="which_finish" value="matt" <?php if ($user['which_finish'] == "matt")
                    echo " checked=\"checked\""; ?> /> Satin <input type="checkbox" name="which_finish" value="satin" <?php if ($user['which_finish'] == "satin")
                    echo " checked=\"checked\""; ?> /> Gloss <input type="checkbox" name="which_finish" value="gloss" <?php if ($user['which_finish'] == "gloss")
                    echo " checked=\"checked\""; ?> /></li>
            <li><strong>How did you find about us:</strong> <?php echo $user['find_about_us']; ?></li>
            <li><strong>Room measurements:</strong> Metres <input type="radio" name="room_dimentions" value="metres"<?php if ($user['room_dimentions'] == "metres")
                    echo " checked=\"checked\""; ?> /> Feet <input id="room_dimentions" type="radio" name="room_dimentions" value="feet"<?php if ($user['room_dimentions'] == "feet")
                    echo " checked=\"checked\""; ?> /></li>
            <li><strong>Amount of rooms:</strong> <input id="rooms_count" type="text" class="date-field" name="rooms_count" value="<?php echo $user['rooms_count']; ?>" style="text-align: center;" /></li>
            <li><strong>Rooms:</strong>
                <div id="ul_rooms">
                    <?php
                    $rooms_settings = unserialize($user['rooms_settings']);
                    //var_dump($rooms_settings); exit();
                    if (isset($rooms_settings)) {
                        $html = "<ul style='list-style-type: none'>";
                        $cnt = count($rooms_settings['room_w']);
                        $total_sq = 0;
                        if ($user['room_dimentions'] == "feet") {
                            for ($i = 1; $i <= $cnt; $i++) {
                                $html .= "<li>";
                                $html .= "<span>Room " . $i . ":&nbsp;&nbsp; </span> ";
                                $html .= "Width ";
                                $html .= "<input type=\"text\" name=\"room_w[" . $i . "]\" id=\"room_w_" . $i . "\" value=\"" . $rooms_settings['room_w'][$i] . "\"  class=\"date-field numb inches room_w\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Feet &nbsp;";
                                $dtmt = isset($rooms_settings['room_w_i'][$i]) ? $rooms_settings['room_w_i'][$i] : "";
                                $html .= "<input type=\"text\" name=\"room_w_i[" . $i . "]\" id=\"room_w_i_" . $i . "\" value=\"" . $dtmt . "\"  class=\"date-field inches room_w_i\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Inches&nbsp;";
                                $html .= "&nbsp;   x&nbsp;&nbsp;   Length ";
                                $html .= "<input type=\"text\" name=\"room_l[" . $i . "]\" id=\"room_l_" . $i . "\" value=\"" . $rooms_settings['room_l'][$i] . "\"  class=\"date-field numb inches room_l\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Feet &nbsp;";
                                $dtmt = isset($rooms_settings['room_l_i'][$i]) ? $rooms_settings['room_l_i'][$i] : "";
                                $html .= "<input type=\"text\" name=\"room_l_i[" . $i . "]\" id=\"room_l_i_" . $i . "\" value=\"" . $dtmt . "\"  class=\"date-field inches room_l_i\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Inches = ";
                                $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                                $html .= "Total Sq Feet&nbsp;&nbsp;&nbsp; Price &pound; ";
                                $html .= "<input type=\"text\" name=\"price[" . $i . "]\" id=\"price_" . $i . "\" value=\"" . $rooms_settings['price'][$i] . "\" class=\"meter-field total_price\" />";
                                $html .= "</li>";
                                $total_sq += $rooms_settings['total_sq'][$i];
                            }
                        } else {
                            for ($i = 1; $i <= $cnt; $i++) {

                                $html .= "<li>";
                                $html .= "<span>Room " . $i . ":&nbsp;&nbsp; </span> ";
                                $html .= "Width ";
                                $html .= "<input type=\"text\" name=\"room_w[" . $i . "]\" id=\"room_w_" . $i . "\" value=\"" . $rooms_settings['room_w'][$i] . "\"  class=\"date-field numb room_w\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Metres&nbsp;&nbsp;   x&nbsp;&nbsp;   Length ";
                                $html .= "<input type=\"text\" name=\"room_l[" . $i . "]\" id=\"room_l_" . $i . "\" value=\"" . $rooms_settings['room_l'][$i] . "\"  class=\"date-field numb room_l\" onkeyup=\"totalMeters(" . $i . ")\" style=\"text-align: center\" rel=\"" . $i . "\" /> ";
                                $html .= "Metres = ";
                                $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                                $html .= "Total Sq Metres&nbsp;&nbsp;&nbsp; Price &pound; ";
                                $html .= "<input type=\"text\" name=\"price[" . $i . "]\" id=\"price_" . $i . "\" value=\"" . $rooms_settings['price'][$i] . "\" class=\"meter-field total_price\" style=\"width: 50px\" />";
                                $html .= "</li>";
                                $total_sq += $rooms_settings['total_sq'][$i];
                            }
                        }
                        $html .= "</ul>";
                        echo $html;
                    }
                    ?>
                </div>

            </li>
            <li><strong>Total Sq <?php echo ($user['room_dimentions'] == "feet") ? "Feet" : "Metres"; ?>:</strong> <input type="text" id="total_sq" value="<?= $total_sq; ?>" class="w70" /></li>
            <li><strong>Price £:</strong> <input type="text" id="tpfj" name="total_price_for_job" value="<?php echo $user['total_price_for_job']; ?>" class="w70" /></li>
            <li><strong>Discount:</strong> <input type="text" id="tpfjdiscount" name="discount" value="<?php echo $user['discount']; ?>" class="w70" /></li>
            <?php if(isset($sales[$user['code']])) { ?>
                <li><strong>Promocode (<?php echo $sales[$user['code']];?>)</strong> <input type="text" id="tpfjpromocode" name="code" value="<?php echo $user['code']; ?>" class="w70" /></li>
            <?php } else { ?>
                <li><strong>Promocode</strong> <input type="text" id="tpfjpromocode" name="code" value="-" class="w70" /></li>
            <?php } ?>
            <!--li><strong>Total price with options £:</strong> <input type="text" id="tpfj" name="payment" value="<?php echo $user['payment']; ?>" class="w70" /></li-->

            <li><strong>Total price £(discount):</strong> <input type="text" id="tpfjtotal" name="total_price_for_job_discount" value="<?php echo $user['total_price_with_discount']; ?>" class="w70" /></li>
    <?php if ($user['payment_status']): ?>
                <li><strong>Deposited £:</strong> <?php echo $user['payment']; ?></li>
    <?php endif; ?>
            <li>
                <strong>Booking date:</strong> <span id="book_date"><?php if ($user['work_date'] != 0)
        echo date("d/m/Y", $user['work_date']); ?>
    <?php if (count($booking) > 1): ?>
                        - <?php echo date("d/m/Y", $booking[count($booking) - 1]->datetime); ?>
    <?php endif; ?>
                </span>
                &emsp;[ <a href="javascript:void(0);" onclick="submitForm(<?php echo $user['id_quotation']; ?>)">Change</a> ]
            </li>
            <li><strong>Further option 1:</strong> <span id="further_option_1"><?php echo (!empty($booking)) ? $booking[0]->further_option_1 : "no"; ?></span></li>
            <input type="hidden" id="fu1" value="<?php echo (!empty($booking)) ? $booking[0]->further_option_1 : "no"; ?>" />
            <li><strong>Further option 2:</strong> <span id="further_option_2"><?php echo (!empty($booking)) ? $booking[0]->further_option_2 : "no"; ?></span></li>
            <input type="hidden" id="fu2" value="<?php echo (!empty($booking)) ? $booking[0]->further_option_2 : "no"; ?>" />
            <li><strong>Payment status: </strong> <?php echo ($user['payment_status']) ? "<span style='color: #27f611;'>yes</span>" : "<span style='color: #cd0100;'>no</span>"; ?></li>
            <li><strong>Description:</strong><textarea name="discribe_work" class="textarea"><?php echo $user['discribe_work']; ?></textarea></li>
    <?php //endif;  ?>
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
<input type="button" value="BACK" class="submit" style="margin-top: 5px;" onclick="parent.location='<?php echo URL::base(); ?>admin/quotation'" />
<!--a href="<?php echo URL::base(); ?>admin/quotation"><< Back</a-->
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
        <form method="post" action="<?php echo URL::base(); ?>admin/quotation/detailsexport">
            <input type="hidden" name="id_quotation" value="<?php echo $user['id_quotation']; ?>" />
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