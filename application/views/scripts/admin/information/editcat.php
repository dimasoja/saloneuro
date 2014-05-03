<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="inner-content">
    <div class="widget-content" align="center">

        <br/>
        <br/>
        <div class="category-toggle" style="overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/information/editcat/<?php echo $cat->id; ?>" method="POST">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Наименование:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="name" value="<?php echo $cat->name; ?>" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Порядок:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="order" value="<?php echo $cat->order; ?>" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Title (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="title" style="float: left;width: 100%;" value="<?php echo $cat->title; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Keywords (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="keywords" style="float: left;width: 100%;" value="<?php echo $cat->keywords; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Description (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="description" style="float: left;width: 100%;" value="<?php echo $cat->description; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Порядок:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="order" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">


                                <input type="submit" class="button button-blue small-button margintop18 marginleft128" value="Добавить">
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