<?php echo ViewMessage::renderMessages();
$total = 0; ?>
<script type="text/javascript">
<?php
foreach ($settings as $key => $val) {
    echo "var " . $key . ' = ' . $val . ";\n";
}
?>
</script>
<h1>Supplies Order Details</h1>
<?php if (!empty($info)): ?>
    <ul class="user-details">
        <li><strong>First Name:</strong> <?php echo $info['name']; ?></li>
        <li><strong>Last Name:</strong> <?php echo $info['surname']; ?></li>
        <li><strong>Email:</strong> <?php echo $info['email']; ?></li>
        <li><strong>Company:</strong> <?php echo $info['company']; ?></li>
        <li><strong>Address:</strong> <?php echo $info['address']; ?></li>
        <li><strong>Town:</strong> <?php echo $info['town']; ?></li>
        <li><strong>Postcode:</strong> <?php echo $info['postcode']; ?></li>
        <li><strong>Landline tel. no.:</strong> <?php echo $info['phone']; ?></li>
        <li><strong>Mobile tel. no.:</strong> <?php echo $info['mphone']; ?></li>
        <li><strong>Special Notes:</strong><?php echo $info['special_notes']; ?></li>
        <?php if ($info['auto_send'] != "none"): ?>
            <li><strong>Automatically send:</strong> Every <?php echo $info['auto_send']; ?></li>
        <?php endif; ?>
        <li><strong>Payment status: </strong> <?php echo ($info['payment_status']) ? "<span style='color: #27f611;'>yes</span>" : "<span style='color: #cd0100;'>no</span>"; ?></li>
    </ul>
    <?php if (!empty($info['supplies'])): ?>
        <table cellpadding="0" cellspacing="0" id="adm_users">
            <tr>
                <th width="100">Product code</th>
                <th>Title</th>
                <th>Type</th>
                <th>Price</th>
                <th width="100">Quantity</th>
                <th width="150" align="center">Total price</th>
            </tr>
            <?php
            $supplies = json_decode($info['supplies']);
            foreach ((array)$supplies as $key => $val) {
                $supply = ORM::factory('supplies')->where('id_supplies', '=', $key)->find();
                ?>
                <tr>
                    <td align="center"><?php echo $supply->code; ?></td>
                    <td><?php echo $supply->title; ?></td>
                    <td><?php echo $supply->type_column; ?></td>
                    <td><?php echo number_format($supply->price, 2, '.', ''); ?></td>
                    <td><?php echo $val->cnt; ?></td>
                    <td>&pound;<?php echo number_format(($val->cnt * $supply->price), 2, '.', '');
            $total += $val->cnt * $supply->price; ?></td>
                </tr>
                    <?php } ?>
            <tr>
                <td colspan="5" align="right"><h2>Sub Total:</h2></td>
                <td><h2>&pound;<?php echo number_format($total, 2, '.', ''); ?></h2></td>
            </tr>
            <tr>
                <td colspan="5" align="right">
                    <strong>
        <?php
        switch ($info['delivery_options']) {
            case "1":
                echo "Next Day Delivery (between 8am - 6pm)";
                break;
            case "2":
                echo "Next Day Delivery before 12 noon";
                break;
            case "3":
                echo "Next Day Delivery before 10:30am";
                break;
        }
        ?>
                    </strong>
                </td>
                <td>
                    <h2>&pound;
        <?php
        switch ($info['delivery_options']) {
            case "1":
                if ($total < 150) {
                    echo $settings['fs_next_day_1'];
                    $delop = $settings['fs_next_day_1'];
                } else {
                    echo "0";
                    $delop = 0;
                }
                break;
            case "2":
                echo $settings['fs_next_day_2'];
                $delop = $settings['fs_next_day_2'];
                break;
            case "3":
                echo $settings['fs_next_day_3'];
                $delop = $settings['fs_next_day_3'];
                break;
        }
        ?>
                    </h2>
                </td>
            </tr>
            <tr>
                <td colspan="5" align="right">
                    <h2>VAT @ 20%</h2>
                </td>
                <td>
                    <h2>&pound;
        <?php
        $ttl = ($total + $delop) * 20 / 100;
        printf("%.2f", $ttl);
        ?>
                    </h2>
                </td>
            </tr>
            <tr>
                <td colspan="5" align="right">
                    <h2>TOTAL</h2>
                </td>
                <td>
                    <h2>&pound;
        <?php
        printf("%.2f", $ttl + $delop + $total);
        ?>
                    </h2>
                </td>
            </tr>
        </table>
    <?php endif; ?>
<?php endif; ?>