<script type="text/javascript">
    jQuery(document).ready(function(){
            jQuery(".lightbox").lightbox();
    });
</script>
<div id="inside_container">
<h1 style="padding-left:30px;">Take a look at our samples of work</h1>
<p class="fontsize18" style="padding-left:30px;"><strong>Simply click on the magnifying glass to see a larger view</strong></p>
<?php if (count($images) > 0): ?>
<div class="service-sample-main">
<ul>
    <?php foreach ($images as $image): ?>
    <li>
        <img src="<?php echo URL::base(); ?>uploads/images/<?php echo $image->path; ?>" style="max-height: 193px;" alt="" />
        <p>
            <a href="<?php echo URL::base(); ?>uploads/images/<?php echo $image->path; ?>" class="lightbox">
                <img src="<?php echo URL::base(); ?>images/zoom-icon.jpg" alt="" border="0" />
            </a>
        </p>
    </li>
    <?php endforeach; ?>
</ul>
<?php  if ($pages > 1): ?>
    <?php if ($page > 1): ?>
    <?php
        if ($page - 1 == 1) {
            $url = URL::base() . "services-work-samples";
        } else {
            $prevPage = $page-1;
            $url = URL::base() . "services-work-samples/page/" . $prevPage . "";
        }
    ?>
    <div><a href="<?php echo $url; ?>" class="sample-back-button"></a></div>
    <?php endif; ?>
    <?php if ($page < $pages): ?>
    <div><a href="<?php echo URL::base(); ?>services-work-samples/page/<?php echo $page + 1; ?>" class="sample-more-button"></a></div>
    <?php endif; ?>
<?php endif; ?>
</div>
<?php endif; ?>
</div> 