<?php echo ViewMessage::renderMessages(); ?>
<div id="messages">
<?php if (isset($success)) { 
    if($success=='ok') {$mess = "<img class='success-img' src='/images/check_no.png'/><div class='success-text'>Сохранено успешно</div>";}
    if($success=='found_url') {$mess = "<img class='error-img' src='/images/close-icon.gif'/><div class='error-mess'>Такой адрес страницы уже существует. Пожалуйста, введите другой.</div>";}
    ?>
    <div class="success-mess">
        <?php echo $mess;?>
    </div>
<?php } ?>
</div>
<form method="post" action="<?php echo URL::base(); ?>admin/pages/new/" id="edit-form-submit" class="form-horizontal">
    <button class="button submit button-blue small-button" onclick="validate()">Сохранить страницу</button>
    <br/><br/>
    <div class="widget">
        <div class="widget-header">
            <h5>Добавить новую страницу:</h5>

        </div>
        <div class="widget-content no-padding">
            <div class="form-row">
                <label class="field-name" for="standard">Имя страницы:</label>

                <div class="field">
                    <input type="text" name="title" style="width: 652px !important;" id="title"
                           value="<?php if (isset($title)) {
                               echo $title;
                           } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Ключевые слова (мета тэг):</label>

                <div class="field">
                    <input type="text" name="keywords" style="width: 652px !important;"
                           id="keywords" value="<?php if (isset($keywords)) {
                        echo $keywords;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Описание (мета тэг):</label>

                <div class="field">
                    <textarea id="description" name="description" cols="90"
                              rows="5"><?php if (isset($description)) {
                            echo $description;
                        } ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Адрес страницы (от корня):</label>

                <div class="field">
                    <input type="text" name="browser_name" style="width: 652px !important;"
                           id="alias" value="<?php if (isset($browser_name)) {
                        echo $browser_name;
                    } ?>">
                </div>
            </div>
            <div class="form-row">
                <label class="field-name" for="standard">Контент:</label>

                <div class="field">
                    <textarea name="content" style="width: 100%; height: 600px;"><?php if (isset($text)) {
                            echo $text;
                        } ?></textarea>
                </div>
            </div>
            <!--            <div class="form-row">-->
            <!--                <label class="field-name" for="standard">Тип:</label>-->
            <!---->
            <!--                <div class="field">-->
            <!--                    <select name="type" class="uniform">-->
            <!--                        <option value="simple" selected>Обычная</option>-->
            <!--                        <option value="news">Новости/Статьи</option>-->
            <!--                    </select>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="form-row">
                <label class="field-name" for="standard">Опубликовано?</label>

                <div class="field">
                    <input type="checkbox"
                           name="published" <?php if ((isset($published)) and ($published == 'on')) {
                        echo "checked='checked'";
                    } ?>/>
                </div>
            </div>
        </div>

    </div>
    <button class="button submit button-blue small-button" onclick="validate()">Сохранить страницу</button>
    <br/><br/>
</form>



<script type="text/javascript" src="/js/admin/fileupload.js"></script>

    <input id="upload1" type="button" value="Загрузить изображение для портфолио" class="button_example button button-turquoise" style="margin-top:0px;display:none;margin-left: 0px;" href="#">

<br/>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var btnUpload = jQuery('#upload1'); 
        var status = jQuery('#status');
        var upload = new AjaxUpload(btnUpload, {
            action: '/admin/products/uploadimage',
            name: 'uploadfile',
            data: {id: <?php echo $id; ?>},
            onSubmit: function(file, ext) {
                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    status.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
//status.text('Загрузка...');
            },
            onComplete: function(file, response) {
                var response_image = response.split("~");
                var id_image = response_image[0];
                var path = response_image[1];                
                var portfolio = jQuery('.portfolio');
                var image_html = '<div class="sws_img_block imagerel' + id_image + '">\n\
                                           <div class="img_block">\n\
                                                <img src="' + path + '" style="max-width: 194px;">\n\
                                           </div>\n\
                                           <div class="del_block">\n\
                                                <a href="javascript:void:(0);" class="del_vid" onclick="deletePortfolio(' + id_image + ');">Удалить</a>\n\
                                           </div>\n\
                                   </div>';
                portfolio.append(image_html);
            }
        });
console.log(upload); 
    });
    
    function deletePortfolio(id) { 
        jQuery.get('/admin/pages/deleteimg',{id:id}, function(data){ console.log(data); 
           if(data=='ok') { 
               jQuery('.imagerel'+id).remove();
           }
        });
    }
</script>
<!--<div class="portfolio">-->
<!--    -->
<!--    --><?php //foreach ($portfolio as $portfol) { ?>
<!--        <div class="sws_img_block imagerel--><?php //echo $portfol->id_image; ?><!--">            -->
<!--            <div class="img_block">-->
<!--                <img src="--><?php //echo $portfol->path; ?><!--" style="max-width: 194px;">-->
<!--            </div>-->
<!--            Описание:-->
<!--            <div class="portfol-descr">-->
<!--                <input type="text" rel="--><?php //echo $portfol->id_image; ?><!--" class="portofldescr--><?php //echo $portfol->id_image; ?><!--" style="width:194px" value="--><?php //echo $portfol->descr; ?><!--"/>-->
<!--            </div>-->
<!---->
<!--            <input type="button" value="Сохранить" class="button_example portofldescr button button-turquoise      " rel="--><?php //echo $portfol->id_image; ?><!--" style="margin-top:16px;margin-left: 0px;" href="#">-->
<!--            <div class="del_block">                    -->
<!--                <a href="javascript:void:(0);" class="del_vid" onclick="deletePortfolio(--><?php //echo $portfol->id_image; ?><!--);">Удалить</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    --><?php //} ?>
<!--</div>-->





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
    function editTemplate(obj) {
        var id = obj.value;        
        location.href = baseurl + 'admin/emails/index/' + id;
    }    
    function deleteTemplate(id) {
        if (confirm("Do you want to delete this template?")) {
            location.href = baseurl + 'admin/emails/delete/' + id;
        }
    }
    function validate() {
        if(jQuery('input[name=title]').val()=='') {
            jQuery('#messages').html('<div class="success-mess"><img class="error-img" src="/images/close-icon.gif"/><div class="error-mess">Имя страницы обязательно.</div></div>');
        } else {
            jQuery('#edit-form-submit').submit();
        }
    }

</script>