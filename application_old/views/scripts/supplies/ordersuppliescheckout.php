<?php $total_price = 0; ?>
<script type="text/javascript">
<?php
    foreach ($settings as $key => $val) {
        echo "var " . $key . ' = ' . $val . ";\n";
    }
?>
</script>
	
<script>
	jQuery("#progress_bar").attr( "src", "/images/buy_sup_step2.png"  );
	jQuery("#progress_bar").css( "top", "80px"  );
	jQuery("#progress_bar").css( "height", "80px"  );
</script>
<form method="post" action="/checkout">
<input type="text" style="display:none;" value="from_suplice" name="kto_ti_uasya">
<div id="inside_container">
    <h1 style="padding-left:35px; font-size:37px;">Review your order</h1>
    <p style="padding-left:35px; font-size:18.2px;">Please review details of your order below. Then click the ‘PLACE ORDER’ button to make your booking.</p>
    <div id="busting-checkout">
        <div id="discription-main">
            <ul>
                <li class="dis">Discription</li>
                <li class="pro">Product Code</li>
                <li class="pri">Price</li>
                <li class="quan">Quantity</li>
                <li class="remove">Remove Item</li>
                <li class="che-total">Total</li>
            </ul>
        </div>
        <div id="discription-sub1">
            <div id="discription-sub2">
                <input type="hidden" name="id_user" value="" />
                <input type="hidden" name="auto_send" value="<?php echo $auto_send; ?>" />
                <?php if (!empty($supplies_arr)): ?>
                <?php foreach ($supplies_arr as $key => $supply): ?>
                <ul id="ul_supply_<?php echo $key; ?>">
                    <li class="dis"><?php echo $supply->title; ?></li>
                    <li class="pro"><?php echo (empty($supply->code) || !isset($supply->code)) ? "&nbsp" : $supply->code; ?></li>
                    <li class="pri"><?php echo number_format($supply->price, 2); ?></li>
                    <li class="quan">
                        <?php echo $supply->cnt; ?>
                        <input type="hidden" name="supplies[<?php echo $key; ?>][quantity]" value="<?php echo $supply->cnt; ?>" />
                    </li>
                    <li class="remove"><input type="checkbox" name="" value="<?php echo $key; ?>" class="pro-remove" /></li>
                    <?php 
                        $total = $supply->price * $supply->cnt; 
                        $total_price += $total;
                    ?>
                    <li class="che-total">
                        <?php echo "&pound; "; echo number_format($total,2); ?>
                        <input type="hidden" name="supplies[<?php echo $key; ?>][total_price]" class="total_che" value="<?php printf("%.2f" , $total); ?>" />
                    </li>
                </ul>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div style="width: 705px; color: #000; font-size: 18px; font-weight: bold; text-align: right; border-right: 2px solid #FF6819; padding: 5px;float: left;">
            Sub-total                
            </div>
            <div id="total_delivery" style="color: #000; font-size: 18px; text-align: center; padding: 5px; font-weight: bold;">&pound;<?php printf("%.2f", $total_price); ?></div>
            <div style="width: 705px; height: 40px; color: #000; font-size: 14px; font-weight: bold; text-align: right; border-right: 2px solid #FF6819; padding: 5px;float: left; background-color: #fff; border-bottom: 3px solid #FF6819;">
            <span id="delivery_text">Next day delivery (between 8am - 6pm)</span><br />
            <span style="font-style: italic; font-weight: normal;">
                If you would like an alternative delivery option, please select from the options below
            </span>
            </div>
            <div style="color: #000; height: 40px; font-size: 18px; text-align: center; padding: 5px; font-weight: bold; background-color: #fff; border-bottom: 3px solid #FF6819;">
                &pound;<span id="delivery_options"><?php $delivery = ($total_price < 150) ? $settings['fs_next_day_1'] : "0"; printf("%.2f", $delivery); ?></span>
            </div>
            <div style="width: 705px; height: 20px; color: #000; font-size: 18px; font-weight: bold; text-align: right; border-right: 2px solid #FF6819; padding: 5px;float: left; background-color: #fff; border-bottom: 3px solid #FF6819;">
                VAT @ 20%
            </div>
            <div style="color: #000; height: 20px; font-size: 18px; text-align: center; padding: 5px; font-weight: bold; background-color: #fff; border-bottom: 3px solid #FF6819;">
                &pound;<span id="vat"><?php
                $do = 0;
                if ($total_price < 150) {
                    $do = $settings['fs_next_day_1'];
                }
                $vat = ($total_price + $do) * 20 / 100;
                printf("%.2f", $vat);
                ?></span>
            </div>
            <div style="width: 705px; height: 20px; color: #000; font-size: 18px; font-weight: bold; text-align: right; border-right: 2px solid #FF6819; padding: 5px;float: left; background-color: #fff; border-bottom: 3px solid #FF6819;">
                TOTAL
            </div>
            <div style="color: #000; height: 20px; font-size: 18px; text-align: center; padding: 5px; font-weight: bold; background-color: #fff; border-bottom: 3px solid #FF6819;">
                &pound;<span id="total"><?php
                $ttl = $total_price + $delivery + $vat;
                printf("%.2f", $ttl);
                ?></span>
            </div>
        </div>
        <div id="delivery-option-main">
            <div id="delivery-option-sub1">
                <h2>Delivery Options</h2>
                <div class="process">
                    Please check<br />required option
                </div>
                <ul>
                    <li class="nextday">Next Day Delivery (between 8am - 6pm) ........................	£<?php echo $settings['fs_next_day_1']; ?></li>
                    <li><input type="radio" name="delivery_options" value="1" checked="checked" /></li>
                    <li class="nextday">Next Day Delivery before 12 noon .................................	£<?php echo $settings['fs_next_day_2']; ?></li>
                    <li><input type="radio" name="delivery_options" value="2" /></li>
                    <li class="nextday">Next Day Delivery before 10:30am .................................	£<?php echo $settings['fs_next_day_3']; ?></li>
                    <li><input type="radio" name="delivery_options" value="3" /></li>
                </ul>
                <p>Above times are based on orders being made by 2.30pm</p>
            </div>
            <div id="check-basket">
                <p>PLEASE CAREFULLY CHECK YOUR BASKET AS ONCE YOU PLACE YOUR ORDER THE PROCESS CANNOT BE REVERSED</p>
                <div id="checkout-card">
                    <ul>
                        <li><img src="<?php echo URL::base(); ?>images/card.gif" width="317" height="44" alt="" /></li>
                        <li><img src="<?php echo URL::base(); ?>images/american-express.jpg" alt="" height="41" /></li>
                    </ul>
                </div>
                <div id="checkout-button"><a href="<?php echo URL::base(); ?>order-supplies-product" class="checkout-back-button"></a> <input type="submit" name="" value="PLACE ORDER" class="checkout-placeorder-button" /></div>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" name="total_val" id="total_val" value="<?php printf("%.2f", $ttl); ?>" />
</form>
<script type="text/javascript">
    var total_delivery = <?php printf("%.2f", $total_price); ?>;
    function calculateThis() {
        var ttl = 0;
        jQuery('.total_che').each(function() {
            ttl += parseFloat(jQuery(this).val());
        });
        var strPrice = ttl.toString();
        total_delivery = ttl;
        jQuery('#total_delivery').html("&pound;" + Number(ttl).toPrecision( ((-1 != strPrice.indexOf('.')) ? strPrice.indexOf('.') : strPrice.length) + 2 ));
        
        var delivery_options = parseFloat(jQuery('#delivery_options').html());
        var vat = (ttl + delivery_options) * 20 / 100;
        var strVat = vat.toString();
        jQuery('#vat').html(Number(vat).toPrecision( ((-1 != strVat.indexOf('.')) ? strVat.indexOf('.') : strVat.length) + 2 ));
        
        var total = ttl + delivery_options + vat;
        var strTotal = total.toString();
        jQuery('#total').html(Number(total).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
        jQuery('#total_val').val(Number(total).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
    }
    
    jQuery('.pro-remove').live('change', function() {
        if (jQuery(this).is(':checked')) {
            if (confirm('Do you really want to delete this item?')) {
                jQuery('#ul_supply_' + jQuery(this).val()).remove();
            } else {
                jQuery(this).removeAttr('checked');
            }
        }
        
        calculateThis();
    });
    jQuery('input[name=delivery_options]').live('change', function() {
        var subtotal;
        switch (this.value) {
            case "1":
                if (parseFloat(total_delivery) < 150) {
                    subtotal = fs_next_day_1;
                } else {
                    subtotal = 0;
                }
                jQuery('#delivery_text').html("Next day delivery (between 8am - 6pm)");
                break;
            case "2":
                subtotal = fs_next_day_2;
                jQuery('#delivery_text').html("Next day delivery before 12 noon");
                break;
            case "3":
                subtotal = fs_next_day_3;
                jQuery('#delivery_text').html("Next day delivery before 10:30am");
                break;
        }
        var strSubtotal = subtotal.toString();
        jQuery('#delivery_options').html(Number(subtotal).toPrecision( ((-1 != strSubtotal.indexOf('.')) ? strSubtotal.indexOf('.') : strSubtotal.length) + 2 ));
        calculateThis();
    })
</script>