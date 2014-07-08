<div id="inside-container-new">
    <!--containt area holder -->
    <div id="supplies-containt_area_holder">
        <div id="supplies-content">
            <span>FloorSand UK</span> offer our customers and 
            Franchisees massive discounts on all 
            trade supplies, whether it’s a sanding 
            belt, a drum of varnish or a sanding 
            machine. Login to your private account 
            and save £££’s on normal trade prices.<br />
            <span>We won’t be beaten like for like 
            on any floor sanding product! 
            Guaranteed!</span>
        </div>
        <div id="man-img">Floor Stand UK</div>
        <div id="trade-price"><a href="#">UP TO A MASSIVE 70% DISCOUNT</a></div>
        <div id="supplies-form">
            <div id="franchisee-login">
                <!--h3>Franchisee Login</h3>
                <ul>
                    <li><input type="text" name="" value="Username" class="franchisee-name" disabled="disabled" /></li>
                    <li>
                        <input type="text" name="" value="Password" class="franchisee-password" disabled="disabled" />
                        <input type="submit" name="" value="GO" class="franchisee-submit" disabled="disabled"  />
                    </li>
                </ul-->
                <h3>Trade Customer Login</h3>
                <div><?php echo ViewMessage::renderMessages(); ?></div>
                <form method="post" action="<?php echo URL::base(); ?>supplies/login">
                <ul>
                    <li><input type="text" name="email" value="Email" class="franchisee-name" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" /></li>
                    <li>
                        <input type="text" name="password" value="Password" class="franchisee-password" onfocus="if(this.value=='Password'){this.value=''};" onblur="if(this.value==''){this.value='Password'};" />
                        <input type="submit" name="" value="GO" class="franchisee-submit"  />
                    </li>
                </ul>
                </form>
                <h3>New Customer registration</h3>
                <form method="post" action="<?php echo URL::base(); ?>supplies">
                <ul>
                    <li>
                        <input type="text" title="First Name" name="name" value="<?php echo HTML::chars((isset($name)) ? $name : 'First Name') ?>" class="franchisee-name<?php if (isset($name_show_error)) echo $name_show_error; ?>" onfocus="if(this.value=='First Name'){this.value=''};" onblur="if(this.value==''){this.value='First Name'};" />
                        <?php if (isset($name_error) && '' != $name_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $name_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Last Name" name="surname" value="<?php echo HTML::chars((isset($surname)) ? $surname : 'Last Name') ?>" class="franchisee-name<?php if (isset($surname_show_error)) echo $surname_show_error; ?>" onfocus="if(this.value=='Last Name'){this.value=''};" onblur="if(this.value==''){this.value='Last Name'};" />
                        <?php if (isset($surname_error) && '' != $surname_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $surname_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Address (Where your credit card is registered)" name="address" value="<?php echo HTML::chars((isset($address)) ? $address : 'Address (Where your credit card is registered)') ?>" class="franchisee-name<?php if (isset($address_show_error)) echo $address_show_error; ?>" onfocus="if(this.value=='Address (Where your credit card is registered)'){this.value=''};" onblur="if(this.value==''){this.value='Address (Where your credit card is registered)'};" />
                        <?php if (isset($address_error) && '' != $address_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $address_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Town" name="town" value="<?php echo HTML::chars((isset($town)) ? $town : 'Town') ?>" class="franchisee-name<?php if (isset($town_show_error)) echo $town_show_error; ?>" onfocus="if(this.value=='Town'){this.value=''};" onblur="if(this.value==''){this.value='Town'};" />
                        <?php if (isset($town_error) && '' != $town_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $town_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Postcode" name="postcode" value="<?php echo HTML::chars((isset($postcode)) ? $postcode : 'Postcode') ?>" class="franchisee-name<?php if (isset($postcode_show_error)) echo $postcode_show_error; ?>" onfocus="if(this.value=='Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Postcode'};" />
                        <?php if (isset($postcode_error) && '' != $postcode_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $postcode_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Tel No (For contact regarding your order)" name="phone" value="<?php echo HTML::chars((isset($phone)) ? $phone : 'Tel No (For contact regarding your order)') ?>" class="franchisee-name<?php if (isset($phone_show_error)) echo $phone_show_error; ?>" onfocus="if(this.value=='Tel No (For contact regarding your order)'){this.value=''};" onblur="if(this.value==''){this.value='Tel No (For contact regarding your order)'};" />
                        <?php if (isset($phone_error) && '' != $phone_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $phone_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Mobile Tel No" name="mphone" value="<?php echo HTML::chars((isset($mphone)) ? $mphone : 'Mobile Tel No') ?>" class="franchisee-name<?php if (isset($mphone_show_error)) echo $mphone_show_error; ?>" onfocus="if(this.value=='Mobile Tel No'){this.value=''};" onblur="if(this.value==''){this.value='Mobile Tel No'};" />
                        <?php if (isset($mphone_error) && '' != $mphone_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $mphone_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Email" name="email" value="<?php echo HTML::chars((isset($email)) ? $email : 'Email') ?>" class="franchisee-name<?php if (isset($email_show_error)) echo $email_show_error; ?>" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" />
                        <?php if (isset($email_error) && '' != $email_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $email_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Password" name="password" value="<?php echo HTML::chars((isset($password)) ? $password : 'Password') ?>" class="supplies-password<?php if (isset($password_show_error)) echo $password_show_error; ?>" onfocus="if(this.value=='Password'){this.value=''};" onblur="if(this.value==''){this.value='Password'};" />
                        <?php if (isset($password_error) && '' != $password_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $password_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <input type="text" title="Re-type Password" name="retype" value="<?php echo HTML::chars((isset($retype)) ? $retype : 'Re-type Password') ?>" class="supplies-password<?php if (isset($retype_show_error)) echo $retype_show_error; ?>" onfocus="if(this.value=='Re-type Password'){this.value=''};" onblur="if(this.value==''){this.value='Re-type Password'};" />
                        <?php if (isset($retype_error) && '' != $retype_error): ?>
                        <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                            <?php echo $retype_error; ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <li>
                        <p>
                            Your User Name and Password 
                            will be sent to your email address
                            immediately
                        </p>
                        <input type="submit" name="" value="GO" class="franchisee-submit"  />
                    </li>
                </ul>
                </form>
            </div>
        </div>
        <div id="supplies-bottom-logo">
            <ul>
                <li><img src="<?php echo URL::base(); ?>images/lagler-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/bona-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/blanchon-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/dewalt-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/dewalt-img1.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/dewalt-img2.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/ball-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/morrells-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/mirka-img.jpg" alt="" /></li>
                <li><img src="<?php echo URL::base(); ?>images/3m-img.jpg" alt="" /></li>
            </ul>
        </div>
    </div>
    <!--End containt area holder -->
</div>
