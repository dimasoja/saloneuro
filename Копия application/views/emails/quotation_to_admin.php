<html>
    <body>
        <img src="http://floorsanduk.com/images/quotation-email.jpg" alt="FloorSand Uk" /><br/><br/>
        <h3>FloorSandUk: New Online Quotation Notification</h3><br/>
        Please, visit http://<?php echo $_SERVER['HTTP_HOST']; ?>/admin/quotation/details/<?=$quotation->id_quotation;?> to check the details.
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