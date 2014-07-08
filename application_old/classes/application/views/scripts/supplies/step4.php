<div id="inside_container">
    <!--containt area holder -->
    <form method="post" id="quotation_form" action="<?php echo URL::base(); ?>online-quotation" enctype="multipart/form-data">
        <input id="id_quotation" type="hidden" name="id_quotation" value="0" />
        <input type="hidden" name="goto_checkout" id="goto_checkout" value="0" />
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <h1 style="margin-top:100px;">Thank you for your order, this is your</h1>
                <h3 style="font-size: 52px;text-decoration:none;">Order Confirmation</h3><br/><br/>
                <h3 style="padding:0;"><span style="color: #FF6418; font-size: 20px;">Your reference number for this order is: </span><font size="6"><?php echo $supplies['id_ss']; ?></font><h3>
                <h3 style="padding:0;"><span style="color: #FF6418; font-size: 20px;">Your transaction id for this order is: </span><font size="6"><?php echo $transaction_id; ?></font><h3>
                        <h3 style="padding-bottom:40px;"><span style="color: #FF6418">Date: </span><span><?php echo date('D, j F Y', $supplies['date']);   ?></span><h3>
                                <h3 style="margin-top: 20px; font-size: 20px; font-weight: normal;font-family:Arial;">The details of your order are:</h3>
                                <table  class="order_table" >
                                    <tbody>	
                                        <tr class="c_tr">
                                            <td align="center" style="width: 100px;">
                                                <span class="col_name">Code</span>
                                            </td>
                                            <td>
                                                <span class="col_name">Title</span>
                                            </td>
                                            <td align="center" style="width: 120px;">
                                                <span class="col_name">Price</span>
                                            </td>
                                            <td align="center" style="width: 120px;">
                                                <span class="col_name">Quantity</span>
                                            </td>
                                            <td align="center"  style="width: 150px;">
                                                <span class="col_name">Total Price</span>
                                            </td>
                                        </tr>
                                        <?php
                                        $subtotal = 0;
                                        $date = $supplies['date'];

                                        $suppliesElems = json_decode((string)$supplies['supplies']);

                                        foreach ($suppliesElems as $supplie => $val) {
                                            $items = ORM::factory('supplies')->where("id_supplies", "=", $supplie)->find();
                                          //  echo "<pre>"; die(print_r($val)); ?>
                                            
                                            <tr class="b_tr">
                                                <td align="center" style="width: 100px;">
                                                    <span class="col_name"><?php echo $items->code; ?></span>
                                                </td>
                                                <td>
                                                    <span class="col_name"><?php echo $items->title; ?></span>
                                                </td>
                                                <td align="center" style="width: 120px;">
                                                    <span class="col_name"><?php echo number_format($items->price,2); ?></span>
                                                </td>
                                                <td align="center" style="width: 120px;">
                                                    <span class="col_name"><?php echo $val->cnt; ?></span>
                                                </td>
                                                <td align="center"  style="width: 150px;">
                                                    <span class="col_name"><?php
                                        echo number_format($val->cnt * $items->price, 2);
                                        $subtotal += $val->cnt * $items->price;
                                        $date = date('D, j F Y', $supplies['date']);
                                        ?></span>
                                                </td>
                                            </tr>
<?php } ?>
                                        <tr class="b_tr">
                                            <td align="right" style="width: 100px;" colspan="4">
                                                <span class="col_name" style="padding-right: 5px;">Sub Total</span>
                                            </td>

                                            <td align="center"  style="width: 150px;">
                                                <span class="col_name"><?php echo number_format($subtotal, 2); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="b_tr">
                                            <td align="right" style="width: 100px;" colspan="4">
                                                <span class="col_name" style="padding-right: 5px;">Next Day Delivery</span>
                                            </td>

                                            <td align="center"  style="width: 150px;">
                                                <span class="col_name"><?php $nextDayDelivery = date('D, j F Y', $supplies['date'] + 86400); echo $nextDayDelivery; ?></span>
                                            </td>
                                        </tr>
                                        <tr class="b_tr">
                                            <td align="right" style="width: 100px;" colspan="4">
                                                <span class="col_name" style="padding-right: 5px;">V.A.T. @20%</span>
                                            </td>

                                            <td align="center"  style="width: 150px;">
                                                <span class="col_name"><?php $vat = $subtotal * 0.2; echo number_format($vat,2); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="b_tr">
                                            <td align="right" style="width: 100px;" colspan="4">
                                                <span class="col_name" style="padding-right: 5px;">Total</span>
                                            </td>

                                            <td align="center"  style="width: 150px;">
                                                <span class="col_name"><?php echo $supplies['total']; ?></span>
                                            </td>
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
                                <div class="person_ditails" style="margin-top: 30px;">

                                    <span style="font-size:16px;color:#FF6418">Your delivery address for this order is: </span><span style="font-size:16px;color:white"><?php echo $address, ", ", $town, " ", $postcode ?><br></span>
                                    <span style="font-size:16px;color:#FF6418">Delivery is: </span><span style="font-size:16px;color:white"><?php echo $nextDayDelivery; ?><br></span>
                                </div>
                                <div class="contact_ditails" style="margin-top: 30px;">
                                    <span style="font-size:16px;color:#FF6418">Your contact details for this order area:</span><br>
                                    <span style="font-size:16px;color:#FF6418">First name and surname: </span><span style="font-size:16px;color:white"><?php echo $name." ".$surname; ?><br></span>
                                    <span style="font-size:16px;color:#FF6418">Email: </span><span style="font-size:16px;color:white"><?php echo $email; ?></span><br>
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