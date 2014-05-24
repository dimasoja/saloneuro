<?php echo ViewMessage::renderMessages(); ?>
<div id="messages">
    <?php
    if (isset($success)) {
        if ($success == 'ok') {
            $text = "<div class='success-text'>Сохранено успешно</div>";
        }
        if ($success == 'found_url') {
            $text = "<div class='error-text'>Такой адрес страницы уже существует. Пожалуйста, введите другой.</div>";
        }
        ?>
        <div class="success-mess">
            <?php echo '<img class="success-img" src="/images/check_no.png"/>';
            echo $text;
            ?>
        </div>

<?php } ?>
</div>
<form method ="post" action="<?php echo URL::base(); ?>admin/products/new/" id="edit-form-submit"  enctype="multipart/form-data">
    <h1>Добавить новую услугу:</h1><br/>
        <p>       
        <input class="submit" type="button" value="Сохранить услугу" onclick="validate()" />       
    </p>
    <div id="meta_tag" style="display: block;">
        <h3>Имя услуги:</h3><input type="text" name="title" style="width: 652px !important;" id="title" value="<?php if (isset($title)) echo $title; ?>"><br>
        <h3>Ключевые слова (мета тэг):</h3><input type="text" name="keywords" style="width: 652px !important;" id="keywords" value="<?php if (isset($kewwords)) echo $keywords; ?>"><br>
        <h3>Описание (мета тэг):</h3><textarea id="description" name="description" cols="90" rows="5"><?php if (isset($description)) echo $description; ?></textarea><br>
        <h3>Адрес услуги (от корня)</h3><input type="text" name="browser_name" style="width: 652px !important;" id="alias" value="<?php if (isset($browser_name)) echo $browser_name; ?>"><br>
        <h3>Тип услуги (от корня)</h3>
        <select name="type" id="type">
            <option value="for_home" <?php if (isset($type)) {
    if ($type == 'selected') echo 'selected';
} ?>>Для дома</option>
            <option value="for_business" <?php if (isset($type)) {
    if ($type == 'selected') echo 'selected';
} ?>>Для бизнеса</option>        
        </select>
        <br>
        <br/><h3>Опубликовано? <input type="checkbox" name="published" <?php if ((isset($published)) and ($published == 'on')) echo "checked='checked'"; ?>/></h3>
    </div><br/>
        <div class="row-fluid">                    
                
                <div class="span6 question-1">
                           <div class="widget">
                                <div class="widget-header">
                                      <h5>Виды услуг </h5>
                                </div>
                                <div class="widget-content answers">                                      
                                      <div class="field">
                                           
                                           <label class="field-name cursorpointer addquestion" onclick="showAddAnswer(1)">Добавить вид услуги:&nbsp;&nbsp;
                                                <a data-toggle="n-tooltip">
                                                      <img src="/images/admin/icon/14x14/light/plus.png" class="plus"></a>
                                           </label><br><br>
                                      </div>
                               </div>
                           </div>
                      </div>
                      </div>  

    <textarea name="content" style="width: 100%; height: 600px;"><?php if (isset($text)) echo $text; ?></textarea><br/>
    Загрузить изображение: <input type="file" name="image_file"/><br/>
    <br/>
    <p>       
        <input class="submit" type="button" value="Сохранить услугу" onclick="validate()" />       
    </p>

</form>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var editor = CKEDITOR.replace('content',
        {
            uiColor : 'lightgrey',
            language: 'en'
        });
        CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
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

    
<script type="text/javascript">
function showAddAnswer(count) {    
    var count_field = jQuery('.question-'+count+' .answers .field').length;      
    answers = jQuery('.question-'+count+' .answers');
    answers.append('<div class="field answer-'+count_field+'">\n\
                         <span class="checked">\n\
                             <!-- <input type="radio" name="radio-'+count+'" rel="'+count_field+'">-->\n\
                         </span>\n\
                         <input type="text" name="value-type[]" class="input-large">\n\
                         \n\
                         <img class="cursorpointer" block="'+count+'" answer="'+count_field+'" onClick=removeCheck(jQuery(this)) src="/images/admin/forms/close.png">\n\
                              \n\
                         \n\
                    </div>\n\
                    </div>\n\ ');                             
    $('input[type="checkbox"], input[type="radio"], select.uniform, input[type="file"]').uniform();
  /*  if(( count )%2) {        
        this_height = jQuery('.question-'+count).height();
        num = count+1;
        jQuery('.question-'+num).height(this_height);        
    } else {
        this_height = jQuery('.question-'+count).height();
        num = count-1;
        jQuery('.question-'+num).height(this_height);        
    }*/
}
function removeCheck(elem) {
    block = elem.attr('block');
    answer = elem.attr('answer');
    jQuery('.question-'+block+' .answer-'+answer).remove();    
}
function showAddQuestion() {
    questions = jQuery('.questions');
    var count_question = jQuery('.questions .span6').length+1;       
    questions.append('<div class="span6 question-'+count_question+'">\n\
                           <div class="widget">\n\
                                <div class="widget-header">\n\
                                      <h5>Вопрос </h5><img class="cursorpointer removeblock" onclick="removeBlock('+count_question+')" src="/images/admin/forms/close.png">\n\
                                </div>\n\
                                <div class="widget-content answers">\n\
                                      <label class="field-name" for="standard">Вопрос:</label>\n\
                                      <div class="field">\n\
                                           <input type="text" class="input-xlarge" name="standard" id="question-text-'+count_question+'"><br/>\n\
                                           <label class="field-name cursorpointer addquestion" onClick="showAddAnswer('+count_question+')">Добавить ответ:&nbsp;&nbsp;\n\
                                                <a data-toggle="n-tooltip" >\n\
                                                      <img src="/images/admin/icon/14x14/light/plus.png" class="plus" ></a>\n\
                                           </label><br/><br/>\n\
                                      </div>\n\
                               </div>\n\
                           </div>\n\
                      </div>'
        );

}
function saveTest() {
    var count_question = jQuery('.questions .span6').length+1; 
    is_continue=true;
    var name = jQuery('.name');    
    var start = jQuery('.start');
    var end = jQuery('.end');
    if (jQuery.trim(jQuery('.name').val()) == '') {
       name.css('border', '1px solid #e7a09f');            
       is_continue = false;
    } else {
       name.css('border', '1px solid #d2d2d2');                  
    }
    if (jQuery.trim(start.val()) == '') {
       start.css('border', '1px solid #e7a09f');            
       is_continue = false;
    } else {
       start.css('border', '1px solid #d2d2d2');                  
    }
    if (jQuery.trim(end.val()) == '') {
       end.css('border', '1px solid #e7a09f');            
       is_continue = false;
    } else {
       end.css('border', '1px solid #d2d2d2');                  
    }
    var result = {};
    for(i=1; i<count_question; i++) {
        var question = jQuery('.question-'+i+' #question-text-'+i).val();
        if(question=='') is_continue=false;
        var quest = [];
        quest.push(question);        
        count_field = jQuery('.question-'+i+' .answers .field').length;            
        for(m=1; m<count_field; m++) {            
            var answer = jQuery('.question-'+i+' .answer-'+m+' .input-large').val();
            if(answer=='') is_continue=false;
            quest.push(answer);
        }        
        var right_answer = jQuery('.question-'+i+' span.checked span.checked input').attr('rel');
        if(right_answer==null) is_continue=false;
        quest.push(right_answer);
        quest.push(name.val());
        quest.push(start.val());
        quest.push(end.val());
        result[i] = quest;
    }     
    console.log(result);
    if(is_continue==false) {
        alert("Заполните, пожалуйста, имя теста, дату активации/окончания, все открытые ответы/вопросы и отметьте везде верные ответы ");
    } else {
        jQuery.post('/userfriendlycms2013/tests/save', {test: result}, function(data) {
            console.log(data);
            if(data=='ok') window.location = '/userfriendlycms2013/tests/show/all'; else console.log(data);
        });   
    }
}
function removeBlock(num) {
    jQuery('.question-'+num).remove();
}
</script>

<script type="text/javascript">
    function validateForm() {
        yes = jQuery('.yes');
        no = jQuery('.no');
        mess_yes = jQuery('#notification-form .error1');
        mess_no = jQuery('#notification-form .error2');
        text_yes = yes.val();
        text_no = no.val();
        is_continue = true;
        if (jQuery.trim(text_yes) == '') {
            yes.css('border', '1px solid #e7a09f');
            mess_yes.css('display', 'block');
            is_continue = false;
        } else {
            yes.css('border', '1px solid #d2d2d2');
            mess_yes.css('display', 'none');            
        }
        if (jQuery.trim(text_no) == '') {
            no.css('border', '1px solid #e7a09f');
            mess_no.css('display', 'block');
            is_continue = false;
        } else {
            no.css('border', '1px solid #d2d2d2');
            mess_no.css('display', 'none');            
        }
        return is_continue;
    }
    function saveNotification() {
        yes = jQuery('.yes');
        no = jQuery('.no');
        is_continue = validateForm();
        if (is_continue === true) {
            jQuery.post('/userfriendlycms2013/notifications/savenotificationdouble?type=check', {message_yes: yes.val(),message_no: no.val()}, function(data) {
                if (data == 'ok') {
                    jQuery('.alert.alert-info.noMargin').css('display', 'block').html('<button type="button" class="close" data-dismiss="alert">&times;</button>Уведомление сохранено успешно.');
                }
            });
        }
    }
    </script>
