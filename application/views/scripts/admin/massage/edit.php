<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="inner-content">
    <div class="widget-content" align="center">
        <div class="category-toggle" style="display: block;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/massage/editpage/<?php echo $massage->id; ?>" method="POST"
                          enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новая:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Наименование:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="name"
                                           style="float: left;width: 100%;" value="<?php echo $massage->name; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Описание:</label>

                                <div class="field">
                                    <textarea name="description" id="add-answer"
                                              class="input-large name-edit"><?php echo $massage->description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Электронное управление?:</label>
                                <div class="field " style="text-align:left;">
                                    <select class="uniform electronic" name="electronic">
                                        <option value="off" <?php if($massage->electronic=='off') echo 'selected'; ?>>Нет</option>
                                        <option value="on" <?php if($massage->electronic=='on') echo 'selected'; ?>>Да</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Цена:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="price"
                                           style="float: left;width: 100%;" value="<?php echo $massage->price; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Изображение:</label>

                                <div class="field">
                                    <input type="file" class="input-large name-edit" name="image"
                                           style="float: left;width: 100%;">
                                </div>
                                <?php if($massage->image!='') { ?>
                                    <img src="<?php echo $massage->image; ?>" width="200"/>
                                <?php } ?>
                                <br/><br/><br/>
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