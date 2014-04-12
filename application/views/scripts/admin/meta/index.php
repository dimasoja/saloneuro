<?php echo ViewMessage::renderMessages(); ?>
<?php
    if (count($meta_pages) > 0) {
?>
<br/>
<h1>Meta Tags</h1><br/>
<h3>Please select a page and set it's Meta Tags:</h3>
<ul class="pages-ul">
<form action='meta/save' method='POST' id='meta_form'>
<select id='meta' name='meta_id' onchange='get_meta_tags(this.value)'>
<option value='0'>Select...</option>
<?php
    foreach ($meta_pages as $meta) {
?>
    <option value="<?php echo $meta->id; ?>"><?php echo $meta->value;?></option>
<?php
    }
?>
</select>
</ul><br/>
<div id='result'>
<?php 
if(isset($_GET['success'])) {
	echo 'Meta Tags for page '.$_GET['success'].' are successfully updated!';
}
?>
</div>
<?php
}
?>
<div id="meta_tag" style="display: none">
	<h3>Keywords:</h3><input type='text' name='keywords' style="width: 652px !important;" id='keywords'></input><br/>
	<h3>Description:</h3><textarea id='description' name='description' cols=90 rows = 5></textarea>

<br/>
<input type="button" class="submit" value="Save" onclick="meta_submit()"  />
</div>
</form>