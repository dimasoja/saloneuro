<script type="text/javascript">
<?php
foreach ($settings as $key => $val) {
    echo "var " . $key . ' = ' . $val . ";\n";
}
echo "var fs_max_count_rooms = " . $settings2['fs_max_count_rooms'] . ";\n";
?>
    jQuery(document).ready(function() {
        jQuery("#discounts-info").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#daily").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#buff").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true,
            'type'              : 'ajax'
        });
        jQuery("#deep").fancybox({
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
    <form id="maintenance_form" method="post" action="<?php echo URL::base(); ?>online-maintenance">
        <input type="hidden" id="goto_checkout" name="goto_checkout" value="0" />
        <input id="id_maintenance" type="hidden" name="id_maintenance" value="0" />
        <!--containt area holder -->
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <!--h1>Maintenance Contract</h1>
                <?php echo ViewMessage::renderMessages(); ?>
                <h3>Keep your wooden floor in perfect condition for years to come</h3>
                <div id="personal-info">
                    <ul>
                        <li>
                            <input id="name" type="text" name="name" value="<?php echo (isset($name)) ? $name : "First Name"; ?>" class="franchisee-name<?php if (isset($name_show_error))
                    echo $name_show_error; ?>" onfocus="if(this.value=='First Name'){this.value=''};" onblur="if(this.value==''){this.value='First Name'};" />
                            <div id="name_block">
                <?php if (isset($name_error) && '' != $name_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $name_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="surname" type="text" name="surname" value="<?php echo (isset($surname)) ? $surname : "Last Name"; ?>" class="franchisee-name<?php if (isset($surname_show_error))
                    echo $surname_show_error; ?>" onfocus="if(this.value=='Last Name'){this.value=''};" onblur="if(this.value==''){this.value='Last Name'};" />
                            <div id="surname_block">
                <?php if (isset($surname_error) && '' != $surname_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $surname_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="email" type="text" name="email" value="<?php echo (isset($email)) ? $email : "Email"; ?>" class="franchisee-name<?php if (isset($email_show_error))
                    echo $email_show_error; ?>" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" />
                            <div id="email_block">
                <?php if (isset($email_error) && '' != $email_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $email_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="address" type="text" name="address" value="<?php echo (isset($address)) ? $address : "Address"; ?>" class="franchisee-name<?php if (isset($address_show_error))
                    echo $address_show_error; ?>" onfocus="if(this.value=='Address'){this.value=''};" onblur="if(this.value==''){this.value='Address'};" />
                            <div id="address_block">
                <?php if (isset($address_error) && '' != $address_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $address_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="town" type="text" name="town" value="<?php echo (isset($town)) ? $town : "Town"; ?>" class="franchisee-name<?php if (isset($town_show_error))
                    echo $town_show_error; ?>" onfocus="if(this.value=='Town'){this.value=''};" onblur="if(this.value==''){this.value='Town'};" />
                            <div id="town_block">
                <?php if (isset($town_error) && '' != $town_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $town_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="postcode" type="text" name="postcode" value="<?php echo (isset($postcode)) ? $postcode : "Postcode"; ?>" class="franchisee-name<?php if (isset($postcode_show_error))
                    echo $postcode_show_error; ?>" onfocus="if(this.value=='Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Postcode'};" />
                            <div id="postcode_block">
                <?php if (isset($postcode_error) && '' != $postcode_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $postcode_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="phone" type="text" name="phone" value="<?php echo (isset($phone)) ? $phone : "Telephone number"; ?>" class="franchisee-name<?php if (isset($phone_show_error))
                    echo $phone_show_error; ?>" onfocus="if(this.value=='Telephone number'){this.value=''};" onblur="if(this.value==''){this.value='Telephone number'};" />
                            <div id="phone_block">
                <?php if (isset($phone_error) && '' != $phone_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $phone_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <input id="mphone" type="text" name="mphone" value="<?php echo (isset($mphone)) ? $mphone : "Mobile number"; ?>" class="franchisee-name<?php if (isset($mphone_show_error))
                    echo $mphone_show_error; ?>" onfocus="if(this.value=='Mobile number'){this.value=''};" onblur="if(this.value==''){this.value='Mobile number'};" />
                            <div id="mphone_block">
                <?php if (isset($mphone_error) && '' != $mphone_error): ?>
                                        <div style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">
                    <?php echo $mphone_error; ?>
                                        </div>
                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div style="float: right; margin-top: 5px; width: 50%;">
                    <div>
                        <ul style="list-style-type:none">
                            <li class="fontsize18">Please give address of site where work is to take place, if different from contact address</li>
                            <li><input id="alternative_address" type="text" name="alternative_address" value="<?php echo (isset($alternative_address)) ? $alternative_address : "Alternative Address"; ?>" class="franchisee-name<?php if (isset($alternative_address_show_error))
                    echo $alternative_address_show_error; ?>" onfocus="if(this.value=='Alternative Address'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Address'};" /></li>
                            <li><input id="alternative_town" type="text" name="alternative_town" value="<?php echo (isset($alternative_town)) ? $alternative_town : "Alternative Town"; ?>" class="franchisee-name<?php if (isset($alternative_town_show_error))
                    echo $alternative_town_show_error; ?>" onfocus="if(this.value=='Alternative Town'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Town'};" /></li>
                            <li><input id="alternative_postcode" type="text" name="alternative_postcode" value="<?php echo (isset($alternative_postcode)) ? $alternative_postcode : "Alternative Postcode"; ?>" class="franchisee-name<?php if (isset($alternative_postcode_show_error))
                    echo $alternative_postcode_show_error; ?>" onfocus="if(this.value=='Alternative Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Alternative Postcode'};" /></li>
                        </ul>
                    </div>
                    <div class="discounts-container">
                        <h3>Discounts for larger areas</h3>
                        <h4>The following discounts are awarded for large areas:-</h4>
                        <h5>100sq metres+ 10%<br/>
                        200sq metres+ 20%<br/>
                        300sq metres+ 30%<br/>
                        500sq metres+ 50%</h5>
                    </div>
                </div><br/><br/-->
                <h1>Maintenance Contract</h1>
                <div id="personal-info" style="width:55%">
                    <span style="font-size:17px;">Keep your wooden floor in perfect condition for years to come</span>
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
                <div style="float: right; margin-top: 40px;width: 45%;">
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
                    <a id="discounts-info" class="fancybox discounts-link" href="<?php echo URL::base(); ?>online-maintenance/info/discounts"><img src="<?php echo URL::base(); ?>images/discounts.jpg" alt="" style="margin-top: 15px;" /></a>
                </div>
                <div class="clear"></div>
                <div class="require-services">
                    <h2>What service do you require? Please tick appropriate.</h2>
                    <p style="margin-top:5px;">
                        <span style="display: inline-block; width: 220px; font-size: 14.85px; font-weight: 700;">Daily Clean</span> Daily <input type="checkbox" name="daily_clean" value="daily" class="radio_price1" rel="365"<?php echo (isset($daily_clean) && $daily_clean == "daily") ? " checked='checked'" : ""; ?> /> Monthly <input type="checkbox" name="daily_clean" value="monthly" class="radio_price1" rel="12"<?php echo (isset($daily_clean) && $daily_clean == "monthly") ? " checked='checked'" : ""; ?> /> Quarterly <input type="checkbox" name="daily_clean" value="quarterly" class="radio_price1" rel="4"<?php echo (isset($daily_clean) && $daily_clean == "quarterly") ? " checked='checked'" : ""; ?> />
                    </p>
                    <div style="margin-top: 7px; margin-bottom: 8px; overflow: auto;">
                        <a id="daily" class="fancy" href="<?php echo URL::base(); ?>online-maintenance/info/daily"><img src="<?php echo URL::base(); ?>images/i-prod.jpg" alt="" width="25px" height="25px" style="float: left;" /></a>
                        <div style="display: inline-block; padding-left: 5px; padding-top: 10px;">Please click for more info on this service</div>
                    </div>
                    <div class="clear"></div>
                    <p>
                        <span style="display: inline-block; width: 220px;font-size: 14.85px; font-weight: 700;">Deep Cleaning & Protector</span> Daily <input type="checkbox" name="deep_clean" value="daily" class="radio_price2" rel="365"<?php echo (isset($deep_clean) && $deep_clean == "daily") ? " checked='checked'" : ""; ?> /> Monthly <input type="checkbox" name="deep_clean" value="monthly" class="radio_price2" rel="12"<?php echo (isset($deep_clean) && $deep_clean == "monthly") ? " checked='checked'" : ""; ?> /> Quarterly <input type="checkbox" name="deep_clean" value="quarterly" class="radio_price2" rel="4"<?php echo (isset($deep_clean) && $deep_clean == "quarterly") ? " checked='checked'" : ""; ?> />
                    </p>
                    <div style="margin-top: 7px; overflow: auto;">
                        <a id="deep" class="fancy" href="<?php echo URL::base(); ?>online-maintenance/info/deep"><img src="<?php echo URL::base(); ?>images/i-prod.jpg" alt="" width="25px" height="25px" style="float: left;" /></a>
                        <div style="display: inline-block; padding-left: 5px; padding-top: 10px;">Please click for more info on this service</div>
                    </div>
                </div>
                <div class="require-services" style="border-top:none;margin: 0px;">
                    <h2>Buff ‘n’ Coat – please indicate how often you require this service to be carried out.</h2>
                    <ul class="buff">
                        <li>Daily <input type="checkbox" value="daily" name="buff_n_coat" class="radio_price3" rel="365"<?php echo (isset($buff_n_coat) && $buff_n_coat == "daily") ? " checked='checked'" : ""; ?> /></li>
                        <li>Weekly <input type="checkbox" value="weekly" name="buff_n_coat" class="radio_price3" rel="52"<?php echo (isset($buff_n_coat) && $buff_n_coat == "weekly") ? " checked='checked'" : ""; ?> /></li>
                        <li>Monthly <input type="checkbox" value="monthly" name="buff_n_coat" class="radio_price3" rel="12"<?php echo (isset($buff_n_coat) && $buff_n_coat == "monthly") ? " checked='checked'" : ""; ?> /></li>
                        <li>Quarterly  <input type="checkbox" value="quarterly" name="buff_n_coat" class="radio_price3" rel="4"<?php echo (isset($buff_n_coat) && $buff_n_coat == "quarterly") ? " checked='checked'" : ""; ?> /></li>
                        <li>6 Monthly <input type="checkbox" value="6 monthly" name="buff_n_coat" class="radio_price3" rel="2"<?php echo (isset($buff_n_coat) && $buff_n_coat == "6 monthly") ? " checked='checked'" : ""; ?> /></li>
                        <li>Annually <input type="checkbox" value="annually" name="buff_n_coat" class="radio_price3" rel="1"<?php echo (isset($buff_n_coat) && $buff_n_coat == "annually") ? " checked='checked'" : ""; ?> /></li>
                        <li>3 Yearly <input type="checkbox" value="3 yearly" name="buff_n_coat" class="radio_price3" rel="1"<?php echo (isset($buff_n_coat) && $buff_n_coat == "3 yearly") ? " checked='checked'" : ""; ?> /></li>
                        <li>5 Yearly <input type="checkbox" value="5 yearly" name="buff_n_coat" class="radio_price3" rel="1"<?php echo (isset($buff_n_coat) && $buff_n_coat == "5 yearly") ? " checked='checked'" : ""; ?> /></li>
                    </ul>
                    <div class="clear"></div>
                    <div style="margin-top: 7px; overflow: auto;">
                        <a id="buff" class="fancy" href="<?php echo URL::base(); ?>online-maintenance/info/buff"><img src="<?php echo URL::base(); ?>images/i-prod.jpg" alt="" width="25px" height="25px" style="float: left;" /></a>
                        <div style="display: inline-block; padding-left: 5px; padding-top: 10px;">Please click for more info on this service</div>
                    </div>
                </div>
                <div class="require-services" style="border-top:none;margin: 0px;">
                    <h2>Type of floor.</h2>
                    <ul class="buff">
                        <li>Floorboards <input type="radio" value="floorboards" name="type_of_floor"<?php echo (!isset($type_of_floor) || $type_of_floor == "floorboards") ? " checked='checked'" : ""; ?> /></li>
                        <li>Parquet <input type="radio" value="parquet" name="type_of_floor"<?php echo (isset($type_of_floor) && $type_of_floor == "parquet") ? " checked='checked'" : ""; ?> /></li>
                        <li>Engineered <input type="radio" value="engineered" name="type_of_floor"<?php echo (isset($type_of_floor) && $type_of_floor == "engineered") ? " checked='checked'" : ""; ?> /></li>
                        <li>Other  <input id="other_radio" type="radio" value="other" name="type_of_floor"<?php echo (isset($type_of_floor) && $type_of_floor == "other") ? " checked='checked'" : ""; ?> /></li>
                        <li id="other_text" <?php echo (!isset($type_of_floor) || $type_of_floor != "other") ? "style='display:none;'" : ""; ?>><input type="text" name="type_of_floor_other" value="<?php if (isset($type_of_floor_other))
                                       echo $type_of_floor_other; ?>" class="meter-field" maxlength="20" /></li>
                    </ul>
                    <div class="clear"></div>
                    <h2>
                        <span style="display:inline-block; width: 250px;">How did you find out about us?</span>
                        <select name="find_about_us">
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
                    </h2>
                </div>
                <div class="require-services" style="border-top:none;margin: 0px;">
                    <h2>Please indicate your preferred day of the week for works to take place.</h2>
                    <ul class="buff">
                        <li>Monday <input type="checkbox" value="Monday" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "Monday") ? " checked='checked'" : ""; ?> /></li>
                        <li>Tuesday <input type="checkbox" value="Tuesday" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "Tuesday") ? " checked='checked'" : ""; ?> /></li>
                        <li>Wednesday <input type="checkbox" value="Wednesday" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "Wednesday") ? " checked='checked'" : ""; ?> /></li>
                        <li>Thursday <input type="checkbox" value="Thursday" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "Thursday") ? " checked='checked'" : ""; ?> /></li>
                        <li>Friday <input type="checkbox" value="Friday" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "Friday") ? " checked='checked'" : ""; ?> /></li>
                        <li>(Weekend/out of hours work by request only) <input type="checkbox" value="(Weekend/out of hours work by request only)" name="day_of_week"<?php echo (isset($day_of_week) && $day_of_week == "(Weekend/out of hours work by request only)") ? " checked='checked'" : ""; ?> /></li>
                    </ul>
                    <div class="clear"></div>
                    <div style="text-align: right; margin-top: 5px;">We will confirm your actual booking dates via email upon receipt of your booking.</div>
                </div>
                <div class="require-services require-services-bor-none" style="border-top:none;margin: 0px;">
                    <div class="many-rooms-sub1">
                        <h2 style="color: #fff !important; font-size: 1.5em !important;">Room dimensions</h2>
                        <h5>
                            <span style="display:inline-block; width: 250px;">Are your room measurements in?</span>
                            <span style="color:#fff;">Metres</span>
                            <input class="measurements" type="radio" checked="checked" value="metres" name="room_dimentions">
                            <span style="color:#fff;">Feet</span>
                            <input id="room_dimentions" class="measurements" type="radio" value="feet" name="room_dimentions"<?php if (isset($room_dimentions) && $room_dimentions == "feet")
                                        echo " checked=\"checked\""; ?>>
                        </h5>
                        <h5>How many rooms? <input id="rooms_count" type="text" name="rooms_count" value="<?php echo (isset($rooms_count)) ? $rooms_count : ""; ?>" id="rooms_count" class="date-field is<?php echo (isset($rooms_count_show_error)) ? $rooms_count_show_error : ""; ?>" style="text-align: center" /></h5>
                        <div id="ul_rooms">
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
                    <ul class="room">
                        <li class="width">TOTAL ANNUAL PRICE FOR WORK</li>
                        <li class="width2">£</li>
                        <li><input id="total_price_for_job" type="text" value="<?php if (isset($total_price_for_job))
                                echo $total_price_for_job; ?>" name="total_price_for_job" class="meter-field1"  /></li>
                    </ul>
                    <br />
                    <center>
                        <input class="submit" type="button" onclick="calculatePrice();" value="CALCULATE MY PRICE NOW!" name="">
                    </center>
                </div>
                <div class="require-services">
                    <br/>
                    <div style="clear:both;">
                        <input id="uploadButton" type="button" name="" value="ATTACH PHOTO" class="submit"  /><br />(Optional - You can upload up to 6 photos)
                        <div class="clear"></div>
                        <div id="photos_block_error"></div>
                        <div class="clear"></div>
                        <div style="margin: 15px 0;" id="photos_block"></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div id="easy-payment-main">
                    <div class="payment-option">
                        <h1>3 Easy payment Options</h1>
                        <h4>OPTION 1: UPFRONT FULL ANNUAL PAYMENT</h4>
                        <p>
                            This option provides a 20% discount and free callout for deep dent and scratch fill, along with rubber mark removal &amp; Disaster Spillage Recovery Service (inc materials).
                        </p>
                        <ul>
                            <li class="width">Total amount payable =</li>
                            <li><input type="text" id="option_1" name="option_1" value="<?php if (isset($option_1))
                                       echo $option_1; ?>" class="meter-field" /></li>
                            <li class="width-new">+ VAT (payable on receipt of this order)</li>
                            <li class="width-1">That equates to an annual saving of</li>
                            <li><input type="text" id="option_1_saving" name="option_1_saving" value="<?php if (isset($option_1_saving))
                                           echo $option_1_saving; ?>" class="meter-field" /></li>
                            <li class="width-new">+ VAT per year</li>
                            <li><input type="button" name="" value="MAKE BOOKING" class="button" onclick="submitForm(1);" /></li>
                        </ul>
                    </div>
                    <div class="payment-option"><br />
                        <h4>OPTION 2: CREDIT/DEBIT CARD MONTHLY PAYMENT (each monthly payment is charged in advance)</h4>
                        <p>
                            This option provides free callout for deep dent and scratch fill, along with rubber mark removal (inc materials, max 6 callouts per year).
                        </p>
                        <ul>
                            <li class="width-1">Amount payable = </li>
                            <li><input type="text" name="option_2" id="option_2" value="<?php if (isset($option_2))
                                           echo $option_2; ?>" class="meter-field" /></li>
                            <li class="width-new">+ VAT per month (This amount will be debited from this card each month)</li>
                            <li><input type="button" name="" value="MAKE BOOKING" class="button" onclick="submitForm(2);" /></li>
                        </ul>
                    </div>
                    <div class="payment-option"><br />
                        <h4>OPTION 3: BILL AND PAYMENT ON EACH VISIT - AT PRICES SHOWN ABOVE</h4>
                        <p>
                            With this option, callouts for dent and scratch fill will be charged on an individual basis.
                        </p>
                        <ul>
                            <li class="width-1">Amount payable = </li>
                            <li><input type="text" name="option_3" id="option_3" value="<?php if (isset($option_3))
                                           echo $option_3; ?>" class="meter-field" /></li>
                            <li class="width-new">+ VAT on each visit</li>
                            <li><input type="button" name="" value="SUBMIT" class="button" onclick="submitForm(0);" /></li>
                        </ul>
                    </div>
                    <div id="customer-terms">
                        <p id="terms_and_conditions_p">
                            When signing this contract, you agree the the Company’s Customer Terms & Conditions. I agree, understand and accept the <a style="color: #fff !important;text-decoration:underline;" href="<?php echo URL::base(); ?>customer-terms-and-conditions">Terms & Conditions</a> (please tick) 
                            <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" value="yes" <?php if (isset($terms_and_conditions) && $terms_and_conditions == "yes")
                                           echo "checked='checked'"; ?> />
                        </p>
                        <p>
                            Your actual booking dates will be confirmed to you by email, fax or post.  Allow 2-3 days for this 
                            information, however we do try to send you this information within 1 working day. Please ensure that 
                            we have access to enter the property on this date or arrange for keys to be made 
                            available to enter and carry out works.
                        </p>
                        <p>
                            We accept all major credit and debit cards. Please advise us of your preferred option.<br />
                            If you have any queries or would like any further information, please do not hesitate to contact 
                            me on 01625 582567.
                        </p>
                        <div id="lucky-wilkinson"> 
                            Yours sincerely,
                            <img src="<?php echo URL::base(); ?>images/wilkinson-img.jpg" alt="" />
                            Lucy Wilkinson - Head of Finance
                        </div>
                        <div id="visa-main">
                            <ul>
                                <li><img src="<?php echo URL::base(); ?>images/visa-img1.jpg" alt="" height="38" /></li>
                                <li><img src="<?php echo URL::base(); ?>images/visa-img2.jpg" alt="" height="38" /></li>
                                <li><img src="<?php echo URL::base(); ?>images/mastro-img.jpg" alt="" height="38" /></li>
                                <li><img src="<?php echo URL::base(); ?>images/mastro-img1.jpg" alt="" height="38" /></li>
                                <li><img src="<?php echo URL::base(); ?>images/solo-img.jpg" alt="" height="38" /></li>
                                <li><img src="<?php echo URL::base(); ?>images/american-express.jpg" alt="" height="38" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--End containt area holder -->
</div>