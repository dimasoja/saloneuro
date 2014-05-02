<h2><?php if (isset($this_category)) {
        echo $this_category->name;
    } else {
        echo 'Продукция';
    } ?></h2>
<?php if (isset($this_category)) { ?>
    <i>Nunc vitae commodo turpis, tempor posuere eros. Aliquam porta adipiscing mi, aliquet ultrices metus porta eget.
        In hac habitasse platea dictumst. Maecenas sodales, dolor eu aliquam auctor, nibh diam cursus enim, nec
        venenatis metus leo et est. Nam sed tristique velit. Duis pulvinar auctor pharetra. Curabitur ac enim purus.
        Nulla facilisis dolor pulvinar semper viverra. Cras ipsum est, mollis vitae urna quis, vestibulum posuere purus.
        Pellentesque ullamcorper placerat turpis quis posuere. Sed rutrum malesuada consequat. Quisque orci orci,
        condimentum ac nulla et, dictum aliquam mauris. Integer sed cursus eros. In sed commodo leo.</i>
<?php } ?>

<hr/>
<div class="width100">
<span class="floatright">
    Сортировка:
    <select class="sortby form-control">
        <option value="price-asc" <?php if($order_by=='price-asc') echo 'selected'; ?>>По цене &#x2191;</option>
        <option value="price-desc" <?php if($order_by=='price-desc') echo 'selected'; ?>>По цене &#x2193;</option>
        <option value="rating-asc" <?php if($order_by=='rating-asc') echo 'selected'; ?>>По популярности &#x2191;</option>
        <option value="rating-desc" <?php if($order_by=='rating-desc') echo 'selected'; ?>>По популярности &#x2193;</option>
    </select>
</span>
</div>
<?php foreach ($items as $item) { ?>
    <?php $options = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $item->id)->find_all()->as_array(); ?>
    <?php
    if (isset($options[0])) {
        $featured = $options[0];
        $image = ORM::factory('images')->where('id_image', '=', $featured->value)->find();
    }
    ?>

    <div class="information-item">
        <?php if (isset($image->path)) { ?>
            <div class="information-image">
                <?php $sizes = ImageWork::getImageSize('.' . $image->path, '200', '200', '200', '200'); ?>
                <?php if ($image->path != '') { ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $image->path; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'
                             style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"/>
                    </div>
                <?php } else { ?>

                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="information-image">
                <div class="category-image-wrapper-information">
                </div>
            </div>
        <?php } ?>
        <div class="information-text">
            <?php $parent = ORM::factory('productscat')->where('id', '=', $item->id)->find(); ?>
            <div class="information-title">
                <a href="/catalog/<?php echo strtolower(transliterate($this_category->name)) . '/'; ?><?php echo strtolower(transliterate($item->name)); ?>"><?php echo $item->name; ?></a>
            </div>
            <div class="raty"></div>
            <div class="textiprice">
                <div class="information-pretext">
                    <?php echo FrontHelper::maxsite_str_word($item->description, 50); ?>
                </div>
                <div class="information-price">
                    <?php echo number_format($item->price, 0, ' ', ' '); ?> руб.
                </div>
            </div>
            <br/>
        </div>
        <br/>
        <br/>
    </div>
<?php
}
?>
<?php $current_url = Request::instance()->uri().URL::query(); ?>
<?php $pos = strripos($current_url, '?'); ?>
<?php if($pos===false) {
    $current_url_type = '?';
} else {
    $current_url_type = '&';
} ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.sortby').change(function(){
            var value = jQuery(this).val();
            <?php if($current_url_type=='?') { ?>
                window.location = '/<?php echo $current_url; ?>?order_by='+value;
            <?php } else { ?>
                window.location = '/<?php echo $current_url; ?>&order_by='+value;
            <?php } ?>
        });
        jQuery('.raty').raty({
            half: true,
            score: 3.26,
            path: null,
            halfShow: false,
            starOff: '/images/star-empty.png',
            starOn: '/images/star-full.png'});
    });
</script>