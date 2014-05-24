<h2><?php if(isset($page_name)) echo $page_name; else echo 'Полезная информация'; ?></h2>
<hr/>
<?php foreach ($items as $item) { ?>
    <div class="information-item">
        <?php if (isset($images[$item->id])) { ?>
            <div class="information-image">
                <?php $sizes = ImageWork::getImageSize('.' . $images[$item->id], '200', '200', '200', '200'); ?>
                <?php if ($images[$item->id] != '') { ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $images[$item->id]; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'
                             style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"/>
                    </div>
                <?php } else { ?>

                <?php } ?>
            </div>
        <?php } else { ?>

        <?php } ?>
        <div class="information-text">
            <?php $parent = ORM::factory('information')->where('id','=',$item->parent_id)->find(); ?>
            <div class="information-title">
                <a href="/information/<?php echo strtolower(transliterate($parent->name)).'/'; ?><?php echo strtolower(transliterate($item->name)); ?>"><?php echo $item->name; ?></a>
            </div>
            <div class="information-pretext">
                <?php echo FrontHelper::maxsite_str_word($item->content, 50); ?>
            </div>
            <br/>
            <div class="bottom-information">
                <span style="float:left;">Категория: <a href="/information/<?php echo strtolower(transliterate($parent->name)); ?>" class="parent-info1"><?php echo $parent->name; ?></a></span>
                <a href="/information/<?php echo strtolower(transliterate($parent->name)).'/'.strtolower(transliterate($item->name)); ?>" class="parent-next">Подробнее</a>
            </div>
        </div>
    </div>
<?php
}
?>