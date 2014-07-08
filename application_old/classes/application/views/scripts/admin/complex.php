<div class="inner-content">
    <div class="row-fluid">
        <div class="widget">
            <form class="form-horizontal">
                <div class="widget-header">
                    <h5>Комплексы услуг</h5>
                </div>
                <div class="widget-content no-padding">
                    <div class="form-row">
                        <label class="field-name cursorpointer" onClick="showAddQuestion()">Добавить комплекс услуг:&nbsp;&nbsp;<a data-toggle="n-tooltip" href="#"><img  onClick="showAddQuestion()" src="/images/admin/icon/14x14/light/plus.png" class="plus"></a></label><br/><br/>
                        <div class="field questions">
                            <?php $count = 0; 
                                  $complex_all = ORM::factory('complex')->find_all()->as_array();
                             //     $complex = array();
                            ?>
                            <?php foreach ($complex_all as $complex) { ?>
                                <?php $count++; ?>
                                <div class="span6 question-<?php echo $count; ?>">
                                    <div class="widget">
                                        <div class="widget-header">
                                            <h5>Комплекс услуг </h5><img class="cursorpointer removeblock" onclick="removeBlock(<?php echo $count; ?>)" src="/images/admin/forms/close.png">
                                        </div>
                                        <div class="widget-content answers">
                                            <label class="field-name" for="standard">Имя:</label>
                                          <div class="field"><input type="text" class="input-xlarge" name="standard" id="question-name-<?php echo $count; ?>" value="<?php if(isset($complex->name)) echo $complex->name; ?>"><br/></div>
                                          <label class="field-name" for="standard">Описание:</label>
                                          <div class="field"><input type="text" class="input-xlarge" name="standard" id="question-descr-<?php echo $count; ?>" value="<?php if(isset($complex->descr)) echo $complex->descr; ?>"><br/></div>
                                          <label class="field-name" for="standard">Цена:</label>
                                            <div class="field">                                                
                                                <input type="text" class="input-xlarge" name="standard" id="question-price-<?php echo $count; ?>" value="<?php if(isset($complex->price)) echo $complex->price; ?>"><br>
                                                <label class="field-name cursorpointer addquestion" onclick="showAddAnswer(<?php echo $count; ?>)">Добавить услугу:&nbsp;&nbsp;
                                                    <a data-toggle="n-tooltip">
                                                        <img src="/images/admin/icon/14x14/light/plus.png" class="plus"></a>
                                                </label><br><br>
                                            </div>
                                            <?php
                                                 $complextypes = ORM::factory('complextypes')->where('related','=',$complex->id)->find_all()->as_array();
                                            ?>
                                            <?php $count_ct = 2;?>
                                            <?php foreach($complextypes as $complextype) { ?>
                                            <?php $count_ct++;?>
                                            <div class="field answer-<?php echo $count_ct;?>">
                                                <input type="text" class="input-large" value="<?php if(isset($complextype->title)) echo $complextype->title; ?>">
                                                <img class="cursorpointer" block="<?php echo $count; ?>" answer="<?php echo $count_ct; ?>" onclick="removeCheck(jQuery(this))" src="/images/admin/forms/close.png">
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <br/><div class="button button-blue small-button cursorpointer" style="margin-left: 20px;margin-bottom:20px;" onClick="saveTest()">Сохранить комплекс</div><br>
<!--                    <div class="button button-red small-button cursorpointer" style="margin-left: 20px;" onClick="deleteTest(<?php //echo $tests->id; ?>)">Удалить тест</div><br/><br/>-->
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript">
                            function deleteTest(testId) {
                                jQuery.post('/userfriendlycms2013/tests/delete', {test: testId}, function(data) {
                                        if (data == 'ok')
                                            window.location = '/userfriendlycms2013/tests/show/all';
                                        else
                                            console.log(data);
                                            window.location = '/userfriendlycms2013/tests/show/all';
                                    });
                            }
        
                            function showAddAnswer(count) {
                                var count_field = jQuery('.question-' + count + ' .answers .field').length;
                                answers = jQuery('.question-' + count + ' .answers');
                                answers.append('<div class="field answer-' + count_field + '">\n\
                             <span class="checked">\n\
                                 <!-- <input type="radio" name="radio-' + count + '" rel="' + count_field + '">-->\n\
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
                                          <h5>Комплекс услуг </h5><img class="cursorpointer removeblock" onclick="removeBlock(' + count_question + ')" src="/images/admin/forms/close.png">\n\
                                    </div>\n\
                                    <div class="widget-content answers">\n\
                                    <label class="field-name" for="standard">Имя:</label>\n\
                                          <div class="field"><input type="text" class="input-xlarge" name="standard" id="question-name-' + count_question + '"><br/></div>\n\
                                          <label class="field-name" for="standard">Описание:</label>\n\
                                          <div class="field"><input type="text" class="input-xlarge" name="standard" id="question-descr-' + count_question + '"><br/></div>\n\
                                          <label class="field-name" for="standard">Цена:</label>\n\
                                          \n\
                                          \n\
                                          <div class="field">\n\
                                               <input type="text" class="input-xlarge" name="standard" id="question-price-' + count_question + '"><br/>\n\
                                               <label class="field-name cursorpointer addquestion" onClick="showAddAnswer(' + count_question + ')">Добавить услугу:&nbsp;&nbsp;\n\
                                                    <a data-toggle="n-tooltip">\n\
                                                          <img src="/images/admin/icon/14x14/light/plus.png" class="plus"></a>\n\
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
                                /*var name = jQuery('.name');
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
                                }*/
                                var result = {};
                                for (i = 1; i < count_question; i++) {
                                    var price = jQuery('.question-' + i + ' #question-price-' + i).val();
                                    var name = jQuery('.question-' + i + ' #question-name-' + i).val();
                                    var descr = jQuery('.question-' + i + ' #question-descr-' + i).val();
                                    if (price == '')
                                        is_continue = false;
                                        if (price == '')
                                    is_continue = false;
                                        if (price == '')
                                    is_continue = false;
                                    var quest = [];
                                    quest.push(name);
                                    quest.push(price);
                                    quest.push(descr);
                                    count_field = jQuery('.question-' + i + ' .answers .field .input-large').length;                                    
                                    for (m = 3; m < count_field+3; m++) { 
                                        var answer = jQuery('.question-' + i + ' .answer-' + m + ' .input-large').val();
                                        if (answer == '')
                                            is_continue = false;
                                        quest.push(answer);
                                    }
                                   // var right_answer = jQuery('.question-' + i + ' span.checked span.checked input').attr('rel');
                                  //  if (right_answer == null)
                                   //     is_continue = false;
                                   // quest.push(right_answer);
                                 //   quest.push(name.val());                                    
                                 //   quest.push(start.val());                                    
                                 //   quest.push(end.val());
                                   // quest.push(<?php // echo $tests->id; ?>);
                                  //  quest.push('edit');                                    
                                    result[i] = quest;
                                }                                                                
                                if (is_continue == false) {
                                    alert("Заполните, пожалуйста, имя теста, дату активации/окончания, все открытые ответы/вопросы и отметьте везде верные ответы ");
                                } else {
                                console.log(result);
                                    jQuery.post('/admin/complex/save', {test: result}, function(data) {
                                    console.log(data);
window.location = '/admin/complex';
                                      /*  if (data == 'ok')
                                            window.location = '/userfriendlycms2013/tests/show/all';
                                        else
                                            console.log(data);*/
                                          //  console.log(data);
                                    });
                                }
                            }
                            function removeBlock(num) {
                                jQuery('.question-' + num).remove();
                            }
    </script>
