<div id="inside-login-container-new">
    <!--containt area holder -->
    <div id="franchise-containt_area_holder">
        <div id="sandman-form">
            <div id="sandman-result">
                <h3>Find a SandMan</h3>
                <ul>
                    <li>
                        <form method="post">
                        <?php if ($postcode): ?>
                            <input type="text" name="postcode" class="sandman-postalcode" value="<?php echo $postcode; ?>" /> <input type="submit" name="" value="GO" class="sandman-go" />
                        <?php else: ?>
                            <input type="text" name="postcode" class="sandman-postalcode" value="Please type in your postcode" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /> <input type="submit" name="" value="GO" class="sandman-go" />
                        <?php endif; ?>
                        
                        </form>
                    </li>
                </ul>
                <h3>Your nearest SandMan that covers <br />your area is:</h3>
                <ul>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['name'])) ? $office['name'] : "Name of office"; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['address'])) ? $office['address'] : "Address"; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['town'])) ? $office['town'] : "Town"; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['postcode'])) ? $office['postcode'] : "Postcode"; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['email'])) ? $office['email'] : "Email"; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['mphone'])) ? $office['mphone'] : "Mobile tel. no."; ?>" disabled="disabled" />
                    </li>
                    <li>
                        <input type="text" name="" class="sandman-postalcode1" value="<?php echo (isset($office['phone'])) ? $office['phone'] : "Landline tel. no."; ?>" disabled="disabled" />
                    </li>
                    <li><input type="button" name="" value="ENQUIRE" class="sandman-go sandman-space" onclick="location.href = '<?php echo URL::base(); ?>online-quotation'"  /></li>
                </ul>
            </div>
            <div id="sandman-result-man">
                <img src="<?php echo URL::base(); ?>images/resultman.png" alt="" />
            </div>
        </div>
    </div>
    <!--End containt area holder -->
</div>