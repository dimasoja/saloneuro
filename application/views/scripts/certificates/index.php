<h2>Наши достижения</h2>
<?php echo $text; ?>
<?php foreach ($certificates as $certificate) { ?>
    <?php if (file_exists('.' . $certificate->image)) { ?>
        <?php $sizes = ImageWork::getImageSize('.' . $certificate->image, '200', '200', '200', '200'); ?>
        <?php if ($certificate->image != '') { ?>
            <div class="category-image-wrapper-information certificate-image">
                <a href="<?php echo $certificate->image; ?>" title="<?php echo $certificate->description; ?>"
                   class="certyfancy" rel="group">
                    <img src='<?php echo $certificate->image; ?>' width='<?php echo $sizes['newwidth']; ?>'
                         height='<?php echo $sizes['newheight']; ?>'
                         style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"/>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.certyfancy').fancybox({
            'beforeShow' : function() {
                jQuery('.fancybox-wrap').addClass('certif-fancybox');
            }
        });
    });
</script>