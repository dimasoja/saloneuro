<?php 
require_once('header.php');
if ($type == '')
    $type = 'home';
$mail = new PHPMailer; 
?>
<div id="main-content-wrapper" style="padding-top:15px;">
    <div class="header-center-romb">
    <?php if(isset($breadcrumbs)) { ?>
   <div class='breadcrumbs'><?php echo $breadcrumbs;  ?></div>
   <?php } ?>
        <div id="left-content" style="width:953px;">        
        <div class="product-name">
           <?php if(isset($content->title)) { ?> <h2><?php echo $content->title; ?></h2><?php } ?>
        </div>
            <br/>
            <?php if(isset($content->image)) {  if($content->image!='') { ?>
            <a href="<?php echo '/uploads/images/'.$content->image->path; ?>" class="fancybox">
                 <img src="<?php echo '/uploads/images/'.$content->image->path; ?>" class="products-feat-image"/>
            </a>
            <?php } } ?>
            <?php echo $content; ?>
        </div>

    </div><br/><br/><br/>
</div>
<script type="text/javascript">
    function getVisibleBlock() {
    if(jQuery('.get-order-buttons').css('display')=='block') {
	jQuery('.get-order-buttons').css('display','none');
    } else {
        jQuery('.get-order-buttons').css('display','block');
    }
    }
</script>
<?php require_once 'footer.php'; ?>
