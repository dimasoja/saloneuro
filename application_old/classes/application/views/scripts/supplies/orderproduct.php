<div id="inside_container">
    <h1 class="trade-price"><span>FloorSand UK</span> Unbeatable Trade Busting Prices</h1>
    <p class="fontsize18" style="padding-left:30px; font-size:25px;">
        <strong>Click each tab for great prices on abrasives, adhesives,<br /> 
tools, machinery and miscellaneous items</strong><br />
        <strong>Click the <a href="#" title="Click Here"><img src="<?php echo URL::base(); ?>images/i-prod.jpg" alt="" /></a> button for more information about each FloorSand UK product</strong><br />
    </p>
    <p class="fontsize18" style="padding-left: 30px; font-weight: bold;">
                All prices are subject to VAT @ 20%
    </p>
    <div id="order-supplies-main">
        <div class="order-supplies-tab">
            <ul id="countrytabs">
                <li><a class="selected tabclass" href="javascript:void(0);" onclick="tabIt(this, 'abrasives');">CLEANING &<br/>MAINTENANCE</a></li>
                <li><a class="tabclass" href="javascript:void(0);" onclick="tabIt(this, 'varnishes');">LACQUERS,<br/>PRIMERS & STAINS</a></li>
                <li><a class="tabclass" href="javascript:void(0);" onclick="tabIt(this, 'tools');">ADHESIVES<br /> & FILLERS</a></li>
                <li class="spacing1"><a class="tabclass" href="javascript:void(0);" onclick="tabIt(this, 'miscellaneous');">MISCELLANEOUS</a></li>
            </ul>
        </div>
        <div class="order-supplies-tab-con-main">
            <div class="order-supplies-tab-con-main1">
                <div id="supplies_container">
                </div>
            </div>
        </div>
        <div class="pro-bot">
            <div class="pro-bot-in">
                <div class="val-lt">
                    <div style="float: left; width: 370px;">
                    <ul id="basket_ul">
                    </ul>
                    <div style="text-align: right;height:25px; float: left; width: 370px; color: #000; padding-left: 10px; font-size: 20px; font-weight: bold; border-top: 2px solid #000;">
                        Total price: &nbsp;<span style="color: #FF6418; font-size: 22px; font-weight: bold;">&pound;<span id="total_prc">0.00</span></span>
                    </div> 
                    </div>
                    <div style="float: right">
                    <div class="val-lt-left">
                        <p>PLEASE CHECK YOUR BASKET AND PROCEED TO CHECK OUT.</p>
                        <a href="javascript:void(0);" title="Check Out" onclick="submitFrm();"><img src="<?php echo URL::base(); ?>images/chk-out.jpg" alt="Check Out" /></a>
                    </div>
                    </div>
                </div>
                <div class="add-rt">
                    <ul>
                        <li><a href="#" title="FSUK Gold Shield Guarantee"><img src="<?php echo URL::base(); ?>images/gold-shield.jpg" alt="FSUK Gold Shield Guarantee" /></a></li>
                        <li><a href="#" title="FSUK Green Shield Guarantee"><img src="<?php echo URL::base(); ?>images/green-shield.jpg" alt="FSUK Green Shield Guarantee" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="submit_frm" method="post" action="<?php echo URL::base(); ?>order-supplies-checkout">
    <input type="hidden" id="supplies_arr" name="supplies_arr" value="" />
    <input type="hidden" id="auto_send" name="auto_send" value="" />
</form>