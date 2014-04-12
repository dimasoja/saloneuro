<script type="text/javascript">
    jQuery('#progress_bar').attr("src","/images/step5.png");	
    jQuery('#progress_bar').css('height', '');
</script>
<div id="inside_container">
    <!--containt area holder -->
    <form method="post" id="quotation_form" action="<?php echo URL::base(); ?>online-quotation" enctype="multipart/form-data">
        <input id="id_quotation" type="hidden" name="id_quotation" value="0" />
        <input type="hidden" name="goto_checkout" id="goto_checkout" value="0" />
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <h1 style="margin-top: 100px;">Thank you for your order, this is your</h1>
                <h3 style="font-size: 48px;text-decoration:none;padding-top:15px;">Floor Sanding Order Confirmation</h3><br/><br/><br/>
                <h3 style="padding:0;"><span style="color: #FF6418; font-size: 24px;">Your reference number for this order is: </span><font size="6"><?php print($id); ?></font><h3>
                <?php if($transaction_id!='0') { ?>  <h3 style="padding:0;"><span style="color: #FF6418; font-size: 24px;">Your reference transaction id for this order is: </span><font size="6"><?php echo $transaction_id; ?></font><h3> <?php } ?>       <h3 style="padding-bottom:40px;"><span style="color: #FF6418; font-size: 24px;">Date: </span><span><?php echo date('j F Y', time()); ?></span><h3>
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
                                                    <span class="table_content"><?php print(number_format($rooms_settings['room_w'][$i],2)); ?>m x <?php print(number_format($rooms_settings['room_l'][$i],2)); ?>m = <?php print($rooms_settings['total_sq'][$i]); ?> sq. m</span>
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
                                                <span class="col_name" style="padding:10px;font-size:18px"><!--Additional works:--></span>
                                            </td>
                                            <td>
                                            </td>

                                        </tr>                                      
                                            <?php if ($daily_clean != '') { ?><tr class="b_tr"><td align="center"><span class="col_name">Daily Clean: </span></td><td><span class="col_name"><?php echo $deep_clean; ?></span></td><td></td></tr><?php } ?>
                                            <?php if ($deep_clean != '') { ?><tr class="b_tr"><td align="center"><span class="col_name">Deep Cleaning & Protector: </span></td><td><span class="col_name"><?php echo $day_of_week; ?></span></td><td></td></tr><?php } ?>
                                            <?php if ($buff_n_coat != '') { ?><tr class="b_tr"><td align="center"><span class="col_name">Buff ‘n’ Coat: </span></td><td><span class="col_name"><?php echo $buff_n_coat; ?></span></td><td></td></tr><?php } ?>                                   
                                            <?php if ($type_of_floor != '') { ?><tr class="b_tr"><td align="center"><span class="col_name">Type of floor: </span></td><td><span class="col_name"><?php echo $type_of_floor; ?></span></td><td></td></tr><?php } ?>
                                            <?php if ($day_of_week != '') { ?><tr class="b_tr"><td align="center"><span class="col_name">Your preferred day of the week for works to take place: </span></td><td><span class="col_name"><?php echo $daily_clean; ?></span></td><td></td></tr><?php } ?>
										<tr>
												<td colspan=2 align="right" class="table_content" style="font-size: 16px;">Your deposit amount is:&emsp;</td>
												<td align=center style="font-size: 24px; font-weight: bold; background-color: #373131;" >								
													<font size="5" style="color: white">£<?php print( number_format($option_price,2)); ?></font>
												</td>
											</tr>
                                        <tr class="s_tr">
                                            <td colspan="2"></td>
                                            <td rowspan=2 class="table_content" style="font-size: 24px; font-weight: bold; background-color: #373131;" align="center">£<?php print( number_format($option_price,2)); ?>
									</tr>
                                        <tr class="s_tr">
                                            <td colspan=2 class="table_content" align="right" style="font-size:20px;">Total: &emsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php /* if ($option == "1") { ?>
                                  <div class="option_1">
                                  <br/>
                                  <h3>You have picked option 1, so you will only be charged your deposit of 5%<br/>
                                  with this confirmation and the remainder will be payable<br/>
                                  on completion of the work.<br/><br/>
                                  Your deposit amount is:&emsp;<font size="5">£<?php print( $total_price_for_job * 0.05); ?></font><br/>
                                  Your amount amount payable on completion will be:&emsp;<font size="5">£<?php print( $total_price_for_job); ?></font></h3>
                                  </div>
                                  <?php } */ ?>
                                
                                <?php 
                                if($type_of == 'maintenance') {
                                    $message = "";
                                    switch($option) {
                                        case 'option 1': 
                                            $message = "UPFRONT FULL ANNUAL PAYMENT";
                                            break;
                                        case 'option 2': 
                                            $message = "CREDIT/DEBIT CARD MONTHLY PAYMENT (each monthly payment is charged in advance)";
                                            break;
                                        case 'option 3': 
                                           
                                            break;
                                    }
                                }
                                echo '<br/><br/><br/><span style="font-size:19px;color:#FF6418">'.$message.'</span>';
                                ?>                                
                                <div class="person_ditails" style="margin-top: 45px;">
                                    <span style="font-size:16px;color:#FF6418">Name: </span><span style="font-size:16px;color:white"><?php echo $name, " ", $surname; ?><br></span>
                                    <span style="font-size:16px;color:#FF6418">Site Address: </span><span style="font-size:16px;color:white"><?php echo $address, ", ", $town, " ", $postcode ?><br></span>
                                    <?php if((isset($alternative_address)) and ($alternative_address!='')) { ?><span style="font-size:16px;color:#FF6418">Alternative Address: </span><span style="font-size:16px;color:white"><?php echo $alternative_address, ", ", $alternative_town, " ", $alternative_postcode ?><br></span><?php } ?>
                                   <!-- <?php if($day_of_week != '') { ?><span style="font-size:16px;color:#FF6418">Your preferred day of the week for works to take place: </span><span style="font-size:16px;color:white"><?php echo $daily_clean; ?><br></span><?php } ?>
                                    <?php if($daily_clean != '') { ?><span style="font-size:16px;color:#FF6418">Daily Clean: </span><span style="font-size:16px;color:white"><?php echo $deep_clean; ?><br></span><?php } ?>
                                    <?php if($deep_clean != '') { ?><span style="font-size:16px;color:#FF6418">Deep Cleaning & Protector: </span><span style="font-size:16px;color:white"><?php echo $day_of_week; ?><br></span><?php } ?>
                                    <?php if($buff_n_coat != '') { ?><span style="font-size:16px;color:#FF6418">Buff ‘n’ Coat: </span><span style="font-size:16px;color:white"><?php echo $buff_n_coat; ?><br></span><?php } ?>
                                    <?php if($type_of_floor != '') { ?><span style="font-size:16px;color:#FF6418">Type of floor: </span><span style="font-size:16px;color:white"><?php echo $type_of_floor; ?><br></span><?php } ?>
                                    <?php if($day_of_week != '') { ?><span style="font-size:16px;color:#FF6418">Your preferred day of the week for works to take place: </span><span style="font-size:16px;color:white"><?php echo $day_of_week; ?><br></span><?php } ?>-->
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
                                <div style="margin-top: 30px;">
                                    <a href="#" style="text-decoration:none;font-size:16px;color:#FF6418;margin-left: 776px;">
                                        <span style="font-size:16px;color:#FF6418" onclick="window.print() ;">
					Print this page
                                        </span>
                                    </a>
                                </div>
                                <!--div id="total-price">
                                        <h1>TOTAL PRICE FOR JOB</h1>
                                        <p><strong>£</strong><input type="text" name="total_price_for_job" id="total_price_for_job" value="<?php if (isset($option_price))
                                    echo $option_price; ?>" class="field-bg" style="padding-left: 10px;color:#FA5827; font-size: 18px; font-weight: bold" /></p>
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
