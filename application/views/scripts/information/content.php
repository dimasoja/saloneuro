<h2><?php echo $page['name']; ?></h2>
<hr/>
<div class="information-item">
    <?php if (isset($page['image'])) { ?>
        <?php if ($page['image'] != '') { ?>
            <?php if (file_exists('.' . $page['image'])) { ?>
                <div class="information-image">

                    <?php $sizes = ImageWork::getImageSize('.' . $page['image'], '200', '200', '200', '200'); ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $page['image']; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'/>
                        <!--     style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"-->

                    </div>
                </div>
                <?php ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php echo $page['content']; ?>

</div>
