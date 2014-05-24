<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.fancybox').fancybox();
    });
</script>
<div id="inside_container"><?php echo $content; ?></div><br/>
<div id="portfolio">
    <?php
    if (!empty($portfolio)) {
        echo "<h2 class='portfolio'>Портфолио:</h2>";
    }
    ?>
    <?php if(isset($portfolio)) { ?>
<?php foreach ($portfolio as $portfol) { ?>
       <?php $thumb_path = str_replace('/uploads/','/uploads/thumb-', $portfol->path); ?>
       <?php if(file_exists('.'.$portfol->path)) { ?>
       <?php Image::factory('.'.$portfol->path)->resize('285','186', Image::WIDTH)->crop('285','186')->save('.'.$thumb_path, 100); } ?>
        <div class="col">
            <a href="<?php echo $portfol->path; ?>" class="fancybox" rel="gallery">
                <img src="<?php echo $thumb_path; ?>" width ="150"  class="products-feat-image"/>
            </a>
        </div>
<?php } ?>
<?php } ?>
</div>
<div class="clearboth"></div>
<?php if(!empty($responses)) { 
echo "<h2 class='portfolio'>Отзывы:</h2>";
?>
<?php foreach($responses as $response) { ?>
<div class="widget">
      <div class="widget-header">
             <h5><?php echo date("Y-m-d H:i:s", $response->created); ?></h5>
      </div> 
      <div class="widget-content">
             <blockquote>
                    <p><?php echo $response->response; ?></p>
                    <small><?php echo $response->name; ?></small>
             </blockquote>
      </div>
</div>
<?php } } ?>

<!--<a href="/uploads/images/cb29d0304cfddb2def59581d10d35d4a.jpg" class="fancybox">
                 <img src="/uploads/images/cb29d0304cfddb2def59581d10d35d4a.jpg" class="products-feat-image">
            </a>-->