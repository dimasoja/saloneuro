<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="inner-content">
    <div class="widget-content" align="center">

        <br/>
        <br/>
        <div class="category-toggle" style="overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/information/editpage/<?php echo $page->id; ?>" method="POST" enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новая: </h5>
                            <span style="display:none"><?php echo $page->name; ?></span>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Заголовок:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="title" value="<?php if(isset($page->name)) echo $page->name; ?>" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Текст:</label>
                                <div class="field">
                                    <textarea name="content" id="add-answer" class="input-large name-edit"><?php if(isset($page->name)) echo $page->content; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Вставить в блок:</label>
                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="featured" class="uniform" <?php if(isset($page->featured)) {if($page->featured=='on') echo 'checked';}; ?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Технология? (Выводится в товарах):</label>
                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="technologies" class="uniform" <?php if(isset($page->technologies)) {if($page->technologies=='on') echo 'checked';}; ?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Изображение:</label>
                                <div class="field">
                                    <input type="file" class="input-large name-edit" name="image" style="float: left;width: 100%;">
                                    <?php if($page->image!='0') { ?>
                                        <img src="<?php echo $page->image; ?>" width="200"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Категория:</label>
                                <div class="field" style="text-align:left;">
                                    <select name="parent_id" class="uniform">
                                        <?php foreach($categories as $category) { ?>
                                            <option value="<?php echo $category->id; ?>" <?php if($category->id==$page->parent_id) echo "selected"; ?>><?php echo $category->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <br/>
                                <input type="submit" class="button button-blue small-button margintop18 marginleft128" value="Обновить">
                                <br/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var editor = CKEDITOR.replace('add-answer',
                {
                    uiColor : 'lightgrey',
                    language: 'en'
                });
            CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
        });


    </script>