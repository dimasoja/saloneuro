<?php if ((isset($_SESSION['checkout_type'])) and ($_SESSION['checkout_type']=='quotation')) { ?>
<script type="text/javascript">
    jQuery('#progress_bar').attr("src","/images/checkout_pb.png");	
    jQuery('#progress_bar').css('height', '');
    window.onbeforeunload = function() {
        return 'Do you really want to leave/refresh Online Quotation page? All the info would be lost!';
    }
    function cancelEvent(ev){
        window[ev]=function(){null}
    }
</script>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#cvv-info").fancybox({
            'scrolling'		: 'no',
            'titleShow'		: false,
            'modal'             : false,
            'closeClick'        : false,
            'closeBtn'          : true
        });
    });
    function changeHide() {
        var visible;
        if(jQuery('#shipping').attr('checked')=='checked') { visible='table-row';} else {visible='none'} 
        jQuery('#ship_postcode, #ship_town, #ship_address').css('display',visible);
    }
</script>
<div id="inside_container">
    <!--containt area holder -->
                 <?php
                    if(isset($payment_error)) {
                    switch ($payment_error) {
                        case '501' :
                            $payment_error = "This transaction has already been processed! If you feel this is incorrect please contact the merchant!";
                            break;
                        case '101' :
                            $payment_error = "Card expired.";
                            break;
                        case '102' :
                            $payment_error = "Bank of the card holder will not allow the transaction to go through automatically.";
                            break;
                        case '103' :
                            $payment_error = "The card has been marked as lost, stolen or cancelled. Payment will not be taken.";
                            break;
                        case '200' :
                            $payment_error = "Communications error.";
                            break;
                        case '' :
                            $payment_error = "";
                            break;
                        default :
                            $payment_error = "Unknown error!";
                            break;
                    }
                    }
                    ?>
    <form method="post" id="quotation_form" action="<?php echo URL::base(); ?>checkout/makepay">
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <div style="margin-left:130px; margin-top: 150px;">
                    <div style="float:left;"> 
                        <img src="/images/hsbc_logo.png">
                    </div>
                    <div style="float:left; margin-left:20px;"> 

                        <h1 style="font-size:40px;color:white;">Payment System</h1>
                    </div>
                </div>
                <div style="width:100%;float:left;margin-top:30px;margin-left:130px;">
                    <h1 style="font-size:18px;color:white; font-weight: normal;">Please enter your credit card details below to finalise your order.</h1> 
                </div>	

                <table cellpadding="0" cellspacing="0" class="cc_table" style="float: left;">
                    <?php if(isset($payment_error)) { ?>
                    <tr style="height: 90px;">
                        <td align="left" colspan="2">                  
                            <?php  echo '<div class="error_message" style="width: 722px !important; margin-left: 130px;">' . $payment_error . '</div>'; ?>
                        </td>
                        </tr>
                    <?php } ?>
                    <tr style="height: 90px;">
                        <td align="left" colspan="2"><span style="margin-left:130px;font-size:28px;">Billing information</span></td>

                    </tr>
                    <tr>
                        <td align="right" style="width: 370px;">Name</td>
                        <td>
                            <input id="cardholdername" type="text" name="cardholder_name" style="margin: 0 0 0 5px; <?php if(isset($cardholder_name) && $cardholder_name!="") {echo "color:black;";} else {echo "color: lightgrey;"; } ?>" value="<?php if (isset($cardholder_name) && $cardholder_name!="") { echo $cardholder_name . " " . $cardholder_surname; } else { echo "as it appears on the card"; } ?>" onfocus="if(this.value=='as it appears on the card'){this.value='';jQuery(this).css('color', 'black');};" onblur="if(this.value==''){this.value='as it appears on the card'};" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <!--<tr>
                        <td align="right">Cardholder last name:</td>
                        <td>
                            <input type="text" name="cardholder_surname" value="<?php echo $cardholder_surname; ?>" class="franchisee-name" />
                        </td>
                    </tr>-->
                    <tr>
                        <td align="right">Company</td>
                        <td>
                            <input type="text" <?php if(isset($_SESSION['company'])) echo "value = '".$_SESSION['company']."'"; ?>  name="cardholder_company" value="(optional)" style="margin: 0 0 0 5px; <?php if(isset($_SESSION['company']) && $_SESSION['company']!="") {echo "color:black;";} else {echo "color: lightgrey;"; } ?>" onfocus="if(this.value=='(optional)'){this.value=''; jQuery(this).css('color', 'black');};" onblur="if(this.value==''){this.value='(optional)'};" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">House Number & Street Address</td>
                        <td>
                            <input id="cardholderadress" type="text" name="address" style="margin: 0 0 0 5px; <?php if(isset($address) && $address!="") {echo "color:black;";} else {echo "color: lightgrey;"; } ?>" value="<?php echo (isset($address) && $address!="") ? $address : "where the card is registered"; ?>" onfocus="if(this.value=='where the card is registered'){this.value='';jQuery(this).css('color', 'black');};" onblur="if(this.value==''){this.value='where the card is registered'};" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Town</td>
                        <td>
                            <input id="cardholdertown" type="text" name="town" style="margin: 0 0 0 5px; <?php if(isset($town) && $town!="") {echo "color:black;";} else {echo "color: lightgrey;"; } ?>"" value="<?php echo (isset($town) && $town!="") ? $town : "where the card is registered"; ?>" onfocus="if(this.value=='where the card is registered'){this.value='';jQuery(this).css('color', 'black');};" onblur="if(this.value==''){this.value='where the card is registered'};" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Postcode</td>
                        <td>
                            <input id="cardholderpostcode" type="text" name="postcode" style="margin: 0 0 0 5px; width:338px;color: black;" value="<?php echo $postcode; ?>" class="cvv franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr><td></td>
                        <td>
                            <br/>&nbsp;&nbsp;<label for="shipping-slide">Do you want us to ship to alternative address?</label> <input type="checkbox" id="shipping" name="shipping" onChange="changeHide()"/>
                        </td>
                    </tr>
                    <tr id="ship_address" style="display:none">
                        <td align="right"><br/>Shipping House Number & Street Address</td>
                        <td>
                            <br/><input id="alt_cardholderadress" type="text" name="alternative_address" style="margin: 0 0 0 5px; color: black;" value="<?php echo (isset($alternative_address) && $alternative_address != "") ? $alternative_address : ""; ?>" class="franchisee-name-checkout" />
                        </td>
                    </tr>  
                    <tr id="ship_town" style="display:none">
                        <td align="right">Shipping Town</td>
                        <td>
                            <input id="alt_cardholdertown" type="text" name="alternative_town" style="margin: 2px 0 0 5px; color: black;" value="<?php echo (isset($alternative_town) && $alternative_town != "") ? $alternative_town : ""; ?>" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr id="ship_postcode" style="display:none">
                        <td align="right">Shipping Postcode</td>
                        <td>
                            <input id="alt_cardholderpostcode" type="text" name="alternative_postcode" style="margin: 0 0 0 5px;width:338px; color: black;" value="<?php echo $alternative_postcode; ?>" class="cvv franchisee-name-checkout" />
                        </td>
                    </tr>  
                    <tr style="height: 90px;">
                        <td align="left" colspan="2"><span style="margin-left:130px;font-size:28px;">Credit Card Details</span></td>
                            
                    </tr>
                    <tr>
                        <td align="right">Card Number</td>
                        <td>
                            <input id="cardnumber" type="text" style="margin: 0 0 0 5px; color: lightgrey;" name="cardholderpan" value="1234567898765432" onfocus="if(this.value=='1234567898765432'){this.value='';jQuery(this).css('color', 'lightgrey');};" onKeyDown ="jQuery(this).css('color','black');" onblur="if(this.value==''){this.value='1234567898765432';jQuery(this).css('color', 'lightgrey');};" maxlength="16" class="franchisee-name-checkout" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Expiry date (mm/yy)</td>
                        <td>
                            <input id="card_date" type="text" style="margin: 0 0 0 5px; color: lightgrey;" name="card_expiration" value="mm/yy" onfocus="if(this.value=='mm/yy'){this.value='';jQuery(this).css('color', 'black');};" onKeyDown ="jQuery(this).css('color','black');" onblur="if(this.value==''){this.value='mm/yy'};" class="cvv franchisee-name-checkout" maxlength="5" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Security Code last 3 digits (CVV)</td>
                        <td>
                            <input id="card_cvv" type="text" style="margin: 0 0 0 5px; color: lightgrey;" name="cvv2val" value="CVV" onfocus="if(this.value=='CVV'){this.value='';jQuery(this).css('color', 'black');};" onblur="if(this.value==''){this.value='CVV'};" onKeyDown ="jQuery(this).css('color','black');" class="cvv franchisee-name-checkout" maxlength="4" style="float: left; margin-right: 10px;" /> 
                            <a id="cvv-info" href="<?php echo URL::base(); ?>images/cvv2.jpg" id="cvv" class="fancy" onclick="window.onbeforeunload = null;">
                                <img src="<?php echo URL::base(); ?>images/i-prod2.jpg" style="width: 27px;vertical-align: bottom;" />
                            </a>
                        </td>

                    </tr>
                    <tr style="height: 30px;">
                        <tr colspan="2"></td>
                    </tr>
                    <tr>
                        <td align="right">Contact Email Address</td>
                        <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                            <input id="cardholderemail" style="margin: 0 0 0 5px; color: black;" type="text" name="email" value="<?php echo $email; ?>" class="franchisee-name-checkout" maxlength="60" style="float: left; margin-right: 10px;" /> 
                        </td>
                    </tr>
                    <?php if ($_SESSION['checkout_type'] == 'supplies') {?>
                        <tr>
                            <td align="right">Landline Telephone Number</td>
                            <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                <input id="landtel" style="margin: 0 0 0 5px; color: black;" type="text" name="landtel" value="<?php if(isset($landtel))echo $landtel; ?>" class="franchisee-name-checkout" maxlength="60" style="float: left; margin-right: 10px;" /> 
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Mobile Telephone Number</td>
                            <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                <input id="mobtel" style="margin: 0 0 0 5px; color: black;" type="text" name="mobtel" value="<?php if(isset($mobtel)) echo $mobtel; ?>" class="franchisee-name-checkout" maxlength="60" style="float: left; margin-right: 10px;" /> 
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="right">Special Notes</td>
                        <td>
                            <textarea name="special_notes" rows="2" cols="20" style="color: black; width:339px;height:100px;overflow-x: hidden;overflow-y: auto; margin: 1px 0px 1px 4px;"><?php if(isset($special_notes)) echo $special_notes; ?></textarea>
                        </td>

                    </tr>
                    <tr style="height: 40px;">
                        <td align="right">Check Amount and Make Payment:</td>
                        <td><h2 style="margin-left: 8px;">&pound;<?php echo number_format($payment, 2); ?>
                        <input type="hidden" name="total_val" value="<?php echo $payment; ?>"/>
                                    <img id="pymemt" src="<?php echo URL::base(); ?>images/pay.jpg" style="height: 27px;vertical-align: bottom;margin-left: 72px;cursor:pointer;" onclick="checkPymemt();cancelEvent('onbeforeunload')" /></h2></td>
                    </tr>
                </table>

                <div class="clear"></div>
                <div id="booking-main1">
                    <!-- <div id="booking-mainsub1">
                         <ul>
                             <li><input type="submit" value="PAY" class="booking1" /></li>
                         </ul>
                     </div>-->
                    <!--End containt area holder -->
                    <br/><br/><br/><br/>
                    <div id="card-main" style="width: 100%">
                        <!--ul style="float:left;">
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card1.jpg" alt="" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card2.jpg" alt="" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card3.jpg" alt="" /f></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card4.jpg" alt="" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/quotation-card5.jpg" alt="" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/american-express.jpg" alt="" /></li>
                            <li><img src="<?php echo URL::base(); ?>images/hsbc_logo.png" alt="" / style="height: 42px;"></li>
                        </ul-->
                        <img src="<?php echo URL::base(); ?>images/cred-cards.jpg" alt="" />
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="underConstruct" style="display:none;">
    <h2 style="color: #ff8000; text-align: center;">
        This area of the site is currently undergoing testing so the online payment service is unavailable.<br/><br/>
        To make a payment, please telephone us on <b>01625 582567</b>.<br/><br/>
        We apologise for any inconvenience.
    </h2><br/>

    <center><input class="submit" type="button" onclick="<?php echo $proceedOnClick; ?>" value="Proceed" /></center>
</div>
<div id="modal_block_hidden"></div>
<div id="modal_block"></div>