<?php echo ViewMessage::renderMessages(); ?>
<h1>Testimonials</h1>
<?php if (count($testimonials) > 0): ?>

<table cellpadding="0" cellspacing="0" class="quotation-user">
    <tr>
        <th></th>
        <th>Name</th>
        <th>Surname</th>
        <th>email</th>
        <th>Date</th>
        <th>Status</th>
        <th>Details</th>
    </tr>
	<?php $total = 0; ?>
    <?php foreach($testimonials as $testimonial): if(trim($testimonial['email'])!=""): ?>
    <tr>
        <td align="center"><input type="checkbox" class='supplies_check' /></td>
        <td><?php echo $testimonial['name']; ?> </td>
        <td><?php echo $testimonial['surname']; ?></td>
        <td><?php echo $testimonial['email']; ?></td>
        <td><?php echo date("d.m.Y H:i:s", $testimonial['date']); ?></td>
        <td>
        <?php 
            switch($testimonial['status']) {
                case 'new': echo "New"; break;
                case 'approved': echo "<font style='color: #00ff00;'>Approved</font>"; break;
                case 'complaint': echo "<font style='color: red;'>Complaint</font>"; break;
            }
            ?>
        </td>
        <td><a href="<?php echo URL::base(); ?>admin/testimonials/details/<?php echo $testimonial['id']; ?>">Details</a></td>
    </tr>
    <?php endif; endforeach; ?>
</table>
<h2 style="text-align: right;">Total: <?php echo $total; ?></h2>

<input type="button" onclick="deleteSomeSuppliesCheck()" class="submit" value="DELETE">
<script type='text/javascript'>
function deleteSomeSuppliesCheck() {
	var list = "";
	jQuery(".supplies_check:checked").each(function(index, el){
		hash = jQuery(el).attr('id').split("_");
		list = list + hash[1] +",";
	});
	if (list != "") {
		if (confirm('This action is permanent. Are you sure?')) {
        jQuery.post(baseurl + 'admin/supplies/deletegroup',
            {
                hash: list
            },
            function(data) {
                if (data == "ok") {
					jQuery(".supplies_check:checked").each(function(index, el){
						hash = jQuery(el).parent().parent().hide();
					});
				} else {
					alert('some error!');
				}
            }
        );
		}
	} else {
		alert('Nothing to delete! Check some items please.');
	}
}
</script>
<?php endif; ?>