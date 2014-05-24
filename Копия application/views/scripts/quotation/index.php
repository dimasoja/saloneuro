<script type="text/javascript">
    jQuery('#progress_bar').attr("src","/images/step1.png");	
    jQuery('#progress_bar').css('height', '');
</script>
<script type="text/javascript">
<?php
foreach ($settings as $key => $val) {
    echo "var " . $key . ' = ' . $val . ";\n";
}
?>
    jQuery(document).ready(function() {
        jQuery("#finish").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });     
        jQuery("#staining").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        }); 
        jQuery("#liftremova").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#gapfilling").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#widegapfil").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#bitumenbb").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
    });
</script>
<div id="inside_container">
    <!--containt area holder -->
    <form method="post" id="quotation_form" action="<?php echo URL::base(); ?>online-quotation" enctype="multipart/form-data">
        <input id="id_quotation" type="hidden" name="id_quotation" value="<?php echo $id_quotation; ?>" />
        <input type="hidden" value="<?php echo $link; ?>" name="link" id="link_rel"/>
        <input type="hidden" name="goto_checkout" id="goto_checkout" value="0" />
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <h1>Get an INSTANT Floor Sanding Quotation</h1>
                <div id="personal-info">
                    <span style="font-size:17px;">Please supply your Contact Details</span>
                    <ul>
                        <li>
                            <div class="franchisee-name-small-div">
                                <input id="name" type="text" name="name" value="<?php echo (isset($name)) ? $name : "First Name"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($name_show_error))
    echo $name_show_error; ?>" onfocus="if(this.value=='First Name'){this.value=''};" onblur="if(this.value==''){this.value='First Name'};" />
                                <div id="name_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($name_error) && '' != $name_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $name_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="franchisee-name-small-div">
                                <input style="margin-left: 10px;" id="surname" type="text" name="surname" value="<?php echo (isset($surname)) ? $surname : "Last Name"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($surname_show_error))
                                        echo $surname_show_error; ?>" onfocus="if(this.value=='Last Name'){this.value=''};" onblur="if(this.value==''){this.value='Last Name'};" />

                                <div id="surname_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($surname_error) && '' != $surname_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $surname_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>

                        <li>
                            <input id="address" type="text" name="address" value="<?php echo (isset($address)) ? $address : "Address"; ?>" class="franchisee-name<?php if (isset($address_show_error))
                                        echo $address_show_error; ?>" onfocus="if(this.value=='Address'){this.value=''};" onblur="if(this.value==''){this.value='Address'};" />
                            <div id="address_block">
                                <?php if (isset($address_error) && '' != $address_error): ?>
                                    <div class="franchisee-name-big-error">
                                        <?php echo $address_error; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>

                        <li>
                            <div class="franchisee-name-small-div">
                                <input id="town" type="text" name="town" value="<?php echo (isset($town)) ? $town : "Town"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($town_show_error))
                                    echo $town_show_error; ?>" onfocus="if(this.value=='Town'){this.value=''};" onblur="if(this.value==''){this.value='Town'};" />
                                <div id="town_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($town_error) && '' != $town_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $town_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="franchisee-name-small-div">
                                <input style="margin-left: 10px;" id="postcode" type="text" name="postcode" value="<?php echo (isset($postcode)) ? $postcode : "Postcode"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($postcode_show_error))
                                        echo $postcode_show_error; ?>" onfocus="if(this.value=='Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Postcode'};" />

                                <div id="postcode_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($postcode_error) && '' != $postcode_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $postcode_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="franchisee-name-small-div">
                                <input id="phone" type="text" name="phone" value="<?php echo (isset($phone)) ? $phone : "Tel No (Landline)"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($phone_show_error))
                                        echo $phone_show_error; ?>" onfocus="if(this.value=='Tel No (Landline)'){this.value=''};" onblur="if(this.value==''){this.value='Tel No (Landline)'};" />
                                <div id="phone_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($phone_error) && '' != $phone_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $phone_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="franchisee-name-small-div">
                                <input style="margin-left: 10px;" id="mphone" type="text" name="mphone" value="<?php echo (isset($mphone)) ? $mphone : "Tel No (Mobile)"; ?>" class="franchisee-name-small franchisee-name<?php if (isset($mphone_show_error))
                                        echo $mphone_show_error; ?>" onfocus="if(this.value=='Tel No (Mobile)'){this.value=''};" onblur="if(this.value==''){this.value='Tel No (Mobile)'};" />
                                <div id="mphone_block" class="franchisee-name-small-error-div">
                                    <?php if (isset($mphone_error) && '' != $mphone_error): ?>
                                        <div class="franchisee-name-small-error">
                                            <?php echo $mphone_error; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <li>
                            <input id="email" type="text" name="email" value="<?php echo (isset($email)) ? $email : "Email"; ?>" class="franchisee-name<?php if (isset($email_show_error))
                                        echo $email_show_error; ?>" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" />
                            <div id="email_block">
                                <?php if (isset($email_error) && '' != $email_error): ?>
                                    <div class="franchisee-name-big-error">
                                        <?php echo $email_error; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div style="float: right; margin-top: 37px;width: 50%;">
                    <ul style="list-style-type:none; float: right;">
                        <li class="fontsize18" style="font-size:14px;">Please give address of property where work is to take place,</li>
                        <li class="fontsize18" style="font-size:14px;">if different from Contact Details.</li>
                        <li><input  style="background: #aeb0b3;" id="alternative_address" type="text" name="alternative_address" value="<?php echo (isset($alternative_address)) ? $alternative_address : "Alternative Address"; ?>" class="franchisee-name<?php if (isset($alternative_address_show_error))
                                    echo $alternative_address_show_error; ?>" onfocus="if(this.value=='Alternative Address'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Address'};" /></li>
                        <li><input style="width:190px;float:left;background: #aeb0b3;" id="alternative_town" type="text" name="alternative_town" value="<?php echo (isset($alternative_town)) ? $alternative_town : "Alternative Town"; ?>" class="franchisee-name<?php if (isset($alternative_town_show_error))
                                        echo $alternative_town_show_error; ?>" onfocus="if(this.value=='Alternative Town'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Town'};" /></li>
                        <li><input style="width:190px;float:left;margin-left: 10px;background: #aeb0b3;" id="alternative_postcode" type="text" name="alternative_postcode" value="<?php echo (isset($alternative_postcode)) ? $alternative_postcode : "Alternative Postcode"; ?>" class="franchisee-name  <?php if (isset($alternative_postcode_show_error))
                                       echo $alternative_postcode_show_error; ?>" onfocus="if(this.value=='Alternative Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Postcode'};" /></li>
                    </ul>
                </div>
                <div style="float: right; margin-top: 17px; width: 50%;">
                    <ul style="list-style-type:none; float: right; margin-right: 58px">
                        <li class="fontsize18" style="font-size:14px;"><b>Got a promo code? Please put it in the field below</b></li>
                        <li><input style="width: 190px; float: left;" id="promocode" type="text" name="sale" value="<?php echo (isset($code)) ? $code : "Promocode"; ?>" class="franchisee-name<?php if (isset($alternative_address_show_error))
                                    echo $alternative_address_show_error; ?>" onfocus="if(this.value=='Promocode'){this.value=''};" onblur="if(this.value==''){this.value='Promocode'};" /></li>
                         <input type="button"  value="Check" class="submit" onclick="getPromo();" style="float: left;margin-left: 9px; margin-top: 4px;"> 
                         <input type="hidden" value="<?php if(isset($code)) echo $code; ?>" id="hidden-code" name="code"/>
                         <div id="result-promo"><?php if((isset($code)) and ($code!='')) echo "<img src='/images/check_no.png' width=40 height=40; style='margin-top:3px;'/>"; ?></div>
                    </ul>
                </div>
                <div class="clear"></div><br/>
                <span style="font-size:17px;">Describe your work the floor in the box below.</span><br/>
                <div style="margin-top:8px;">
                    <textarea id="discribe_work" name="discribe_work" onfocus="if(this.value=='Description'){this.value=''};" onblur="if(this.value==''){this.value='Description'};" class="textarea is<?php if (isset($discribe_work_show_error))
                                       echo $discribe_work_show_error; ?>"><?php if (isset($discribe_work))
                                  echo HTML::chars($discribe_work); ?></textarea>
				<div id="discribe_work_block" class="franchisee-name-small-error-div"></div>
                </div>
                <div class="require-services">
                    <h2><span style="display:inline-block; width: 308px; color: #fff;font-size:17px;font-weight: normal;">What type of floor do you have?</span> <span style="color: #FF6819;">Parquet</span> <input id="parquet_area" type="radio" name="area_type" value="parquet" <?php echo (isset($area_type) && $area_type == "parquet") ? "checked='checked'" : ""; ?> /> 
                        <span style="color: #FF6819;">Plank floorboards</span> <input id="plank_area" type="radio" name="area_type" value="plank" <?php echo (isset($area_type) && $area_type == "parquet") ? "" : "checked='checked'"; ?> />
                        <span style="margin-left: 50px;display:inline-block; width: 290px; color:white;font-size:17px;font-weight: normal;">How did you find out about us?</span>
                    </h2>
                    <h2><span style="display:inline-block; width: 320px; color: #fff;font-size:17px;font-weight: normal;"><a id="finish" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/varnish" style="position: absolute; margin-top: -3px;" ><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a>&emsp;<span style="padding: 0 0 0 15px;">What type of Varnish would you like?</span></span> <span style="color:#FF6819;margin-left: 25px;">Matt</span> <input type="checkbox" class="which_finish" name="which_finish" value="matt" <?php echo (isset($which_finish) && $which_finish == "matt") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;margin-left: 21px;">Satin</span> <input type="checkbox" class="which_finish" name="which_finish" value="satin" <?php echo (isset($which_finish) && $which_finish == "satin") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">Gloss</span> <input type="checkbox" class="which_finish" name="which_finish" value="gloss" <?php echo (isset($which_finish) && $which_finish == "gloss") ? "checked='checked'" : ""; ?> />
                    
					  
					  <select id="find_about_us" name="find_about_us" style="margin-left: 50px;background:#aeb0b3">
                            <option value=""<?php if (isset($find_about_us) && $find_about_us == "")
                            echo " selected=\"selected\""; ?>>Please choose one of the following</option>
                            <option value="Referred by a friend"<?php if (isset($find_about_us) && $find_about_us == "Referred by a friend")
                                        echo " selected=\"selected\""; ?>>Referred by a friend</option>
                            <option value="Google"<?php if (isset($find_about_us) && $find_about_us == "Google")
                                        echo " selected=\"selected\""; ?>>Google</option>
                            <option value="Yahoo"<?php if (isset($find_about_us) && $find_about_us == "Yahoo")
                                        echo " selected=\"selected\""; ?>>Yahoo</option>
                            <option value="Yell"<?php if (isset($find_about_us) && $find_about_us == "Yell")
                                        echo " selected=\"selected\""; ?>>Yell</option>
                            <option value="Yellow Pages"<?php if (isset($find_about_us) && $find_about_us == "Yellow Pages")
                                        echo " selected=\"selected\""; ?>>Yellow Pages</option>
                            <option value="AOL"<?php if (isset($find_about_us) && $find_about_us == "AOL")
                                        echo " selected=\"selected\""; ?>>AOL</option>
                            <option value="Ask Jeeves"<?php if (isset($find_about_us) && $find_about_us == "Ask Jeeves")
                                        echo " selected=\"selected\""; ?>>Ask Jeeves</option>
                            <option value="MSN Search"<?php if (isset($find_about_us) && $find_about_us == "MSN Search")
                                        echo " selected=\"selected\""; ?>>MSN Search</option>
                            <option value="AOL Search"<?php if (isset($find_about_us) && $find_about_us == "AOL Search")
                                        echo " selected=\"selected\""; ?>>AOL Search</option>
                            <option value="Other search engine"<?php if (isset($find_about_us) && $find_about_us == "Other search engine")
                                        echo " selected=\"selected\""; ?>>Other search engine</option>
                            <option value="Gumtree"<?php if (isset($find_about_us) && $find_about_us == "Gumtree")
                                        echo " selected=\"selected\""; ?>>Gumtree</option>
                            <option value="Link from another website"<?php if (isset($find_about_us) && $find_about_us == "Link from another website")
                                        echo " selected=\"selected\""; ?>>Link from another website</option>
                            <option value="Internet Directory"<?php if (isset($find_about_us) && $find_about_us == "Internet Directory")
                                        echo " selected=\"selected\""; ?>>Internet Directory</option>
                            <option value="Newspaper"<?php if (isset($find_about_us) && $find_about_us == "Newspaper")
                                        echo " selected=\"selected\""; ?>>Newspaper</option>
                            <option value="Radio"<?php if (isset($find_about_us) && $find_about_us == "Radio")
                                        echo " selected=\"selected\""; ?>>Radio</option>
                            <option value="Leaflet"<?php if (isset($find_about_us) && $find_about_us == "Leaflet")
                                        echo " selected=\"selected\""; ?>>Leaflet</option>
                            <option value="Brochure"<?php if (isset($find_about_us) && $find_about_us == "Brochure")
                                        echo " selected=\"selected\""; ?>>Brochure</option>
                            <option value="Business Card"<?php if (isset($find_about_us) && $find_about_us == "Business Card")
                                        echo " selected=\"selected\""; ?>>Business Card</option>
                            <option value="Facebook"<?php if (isset($find_about_us) && $find_about_us == "Facebook")
                                        echo " selected=\"selected\""; ?>>Facebook</option>
                            <option value="Twitter"<?php if (isset($find_about_us) && $find_about_us == "Twitter")
                                        echo " selected=\"selected\""; ?>>Twitter</option>
                            <option value="I have used you before"<?php if (isset($find_about_us) && $find_about_us == "I have used you before")
                                        echo " selected=\"selected\""; ?>>I have used you before</option>
                            <option value="Other"<?php if (isset($find_about_us) && $find_about_us == "Other")
                                        echo " selected=\"selected\""; ?>>Other</option>
                        </select>
					<div id="which_finish_block" style="width: 544px; float: left"></div>
					<div id="find_about_us_block" style="float: right; margin-right: 83px;"></div>
                    </h2>

                </div>
                <div id="many-rooms">
                    <div class="many-rooms-sub1">
                        <br />
                        <span style="font-size:21px;">Room dimensions</span>
                        <h5><span style="display:inline-block; width: 300px;">Are your room measurements in?</span> <span style="color:#FF6819;">Metres</span> <input type="radio" name="room_dimentions" value="metres" checked="checked" class="measurements" /> <span style="color:#FF6819;">Feet</span> <input id="room_dimentions" type="radio" name="room_dimentions" value="feet"<?php if (isset($room_dimentions) && $room_dimentions == "feet")
                                        echo " checked=\"checked\""; ?> class="measurements" /></h5>
                        <h5 style="width: 200px; float: left;">How many rooms? <input type="text" name="rooms_count" value="<?php echo (isset($rooms_count)) ? $rooms_count : ""; ?>" id="rooms_count" class="date-field is<?php echo (isset($rooms_count_show_error)) ? $rooms_count_show_error : ""; ?>" style="text-align: center" /></h5>
						<div id="rooms_count_block" class="franchisee-name-small-error-div" style = "float: left !important; margin-top: 9px;"></div>
						<div id="clear">&nbsp;</div>
						<div id="ul_rooms" style="clear: both;">
                            <?php
                            if (isset($rooms_settings)) {
                                $html = "<ul>";
                                $cnt = count($rooms_settings['room_w']);
                                if ($room_dimentions == "feet") {
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
                                        $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field\" style=\"text-align: center\" />  ";
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
                                        $html .= "<input type=\"text\" name=\"total_sq[" . $i . "]\" id=\"total_sq_" . $i . "\" value=\"" . $rooms_settings['total_sq'][$i] . "\"  class=\"date-field\" style=\"text-align: center\" />  ";
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
                    </div>

                </div>
                <div class="require-services2">
                    <?php
                    if((isset($staining_area) && $staining_area!="") || (isset($lift_removal) && $lift_removal!="") || (isset($gap_filling) && $gap_filling!="") || (isset($gap_filling_w) && $gap_filling_w!="") || (isset($bitumen) && $bitumen!="")) {
                        $extras_op_style = "";
                        $extras_op_st = "";
                    } else {
                        $extras_op_style = 'style="display:none;"';
                        $extras_op_st = "display:none;";
                    }
                    ?>
                    <div style="float:left;position: relative; display: block; overflow-x: hidden; overflow-y: hidden; height: 38px; width: 183px; "><input id="OpExButton" type="button" name="" value="Optional Extras" class="submit" onclick="showOptionalExtas();"></div>
                    <div style="width: 722px;margin-left:10px; margin-top: 11px; float:left;height:38px;<?php echo $extras_op_st; ?>" id="extas_text">
                        <span style="font-size: 1.2em;font-weight: bold;">Please input the room number where you want the 'extas'. Refer to associated room numbers given above.
                        </span>
                    </div>
                    <div id="extas_op" <?php echo $extras_op_style; ?>>          
                        <h2 style="margin-top: 50px;"><span style="position: absolute;"><a id="staining" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/statining"><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a></span>&emsp;<span style="display:inline-block; width: 290px;font-size: 0.9em; margin: 5px 0 0 15px;">Do you require staining?</span> <span style="color:#FF6819;">Yes</span> <input onclick="stainig_on();"id="staining_area" class="staining" type="checkbox" name="staining_area" value="yes" <?php echo (isset($staining_area) && $staining_area != "" && $staining_area != ",") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">No</span> <input onclick="staining_off();"type="checkbox" class="staining" name="staining_area" value="no" <?php echo (isset($staining_area) && $staining_area == "no") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">Not sure</span></h2>
                        <div style="width:100%" id="staining_div" class="extraRoomsDiv" style="float:left;">
                            <?php
                            // если пришли по ссылке обратно изменить заказ, загружаем данные
                            if(isset($staining_area) && $staining_area!="") {
                            ?>
                            <div class="extraRoomsDiv" id="staining_div" style="width:100%; margin-left:0px;">
                                <div style="float:left;">
                                    <span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span>
                                </div>
                                <div style="float:left;" id="st_fields">
                                    <?php
                                    $st_arr = explode(",", $staining_area);
                                    $st_c = 1;
                                    foreach ($st_arr as $st) {
                                        if ("" != $st) {
                                    ?>
                                            <input type="text" name="stainig<?php echo $st_c; ?>" value="<?php echo $st; ?>" class="stainig" onkeyup="staining_change(this)" style="width:23px;">
                                            <input type="button" value="+" onclick="addStainigField()">
                                    <?php
                                        }
                                        $st_c++;
                                    }
                                    ?>
                                </div>
                                <div style="float:left;">
                                    <span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span>
                                    <input type="text" id="total_price_stainig" value="" style="width:50px;">
                                </div>
                                <div style="width:100%;clear:both;"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 style="margin-top: 25px;"><span style="position: absolute;"><a id="liftremova" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/liftremova"><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a></span>&emsp;<span style="display:inline-block; width: 290px;font-size: 0.9em; margin: 5px 0 0 15px;">Do you require carpet lift & removal?</span> <span style="color:#FF6819;">Yes</span> <input onclick="carpet_on();" id="lift_removal" type="checkbox" class="lift_removal" name="lift_removal" value="yes" <?php echo (isset($lift_removal) && $lift_removal != "" && $lift_removal != ",") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">No</span> <input onclick="carpet_off();" type="checkbox" class="lift_removal" name="lift_removal" value="no" <?php echo (isset($lift_removal) && $lift_removal == "no") ? "checked='checked'" : ""; ?> /></h2>
                        <div style="width:100%" id="carpet_div" class="extraRoomsDiv" style="float:left;">
                            <?php
                            // если пришли по ссылке обратно изменить заказ, загружаем данные
                            if(isset($lift_removal) && $lift_removal!="") {
                            ?>
                            <div class="extraRoomsDiv" id="carpet_div" style="width:100%; margin-left:0px;">
                                <div style="float:left;">
                                    <span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span>
                                </div>
                                <div style="float:left;" id="ca_fields">
                                    <?php
                                    $st_arr = explode(",", $lift_removal);
                                    $st_c = 1;
                                    foreach ($st_arr as $st) {
                                        if ("" != $st) {
                                    ?>
                                            <input type="text" name="carpet<?php echo $st_c; ?>" value="<?php echo $st; ?>" class="carpet" onkeyup="carpet_change(this)" style="width:23px;">
                                            <input type="button" value="+" onclick="addCarpetField()">
                                    <?php
                                        }
                                        $st_c++;
                                    }
                                    ?>
                                </div>
                                <div style="float:left;">
                                    <span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span>
                                    <input type="text" id="total_price_carpet" value="" style="width:50px;">
                                </div>
                                <div style="width:100%;clear:both;"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 style="margin-top: 25px;"><span style="position: absolute;"><a id="gapfilling" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/gapfilling"><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a></span>&emsp;<span style="display:inline-block; width: 290px;font-size: 0.9em; margin: 5px 0 0 15px;">Do you require resin(narrow) gap filling?</span> <span style="color:#FF6819;">Yes</span> <input onclick="resin_on();" id="gap_filling" type="checkbox" class="gap_filling" name="gap_filling" value="yes" <?php echo (isset($gap_filling) && $gap_filling != "" && $gap_filling != ",") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">No</span> <input onclick="resin_off();" type="checkbox" class="gap_filling" name="gap_filling" value="no" <?php echo (isset($gap_filling) && $gap_filling == "no") ? "checked='checked'" : ""; ?> />  </h2>
                        <div style="width:100%" id="resin_gap" class="extraRoomsDiv" style="float:left;">
                            <?php
                            // если пришли по ссылке обратно изменить заказ, загружаем данные
                            if(isset($gap_filling) && $gap_filling!="") {
                            ?>
                            <div class="extraRoomsDiv" id="resin_div" style="width:100%; margin-left:0px;">
                                <div style="float:left;">
                                    <span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span>
                                </div>
                                <div style="float:left;" id="re_fields">
                                    <?php
                                    $st_arr = explode(",", $gap_filling);
                                    $st_c = 1;
                                    foreach ($st_arr as $st) {
                                        if ("" != $st) {
                                    ?>
                                            <input type="text" name="resin<?php echo $st_c; ?>" value="<?php echo $st; ?>" class="resin" onkeyup="resin_change(this)" style="width:23px;">
                                            <input type="button" value="+" onclick="addResinField()">
                                    <?php
                                        }
                                        $st_c++;
                                    }
                                    ?>
                                </div>
                                <div style="float:left;">
                                    <span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span>
                                    <input type="text" id="total_price_resin" value="" style="width:50px;">
                                </div>
                                <div style="width:100%;clear:both;"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 style="margin-top: 25px;"><span style="position: absolute;"><a id="widegapfil" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/widegapfil"><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a></span>&emsp;<span style="display:inline-block; width: 290px;font-size: 0.9em; margin: 5px 0 0 15px;">Do you require wood(wide) gap filling?</span> <span style="color:#FF6819;">Yes</span> <input onclick="wood_on();" id="gap_filling_w" type="checkbox" class="gap_filling_w" name="gap_filling_w" value="yes" <?php  echo (isset($gap_filling_w) && $gap_filling_w != "" && $gap_filling_w != ",") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">No</span> <input onclick="wood_off();" type="checkbox" class="gap_filling_w" name="gap_filling_w" value="no" <?php echo (isset($gap_filling) && $gap_filling == "no") ? "checked='checked'" : ""; ?> />  </h2>
                        <div style="width:100%" id="wood_gap" class="extraRoomsDiv" style="float:left;">
                            <?php
                            // если пришли по ссылке обратно изменить заказ, загружаем данные
                            if(isset($gap_filling_w) && $gap_filling_w!="") {
                            ?>
                            <div class="extraRoomsDiv" id="wood_div" style="width:100%; margin-left:0px;">
                                <div style="float:left;">
                                    <span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span>
                                </div>
                                <div style="float:left;" id="wo_fields">
                                    <?php
                                    $st_arr = explode(",", $gap_filling_w);
                                    $st_c = 1;
                                    foreach ($st_arr as $st) {
                                        if ("" != $st) {
                                    ?>
                                            <input type="text" name="wood<?php echo $st_c; ?>" value="<?php echo $st; ?>" class="wood" onkeyup="wood_change(this)" style="width:23px;">
                                            <input type="button" value="+" onclick="addWoodField()">
                                    <?php
                                        }
                                        $st_c++;
                                    }
                                    ?>
                                </div>
                                <div style="float:left;">
                                    <span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span>
                                    <input type="text" id="total_price_wood" value="" style="width:50px;">
                                </div>
                                <div style="width:100%;clear:both;"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 style="margin-top: 25px;"><span style="position: absolute;"><a id="bitumenbb" class="fancy" href="<?php echo URL::base(); ?>online-quotation/info/bitumenbb"><img style=""width="25px" height="25px" src="/images/i-prod.jpg" alt="" style="float: left;"></a></span>&emsp;<span style="display:inline-block; font-size: 0.9em; margin: 5px 0 0 15px;">Is there any black/brown bitumen or paint on your floor (if present, this is usually around the perimeters of the room)</span><br/><span style="margin: 0 0 0 325px;"><span style="color:#FF6819;">Yes</span> <input id="bitumen" type="checkbox" onclick="bitumen_on();" class="bit" name="bitumen" value="yes" <?php echo (isset($bitumen) && $bitumen != "" && $bitumen != "none" && $bitumen != ",") ? "checked='checked'" : ""; ?> /> <span style="color:#FF6819;">No</span> <input type="checkbox" onclick="bitumen_off();" class="bit" name="bitumen" value="no" <?php echo (isset($bitumen) && $bitumen == "no") ? "checked='checked'" : ""; ?> /></span></h2>
                        <div style="width:100%" id="bitumen_div" class="extraRoomsDiv" style="float:left;">
                            <?php
                            // если пришли по ссылке обратно изменить заказ, загружаем данные
                            if(isset($bitumen) && $bitumen!="") {
                            ?>
                            <div class="extraRoomsDiv" id="bitumen_div" style="width:100%; margin-left:0px;">
                                <div style="float:left;">
                                    <span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span>
                                </div>
                                <div style="float:left;" id="bi_fields">
                                    <?php
                                    $st_arr = explode(",", $bitumen);
                                    $st_c = 1;
                                    foreach ($st_arr as $st) {
                                        if ("" != $st) {
                                    ?>
                                            <input type="text" name="bitumen<?php echo $st_c; ?>" value="<?php echo $st; ?>" class="bitumen" onkeyup="bitumen_change(this)" style="width:23px;">
                                            <input type="button" value="+" onclick="addBitumenField()">
                                    <?php
                                        }
                                        $st_c++;
                                    }
                                    ?>
                                </div>
                                <div style="float:left;">
                                    <span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span>
                                    <input type="text" id="total_price_bitumen" value="" style="width:50px;">
                                </div>
                                <div style="width:100%;clear:both;"></div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h2><div class="clear"></div></h2>
                    </div>
                </div>
                <div id="next-availaty" style="margin-top: 10px;">
                    <div style="clear:both;">
                        <input id="uploadButton" type="button" name="" value="ATTACH PHOTO" class="submit" onclick="attachPhoto();"  /><br />(Optional - You can upload up to 6 photos)
                        <div class="clear"></div>
                        <div id="photos_block_error"></div>
                        <div class="clear"></div>
                        <div style="margin: 15px 0;" id="photos_block"></div>
                        <div class="clear"></div>
                    </div>
                    <input type="hidden" id="further_option_1" name="further_option_1" value="<?php echo $further_option_1; ?>" />
                    <input type="hidden" id="further_option_2" name="further_option_2" value="<?php echo $further_option_2; ?>" />
                    <?php if (isset($is_date)): ?>
                        <ul style="text-align: center;">
                            <li>Next date available to do the work</li>
                            <li>
                                <input type="text" value="<?php echo $dd; ?>" class="date-field" disabled="disabled" style="text-align:center;" />
                                <input type="hidden" name="day" value="<?php echo $dd; ?>" />
                            </li>
                            <li>
                                <input type="text" value="<?php echo $mm; ?>" class="date-field" disabled="disabled" style="text-align:center;" />
                                <input type="hidden" name="month" value="<?php echo $mm; ?>" />
                            </li>
                            <li>
                                <input type="text" value="<?php echo $yy; ?>" class="date-field1" disabled="disabled" style="text-align:center;" />
                                <input type="hidden" name="year" value="<?php echo $yy; ?>" />
                            </li>
                            <li><strong>dd/mm/year</strong></li>
                        </ul>
                        <input type="hidden" id="is_date" value="yes" />
                        <div style="clear:both;"><br/></div>
                    <?php endif; ?>
                    <center><input type="button" name="" value="CALCULATE MY PRICE NOW!" class="submit" onclick="calculatePrice();" /></center>
                                    <!--<center><input style="margin-top: 10px;" type="button" name="" value="CHECK DATES AVAILABLE NOW!" class="submit" onclick="showSubmitForm();" /></center>-->
                </div>

                <div style="margin: 20px 0;display:none;" id="options">
                    <div style="margin: 20px 0;">
                        <h2 style="font-size: 2.5em; text-align: center;">Now simply select one of the 2 options below to make your booking</h2>
                    </div>
                    <div style="float: left; width: 49%; margin-right: 1%;">
                        <div style="padding: 10px; border: 1px solid #fff; height: 246px; position: relative;">
                            <h2 style="color: #FF6819; font-size: 3em;"><span style="color:#fff">Option 1</span> - Payment on completion of works</h2><br/>
                            <h2 style="text-transform: uppercase; color: #fff; font-size:2.2em">Total price for job</h2><h2 style="font-size: 3em">&pound; <span id="total_price_for_job"><?php if (isset($total_price_for_job))
                        echo $total_price_for_job; ?></span></h2>
                            <input type="hidden" name="total_price_for_job" id="tpfj" value="<?php if (isset($total_price_for_job))
                                        echo $total_price_for_job; ?>" />
                            <p>Deposit required (5%): <span id="deposit_required" style="font-size:18px;"><?php if (isset($deposit_required))
                                       echo $deposit_required; ?></span></p>
                            <input type="hidden" name="deposit_required" id="dr" value="<?php if (isset($deposit_required))
                                        echo $deposit_required; ?>" />
                            <div id="promocode1" style="display: none;">
                                <p>Promo-code (<font id="percent-promocode"></font>%): <span id="sale_summ" style="font-size:18px;"><?php if (isset($sale_summ))
                                            echo $sale_summ;
?></span></p>
                                <input type="hidden" name="code1" id="ss" value="<?php if (isset($sale_summ))
                                            echo $sale_summ;
?>" />
                            </div>
                            <div >
                                <input  style="margin-top: 5px;" type="button" class="submit promo1" value='CHECK AVAILABLE DATES'  onclick="submitForm(0);"/>
                            </div>
                        </div>
                    </div>
                    <div style="float: left; width: 50%">
                        <div style="padding: 10px; border: 1px solid #fff; height: 246px; position: relative;">
                            <h2 style="color: #FF6819; font-size: 3em;"><span style="color:#fff">Option 2</span> - Full online pre-payment</h2><br/>
                            <h2 style="text-transform: uppercase; color: #fff; font-size:2.2em">Total price for job</h2>
                            <h2 style="font-size: 3em">&pound; <span id="total_price_for_job2"><?php if (isset($total_price_for_job2))
                                       echo $total_price_for_job2; ?></span></h2>
                            <input type="hidden" name="total_price_for_job2" id="tpfj2" value="<?php if (isset($total_price_for_job2))
                                        echo $total_price_for_job2; ?>" />
                            <p style="margin-top:7px;">Full Online Pre-payment (10% Discount)</p>
                            <div id="promocode2" style="display:none">
                                <p>Promo-code (<font id="percent-promocode-1"></font>%): <span id="sale_summ-1" style="font-size:18px;"><?php if (isset($sale_summ_pp))
                                            echo $sale_summ_pp;
?></span></p>
                                <input type="hidden" name="sale_summ" id="ss-pp" value="<?php if (isset($sale_summ_pp))
                                            echo $sale_summ_pp;
?>" />
                            </div>
                            <div >
                                <input type="button" class="submit promo1" value='CHECK AVAILABLE DATES' style="margin-top: 6px;" onclick="submitForm(1);" />
                            </div>
                        </div>
                        <!--div id="card-main">
                        <ul>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card1.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card2.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card3.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card4.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card5.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/hsbc1.gif" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/american-express.jpg" alt="" height="38" /></li>
                        </ul>
                        </div-->
                    </div>
                    <div style="padding-top: 270px; width: 100%;">
                        To ensure the validity of our online bookings and to eliminate
                        spam, we require a deposit payment of 5% of the total job price. 
                        This amount is deducted from your final payment.  This amount
                        is refundable in the event of cancellation, provided we are
                        notified of your cancellation no later than 7 days prior to your
                        booking date.</div>
                </div>
                <!--div id="total-price">
                        <h1>TOTAL PRICE FOR JOB</h1>
                        <p><strong>£</strong><input type="text" name="total_price_for_job" id="total_price_for_job" value="<?php if (isset($total_price_for_job))
                                       echo $total_price_for_job; ?>" class="field-bg" style="padding-left: 10px;color:#FA5827; font-size: 18px; font-weight: bold" /></p>
                        <p class="terms">The above price is for standard services. Any other bespoke services will have to priced for separately.  
                        </p>
                        <input type="hidden" name="goto_checkout" id="goto_checkout" value="0" />
                    </div-->
                <!--div id="booking-main1">
                    <div id="booking-mainsub1">
                        <ul>
                            <li><input type="button" value="MAKE BOOKING" onclick="submitForm(0);" class="booking" /></li>
                            <li><input type="button" value="GO TO CHECKOUT" onclick="submitForm(1);" class="booking1" /></li>
                        </ul>
                        <p>Online Pre-payment receive a 10% Discount</p>
                    </div>
                    <div id="card-main">
                        <ul>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card1.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card2.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card3.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card4.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card5.jpg" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/hsbc1.gif" alt="" height="38" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/american-express.jpg" alt="" height="38" /></li>
                        </ul>
                    </div>
                    
                </div-->

                <div id="is_date_not"></div>
            </div>
        </div>
    </form>
    <!--End containt area holder -->
</div>
<div id="modal_block_hidden"></div>
<div id="modal_block"></div>
<?php $settings = ORM::factory('settings')->where('short_name', '=', 'fs_wood_price')->find(); ?>
<input style="display:none;" id="fs_wood_price" value="<?php print($settings->value); ?>">
<?php $settings = ORM::factory('settings')->where('short_name', '=', 'fs_carpet_removal')->find(); ?>
<input style="display:none;" id="fs_carpet_removal" value="<?php print($settings->value); ?>">
<?php $settings = ORM::factory('settings')->where('short_name', '=', 'fs_resin_price')->find(); ?>
<input style="display:none;" id="fs_resin_price" value="<?php print($settings->value); ?>">
<?php $settings = ORM::factory('settings')->where('short_name', '=', 'fs_bitumen_removal')->find(); ?>
<input style="display:none;" id="fs_bitumen_price" value="<?php print($settings->value); ?>">
