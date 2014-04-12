<?php 
    $month_number = date("n");
    $year = date("Y");
?>
<div id="inside_container">
    <h1 style="padding-left:35px;">Booking Schedule</h1>
    <h2 style="padding-left:35px;">Please select your preferred day, if you would like to proceed. The number of days required for your works will be selected automatically.</h2>
    <div style="margin: 10px auto; width: 835px; font-size: 15px;">
        If you require your work to be carried out on a Saturday or Sunday or if your work is likely to use a Saturday or Sunday, please tick the boxes but note that weekend work is subject to confirmation.
    </div>
    <div id="booking-main">
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
                    if (in_array(mktime(0,0,0,$month_number, $j, $year), $dates) || mktime(23,59,59,$month_number, $j, $year) < time()) {
                        echo "<span><img src=\"" . URL::base() . "images/close-icon.gif\" width=\"27\" height=\"24\" alt=\"\" /></span>";
                    } else {
                        echo "<span><a href=\"javascript:void(0);\" onclick='checkDate(" . $j . ", " . $month_number . ", " . $year . ")'><img src=\"" . URL::base() . "images/green-mark.gif\" width=\"27\" height=\"24\" alt=\"\" /></a></span>";
                    }
                    if (date("D", mktime(0,0,0,$month_number, $j, $year)) == "Sat" || date("D", mktime(0,0,0,$month_number, $j, $year)) == "Sun") echo "<center>on req.</center>";
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
    <form method="post" action="<?php echo URL::base(); ?>booking-shedule/add">
        <br />
    <div style="margin: 0 auto; width: 835px; font-size: 18px;">
        
        <span style="color: #FF8000; font-weight: bold;">Further option 1:</span> On occasion, reservations are cancelled or postponed.
        We have a Cancellations List and we can add you to this list, should you wish to take advantage of a possible earlier date.
        Please note that these dates may only allow short notice.
        If you would like to opt in for this, please tick here. <strong>YES</strong> <input type="checkbox" name="further_option_1" value="yes" />
        <br />
        <br />
        <span style="color: #FF8000; font-weight: bold;">Further Option 2:</span> The above time allocation is based upon an ideal period of time for us to complete works for you.
        In  certain circumstances, works can be completed sooner – this is usually satisfied by using multiple machines/workers.  
        We review each job based upon the individual details to determine whether this is feasible.  
        Would you like to opt in for this option? <strong>YES</strong> <input type="checkbox" name="further_option_2" value="yes" />
    </div>
	<div id="enter-date-div">
            
            
            <ul>
            	<li class="enterd">The date entered:</li>
                <li>
                    <input type="text" id="day" value="" class="date" disabled="disabled" />
                    <input type="hidden" name="day" value="" id="dayh" />
                </li>
                <li>
                    <input type="text" id="month" value="" class="date" disabled="disabled" />
                    <input type="hidden" name="month" value="" id="monthh" />
                </li>
                <li>
                    <input type="text" id="year" value="" class="year" disabled="disabled" />
                    <input type="hidden" name="year" value="" id="yearh" />
                </li>
                <li><input type="submit" name="" value="ACCEPT & BOOK" class="book" /></li>
            </ul>
            </form>
        </div>
    
   </div>
<script type="text/javascript">
    function checkDate(day, month, year) {
        jQuery('#day').val(day);
        jQuery('#dayh').val(day);
        jQuery('#month').val(month);
        jQuery('#monthh').val(month);
        jQuery('#year').val(year);
        jQuery('#yearh').val(year);
    }
</script>