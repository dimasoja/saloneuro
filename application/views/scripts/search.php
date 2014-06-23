<div id="inside_container">
    <h2>Результаты поиска <?php if (isset($word)) {
            echo 'по запросу "' . $word . '"';
        } ?></h2>
    <?php $s_page = 'no'; ?>
    <?php $s_product = 'no'; ?>
    <?php if (isset($search['0'])) { ?>

        <?php
        if (is_array($search)) {
            $s_page = 'yes';
            foreach ($search as $s) {
                $page = ORM::factory('catalog')->where('id', '=', $s)->find();
                $parent = ORM::factory('productscat')->where('id', '=', $page->category)->find();

                ?>
                <br/>
                <div class="search-name">
                    <h2>
                        <a href="/catalog/<?php echo strtolower(FrontHelper::transliterate($parent->name)) . '/'; ?><?php echo strtolower(FrontHelper::transliterate($page->name)); ?>"><?php echo $page->name; ?></a>'
                    </h2>
                </div>
                <?php echo FrontHelper::truncateHtml($page->description, 700, '...'); ?><br/>
            <?php
            } ?><?php
        }
    }
    ?>
    <?php  if (($s_page == 'yes') && ($s_page == 'yes')) {
        //echo '<h2>К сожалению, по вашему запросу ничего не найдено</h2>';
    }
    ?>

