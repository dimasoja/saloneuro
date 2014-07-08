<script type="text/javascript">
    jQuery('#progress_bar').attr("src","/images/quote_progress_step3.png");	
    jQuery('#progress_bar').css('height', '');
    window.onbeforeunload = function() {
        return 'Do you really want to leave/refresh Online Quotation page? All the info would be lost!';
    }
    function cancelEvent(ev){
        window[ev]=function(){null}
    }
</script>
<div id="inside_container">
    <!--containt area holder -->
    <form method="post" id="quotation_form" action="<?php echo URL::base(); ?>online-quotation" enctype="multipart/form-data">
        <input id="id_quotation" type="hidden" name="id_quotation" value="0" />
        <input type="hidden" name="goto_checkout" id="goto_checkout" value="0" />
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <h1 style="margin-top: 70px; font-size: 40px;">Review your order</h1>



                <h3 style="font-size: 26px; font-weight: normal;font-family:Arial;">Please review details of your order below.<br/>
                    Then click 'NEXT' button to make your booking.</h3><br/><br/><br/><br/>
                <h3 style="margin-top: 30px; font-size: 20px; font-weight: normal;font-family:Arial;">The details of your order are:</h3>
                <table  class="order_table" >
                    <tbody>	
                        <tr class="s_tr" style="height: 35px;">
                            <td colspan=3>
                                <span class="col_name" style="padding:10px;font-size:18px">Sanding & Varnishing description:</span>
                            </td>
                        </tr>
                        <tr class="b_tr">
                            <td align="center">
                                <span class="col_name">Room</span>
                            </td>
                            <td>
                                <span class="col_name">Dimensions</span>
                            </td>
                            <td align="center" width="20%">
                                <span class="col_name">Price</span>
                            </td>
                        </tr>
                        <?php
                        $rooms_settings = unserialize($rooms_settings);
                        $count = count($rooms_settings['room_w']);
                        $subtotal = 0;
                        for ($i = 1; $i <= $count; $i++) {
                            $subtotal += $rooms_settings['price'][$i];
                            ?>
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content"><?php print($i); ?></span>
                                </td>
                                <td>
                                    <span class="table_content"><?php print(number_format($rooms_settings['room_w'][$i], 2)); ?>m x <?php print(number_format($rooms_settings['room_l'][$i], 2)); ?>m = <?php print($rooms_settings['total_sq'][$i]); ?> sq. m</span>
                                </td>
                                <td  align="center">
                                    <span class="table_content"><?php print($rooms_settings['price'][$i]); ?></span>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        <tr class="s_tr">
                            <td colspan="2"></td>
                            <td rowspan=2 class="table_content" style="font-size: 20px; background-color: #515254;" align="center">£<? print(number_format($subtotal, 2)); ?></td>
                        </tr>
                        <tr class="s_tr">
                            <td colspan=2 class="table_content" align="right" style="font-size:16px;">Subtotal:&emsp;</td>
                        </tr>
                        <!--additional works section-->
                        <tr class="s_tr" style="height: 35px;">
                            <td colspan=2>
                                <span class="col_name" style="padding:10px;font-size:18px">Additional works:</span>
                            </td>
                            <td>
                            </td>

                        </tr>
                        <tr class="b_tr">
                            <td align="center">
                                <span class="col_name">Item</span>
                            </td>
                            <td >
                                <span class="col_name">Rooms</span>
                            </td>
                            <td></td>

                        </tr>
                        <?php
                        $subtotal_extras = 0;
                        if ($staining_area != "" && $staining_area != "none") {
                            ?>
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content">Staining</span>
                                </td>
                                <td >
                                    <span class="table_content"><?php print(substr($staining_area, 0, strlen($staining_area) - 1)); ?></span>
                                </td>
                                <td align="center">

                                    <?php
                                    $rooms = explode(",", $staining_area);
                                    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_staining_area_price')->find();
                                    $subtotal = 0;
                                    for ($i = 0; $i < sizeof($rooms); $i++) {
                                        if ($rooms[$i] != "") {
                                            $subtotal += $rooms_settings['total_sq'][$rooms[$i]] * $settings->value;
                                        }
                                    }
                                    ?>
                                    <span class="table_content"><?php
                                $subtotal_extras+=$subtotal;
                                print(number_format($subtotal, 2));
                                ?></span>
                                </td>

                            </tr>
                        <?php } ?>
<?php if ($lift_removal != "" && $lift_removal != "none") { ?>
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content">Carpet Lift & Removal</span>
                                </td>
                                <td >
                                    <span class="table_content"><?php print(substr($lift_removal, 0, strlen($lift_removal) - 1)); ?></span>
                                </td>
                                <td align="center">
                                    <?php
                                    $rooms = explode(",", $lift_removal);
                                    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_carpet_removal')->find();
                                    $subtotal = 0;
                                    for ($i = 0; $i < sizeof($rooms); $i++) {
                                        if ($rooms[$i] != "") {
                                            $subtotal += $settings->value;
                                            //print($rooms_settings['total_sq'][$rooms[$i]]."*".$settings->value." ");
                                        }
                                    }
                                    ?>
                                    <span class="table_content"><?php
                                    $subtotal_extras+=$subtotal;
                                    print(number_format($subtotal, 2));
                                    ?></span>
                                </td>

                            </tr>
<?php } ?>
<?php if ($gap_filling != "" && $gap_filling != "none") { ?>				
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content">Gap Filling(resin)</span>
                                </td>
                                <td >
                                    <span class="table_content">	<?php print(substr($gap_filling, 0, strlen($gap_filling) - 1)); ?></span>
                                </td>
                                <td align="center">
                                    <?php
                                    $rooms = explode(",", $gap_filling);
                                    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_resin_price')->find();
                                    $subtotal = 0;
                                    for ($i = 0; $i < sizeof($rooms); $i++) {
                                        if ($rooms[$i] != "") {
                                            $subtotal += $rooms_settings['total_sq'][$rooms[$i]] * $settings->value;
                                            //print($rooms_settings['total_sq'][$rooms[$i]]."*".$settings->value." ");
                                        }
                                    }
                                    ?>
                                    <span class="table_content"><?php
                                    $subtotal_extras+=$subtotal;
                                    print(number_format($subtotal, 2));
                                    ?></span>
                                </td>

                            </tr>
<?php } ?>	
<?php if ($gap_filling_wood != "" && $gap_filling_wood != "none") { ?>
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content">Gap Filling(wood)</span>
                                </td>
                                <td >
                                    <span class="table_content"><?php print(substr($gap_filling_wood, 0, strlen($gap_filling_wood) - 1)); ?></span>
                                </td>
                                <td align="center">
                                    <?php
                                    $rooms = explode(",", $gap_filling_wood);
                                    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_wood_price')->find();
                                    $subtotal = 0;
                                    for ($i = 0; $i < sizeof($rooms); $i++) {
                                        if ($rooms[$i] != "") {
                                            $subtotal += $rooms_settings['total_sq'][$rooms[$i]] * $settings->value;
                                            //print($rooms_settings['total_sq'][$rooms[$i]]."*".$settings->value." ");
                                        }
                                    }
                                    ?>
                                    <span class="table_content"><?php
                                    $subtotal_extras+=$subtotal;
                                    print(number_format($subtotal, 2));
                                    ?></span>
                                </td>

                            </tr>
<?php } ?>
<?php if ($bitumen != "" && $bitumen != "none") { ?>
                            <tr class="s_tr">
                                <td align="center">
                                    <span class="table_content">Bitumen Removal</span>
                                </td>
                                <td >
                                    <span class="table_content"><?php print(substr($bitumen, 0, strlen($bitumen) - 1)); ?></span>
                                </td>
                                <td align="center">
                                    <?php
                                    $rooms = explode(",", $bitumen);
                                    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_bitumen_removal')->find();
                                    $subtotal = 0;
                                    $subtotal = (count($rooms) - 1) * $settings->value;
                                    /* for ($i = 0; $i < sizeof($rooms); $i++) {
                                      if ($rooms[$i] != "") {
                                      $subtotal += $rooms_settings['total_sq'][$rooms[$i]] * $settings->value;
                                      //print($rooms_settings['total_sq'][$rooms[$i]]."*".$settings->value." ");
                                      }
                                      } */
                                    ?>
                                    <span class="table_content"><?php
                                    $subtotal_extras+=$subtotal;
                                    print(number_format($subtotal, 2));
                                    ?></span>
                                </td>

                            </tr>
<?php } ?>
<?php if ($option == "2") { ?>
                            <tr>
                                <td colspan=2 align="right" class="table_content" style="font-size: 16px;">10% discount for full online pre-payment:&emsp;</td>
                                <td align=center style="font-size: 24px; font-weight: bold; background-color: #373131;" >								
                                    <font size="5" style="color: white">£<?php print( number_format($total_price_for_job * 0.1, 2)); ?></font>
                                </td>
                            </tr>
                            
<?php if($sale!=0) { ?>
                            <tr>
                                <td colspan=2 align="right" class="table_content" style="font-size: 16px;">Promo-code Discount(<?php echo $sale."%";?>):&emsp;</td>
                                <td align=center style="font-size: 24px; font-weight: bold; background-color: #373131;" >								
                                    <font size="5" style="color: white">£<?php print( number_format($total_price_for_job * ((float)$sale/100), 2)); ?></font>
                                </td>
                            </tr>                            
<?php }} ?>
<?php if ($option == "1") { ?>
                         <?php if($sale!=0) { ?>
                            <tr>
                                <td colspan=2 align="right" class="table_content" style="font-size: 16px;">Promo-code Discount(<?php echo $sale."%";?>):&emsp;</td>
                                <td align=center style="font-size: 24px; font-weight: bold; background-color: #373131;" >								
                                    <font size="5" style="color: white">£<?php print( number_format($total_price_for_job * ((float)$sale/100), 2)); ?></font>
                                </td>
                            </tr>                            
<?php }?>
                            <tr>
                                <td colspan=2 align="right" class="table_content" style="font-size: 16px;">Your deposit amount is:&emsp;</td>
                                <td align=center style="font-size: 24px; font-weight: bold; background-color: #373131;" >								
                                    <font size="5" style="color: white">£<?php print(number_format(($total_price_for_job * (0.05))*(1-(float)$sale/100), 2)); ?></font>
                                </td>
                            </tr>
                                <?php } ?>
                        <tr class="s_tr">
                            <td colspan="2"></td>
                            <td rowspan=2 class="table_content" style="font-size: 24px; font-weight: bold; background-color: #373131;" align="center">£
                                <?php
                                if ($option == "2") {
                                    print(number_format($total_price_for_job * (0.9-(float)$sale/100), 2));
                                } else {
                                    print(number_format($total_price_for_job * (1-(float)$sale/100), 2));
                                }
                                ?></td>
                        </tr>
                        <tr class="s_tr">
                            <td colspan=2 class="table_content" align="right" style="font-size:20px;">Total:&emsp;</td>
                        </tr>
                    </tbody>
                </table>
<?php if ($option == "1") { ?>
                    <div class="option_1">
                        <br/>
                        <h3>You have picked option 1, so you will only be charged your deposit of 5%<br/>
                            with this confirmation and the remainder will be payable<br/>
                            on completion of the work.<br/><br/>
                            Your deposit amount is:&emsp;<font size="5">£<?php print( number_format(($total_price_for_job)*0.05*(1-(float)$sale/100), 2)); ?></font><br/>
                            Your amount amount payable on completion will be:&emsp;<font size="5">£<?php print(number_format($total_price_for_job *0.95* (1-(float)$sale/100), 2)); ?></font></h3>
                    </div>
                    <?php } ?>
                <div class="person_ditails" style="margin-top: 50px;">
                    <span style="font-size:16px;color:#FF6418">Name: </span><span style="font-size:16px;color:white"><?php echo $name, " ", $surname; ?><br></span>
                    <span style="font-size:16px;color:#FF6418">Site Address: </span><span style="font-size:16px;color:white"><?php echo $address, ", ", $town, " ", $postcode ?><br></span>
<?php if (isset($alternative_address) && $alternative_address != "") { ?><span style="font-size:16px;color:#FF6418">Alternative Address: </span><span style="font-size:16px;color:white"><?php echo $alternative_address, ", ", $alternative_town, " ", $alternative_postcode ?><br></span><?php } ?>
<?php if ($work_date != 0) { ?><span style="font-size:16px;color:#FF6418">Start Date: </span><span style="font-size:16px;color:white"><?php
    echo date('D, j F Y', $work_date);
    ?><br></span><?php } ?>
                </div>
                <div class="contact_ditails" style="margin-top: 50px;">
                    <span style="font-size:16px;color:#FF6418">Your contact details for this order area:</span><br>
                    <span style="font-size:16px;color:#FF6418">Email: </span><span style="font-size:16px;color:white"><?php echo $email; ?></span><br>
                    <span style="font-size:16px;color:#FF6418">Landline: </span><span style="font-size:16px;color:white"><?php echo $phone; ?></span><br>
                    <span style="font-size:16px;color:#FF6418">Mobile/SMS: </span><span style="font-size:16px;color:white"><?php echo $mphone; ?></span><br>
                </div><br/>
                <div class="contact_us">
                    <span style="font-size: 16px">If you have any queries? please feel free to email us at:</span><span style="font-size:16px;color:#FF6418"> <?php echo $admin_email; ?></span>
                </div>   
                <div style="width:100%;margin-top: 30px;">
                    <input type="button" name="" value="Go back to make changes" class="submit" onclick="location.href='index/<?php echo $link; ?>';cancelEvent('onbeforeunload')" style="height: 25px;">
                    <input type="button" name="" value="NEXT" class="submit" onclick="location.href='../checkout';cancelEvent('onbeforeunload')" style="margin-left:500px;">
                </div>
                <div style="margin-top: 20px;">
                    <a href="#" style="text-decoration:none;font-size:16px;color:#FF6418;margin-left: 770px;">
                        <span style="font-size:16px;color:#FF6418" onclick="window.print() ;" >
                            Print this page
                        </span>
                    </a>
                </div>
                <!--div id="total-price">
                        <h1>TOTAL PRICE FOR JOB</h1>
                        <p><strong>£</strong><input type="text" name="total_price_for_job" id="total_price_for_job" value="<?php
if (isset($total_price_for_job))
    echo $total_price_for_job;
?>" class="field-bg" style="padding-left: 10px;color:#FA5827; font-size: 18px; font-weight: bold" /></p>
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
            </div><!--online-maintainence-form-->
        </div><!--online-maintainence-main-->
    </form>
    <!--End containt area holder -->
</div>
<div id="modal_block_hidden"></div>
<div id="modal_block"></div>

<?php
//Request::instance()->redirect( Route::get('quotation')->uri(array() );
?>
