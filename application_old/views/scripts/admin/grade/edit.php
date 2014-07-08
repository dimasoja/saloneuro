<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="inner-content">
    <div class="widget-content" align="center">
        <div class="category-toggle" style="display: block;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/grade/editpage/<?php echo $grade->id; ?>" method="POST"
                          enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новая:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Наименование:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="name"
                                           style="float: left;width: 100%;" value="<?php echo $grade->name; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Описание:</label>

                                <div class="field">
                                    <textarea name="description" id="add-answer"
                                              class="input-large name-edit"><?php echo $grade->description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Цена:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="price"
                                           style="float: left;width: 100%;" value="<?php echo $grade->price; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Изображение:</label>

                                <div class="field">
                                    <input type="file" class="input-large name-edit" name="image"
                                           style="float: left;width: 100%;">
                                </div>
                                <?php if($grade->image!='') { ?>
                                    <img src="<?php echo $grade->image; ?>" width="200"/>
                                <?php } ?>
                                <br/><br/><br/>

                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Группировать по продукту:</label>

                                <div class="field" style="text-align:left;">
                                    <select name="group" class="uniform">
                                        <option value=""></option>
                                        <?php foreach ($products as $product) { ?>
                                            <option value="<?php echo $product->id; ?>" <?php if($grade->group==$product->id) echo 'selected'; ?>><?php echo $product->name; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <input type="submit" class="button button-blue small-button margintop18 marginleft128"
                                       value="Редактировать">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var editor = CKEDITOR.replace('add-answer',
            {
                uiColor: 'lightgrey',
                language: 'en'
            });
        CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');
    });


</script>