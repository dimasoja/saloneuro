

<div class="form-row">
    <!--    <a href="#" class="button button-turquoise small-button" onclick="showAddQuestion()">-->
    <!--        <label class="field-name cursorpointer" >Добавить вопрос:</label>-->
    <!--    </a>-->
    <?php if ($directory->type != 'text') { ?>
        <div class="field questions" style="overflow:auto">
            <input type="hidden" value="<?php echo $directory->id; ?>" class="directory-id"/>

            <div class="span6 question-1">
                <div class="widget">
                    <div class="widget-header">
                        <h5>Элемент справочника </h5>
                        <!--                    <img class="cursorpointer removeblock" onclick="removeBlock(1)"-->
                        <!--                                         src="/images/admin/forms/close.png">-->
                    </div>
                    <div class="widget-content answers">
                        <label class="field-name" for="standard">Наименование:</label>

                        <div class="field">
                            <input type="text" class="input-xlarge" name="standard" id="question-text-1"
                                   value="<?php echo $directory->name; ?>"><br><br/>
                            <br>
                        </div>
                        <div class="form-row" style="height:100px">
                            <label class="field-name" for="standard">Категории:</label>

                            <div class="field" style="text-align: left;">
                                <select multiple="" name="categories[]" class="categories-multiple">
                                    <?php foreach($categories as $category) { ?>
                                        <option value="<?php echo $category->id; ?>" <?php if(in_array($category->id, $json_cat)) echo 'selected'; ?>><?php echo $category->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="field-name cursorpointer addquestion" onclick="showAddAnswer(1)">Добавить
                                опцию:&nbsp;&nbsp;
                                <a data-toggle="n-tooltip">
                                    <img src="/images/admin/icon/14x14/light/plus.png" class="plus"></a>
                            </label>
                        </div>
                        <?php $count = 1; ?>
                        <?php foreach ($items as $item) { ?>
                            <div class="field answer-<?php echo $count; ?>">

                                <!--                              <input type="radio" name="radio-1" rel="-->
                                <?php //echo $item->id; ?><!--">-->

                                <input type="text" class="input-large" value="<?php echo $item->name; ?>">
                                <img class="cursorpointer" block="1" answer="<?php echo $count; ?>"
                                     onclick="removeCheck(jQuery(this))"
                                     src="/images/admin/forms/close.png">
                            </div>
                            <?php $count++; ?>
                        <?php } ?>
                    </div>
                    <br/>


                </div>
                <div class="button button-blue small-button cursorpointer" style="clear:both ;margin-left:0px" onclick="saveTest()">
                    Сохранить
                    тест
                </div>
            </div>
        </div>
    <?php } else { ?>




    <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
        <div class="widget">
            <form class="form-horizontal" action="/admin/directory/edittext/<?php echo $directory->id; ?>" method="POST"
                  enctype="multipart/form-data">
                <div class="widget-content no-padding">
                    <div class="form-row">
                        <label class="field-name" for="standard">Наименование:</label>

                        <div class="field">
                            <input type="text" class="input-large name-edit" name="name"
                                   style="float: left;width: 100%;" value="<?php echo $directory->name; ?>">
                        </div>
                        <input type="hidden" value="<?php echo $directory->id; ?>"/>
                    </div>
                    <br/>
                    <div class="form-row">
                        <label class="field-name" for="standard">Категории:</label>
                        <div class="field" style="text-align: left;">
                            <select multiple="" name="categories[]">
                                <?php foreach($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>" <?php if(in_array($category->id, $json_cat)) echo 'selected'; ?>><?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div><br/>
                    <input type="submit" class="button-turquoise button" value="Отправить" style="margin-left: 219px;"/>
                    <br/><br/>
                </div>
            </form>
        </div>
    </div>



</div>
<?php } ?>
</div>


<script type="text/javascript">
    function showAddAnswer(count) {
        var count_field = jQuery('.question-' + count + ' .answers .field').length;
        answers = jQuery('.question-' + count + ' .answers');
        answers.append('<div class="field answer-' + count_field + '">\n\
                         <span class="checked">\n\
                              <!--<input type="radio" name="radio-' + count + '" rel="' + count_field + '">-->\n\
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
        console.log('.question-' + block + ' .answer-' + answer);
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
                                           <label class="field-name cursorpointer addquestion" onClick="showAddAnswer(' + count_question + ')">Добавить опцию:&nbsp;&nbsp;\n\
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
        var id = jQuery('.directory-id').val();
        var str = [];
        $(".categories-multiple option:selected").each(function () {
            str.push($(this).val());
        });

        var categories = JSON.stringify(str);
        is_continue = true;
        var count_question = jQuery('.questions .span6').length + 1;
        var result = {};
        for (i = 1; i < count_question; i++) {
            var question = jQuery('.question-' + i + ' #question-text-' + i).val();
            var quest = [];
            quest.push(question);
            count_field = jQuery('.question-' + i + ' .answers .field').length;
            for (m = 1; m < count_field; m++) {
                var answer = jQuery('.question-' + i + ' .answer-' + m + ' .input-large').val();
                if (answer == '') {
                    is_continue = false;
                }
                quest.push(answer);
            }
            result[i] = quest;
        }
        console.log(result);
        if (is_continue == false) {
            alert("Заполните, пожалуйста, имя справочника ");
        } else {
            jQuery.post('/admin/directory/save', {test: result, id: id, categories:categories}, function (data) {
                console.log(data);
                if (data == 'ok') window.location = '/admin/directory'; else console.log(data);
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


























</div>


</div>

