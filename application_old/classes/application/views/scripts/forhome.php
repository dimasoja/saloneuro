 <div id="inside_container">
 <h2>Для бизнеса</h2><br/><?php
$count = 0;
$hidemenu = ORM::factory('products')->where('published', '=', 'on')->where('type', '=', 'for_home')->find_all()->as_array();
foreach ($hidemenu as $hide) {
?>
<div class=""><a href="<?php echo URL::base() . "" . $hide->browser_name	; ?>"><?php echo $hide->title; ?></a>                              
</div><br/>  
<?php
$count++;
}
?></div>