<h1>Edit user <?php echo $user['name']; ?></h1>
<?php echo ViewMessage::renderMessages(); ?>
<form method="post" action="<?php echo URL::base(); ?>admin/users/edit/<?php echo $user['id_user']; ?>">
<table cellpadding="0" cellspacing="0" class="edit-user">
    <tr>
        <td>Name:</td>
        <td><input type="text" name="name" value="<?php echo $user['name']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Surname:</td>
        <td><input type="text" name="name" value="<?php echo $user['surname']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><input type="text" name="email" value="<?php echo $user['email']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Address:</td>
        <td><input type="text" name="address" value="<?php echo $user['address']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Town:</td>
        <td><input type="text" name="town" value="<?php echo $user['town']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Postcode:</td>
        <td><input type="text" name="postcode" value="<?php echo $user['postcode']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td><input type="text" name="phone" value="<?php echo $user['phone']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td>Mobile:</td>
        <td><input type="text" name="mphone" value="<?php echo $user['mphone']; ?>" class="franchisee-name" /></td>
    </tr>
    <tr>
        <td><input type="submit" value="Save changes" /></td>
</table>
</form>
<div class="clear"></div>
<input type="button" onclick="javascript:history.back();" value="Back" class="submit">