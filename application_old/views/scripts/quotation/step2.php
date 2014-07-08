<script type="text/javascript">
    /*  jQuery(document).ready(function() {
        jQuery('#cvv').fancybox();
        
        var links = document.getElementsByTagName('a');
        for(var i = 0, l = links.length; i < l; i++) {
            links[i].onclick = function(){
            links[i].onclick = function(){
                return false;
            };
        }
	  
        jQuery('a').click(function(){
            
            if (confirm('Your order has not been completed. Are you sure?')) {
                location = this.href;
            }
        })
                }
    })*/
    jQuery('#progress_bar').attr("src","/images/quote_progress_step2.png");	
    jQuery('#progress_bar').css('height', '');
	
</script>
<div id="inside_container" >
    <h1>Booking Schedule</h1>
    <form action="/online-quotation/step2" method="POST" style="display:none;" id="is_date_not_form">
        <div id="is_date_not" style="display:none;">
			<input style="display: none;" id="weekend_work" type="text" name="weekend_work" value="0"></input>
            <input style="display:none;" id='fo1_form' type='checkbox' name='further_option_1_form' value='no'>
            <input style="display:none;" id="fo2_form" type="checkbox" name="further_option_2_form" value="no">
            <input style="display:none;" id="quotation_option" type="text" name="quotation_option" value="0">
            <!-- дата которая уже выбрана (необходимо для того чтобы убирать чекбоксы) -->
            <input type="hidden" name="eel" id="eel" value="<?php echo $eel; ?>" />
            <input style="display:none;"  type="submit" name="" value="send">
        </div>
    </form>
    <?php
    $month_number = date("n");
    $year = date("Y");
    $rooms_settings = unserialize($rooms_settings);
    $total_m = 0;
    foreach ($rooms_settings['total_sq'] as $k) {
        $total_m+=$k;
    }
    if($room_dimensions=='feet') $total_m = 0.09290304*$total_m;


    $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_25')->find();
    if ($total_m <= 25) {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_25')->find();
        $datepick = $settings->value;
    } elseif ($total_m <= 50) {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_50')->find();
        $datepick = $settings->value;
    } elseif ($total_m <= 75) {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_75')->find();
        $datepick = $settings->value;
    } elseif ($total_m <= 100) {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_100')->find();
        $datepick = $settings->value;
    } elseif ($total_m <= 200) {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_200')->find();
        $datepick = $settings->value;
    } else {
        $settings = ORM::factory('settings')->where('short_name', '=', 'fs_date_booking_other')->find();
        $datepick = $settings->value;
    }
    // $datepick - сколько дней занимает данный заказ
    ?>
    <input type="hidden" name="datepick" id="datepick" value="<?php echo $datepick; ?>" />
    <input type="hidden" name="dayid" id="dayid" value="null">
    <br/>
    <div id="booking-main" style="margin: 0 auto;">
        <h2>The next available dates in your area are as follows:</h2>
        <h3 style="margin: -15px 0 15px 16px;">Please select your preferred day, if you would like to proceed. The number of days required for your works will be selected automatically.</h3>
        <div style="margin: -10px 10px 5px 16px; font-size: 12px; color: #6d6f72;">If you require your work to be carried out on a Saturday or Sunday or if your work is likely to use a Saturday or Sunday, please tick the boxes but note that weekend work is subject to confirmation.</div>
        <center style="font-size: 22px; color: #000; font-weight:bold; padding: 5px 0 10px 0;">Scroll across and/or down for further dates</center>
        <div style="overflow: scroll;; height: 235px">
            <table cellpadding="0" cellspacing="0" class="calendar_table">
                <?php
                $im = 0;
                for ($i = 0; $i < 12; $i++) {
                    $month = date("F", mktime(0, 0, 0, $month_number, 1, $year));
                    $days = date('t', mktime(0, 0, 0, $month_number, 1, $year));
                    ?>
                    <tr>
                        <td class="month"><?php echo $month; ?></td>
                        <?php
                        for ($j = 1; $j <= $days; $j++) {
                            
                            // если день выходной - выставляем флаг
                            if (date("D", mktime(0, 0, 0, $month_number, $j, $year)) == "Sat" || date("D", mktime(0, 0, 0, $month_number, $j, $year)) == "Sun")
                                $holidayFlag = true;
                            else
                                $holidayFlag = false;
                            
                            echo "<td class='days'>";
                            echo $j . " (" . date("D", mktime(0, 0, 0, $month_number, $j, $year)) . ")";
                            if (in_array(mktime(0, 0, 0, $month_number, $j, $year), $dates) || mktime(23, 59, 59, $month_number, $j, $year) < time()) {
                                if(in_array(mktime(0, 0, 0, $month_number, $j, $year), $dates)) {
                                    $key = array_search($_SESSION['id'], $date_ids);
                                    if($dates[$key] == mktime(0, 0, 0, $month_number, $j, $year)) {
                                         echo "<span><img id='image".$im."' src=\"" . URL::base() . "images/blue-mark.png\" width=\"27\" height=\"24\" alt=\"\" /></span>";
                                         unset($date_ids[$key]);
                                         ?>
                                        <script type="text/javascript">
                                            val=jQuery('#eel').val();
                                            jQuery('#eel').val(val+",image<?php echo $im; ?>");
                                        </script>
                                      <?php
                                    } else {
                                        echo "<span><img id='image".$im."' src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></span>";
                                    }
                                } else {
                                    echo "<span><img id='image".$im."' src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></span>";
                                }
                            } else {
                                $imagesToChange = "";
                                for ($it=0; $it < $datepick; $it++) {
                                    $imit = $im + $it;
                                    $imagesToChange .= "image" . $imit . "," ;
                                }
                                
                                // если не выходной то onclick можно выбирать день, иначе - нельзя
                                if($holidayFlag == false)
                                    $chooseDateInsertion = "href=\"javascript:void(0);\" onclick='chooseDate(" . $j . ", " . $month_number . ", " . $year . ", \"" . $imagesToChange . "\")'";
                                else 
                                    $chooseDateInsertion = "";
                                
                                echo "<span><a $chooseDateInsertion><img id='image" . $im . "' src=\"" . URL::base() . "images/green-mark.gif\" width=\"27\" height=\"24\" alt=\"$holidayFlag\" /></a></span>";
                            }
                            $im++;

                            if($holidayFlag == true)
                                echo "<center>on req.</center>";

                            echo "</td>";
                        }
                        ?>
                    </tr>
                    <?php
                    $month_number++;
                    if ($month_number > 12) {
                        $month_number = 1;
                        $year++;
                    }
                }
                ?>
            </table>
        </div>

    </div>
	<div style="margin: 10px auto; font-family: Arial; width: 815px; font-size: 18px; background-color: #000; padding: 10px; color: #fff">
        <div style="text-align:center; width: 100%"><input type="button" class="submit" value="Remove Selection" onclick="removeSelection()" /></div><br/>
        <span style="color: #FF8000; font-weight: bold;">Further option 1:</span> On occasion, reservations are cancelled or postponed.
        We have a Cancellations List and we can add you to this list, should you wish to take advantage of a possible earlier date.
        Please note that these dates may only allow short notice.
        If you would like to opt in for this, please tick here. <strong>YES</strong> <input onclick="choose_option(1)" id="fo1" type="checkbox" name="further_option_1" value="yes"<?php if (isset($fu1) && $fu1 == "yes")
                    echo "checked=\"checked\""; ?> />
        <br />
        <br />
        <span style="color: #FF8000; font-weight: bold;">Further Option 2:</span> The above time allocation is based upon an ideal period of time for us to complete works for you.
        In  certain circumstances, works can be completed sooner – this is usually satisfied by using multiple machines/workers.  
        We review each job based upon the individual details to determine whether this is feasible.  
        Would you like to opt in for this option? <strong>YES</strong> <input onclick="choose_option(2)" id="fo2" type="checkbox" name="further_option_2" value="yes"<?php if (isset($fu2) && $fu2 == "yes")
                                                                                                echo "checked=\"checked\""; ?> />
    </div>

    <div style="margin: 0;">
        <div style="width:100%;padding-bottom: 10px;">
            <center><span style="color:white;font-size:26px;"><b>Now simply select one of the 2 options below to make your booking</b></span></center><br/>
        </div>
        <?php if($sale!='') {
            $total_price_for_job_for_promo = $total_price_for_job;
            $sale_summ = (((float)$total_price_for_job)/100)*((float)$sale);
            $coeff = (float)$sale/100;
            $total_price_for_job = (float)$total_price_for_job-$sale_summ;           
            $display = 'style="display: block"';
            $margin = 'style="padding-top: 5px;"'; 
          //  $deposit_required = (((float)$deposit_required)/100)*((float)$sale);           
        } else {
            $total_price_for_job_for_promo = $total_price_for_job;
            $coeff = 0;
            $display = 'style="display:none"';
            $margin = 'style="padding-top: 13px;"';            
            }?>
        <div style="float: left; width: 49%; margin-right: 1%;">
            <div style="padding: 10px; border: 1px solid #fff; height: 250px; position: relative;">
                <h2 style="color: #FF6819; font-size: 3em;"><span style="color:#fff">Option 1</span> - Payment on completion of works</h2><br/>
                <h2 style="text-transform: uppercase; color: #fff; font-size:2.2em">Total price for job</h2><h2 style="font-size: 3em">&pound; <span id="total_price_for_job"><?php if (isset($total_price_for_job))
                                                                                  echo number_format($total_price_for_job, 2); ?></span></h2>
                <input type="hidden" name="total_price_for_job" id="tpfj" value="<?php if (isset($total_price_for_job))
                            echo $total_price_for_job; ?>" />
                <p>Deposit required (5%): <span id="deposit_required" style="font-size:18px;">£<?php echo number_format($total_price_for_job * 0.05, 2); ?></span></p>
                <input type="hidden" name="deposit_required" id="dr" value="<?php if (isset($deposit_required))
                                echo $deposit_required;
?>" />
                <div id="promocode1" <?php echo $display; ?>>
                    <p>Promo-code (<font id="percent-promocode"><?php echo $sale; ?></font>%): <span id="sale_summ" style="font-size:18px;"><?php
                       if (isset($sale_summ))
                           echo '&pound;'.$sale_summ;
?></span></p>
                    <input type="hidden" name="sale_summ" id="ss" value="<?php
                    if (isset($sale_summ))
                        echo $sale_summ;
?>" />
                </div>
                <div <?php echo $margin; ?>>
                    <input type="button" class="submit" style="font-size: 18px;" value='CLICK HERE TO BOOK WITH THIS OPTION'  onclick="submitForm(1);"/>
                </div>
            </div>
            <div style="margin-top: 5px; width: 100%;">
                <div style="float:left; width: 80px; padding: 15px 0 0 5px;"><input type="button" class="submit" value="BACK" onclick="parent.location='./index/<?php echo $back_link; ?>'" /></div>
                <div style="float: right; width: 350px;">
                    To ensure the validity of our online bookings and to eliminate
                    spam, we require a deposit payment of 5% of the total job price. 
                    This amount is deducted from your final payment.  This amount
                    is refundable in the event of cancellation, provided we are
                    notified of your cancellation no later than 7 days prior to your
                    booking date.
                </div>
            </div>
        </div>
        <div style="float: left; width: 50%">
            <div style="padding: 10px; border: 1px solid #fff; height: 250px; position: relative;">
                <h2 style="color: #FF6819; font-size: 3em;"><span style="color:#fff">Option 2</span> - Full online pre-payment</h2><br/>
                <h2 style="text-transform: uppercase; color: #fff; font-size:2.2em">Total discounted price</h2>
                <h2 style="font-size: 3em">&pound; <span id="total_price_for_job2"><?php if (isset($total_price_for_job_for_promo))
                           echo number_format($total_price_for_job_for_promo * (0.9-$coeff), 2); ?></span></h2>
                <input type="hidden" name="total_price_for_job2" id="tpfj2" value="<?php echo $total_price_for_job; ?>" />
                <p style="margin-top: 7px;">Full online pre-payment</p>
                <div id="promocode2" <?php echo $display; ?>>
                    <p>Promo-code (<font id="percent-promocode-1"><?php echo $sale; ?></font>%): <span id="sale_summ-1" style="font-size:18px;"><?php
                       if (isset($sale_summ))
                           echo '&pound;'.$sale_summ;
?></span></p>
                    <input type="hidden" name="sale_summ" id="ss-pp" value="<?php
                if (isset($sale_summ_pp))
                    echo $sale_summ_pp;
?>" />
                </div>
                <div <?php echo $margin; ?>>
                    <input type="button" class="submit" style="font-size: 18px;" value='CLICK HERE TO BOOK WITH THIS OPTION' onclick="submitForm(2);" />
                </div>
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
        </div>
    </div>






    <!--End containt area holder -->
</div>
<div id="modal_block_hidden"></div>
<div id="modal_block"></div>