<script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>

<form class="form-horizontal" action='/admin/templates/edit/<?php echo $template->id; ?>' method='POST'>
    <div class="widget">
        <div class="widget-header">
            <h5>Редактировать шаблон:</h5>

        </div>
        <div class="widget-content no-padding">
            <div class="form-row">
                <label class="field-name" for="standard">Идентификатор шаблона:</label>

                <div class="field">
                    <input type="text" class="input-large name-edit" name="description"
                           value="<?php echo $template->description; ?>"/>
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Шаблон:</label>

                <div class="field">
                    <textarea id="content"
                              name="template"><?php echo $template->template; ?></textarea>
                </div><input type='submit' class="button button-turquoise" value='Сохранить'/>
            </div>

            </div>
        </div>
    </form>


<script type="text/javascript">
    function deletecat(id) {
        if (confirm('Are you shure?')) {
            window.location = '/admin/categories/delete/' + id;
        }
    }

    function deleteGroup(id) {
        if (confirm('Are you shure?')) {
            window.location = '/admin/categories/deletegroup/' + id;
        }
    }

    jQuery(document).ready(function () {
        jQuery('.button.button-blue.marginbottom30').click(function () {
            if (jQuery('.category-toggle').css('display') == 'none') {
                jQuery('.category-toggle').slideDown('slow', function () {
                    jQuery(this).css('display', 'block');
                });
            } else {
                jQuery('.category-toggle').slideUp('slow', function () {
                    jQuery(this).css('display', 'none');
                });
            }
        });
        jQuery('.tabitem').click(function () {
            jQuery(this).parents(5).children().children('.displayblock').removeClass('displayblock');
        });
        jQuery('.fancybox').fancybox({
            beforeShow: function () {
                var id = jQuery(this)[0].element.attr('rel_id');
                var group_name = jQuery('.group-name-' + id + ' a').html();
                var question = jQuery('#tabs' + id + ' .span12').val();
                jQuery('#form-edit .group-edit').val(id);
                jQuery('#form-edit .question-edit').val(question);
                jQuery('#form-edit .name-edit').val(group_name);
                jQuery('#form-edit').css('margin-left', '15px').css('margin-top', '26px');
            }
        });
    });


</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var editor = CKEDITOR.replace('content',
            {
                uiColor : 'lightgrey',
                language: 'en'
            });
        CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
        jQuery('.portofldescr').click(function(){
            var id = jQuery(this).attr('rel');

            var text = jQuery('.portofldescr'+id).val();
            jQuery.get('/admin/pages/descrimage', {id:id, text:text}, function(data){
                jQuery('.alert.alert-info.noMargin font').html('Сохранено успешно');
                jQuery('.alert.alert-info.noMargin').css('display','block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            })

        });
    });

</script>

