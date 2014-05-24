<div id="inside_container"><?php  $complex = ORM::factory('settings')->getSetting('complex_content');   echo $complex; ?></div>

<div class="zebra">

	<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
		<tr><th>Название комплекса</th><th>Описание</th><th>Скидка</th><th></th></tr>
		<?php foreach($complexs as $complex) { ?>
		<tr>
			<td>
				<b><?php echo $complex->name; ?></b><br/>



			</td>
			<td>
				<?php //echo $complex->descr; ?>
				<?php $complextypes = ORM::factory('complextypes')->where('related','=', $complex->id)->find_all()->as_array(); ?>
				<?php foreach($complextypes as $complextype) { ?>
				<div style="text-align:left; clear:both"><div style="padding-top:4px; float:left;width:26px"><img src="/images/plus.png" width="20px"/></div><div style="padding-top:10px; padding-left:2px"><?php echo $complextype->title; echo "</br>"; ?></div></div>

				<?php } ?>
			</td>
			<td><?php echo $complex->price; ?></td>
			<td><input type="button" class=" small-green-button" onclick = 'getOrder(<?php echo $complex->id; ?>)' value="Заказать"></td>
		</tr>

		<?php } ?>
	</table>

</div>
<script type="text/javascript">
	function getOrder(id) {
		window.location = '/complex/product/'+id;
	}
</script>