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
        <div id="left-content" <?php // if(isset($right_block)) { echo "style='width:953px;'"; } ?>>        
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
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('.fancybox').fancybox();
                });
                
            </script>
            
            <?php if(isset($portfolio)) { ?>
                        
                <?php foreach ($portfolio as $key => $port) { ?>
                    <?php 
                    if(isset($about)) {
                        $styles = 'width: 335px;height:335px;';
                    } else {
                        $styles = 'width: 296px;height:268px;';
                    }
                    ?>
                            <div class="col" style='float: left; <?php echo $styles; ?>'>
                                <div class="border-port">
                                <a href="<?php echo $port->path; ?>" class="fancybox" title = '<?php echo $port->descr; ?>'   >
                                    <?php
$new_width  = 141;
$new_height = 103;
if(isset($about)) {
    $new_width  = 285;
    $new_height = 286;
}
$this_image = '.'.$port->path;

list($width, $height, $type, $attr) = getimagesize("$this_image");

if ($width > $height) {
  $image_height = floor(($height/$width)*$new_width);
  $image_width  = $new_width;
} else {
  $image_width  = floor(($width/$height)*$new_height);
  $image_height = $new_height;
}
                                     ?>
                                    <img src="<?php echo $port->path; ?>" width ="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" <?php if(isset($about)) {echo 'style="width: '.$image_width.'px;height:'.$image_height.'px"';} ?> style="" class="products-feat-image"/>
                                </a>
                                <div class="portfol-descr" style="margin-left:18px;"><?php echo $port->descr; ?></div>
                            </div>
                            </div>
                    
                <?php } ?>
                <?php } ?>




        </div>
        <?php // if(!isset($right_block)) { ?>
        <div id="right-content">
            <div id="area-top">
                &nbsp;
            </div>
            <div id="right-center">                
                <div class="ok">
                    <a href="#">
                        <img src="/images/ok.png"/>
                    </a>
                </div>
                <div class="order-products">
                    <input type="button" class="blue-button" value="Заказать услугу" <?php if(isset($content->this_product)) {echo 'onclick="getOrder()"';} else {echo 'onclick="redirectToOrder()"'; } ?>/>
                </div>                
                <div class="get-order-area">                    
                    <?php if(isset($content->this_product)) { ?>
                    <div class="get-order-content">
                        <div class="get-order-block-top" rel="<?php echo $content->this_product; ?>">
                            <a href="#" rel="<?php if (isset($content->browser_name)) echo $content->browser_name; ?>"><?php if (isset($content->checked)) echo $content->checked; ?></a>
                        </div>
                    </div>                    
                    <div class="down-top" onclick="getVisibleBlock()">
                        <a href="#">
                            <img src="/images/arrows.png" class="down-top-image"/>
                        </a>
                    </div>
                    <?php } ?>
                    <?php if(isset($content->this_product)) { ?>
                    <div class="get-order-buttons" style="display:none"> 
                        <div class="order-home <?php if (($type == 'home') or ($type == '')) echo 'active'; else echo 'not-active'; ?>">
                            <?php
                            $count = 0;
                            foreach ($products_home as $product_home) {
                                $count++;
                                ?>
                                <a href="/<?php echo $product_home->browser_name; ?>">
                                    <div class="order-item-<?php echo $count; ?> order-item <?php if ($product_home->browser_name == $content->browser_name) echo 'active'; else echo 'not-active'; ?>" rel="<?php echo $product_home->id_product; ?>">
                                        <?php echo $product_home->title; ?>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="order-business <?php if ($type == 'business') echo 'active'; else echo 'not-active'; ?>">
                            <?php
                            $count = 0;
                            foreach ($products_business as $product_business) {
                                $count++;
                                ?>
                                <a href="/<?php echo $product_business->browser_name; ?>">
                                    <div class="order-item-<?php echo $count; ?> order-item <?php if ($product_business->browser_name == $content->browser_name) echo 'active'; else echo 'not-active'; ?>" rel="<?php echo $product_business->id_product; ?>">
                                        <?php echo $product_business->title; ?>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="order-form">
                            <div class="ff1 not-active">
                            <div class='types'>
                               <?php if(isset($content->this_product)) { ?>
                                 <?php $types = ORM::factory('productsitems')->where('to','=',$content->this_product)->find_all()->as_array(); ?>
                                 <?php foreach($types as $type) { ?>
                                 <div>
                                       <input id="type<?php echo $type->id; ?>" type="checkbox" value="<?php echo $type->id; ?>" />
                                       <label for="type<?php echo $type->id; ?>"><?php echo $type->value; ?></label> 
                                       </div>
                                 <?php } ?>
                               <?php } ?>
                            </div>
                                <div class="input-name">
                                    <input type="text" id="order-name"  class="order-name-fix" placeholder="Имя" onkeyup="checkOrder()"/>
                                    <div class="order-err-name error"></div>
                                </div>
                                <div class="input-email">
                                    <input type="text" id="order-phone" class="order-phone-fix" placeholder="Телефон" onkeyup="checkOrder()"/>
                                    <div class="order-err-phone error"></div>
                                </div>
                                <div class="order-submit" style="display:none;">
                                    <input type="button" class="order-button" value="Заказать" onclick="makeOrder()">
                                </div>
                                <div class="order-success" style="display:none;">
                                    Спасибо! Мы свяжемся с Вами в ближайшее время.
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function(){
                                    jQuery("#order-phone").mask("+7 (999) 999 99 99");
                                });
                            </script>
                        </div>                             
                    </div>                    
                    <div class="get-order-buttons-bottom">&nbsp;</div>
                    <?php } ?>
                </div>
            </div>
            <div id="area-bottom">
                &nbsp;
            </div>
            <div id="right-center-twice">
                <input type="button" class="green-button" value="Комплексные услуги"/>
                <div class="complex-items">
                    
                    
                    <?php $complexs = ORM::factory('complex')->find_all()->as_array(); ?>
                    <?php $count = 0; ?>
                    <?php foreach($complexs as $complex) { ?>
                    <div class="complex-item<?php echo $count; ?> complex-item">
                        <a href="/complex"><div class="green-label">&nbsp;</div> <?php echo $complex->name; ?></a>
                    </div>                    
                    <?php } ?>
                    
                    
                    
                </div>
            </div>
            <div id="area-bottom-twice">
                &nbsp;
            </div>   
            <div id="right-center-third">
                <div class="man">
                    <a href="#">
                        <img src="/images/block-man.png"/>
                    </a>
                </div>
                <div class="have-questions">
                    <input type="button" class="blue-button" value="Есть вопросы?"/>
                </div>
                <?php 
                     if(isset($content->this_product)) $id_response =  '?id='.$content->this_product; else $id_response = '';
                ?>
                <div class="consult-and-questions">

<!--                    <a href="/consultation<?php echo $id_response; ?>">-->
<a href="/consult">
                        <div class="consult">
                            <div class="consult-image">
                                &nbsp;
                            </div>
                            <div class="consult-text">Консультация</div>
                        </div>
                    </a>
                    <a href="/response<?php echo $id_response; ?>">
                        <div class="questions">
                            <div class="question-image">
                                &nbsp;
                            </div>
                            <div class="question-text" onclick="makeresponse(<?php if(isset($content->this_product)) echo $content->this_product; ?>)">Оставить отзыв</div>
                        </div>
                    </a>
                </div>
            </div> 

            <div id="area-bottom-bottom">
                &nbsp;
            </div>                    
        </div>
    </div>
    
    <?php // } ?><br/><br/><br/>
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
