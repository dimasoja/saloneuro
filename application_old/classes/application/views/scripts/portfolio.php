<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.fancybox').fancybox();
    });
    
</script>
<div id="inside_container"><h2>Портфолио:</h2><br/>
<div>
    <?php foreach ($portfolio as $key => $portfol) { ?>
        <div style='clear:both'>
            <?php
            $title = ORM::factory('products')->where('id_product', '=', $key)->find()->title;
            echo '<h2>' . $title . '</h2><br/>';
            $count = 0;
            foreach ($portfol as $port) {
                $count++;
                ?>
                <div class="col" style='float: left; width: 296px;'>
                    <a href="<?php echo $port['src']; ?>" class="fancybox" rel="gallery<?php echo $count; ?>">
                        <img src="<?php echo $port['src']; ?>" width ="150"  class="products-feat-image"/>
                    </a>
                </div>

            <?php } ?>
        </div>
    <?php } ?>
    </div>
    </div>