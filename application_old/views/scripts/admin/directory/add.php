<div class="form-row">
    <a href="#" class="button button-turquoise small-button" onclick="showAddQuestion()">
        <label class="field-name cursorpointer" >Добавить вопрос:</label>
    </a>
    <br/><br/>
    <div class="field questions">

        <div class="span6 question-1">
            <div class="widget">
                <div class="widget-header">
                    <h5>Вопрос </h5><img class="cursorpointer removeblock" onclick="removeBlock(1)"
                                         src="/images/admin/forms/close.png">
                </div>
                <div class="widget-content answers">
                    <label class="field-name" for="standard">Вопрос:</label>

                    <div class="field">
                        <input type="text" class="input-xlarge" name="standard" id="question-text-1"><br>
                        <label class="field-name cursorpointer addquestion" onclick="showAddAnswer(1)">Добавить ответ:&nbsp;&nbsp;
                            <a data-toggle="n-tooltip">
                                <img src="/images/admin/icon/14x14/light/plus.png" class="plus"></a>
                        </label><br><br>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<br>


<script type="text/javascript">
    function showAddAnswer(count) {
        var count_field = jQuery('.question-' + count + ' .answers .field').length;
        answers = jQuery('.question-' + count + ' .answers');
        answers.append('<div class="field answer-' + count_field + '">\n\
                         <span class="checked">\n\
                              <input type="radio" name="radio-' + count + '" rel="' + count_field + '">\n\
                         </span>\n\
                         <input type="text" class="input-large">\n\
                         \n\
                         <img class="cursorpointer" block="' + count + '" answer="' + count_field + '" onClick=removeCheck(jQuery(this)) src="/images/admin/forms/close.png">\n\
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
        jQuery('.question-' + block + ' .answer-' + answer).remove();
    }
    function showAddQuestion() {
        questions = jQuery('.questions');
        var count_question = jQuery('.questions .span6').length + 1;
        questions.append('<div class="span6 question-' + count_question + '">\n\
                           <div class="widget">\n\
                                <div class="widget-header">\n\
                                      <h5>Вопрос </h5><img class="cursorpointer removeblock" onclick="removeBlock(' + count_question + ')" src="/images/admin/forms/close.png">\n\
                                </div>\n\
                                <div class="widget-content answers">\n\
                                      <label class="field-name" for="standard">Вопрос:</label>\n\
                                      <div class="field">\n\
                                           <input type="text" class="input-xlarge" name="standard" id="question-text-' + count_question + '"><br/>\n\
                                           <label class="field-name cursorpointer addquestion" onClick="showAddAnswer(' + count_question + ')">Добавить ответ:&nbsp;&nbsp;\n\
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
        var count_question = jQuery('.questions .span6').length + 1;
        is_continue = true;
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
        for (i = 1; i < count_question; i++) {
            var question = jQuery('.question-' + i + ' #question-text-' + i).val();
            if (question == '') is_continue = false;
            var quest = [];
            quest.push(question);
            count_field = jQuery('.question-' + i + ' .answers .field').length;
            for (m = 1; m < count_field; m++) {
                var answer = jQuery('.question-' + i + ' .answer-' + m + ' .input-large').val();
                if (answer == '') is_continue = false;
                quest.push(answer);
            }
            var right_answer = jQuery('.question-' + i + ' span.checked span.checked input').attr('rel');
            if (right_answer == null) is_continue = false;
            quest.push(right_answer);
            quest.push(name.val());
            quest.push(start.val());
            quest.push(end.val());
            result[i] = quest;
        }
        console.log(result);
        if (is_continue == false) {
            alert("Заполните, пожалуйста, имя теста, дату активации/окончания, все открытые ответы/вопросы и отметьте везде верные ответы ");
        } else {
            jQuery.post('/userfriendlycms2013/tests/save', {test: result}, function (data) {
                console.log(data);
                if (data == 'ok') window.location = '/userfriendlycms2013/tests/show/all'; else console.log(data);
            });
        }
    }
    function removeBlock(num) {
        jQuery('.question-' + num).remove();
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
            jQuery.post('/userfriendlycms2013/notifications/savenotificationdouble?type=check', {message_yes: yes.val(), message_no: no.val()}, function (data) {
                if (data == 'ok') {
                    jQuery('.alert.alert-info.noMargin').css('display', 'block').html('<button type="button" class="close" data-dismiss="alert">&times;</button>Уведомление сохранено успешно.');
                }
            });
        }
    }
</script>
</div>

</div>
<div class="button button-blue small-button cursorpointer" style="margin-left: 20px;" onclick="saveTest()">Сохранить
    тест
</div><br><br>
