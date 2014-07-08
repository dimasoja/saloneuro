<?php 
    $month_number = date("n");
    $year = date("Y");
    $datepick = 1;
?>

    <h1 style="padding-left:35px;">Booking Schedule</h1>
    <div id="booking-main">
    	<h2>The next available dates in your area are as follows:</h2>
        <div style="overflow: scroll;; height: 235px">
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
    </div>
<script type="text/javascript">
function checkDate(day,month,year, input) {
    img = jQuery('#img_'+day+month+year).parent();
    checkbox = jQuery('#check_'+day+month+year);
    image_rel = img.attr('rel');
    //check image
    if(input=='img') {
        if(image_rel=='busy') {
            img.attr('rel','free');           
            jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/green-mark.gif');
       } else {
            img.attr('rel','busy');            
            jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/close-icon.gif');           
        }
    } else {
        
    }
    //check images for ajax
    if(img.attr('rel')=='busy') {
        type='busy';
        booked_mess = 'booked';
    } else {
        type='free';
        booked_mess = '';
    }
    //check checkbox for ajax
    if(checkbox.attr('checked')=='checked') {
        partial = 'yes';
        partial_mess = '(half)';
    } else {
        partial = 'no';
        partial_mess = '';
    }
    //send ajax
    jQuery.post(baseurl + 'admin/maintenance/checkdate', {
        d: day, 
        m: month, 
        y: year, 
        checked:partial,
        idm:'0',
        type:type,
        s1: 1
    }, function(data) {
        if ("1" == data) {
            if((partial=='no') && (type=='free')) { 
                jQuery('.d' + day + month + year).remove();
            } else {
                jQuery('.d' + day + month + year).remove();
                var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+booked_mess + " " + partial_mess + " <a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
                jQuery('#work_dates').append(newdata);
            }
        }
    });
    //remove date if yes
    if((partial=='no') && (type=='free')) removeDate(day, month, year);
}
</script>