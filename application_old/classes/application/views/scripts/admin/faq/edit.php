<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div class="inner-content">
    <div class="widget-content" align="center">

        <br/>
        <br/>
        <div class="category-toggle" style="overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/faq/edit/<?php echo $faq->id; ?>" method="POST">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Вопрос:</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="question" value="<?php echo $faq->question; ?>" style="float: left;width: 100%;">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Ответ:</label>
                                <div class="field">
                                    <textarea name="answer" id="add-answer" class="input-large name-edit"><?php echo $faq->answer; ?></textarea>
                                </div>
                                <br/>
                                <input type="submit" class="button button-blue small-button margintop18 marginleft128" value="Изменить">
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