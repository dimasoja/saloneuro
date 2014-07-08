<?php echo ViewMessage::renderMessages(); ?>
<h1>Supplies Sales</h1>
<?php if (count($supplies) > 0): ?>

<table cellpadding="0" cellspacing="0" class="quotation-user">
    <tr>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Total Price</th>
        <th>Date</th>
        <th>Status</th>
        <th>Transaction ID</th>
        <th>Details</th>
        <th>Price</th>
    </tr>
	<?php $total = 0; ?>
    <?php foreach($supplies as $supply): if(trim($supply['email'])!=""): ?>
    <tr>
        <td align="center"><input type="checkbox" class='supplies_check' id="supply_<?php echo $supply['hash']; ?>" /></td>
        <td><?php echo $supply['name']; ?> <?php echo $supply['surname']; ?></td>
        <td><?php echo $supply['email']; ?></td>
        <td>&pound;<?php echo number_format((double)$supply['total_price'], 2, '.', ''); ?></td>
        <td><?php echo date("d.m.Y H:i:s", $supply['date']); ?></td>
        <td><?php if ($supply['payment_status']=='1') echo "<font style='color: #00ff00'>Confirmed</font>"; else echo "<font style = 'color:red'>Potential</font>"; ?></td>
        <td><?php echo $supply['transaction_id']; ?></td>
        <td><a href="<?php echo URL::base(); ?>admin/supplies/details/<?php echo $supply['hash']; ?>">Details</a></td>
        <td><?php echo $supply['total_price']; ?></td>
    </tr>
	<? $total = $total + $supply['total_price']; ?>
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