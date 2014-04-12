<html>
    <body>
        <img src="http://floorsanduk.com/images/quotation-email.jpg" alt="FloorSand Uk" /><br/><br/>
<div id="inside_container">
    <font style ="font-family: Arial; font-size: 20px; font-weight: normal;">Hello,<font style="color: red"> <?php echo $name;?></font></font><br/><br/>
        <div id="online-maintainence-main">
            <div id="online-maintainence-form">
                <font style="margin-top:15px; color: #FF6418; font-size: 25px;"><b>Thank you for your order, this is your</b></font><br/>
                <font style="font-size: 40px;text-decoration:none;"><b>Order Confirmation</b></font><br/><br/>
                <font style="padding:0;"><span style="color: #FF6418; font-size: 20px;"><b>Your reference number for this order is: </b></span><font size="5"><b><?php echo $supplies['id_ss']; ?></b></font></font><br/>
                <font style="padding-bottom:40px;"><span style="color: #FF6418; font-size: 20px;"><b>Date:</b> </span><span><b><font size="5"><?php echo date('D, j F Y', $supplies['date']);   ?></font></b></span><font><br/><br/>
                <font style="margin-top: 20px; font-size: 20px; font-weight: normal;font-family:Arial;"><b>The details of your order are:</b></font>
                    <table border = "1" bordercolor = "#22261F" style = "border: 1px solid #22261F; width: 100%;" >
                        <tbody>	
                            <tr>
                                <td align="center" style="width: 100px;">
                                    <span style="font-size: 16px">Code</span>
                                </td>
                                <td>
                                    <span style="font-size: 16px">Title</span>
                                </td>
                                <td align="center" style="width: 120px;">
                                    <span style="font-size: 16px">Price</span>
                                </td>
                                <td align="center" style="width: 120px;">
                                    <span style="font-size: 16px">Quantity</span>
                                </td>
                                <td align="center"  style="width: 150px;">
                                    <span style="font-size: 16px">Total Price</span>
                                </td>
                            </tr>
                            <?php
                            $subtotal = 0;
                            $date = $supplies['date'];

                            $suppliesElems = json_decode((string) $supplies['supplies']);

                            foreach ($suppliesElems as $supplie => $val) {
                                $items = ORM::factory('supplies')->where("id_supplies", "=", $supplie)->find();
                                ?>

                                <tr class="b_tr">
                                    <td align="center" style="width: 100px;">
                                        <span><?php echo $items->code; ?></span>
                                    </td>
                                    <td>
                                        <span><?php echo $items->title; ?></span>
                                    </td>
                                    <td align="center" style="width: 120px;">
                                        <span><?php echo $items->price; ?></span>
                                    </td>
                                    <td align="center" style="width: 120px;">
                                        <span><?php echo $val->cnt; ?></span>
                                    </td>
                                    <td align="center"  style="width: 150px;">
                                        <span><?php
                            echo $val->cnt * $items->price;
                            $subtotal += $val->cnt * $items->price;
                            $date = date('D, j F Y', $supplies['date']);
                                ?></span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr class="b_tr">
                                <td align="right" style="width: 100px;" colspan="4">
                                    <span style="padding-right: 5px;">Sub Total</span>
                                </td>
                                                
                                <td align="center"  style="width: 150px;">
                                    <span><?php echo $subtotal; ?></span>
                                </td>
                            </tr>
                            <tr class="b_tr">
                                <td align="right" style="width: 100px;" colspan="4">
                                    <span style="padding-right: 5px;">Next Day Deliverly</span>
                                </td>
                                                
                                <td align="center"  style="width: 150px;">
                                    <span><?php $nextDayDelivery = date('D, j F Y', $supplies['date'] + 86400);
                            echo $nextDayDelivery; ?></span>
                                </td>
                            </tr>
                            <tr class="b_tr">
                                <td align="right" style="width: 100px;" colspan="4">
                                    <span style="padding-right: 5px;">V.A.T. @20%</span>
                                </td>
                                                
                                <td align="center"  style="width: 150px;">
                                    <span><?php $vat = $subtotal * 0.2;
                            echo $vat; ?></span>
                                </td>
                            </tr>
                            <tr class="b_tr">
                                <td align="right" style="width: 100px;" colspan="4">
                                    <span style="padding-right: 5px;">Total</span>
                                </td>
                                                
                                <td align="center"  style="width: 150px;">
                                    <span><?php echo $supplies['total']; ?></span>
                                </td>
                            </tr>
                                            
                        </tbody>
                    </table>
                    <div style="margin-top: 30px;">
                        <span style="font-size:16px;color:#FF6418"><b>Your delivery address for this order is: </b></span><span style="font-size:16px;color:black;"><b><?php echo $address. ", ". $town. " ". $postcode; ?></b><br></span>
                        <span style="font-size:16px;color:#FF6418"><b>Delivery is: </b></span><span style="font-size:16px;color:black;"><b><?php echo $nextDayDelivery; ?></b><br></span>
                    </div>
                    <div style="margin-top: 30px;">
                        <span style="font-size:16px;color:#FF6418"><b>Your contact details for this order area:</b></span><br>
                        <span style="font-size:16px;color:#FF6418"><b>Email: </b></span><span style="font-size:16px;color:black;"><b><?php echo $email; ?></b></span><br>
                         <span style="font-size:16px;color:#FF6418"><b>Landline: </b></span><span style="font-size:16px;color:black;"><b><?php echo $phone; ?></b><br></span>
                        <span style="font-size:16px;color:#FF6418"><b>Mobile/SMS: </b></span><span style="font-size:16px;color:black"><b><?php echo $mphone; ?></b></span><br>
                    </div><br/>
                    <div >
                        <span style="font-size: 16px"><b>If you have any queries, please feel free to email us at:</b></span><span style="font-size:16px;color:#FF6418"><b> <?php echo $admin_email; ?></b></span>
                    </div>   
                </div>
            </div>
        </div>
    </body>
</html>