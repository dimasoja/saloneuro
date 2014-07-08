
<div class="inner-content">
    <script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
    <div class="row-fluid">
        <div class="widget">
            <form class="form-horizontal" id='asdf' style="text-align:center;">
                <div class="widget-header">
                    <h5>HTML код:</h5>
                </div>
                <div class="widget-content no-padding">
                    <div class="form-row">
                        <label class="field-name" for="standard">Контент:</label>

                        <div class="field">
                            <textarea name="content" id="production"
                                      style="width: 100%; height: 600px;"><?php if (isset($content)) {
                                    echo $content;
                                } ?></textarea>
                        </div>
                    </div>

                    <br/>
                    <a href="#" class=" tutu button button-turquoise small-button configuration-button"
                       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                    <br/><br/>
                </div>
            </form>
        </div>
    </div>
    </div>



    <script type="">

        jQuery(document).ready(function () {
            var editor = CKEDITOR.replace('content',
                {
                    uiColor: 'lightgrey',
                    language: 'en'
                });

            CKFinder.setupCKEditor(editor, '/js/ckeditor/ckfinder/');

            jQuery('.tutu').click(function () {
                CKEDITOR.instances['production'].updateElement();
                var production = jQuery('#production').val();
                jQuery.post('/admin/index/saveproduction', {production: production}, function (data) {
                    console.log(data);
                    jQuery('.alert.alert-info.noMargin font').html('Сохранено.');
                    jQuery('.alert.alert-info.noMargin').css('display', 'block');
                    jQuery('.alert.alert-info.noMargin').fadeOut(3000);
                });
            });


        });
    </script>
</div>