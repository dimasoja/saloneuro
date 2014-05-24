<html>
	<head>
		<style>
		#href {
			background: url(http://floorsanduk.com/images/attach-photo-bg.jpg) left top repeat-x;
			padding-left: 15px;
			padding-right: 15px; 
			padding-top: 10px;
			padding-bottom: 10px;
			text-decoration: none;
			font-size: 19px;
			color: black;
			line-height: 20px;
			height: 38px;
			border: 0px;
			cursor: pointer;
			font-weight: bold;
			-webkit-box-align: center;
		}
		</style>
	</head>
    <body>
        <img src="http://floorsanduk.com/images/quotation-email.jpg" alt="FloorSand Uk" /><br/><br/>
        Hello <?php echo $quotation->name; ?>,<br/><br/>
        Many thanks for your enquiry - I've attached our quote to this email, for your consideration. All our lacquers are commercial grade,
        providing excellent protection against wear and tear.<br/><br/>
        If there are any areas where you indicated 'Not Sure', these are included in the 'Additional / Optional Works' section at the bottom of the quote.<br/><br/>
        In terms of availability we have <?php echo date('D, j F Y', $available_date); ?> available if that is convenient for you.<br/><br/>
        We look forward to discussing with you but, in the meantime, if you have any queries please just give me a call.<br/><br/><br/>
        <a id='href' href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/online-quotation/index/<?php echo $quotation->link; ?>" style="
           background: url(http://floorsanduk.com/images/attach-photo-bg.jpg) left top repeat-x;
padding: 9px 20px 9px 20px;
font-size: 19px;
color: black !important;
text-decoration: none;
line-height: 20px;
height: 38px;
border: 0px;
cursor: pointer;
font-weight: bold;">Make Booking</a>
		<br/><br/><br/>
		Kind regards, <br/><br/>
        <b>Lucy Wilkinson<br/>
        FloorSand Uk Ltd<br/>
        01625 582567
        </b>
    </body>
</html>

<!--html>
    <body>
        <p>
            Hello, <?php echo $quotation->name; ?>
        </p>
        <?php if (isset($is_admin)): ?>
            <p>
                FloorSandUK administrator has changed your quotation:
            </p>
        <?php endif; ?>
        <ul>
            <li><strong>First Name:</strong> <?php echo $quotation->name; ?></li>
            <li><strong>Last Name:</strong> <?php echo $quotation->surname; ?></li>
            <li><strong>Email:</strong> <?php echo $quotation->email; ?></li>
            <li><strong>Address:</strong> <?php echo $quotation->address; ?></li>
            <li><strong>Town:</strong> <?php echo $quotation->town; ?></li>
            <li><strong>Postcode:</strong> <?php echo $quotation->postcode; ?></li>
            <li><strong>Telephone number:</strong> <?php echo $quotation->phone; ?></li>
            <li><strong>Mobile number:</strong> <?php echo $quotation->mphone; ?></li>
            <li><strong>Alternative address:</strong> <?php echo $quotation->alternative_address; ?></li>
            <li><strong>Alternative town:</strong> <?php echo $quotation->alternative_town; ?></li>
            <li><strong>Alternative postcode:</strong> <?php echo $quotation->alternative_postcode; ?></li>
            <li><strong>What type of flooring do you have:</strong> <?php echo $quotation->area_type; ?></li>
            <li><strong>Do you require staining:</strong> <?php echo $quotation->staining_area; ?></li>
            <li><strong>Do you require carpet lift & removal:</strong> <?php echo $quotation->lift_removal; ?></li>
            <li><strong>Do you require gap filling:</strong> <?php echo $quotation->gap_filling; ?></li>
            <?php if (isset($quotation->which_finish) && $quotation->which_finish != 'none'): ?>
                <li><strong>Which finish would you like:</strong> <?php echo $quotation->which_finish; ?></li>
            <?php endif; ?>
            <li><strong>How did you find out about us:</strong> <?php echo $quotation->find_about_us; ?></li>
            <li><strong>Are your room measurements in</strong> <?php echo $quotation->room_dimentions; ?></li>
            <li><strong>How many rooms:</strong> <?php echo $quotation->rooms_count; ?></li>
            <li>
                Rooms:
                <ol>
                    <?php
                    $rooms_settings = unserialize($quotation->rooms_settings);
                    ?>
                    <?php if ($quotation->room_dimentions == "feet"): ?>
                        <?php for ($i = 1; $i <= $quotation->rooms_count; $i++): ?>
                            <li>Width <?= $rooms_settings['room_w'][$i]; ?> Feet <?php echo $rooms_settings['room_w_i'][$i]; ?> Inches x Length <?= $rooms_settings['room_l'][$i]; ?> Feet <?php echo $rooms_settings['room_l_i'][$i]; ?> Inches = <?= $rooms_settings['total_sq'][$i]; ?> Total Sq Feet (Price &pound; <?= $rooms_settings['price'][$i]; ?>)</li>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= $quotation->rooms_count; $i++): ?>
                            <li>Width <?= $rooms_settings['room_w'][$i]; ?> Metres x Length <?= $rooms_settings['room_l'][$i]; ?> Metres = <?= $rooms_settings['total_sq'][$i]; ?> Total Sq Metres (Price &pound; <?= $rooms_settings['price'][$i]; ?>)</li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ol>
            </li>
            <li><strong>Total price for job:</strong> <?php echo $quotation->total_price_for_job; ?></li>
            <li><strong>Price:</strong> <?php echo $quotation->payment; ?></li>
        </ul>
        <p><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/online-quotation/index/<?php echo $quotation->link; ?>">Check your quotation</a></p>
        <p>
            This e-mail was sent automatically from <a href="http://floorsanduk.com">http://floorsanduk.com</a>
        </p>
    </body>
</html-->