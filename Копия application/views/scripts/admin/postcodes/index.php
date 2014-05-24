<h1>Edit offices</h1>
<input type="button" value="Add Office" class="submit" onclick="parent.location='<?php echo URL::base(); ?>admin/postcodes/add'" />
<!--a href="<?php echo URL::base(); ?>admin/postcodes/add">>> Add office <<</a-->
<?php if (count($offices) > 0): ?>
<table cellpadding="0" cellspacing="0" id="vp_users">
    <?php foreach ($offices as $office): ?>
    <tr>
        <td><?php echo $office->name; ?></td>
        <td><?php echo $office->address; ?><br /><?php echo $office->town; ?><br /><?php echo $office->postcode; ?></td>
        <td><?php echo $office->phone; ?></td>
        <td><a href="<?php echo URL::base(); ?>admin/postcodes/edit/<?php echo $office->id_office; ?>">Edit</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
