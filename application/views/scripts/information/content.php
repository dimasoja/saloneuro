<h2><?php echo $page['name']; ?></h2>
<hr/>
<div class="information-item">
    <?php if (isset($page['image'])) { ?>
        <div class="information-image">
            <?php if (file_exists('.' . $page['image'])) { ?>
                <?php $sizes = ImageWork::getImageSize('.' . $page['image'], '200', '200', '200', '200'); ?>
                <?php if ($page['image'] != '') { ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $page['image']; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'/>
                        <!--     style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"-->
                    </div>
                <?php } else { ?>
                    <div class="category-image-wrapper-information"></div>
                <?php } ?>
            <?php } else { ?>
                <div class="category-image-wrapper-information"></div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="information-text">
        <div class="information-title">
        </div>
        <div class="information-pretext">
            <?php echo $page['content']; ?>
        </div>
        <br/>
    </div>
</div>
