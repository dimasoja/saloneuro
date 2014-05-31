<h2><?php if (isset($this_category)) {
        echo $this_category->name;
    } else {
        echo 'Продукция';
    } ?></h2>
<?php if (isset($this_category)) { ?>
    <i><?php echo $this_category->content; ?></i>
<?php } ?>

<hr/>
<div class="width100">
<span class="floatright">
    Сортировка:
    <select class="sortby form-control">
        <option value="default" <?php if ($order_by == 'default') {
            echo 'selected';
        } ?>>По умолчанию</option>
        <option value="price-asc" <?php if ($order_by == 'price-asc') {
            echo 'selected';
        } ?>>По цене &#x2191;</option>
        <option value="price-desc" <?php if ($order_by == 'price-desc') {
            echo 'selected';
        } ?>>По цене &#x2193;</option>
        <option value="rating-asc" <?php if ($order_by == 'rating-asc') {
            echo 'selected';
        } ?>>По популярности &#x2191;</option>
        <option value="rating-desc" <?php if ($order_by == 'rating-desc') {
            echo 'selected';
        } ?>>По популярности &#x2193;</option>
    </select>
</span>
</div>
<?php $countas = 0; ?>
<?php foreach ($items as $item) { ?>


    <?php $options = ORM::factory('options')->where('type', '=', 'image')->where('id_product', '=', $item['id'])->find_all()->as_array(); ?>
    <?php
    if ($item['featured'] != '') {
        $image = ORM::factory('images')->where('id_image', '=', $item['featured'])->find();
    } else {
        if (isset($options[0])) {
            $featured = $options[0];
            $image = ORM::factory('images')->where('id_image', '=', $featured->value)->find();
        }
    }
    ?>

    <div class="information-item">
        <?php if (isset($image->path)) { ?>
            <div class="information-image">
                <?php $sizes = ImageWork::getImageSize('.' . $image->path, '200', '200', '200', '200'); ?>
                <?php if ($image->path != '') { ?>
                    <div class="category-image-wrapper-information">
                        <img src='<?php echo $image->path; ?>' width='<?php echo $sizes['newwidth']; ?>'
                             height='<?php echo $sizes['newheight']; ?>'/>
                        <!-- style="margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;margin-top:<?php echo (202 - $sizes['newheight']) / 2; ?>px;"-->

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
            <?php $parent = ORM::factory('productscat')->where('id', '=', $item['id'])->find(); ?>
            <div class="information-title">
                <a href="/catalog/<?php echo strtolower(FrontHelper::transliterate($this_category->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($item['name'])); ?>"><?php echo $item['name']; ?></a>
            </div>
            <?php $rating = ORM::factory('response')->where('to', '=', $item['id'])->find_all()->as_array(); ?>
            <?php $rat_finish = 0; ?>
            <?php $rat_count = 0; ?>
            <?php foreach ($rating as $rat) {
                $rat_finish = $rat_finish + $rat->rating;
                $rat_count++;
            } ?>

            <div class="raty raty<?php echo $countas; ?>"></div>
            <?php if ($rat_finish != 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery('.raty<?php echo $countas; ?>').raty({
                            score: <?php echo $rat_finish/$rat_count; ?>,
                            path: null,
                            readOnly: true,
                            halfShow: false,
                            starOff: '/images/star-empty.png',
                            starOn: '/images/star-full.png'});
                    });
                </script>
            <?php } ?>

            <div class="textiprice">
                <div class="information-pretext">
                    <?php //echo FrontHelper::maxsite_str_word($item->description, 50000); ?>
                    <?php echo $item['short_description']; ?>
                </div>
                <div class="information-price">
                    <?php $priceglobal = $item['priceglobal']; ?>
                    <?php echo number_format((double)$priceglobal, 0, ' ', ' '); ?> руб.
                </div>
            </div>
            <br/>
        </div>
        <br/>
        <br/>
    </div>
    <?php $countas++; ?>
    <?php
    $image = array();
}
?>
<?php $current_url = Request::instance()->uri() . URL::query(); ?>
<?php $pos = strripos($current_url, '?'); ?>
<?php if ($pos === false) {
    $current_url_type = '?';
} else {
    $current_url_type = '&';
} ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.sortby').change(function () {
            var value = jQuery(this).val();
            <?php if($current_url_type=='?') { ?>
            window.location = '/<?php echo $current_url; ?>?order_by=' + value;
            <?php } else { ?>
            window.location = '/<?php echo $current_url; ?>&order_by=' + value;
            <?php } ?>
        });

    });
</script>
