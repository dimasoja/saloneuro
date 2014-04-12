<div id="inside_container">
    <h2>Результаты поиска <?php if(isset($word)) echo 'по запросу "'.$word.'"'; ?></h2>
    <?php $s_page = 'no';?>
    <?php $s_product = 'no';?>
    <?php if (isset($search['0'])) { ?>
        <h2>Страницы:</h2><?php
        if (is_array($search)) {
            $s_page = 'yes';
            foreach ($search as $s) {
                if($s!='63') {
                $page = ORM::factory('pages')->where('id_page', '=', $s)->find();

                ?>
<br/>
            <div class="search-name">
                <h2><a href='/<?php echo $page->browser_name; ?>' style="font-size: 17px"><?php echo $page->title; ?></a>   </h2>
            </div>
                <?php echo substr($page->value,0,700); ?><br/>


            <?php } ?><?php 
         
            }
        }
    }
    ?>
    <?php if (isset($search_product['0'])) { ?>
        <h2>Услуги:</h2><br/><?php
        foreach ($search_product as $s) {
            $s_product = 'yes';
            $products = ORM::factory('products')->where('id_product', '=', $s)->find();
            $image = ORM::factory('images')->where('part', '=', 'products')->where('id_page', '=', $products->id_product)->find();
            ?><br/>
            <div class="search-name">
                <h2><a href='/<?php echo $products->browser_name; ?>' style="font-size: 17px"><?php echo $products->title; ?></a</h2>
            </div>
        <?php if ($image != '') { ?>
                <a href="<?php echo '/uploads/images/' . $image->path; ?>" class="fancybox" >
                    <img src="<?php echo '/uploads/images/' . $image->path; ?>" class="products-search-image"/>
                </a>
                <?php echo substr($products->content,0,700); ?><br/>


            <?php }
        } ?>
    <?php }
    ?>
   <?php  if(($s_page=='yes')&&($s_page=='yes')) {
       //echo '<h2>К сожалению, по вашему запросу ничего не найдено</h2>';
   }
       
       
       ?>

  </div>