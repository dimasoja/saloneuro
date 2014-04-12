<?php 
    $month_number = date("n");
    $year = date("Y");
    $datepick = 1;
?>
    <div id="booking-main" style="margin: 0 auto;">
        <a href="javascript:void(0);" onclick="closeSubmitForm();" style="float: right; margin-right: 10px; margin-top: 10px; color: #000; font-size: 14px;">Close[X]</a>
        <div class="clear"></div>
    	<h2>The next available dates in your area are as follows:</h2>
        <h3 style="margin: -15px 0 15px 16px;">Please select your preferred day, if you would like to proceed. The number of days required for your works will be selected automatically.</h3>
        <div style="margin: -10px 0 5px 16px; font-size: 12px;">If you require your work to be carried out on a Saturday or Sunday or if your work is likely to use a Saturday or Sunday, please tick the boxes but note that weekend work is subject to confirmation.</div>
        <center style="font-size: 18px; color: #000;">Scroll across and/or down for further dates</center>
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
                            echo "<td class='days'>";
                            echo $j . " (" . date("D", mktime(0, 0, 0, $month_number, $j, $year)) . ")";
                            $is_cont = true;
                            for ($k = 0; $k < $datepick; $k++) {
                                $month_number_ = $month_number;
                                $year_ = $year;
                                $d = $j + $k;
                                if ($d > $days) {
                                    $d = $d - $days;
                                    $month_number_++;
                                    if ($month_number_ > 12) {
                                        $month_number_ = 1;
                                        $year_++;
                                    }
                                }
                                if (in_array(mktime(0, 0, 0, $month_number_, $d, $year_), $dates) || mktime(23, 59, 59, $month_number_, $d, $year_) < time()) {
                                    $is_cont = false; 
                                }  
                                if(in_array(mktime(0, 0, 0, $month_number_, $d, $year_),$partials)) {
                                    $half = 'checked="checked"';
                                } else {
                                    $half = '';
                                }
                                if(isset($types[(string)mktime(0, 0, 0, $month_number_, $d, $year_)])) 
                                    $check_type = $types[(string)mktime(0, 0, 0, $month_number_, $d, $year_)];
                                if((isset($check_type)) and ($check_type=='free')) {
                                    $is_cont = true; $rel = 'free';
                                } else {
                                    $rel = 'busy';
                                }
                            }
                            if (!$is_cont) {
                                echo "<span><img id='image".$im."' src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></span>";
                                echo "<input type='checkbox' id=\"check_" . $j . $month_number . $year . "\" onClick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"checkbox\")' rel=\"busy\" ".$half." style='margin-left:3px;float: left' disabled/><div style='margin-top:4px; float: left'>half</div>";
                            } else {
                                 $imagesToChange = "";
                                 for ($it=0; $it < $datepick; $it++) {
                                    $imit = $im + $it;
                                    $imagesToChange .= "image" . $imit . "," ;
                                }
                                echo "<span><a href=\"javascript:void(0);\" onclick='chooseDate(" . $j . ", " . $month_number . ", " . $year . ", \"" . $imagesToChange . "\")'><img id='image" . $im . "' src=\"" . URL::base() . "images/green-mark.gif\" width=\"27\" height=\"24\" alt=\"\" /></a></span>";
                                echo "<input type='checkbox' id=\"check_" . $j . $month_number . $year . "\" onclick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"checkbox\")' rel=\"free\"  ".$half." style='margin-left:3px;float: left;' disabled/><div style='margin-top:4px; float: left'>half</div>";
                            }                            
//                            if (in_array(mktime(0, 0, 0, $month_number, $j, $year), $dates) || mktime(23, 59, 59, $month_number, $j, $year) < time()) {
//                                echo "<span><img id='image".$im."' src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></span>";
//                            } else {
//                                $imagesToChange = "";
//                                for ($it=0; $it < $datepick; $it++) {
//                                    $imit = $im + $it;
//                                    $imagesToChange .= "image" . $imit . "," ;
//                                }
//                                echo "<span><a href=\"javascript:void(0);\" onclick='chooseDate(" . $j . ", " . $month_number . ", " . $year . ", \"" . $imagesToChange . "\")'><img id='image" . $im . "' src=\"" . URL::base() . "images/green-mark.gif\" width=\"27\" height=\"24\" alt=\"\" /></a></span>";
//                            }
//                            $im++;                          

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
<div style="margin: 10px auto; width: 815px; font-size: 18px; background-color: #000; padding: 10px; color: #fff">
        <span style="color: #FF8000; font-weight: bold;">Further option 1:</span> On occasion, reservations are cancelled or postponed.
        We have a Cancellations List and we can add you to this list, should you wish to take advantage of a possible earlier date.
        Please note that these dates may only allow short notice.
        If you would like to opt in for this, please tick here. <strong>YES</strong> <input id="fo1" type="checkbox" name="further_option_1" value="yes"<?php if (isset($fu1) && $fu1 == "yes") echo "checked=\"checked\""; ?> />
        <br />
        <br />
        <span style="color: #FF8000; font-weight: bold;">Further Option 2:</span> The above time allocation is based upon an ideal period of time for us to complete works for you.
        In  certain circumstances, works can be completed sooner – this is usually satisfied by using multiple machines/workers.  
        We review each job based upon the individual details to determine whether this is feasible.  
        Would you like to opt in for this option? <strong>YES</strong> <input id="fo2" type="checkbox" name="further_option_2" value="yes"<?php if (isset($fu2) && $fu2 == "yes") echo "checked=\"checked\""; ?> />
    </div>


