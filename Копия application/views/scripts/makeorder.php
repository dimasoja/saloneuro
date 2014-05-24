<form action="/makeorder/new" id="makeorder-form" method="POST">
    <h3>Заказать услуги</h3>
<?php echo ORM::factory('settings')->getSetting('makeorder_content'); ?>
    <div class="clearboth">&nbsp;</div>
    <div class="order-home1" style="width:300px; float:left;">
        <?php $count = 0; ?>
        <h3>Для дома</h3>
        <?php
        foreach ($products_home as $product_home) {
            $count++;
            ?>   
            <div class='items<?php echo $product_home->id_product; ?>'>
                <div class="order-item-<?php echo $count; ?> order-item " rel="<?php echo $product_home->id_product; ?>">
                    <div class="order-checkbox ">
                    <input type="checkbox" disabled class="order-check chk  to<?php echo $product_home->id_product; ?>" rel="<?php echo $product_home->id_product; ?>" name="product-<?php echo $product_home->id_product; ?>"/></div><div class="order-label-checkbox"><?php echo $product_home->title; ?></div>                
                </div>                
                <?php $pi = ORM::factory('productsitems')->where('to','=',$product_home->id_product)->find_all()->as_array(); ?>
                <?php foreach($pi as $p) { ?> 
                <div class="productsitems">
                   <input name="product-<?php echo $product_home->id_product; ?>[<?php echo $p->id; ?>]" type="checkbox" class="types-check chk" to="<?php echo $product_home->id_product; ?>" rel="<?php echo $p->id; ?>"/><?php echo $p->value; ?>
               </div>
               <?php } ?>
           </div>
           <?php } ?>
       </div>
       <div class="order-business1" style="margin-left:304px !important">
        <?php $count = 0; ?>
        <h3>Для бизнеса</h3>
        <?php
        foreach ($products_business as $product_business) {
            $count++;
            ?>               
            <div class="order-item-<?php echo $count; ?> order-item" rel="<?php echo $product_business->id_product; ?>">
                <div class="order-checkbox">
                 <input type="checkbox" disabled class="order-check chk  to<?php echo $product_business->id_product; ?>" rel="<?php echo $product_business->id_product; ?>" name="product-<?php echo $product_business->id_product; ?>"/></div><div class="order-label-checkbox"><?php echo $product_business->title; ?></div>                
            </div>   
            <?php $pi = ORM::factory('productsitems')->where('to','=',$product_business->id_product)->find_all()->as_array(); ?>
            <?php foreach($pi as $p) { ?>
            <div class="productsitems">
               <input name="product-<?php echo $product_business->id_product; ?>[<?php echo $p->id; ?>]" type="checkbox" class="types-check chk" to="<?php echo $product_business->id_product; ?>" rel="<?php echo $p->id; ?>"/><?php echo $p->value; ?>
           </div>
           <?php } ?>            
           <?php } ?>    
           <div class="order-err-checked error"></div>

       </div> 
       <div class="ff1" style="margin-top:19px;">
        <div class="input-name">
        <input type="text" id="order-name" class="order-name-fix" name="name" placeholder="Имя" style="margin-left:-6px !important">
            <div class="order-err-name error"></div>
        </div>
        <div class="input-email">
            <input type="text" id="order-phone" class="order-phone-fix"  name="phone" placeholder="Телефон" style="margin-left:-6px !important">
            <div class="order-err-phone error"></div>
        </div>
    </div>
    <div class="order-submit">
        <input type="button" class="order-button" value="Заказать услуги" onclick="makeMainOrder()" style="margin-left:28px !important">
    </div>

</form>
<script type='text/javascript'>
    jQuery(document).ready(function(){
        $('input[type="checkbox"], input[type="radio"], select.uniform, input[type="file"]').uniform();
        jQuery('.types-check').change(function(){
            var to = jQuery(this).attr('to');    
            if(jQuery(this).is(':checked')==true) {        
                jQuery('.to'+to).attr('checked', 'checked');
                $('.to'+to).parent().addClass('checked');
            } else {      
                var flag = true;
                jQuery('.items'+to+' .productsitems .types-check').each(function(){        
                    if(jQuery(this).is(':checked')==true) {flag = false;}
                });        
                if(flag==true) {
                    jQuery('.to'+to).attr('checked',false);
                    $('.to'+to).parent().removeClass('checked');
                }
            }
        });
    });
</script>