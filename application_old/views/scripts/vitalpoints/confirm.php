<div id="inside_container">
    <?php echo $cont['value']; ?>
    <div>
        <?php echo ViewMessage::renderMessages(); ?>
    </div>
    <form method="post" action="<?php echo URL::base(); ?>vital-points/confirm">
    <table cellpadding="0" cellspacing="0" class="confirm_vp">
        <tr>
            <td>First Name</td>
            <td>
                <input type="text" name="name" value="<?php echo HTML::chars((isset($name)) ? $name : $user_info['name']) ?>" class="is<?php if (isset($name_show_error)) echo $name_show_error; ?>" />
                <?php if (isset($name_error) && '' != $name_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $name_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>
                <input type="text" name="surname" value="<?php echo HTML::chars((isset($surname)) ? $surname : $user_info['surname']) ?>" class="is<?php if (isset($surname_show_error)) echo $surname_show_error; ?>" />
                <?php if (isset($surname_error) && '' != $surname_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $surname_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <input type="text" name="address" value="<?php echo HTML::chars((isset($address)) ? $address : ""); ?>" class="is<?php if (isset($address_show_error)) echo $address_show_error; ?>" />
                <?php if (isset($address_error) && '' != $address_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $address_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Town</td>
            <td>
                <input type="text" name="town" value="<?php echo HTML::chars((isset($town)) ? $town : ""); ?>" class="is<?php if (isset($town_show_error)) echo $town_show_error; ?>" />
                <?php if (isset($town_error) && '' != $town_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $town_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Postcode</td>
            <td>
                <input type="text" name="postcode" value="<?php echo HTML::chars((isset($postcode)) ? $postcode : ""); ?>" class="is<?php if (isset($postcode_show_error)) echo $postcode_show_error; ?>" />
                <?php if (isset($postcode_error) && '' != $postcode_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $postcode_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $user_info['email']; ?>" disabled="disabled" /></td>
        </tr>
        <tr>
            <td>Mobile tel. no.</td>
            <td>
                <input type="text" name="mphone" value="<?php echo HTML::chars((isset($mphone)) ? $mphone : ""); ?>" class="is<?php if (isset($mphone_show_error)) echo $mphone_show_error; ?>" />
                <?php if (isset($mphone_error) && '' != $mphone_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $mphone_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Landline tel. no.</td>
            <td>
                <input type="text" name="phone" value="<?php echo HTML::chars((isset($phone)) ? $phone : ""); ?>" class="is<?php if (isset($phone_show_error)) echo $phone_show_error; ?>" />
                <?php if (isset($phone_error) && '' != $phone_error): ?>
                <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                    <?php echo $phone_error; ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <input type="submit" value="SUBSCRIBE" class="franchisee-submit" />
    </form>
</div>