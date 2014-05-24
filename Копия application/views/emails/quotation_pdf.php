<html>
	<head>
		<style>
			* {}
			body { width: 1000px; background: url('/images/pdf-header.png') no-repeat center top; margin: 0px; padding: 0px; font-size: 12px; font-family: Arial; line-height: 15px; color: #000;  }
			html { margin: 0px; padding: 0px; font-size: 12px; font-family: Arial; line-height: 15px; color: #000; }
			p { margin: 0px; padding: 0px; }
		</style>
	</head>
    <body>
		<div style="width: 1000px; height: 245px;">&nbsp;</div>
		<h1 style='text-align: right; font-size: 16px;'>FLOORSAND RESIDENTIAL</h1>
        <p style='text-align: right;'>487 Bury New Road, Prestwich, Manchester, M25 1AD</p>
        <p style='text-align: right;'>Tel: 01625 582567</p>
        <p style='text-align: right;'>&nbsp;</p>
        <p style='text-align: right;'>Email: <a href='mailto:sales@floorsanduk.com'>sales@floorsanduk.com</a></p>
        <p style='text-align: right;'>Web: <a href='http://www.floorsanduk.com'>www.floorsanduk.com</a></p>
        <p style='text-align: right;'>&nbsp;</p>

		<p><?php echo $quotation->name; ?></p>
		<p><?php echo $quotation->address; ?></p>
		<p><?php echo $quotation->town; ?></p>
		<p><?php echo $quotation->postcode; ?></p>
		<p><?php echo date("m/d/Y");?></p>
		<h1 style='text-align: center;'>QUOTATION</h1>
		<p>&nbsp;</p>
		<p>Dear <?php echo $quotation->name; ?>,</p>
		<p>&nbsp;</p>
		<p><strong>Re: Your Flooring Requirements – <?php echo $quotation->address; ?></strong></p>
		<p>&nbsp;</p>
		<p>Please find outlined below our costs for the work recently discussed: </p>
		<p>&nbsp;</p>
		<p><strong>Sanding down & coating existing flooring with commercial grade lacquer in the following areas:</strong></p>

                <ol>
                    <?php
$rooms_settings = unserialize($quotation->rooms_settings);
?>
<?php if ($quotation->room_dimentions == "feet"): ?>
    <?php for ($i = 1; $i <= $quotation->rooms_count; $i++): ?>
<li>Width <?=$rooms_settings['room_w'][$i]; ?> Feet <?php echo $rooms_settings['room_w_i'][$i]; ?> Inches x Length <?=$rooms_settings['room_l'][$i]; ?> Feet <?php echo $rooms_settings['room_l_i'][$i]; ?> Inches = <?=$rooms_settings['total_sq'][$i]; ?> Total Sq Feet (Price &pound; <?=$rooms_settings['price'][$i]; ?>)</li>
    <?php endfor; ?>
<?php else: ?>
<?php for ($i = 1; $i <= $quotation->rooms_count; $i++): ?>
<li>Width <?=$rooms_settings['room_w'][$i]; ?> Metres x Length <?=$rooms_settings['room_l'][$i]; ?> Metres = <?=$rooms_settings['total_sq'][$i]; ?> Total Sq Metres (Price &pound; <?=$rooms_settings['price'][$i]; ?>)</li>
    <?php endfor; ?>
<?php endif;?>
                </ol>
		<p>&nbsp;</p>
        <p><u><strong>Total price for job:</strong> <?php echo $quotation->total_price_for_job; ?></u></p>

<!--<p><strong>Potential Start Date: INSERT NEXT AVAILABLE DATE.</strong></p>-->
<p><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/online-quotation/index/<?php echo $quotation->link; ?>">Check your quotation</a></p>
<p>&nbsp;</p>
<p>We trust the above is acceptable and look forward to hearing from you.  Should you have any queries, please do not hesitate to contact us.</p>
<p>&nbsp;</p>
<p>Kind regards, </p>
<p>&nbsp;</p>
<p>Yours sincerely,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Lucy Wilkinson</strong></p>
</body>
</html>
