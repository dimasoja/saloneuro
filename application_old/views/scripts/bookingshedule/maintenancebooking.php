<?php  
   $month_number = date("n");
    $year = date("Y");
    $datepick = 1;
?>
    <div id="booking-main" style="margin: 0 auto;">
        <a href="javascript:void(0);" onclick="closeSubmitForm();" style="float: right; margin-right: 10px; margin-top: 10px; color: #000; font-size: 14px;">Close[X]</a>
        <div class="clear"></div>
    	<h2>The next available dates in your area are as follows:</h2>
        <center style="font-size: 18px; color: #000;">Scroll across and/or down for further dates</center>
        <div style="overflow: scroll; height: 235px">
        <table cellpadding="0" cellspacing="0" class="calendar_table">
            <?php 
            for ($i=0; $i<12; $i++) {
                $month = date("F", mktime(0, 0, 0, $month_number, 1, $year));
                $days = date('t', mktime(0, 0, 0, $month_number, 1, $year));
                ?>
            <tr>
                <td class="month"><?php echo $month; ?></td>
            <?php
                for ($j = 1; $j <= $days; $j++) {
                    echo "<td class='days'>";
                    echo $j . " (" . date("D", mktime(0,0,0,$month_number, $j, $year)) . ")";
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
                        echo "<span><a href=\"javascript:void(0);\" onclick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"img\")' rel=\"busy\"><img id=\"img_" . $j . $month_number . $year . "\" src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></a></span>";
                        echo "<input type='checkbox' id=\"check_" . $j . $month_number . $year . "\" onClick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"checkbox\")' rel=\"busy\" ".$half." style='margin-left:3px;float: left'/><div style='margin-top:4px; float: left'>half</div>";
                    } else {
                        echo "<span><a href=\"javascript:void(0);\" onclick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"img\")' rel=\"free\"><img id=\"img_" . $j . $month_number . $year . "\" src=\"" . URL::base() . "images/green-mark.gif\" width=\"27\" height=\"24\" alt=\"\" /></a></span>";
                        echo "<input type='checkbox' id=\"check_" . $j . $month_number . $year . "\" onclick='checkDate(" . $j . ", " . $month_number . ", " . $year . ", \"checkbox\")' rel=\"free\"  ".$half." style='margin-left:3px;float: left;'/><div style='margin-top:4px; float: left'>half</div>";
                    }
                    //if (date("D", mktime(0,0,0,$month_number_, $j, $year_)) == "Sat" || date("D", mktime(0,0,0,$month_number_, $j, $year_)) == "Sun") echo "<center>on req.</center>";
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
        <input type="button" class="submit" value="OK" onclick="closeSubmitForm()" />
    </div>