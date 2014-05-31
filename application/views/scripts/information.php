<h2><?php if (isset($page_name)) {
        echo $page_name;
    } else {
        echo 'Полезная информация';
    } ?></h2>
<hr/>
<?php foreach ($items as $item) { ?>
    <?php $class_new = 'fullwidthnew'; ?>
    <div class="information-item">
        <?php if (isset($images[$item->id])) { ?>
            <?php if ($images[$item->id] != '') { ?>
                <?php if (file_exists('.' . $images[$item->id])) { ?>
                    <?php $class_new = ''; ?>
                    <div class="information-image">
                        <?php $sizes = ImageWork::getImageSize('.' . $images[$item->id], '200', '200', '200', '200'); ?>
                        <div class="category-image-wrapper-information">
                            <img src='<?php echo $images[$item->id]; ?>' width='<?php echo $sizes['newwidth']; ?>'
                                 height='<?php echo $sizes['newheight']; ?>'
                                 style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"/>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <div class="information-text <?php echo $class_new; ?>">
            <?php $parent = ORM::factory('information')->where('id', '=', $item->parent_id)->find(); ?>
            <div class="information-title">

                <a href="/information/<?php echo strtolower(FrontHelper::transliterate($parent->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($item->name)); ?>"><?php echo $item->name; ?></a>
            </div>
            <div class="information-pretext">
                <?php echo FrontHelper::truncateHtml($item->content, 1000); ?>
            </div>
            <br/>

            <div class="bottom-information">
                <span style="float:left;">Категория: <a
                        href="/information/<?php echo strtolower(FrontHelper::transliterate($parent->name)); ?>"
                        class="parent-info1"><?php echo $parent->name; ?></a></span>
                <a href="/information/<?php echo strtolower(FrontHelper::transliterate($parent->name)) . '/' . strtolower(FrontHelper::transliterate($item->name)); ?>"
                   class="parent-next">Подробнее</a>
            </div>
        </div>
    </div>
<?php
}
?>