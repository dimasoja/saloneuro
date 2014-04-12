<?php if ($success != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $success; ?>
    </div>
<?php } ?>
<?php if ($error != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $error; ?>
    </div>
<?php } ?>
<?php
?>
<!--<input class="button-turquoise button page-new-add" type="button" value="Создать услугу" onclick="redirectToNew()"/>-->

<div id="searchname">

</div>
<div class="widget-content" align="center">
    <a href="#" class="button button-blue marginbottom30"><img src="/images/admin/icon/14x14/white/download4.png"
                                                               alt=""> Добавить элемент справочника</a>
</div>
<br/>


<div class="inner-content">
    <div class="widget-content" align="center">

        <div class="category-toggle" style="display: none;overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/directory/newtext" method="POST"
                          enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новый элемент справочника</h5>
                        </div>
                        <?php if (isset($add_type)) { ?>
                            <?php if ($add_type == 'text') { ?>
                                <div class="widget-content no-padding">
                                    <div class="form-row">
                                        <label class="field-name" for="standard">Наименование:</label>

                                        <div class="field">
                                            <input type="text" class="input-large name-edit" name="name"
                                                   style="float: left;width: 100%;">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-row">
                                        <label class="field-name" for="standard">Категории:</label>

                                        <div class="field" style="text-align: left;">
                                            <select multiple="" name="categories[]">
                                                <?php foreach($categories as $category) { ?>
                                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>

                                    <input type="submit" class="button-turquoise button" value="Отправить"/>
                                    <br/><br/>
                                </div>
                            <?php } else { ?>
                                <div class="field questions" style="overflow:auto;">
                                    <div class="span6 question-1" style="width: 100% !important;margin-left: 0px !important;">
                                        <div class="widget" style="margin-bottom: 0px !important;background: #f8f8f8 !important;">

                                            <div class="widget-content answers">
                                                <div class="form-row">
                                                    <label class="field-name" for="standard">Наименование:</label>

                                                    <div class="field" style="text-align: left;">
                                                        <input type="text" class="input-xlarge" name="standard"
                                                               id="question-text-1"
                                                               value=""><br><br/>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="form-row" style="height:69px">
                                                    <label class="field-name" for="standard">Категории:</label>

                                                    <div class="field" style="text-align: left;">
                                                        <select multiple="" name="categories[]" class="categories-multiple">
                                                            <?php foreach($categories as $category) { ?>
                                                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="field" style="text-align: left;">
                                                    <label class="field-name cursorpointer addquestion"
                                                           onclick="showAddAnswer(1)" style="margin-left: 205px;
                                                        margin-top: 16px;">Добавить опцию:&nbsp;&nbsp;
                                                        <a data-toggle="n-tooltip">
                                                            <img src="/images/admin/icon/14x14/light/plus.png"
                                                                 class="plus"></a><br/><br/>
                                                    </label><br/><br/>
                                                        </div>
                                                </div>


                                            </div>
                                            <br/>

                                            <input type="button" class="button-turquoise button" onclick="saveTest()" value="Отправить"/><br/><br/>

                                        </div>

                                    </div>

                                </div>
                            <?php } ?>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <table cellpading="0" cellspacing="0" border="0" class="default-table blue">
        <thead>
        <tr align="left">
            <th>Наименование</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <?php foreach ($directories as $directory) { ?>
            <tr>
                <td><?php echo $directory->name; ?></td>
                <td align="center"><a
                        href="<?php echo URL::base(); ?>admin/directory/edit/<?php echo $directory->id; ?>">Редактировать</a>
                </td>
                <td align="center"><a
                        href="<?php echo URL::base(); ?>admin/directory/delete/<?php echo $directory->id; ?>">Удалить</a>
                </td>
            </tr>

        <?php } ?>
    </table>
    <div style="display:none">
        <div class="category">
            <select class="typedir" onchange="writeValue(jQuery(this))">
                <option value="text">Текстовое поле</option>
                <option value="select">Предопределенные значения</option>
            </select>
            <br/><br/>
            <input type="hidden" class="valueselect" value=""/>
            <input type="submit" class="button-turquoise button sendcategory" value="Отправить"
                   style="margin-left:59px;"/>
        </div>
    </div>
    <input type="hidden" class="valueselect" value="text">

    <div class="clear"></div>

    <div class="clear" style="margin-bottom: 20px;"></div>
    <?php if ((isset($return) and ($return == 'yes'))) { ?>
        <br/><input type="button" onclick="redirectToproducts()" value="Вернуться" class="submit"
                    style="margin-top: 20px;">
    <?php } ?>
    <script type="text/javascript">
        var chk_ = false;
        function redirectToproducts() {
            location.href = '/admin/products/';
        }


        function writeValue(val) {
            jQuery('.valueselect').val(val.val());
        }

        function deletePage(id_product) {
            if (confirm('Вы действительно хотите удалить эту страницу?')) {
                location.href = "<?php echo URL::base(); ?>admin/products/deletechecked/" + id_product + "~";
            }
        }

        function deleteChecked() {
            if (confirm('Вы действительно хотите удалить выбранные записи?')) {
                var ids = "";
                jQuery('.chk').each(function () {
                    if (this.checked) {
                        ids += jQuery(this).attr('rel') + '~';
                    }

                });
                location.href = "/admin/products/deletechecked/" + ids;
            }
        }

        jQuery(document).ready(function () {

            <?php if(isset($add_type)) { ?>
            jQuery('.category-toggle').slideDown('slow', function () {
                jQuery(this).css('display', 'block');
            });
            <?php } ?>

            jQuery('.check_all').click(function () {
                var checked_status = this.checked;
                chk_ = checked_status;
                jQuery('.chk').each(function () {
                    this.checked = checked_status;
                });
                jQuery('.check_all').each(function () {
                    this.checked = checked_status;
                });
            });

            jQuery('.chk').click(function () {
                chk_ = false;
                jQuery('.chk').each(function () {
                    if (this.checked) {
                        chk_ = true;
                    }
                });
            });

            setTimeout(function () {
                jQuery('#adminMessage').hide('slow');
            }, 5000);

            jQuery('.button.button-blue.marginbottom30').click(function () {
                jQuery.fancybox(jQuery('.category').html(), {
                    afterShow: function () {
                        jQuery('.valueselect').val(jQuery('.typedir').val());
                        jQuery('.sendcategory').click(function () {
                            var type = jQuery('.valueselect').val();
                            window.location = '/admin/directory/?type=' + type;
                        });
                    }
                });
            });
        });
        function changepublish(id) {
            var yes_no = jQuery('#publ' + id + ' img').attr('id');
            if (yes_no == 'on') {
                var change = 'off';
            } else {
                var change = 'on';
            }
            jQuery.get(baseurl + 'admin/products/changepublished?id=' + id + '&change=' + change,
                function (data) {
                    if (data == 'ok') {
                        jQuery('#publ' + id).html("<img id='" + change + "' src='/images/button_" + change + ".png'/>");
                    }

                }
            );
        }
    </script>


    <script type="text/javascript">
        function redirectToNew() {
            window.location = '/admin/products/add';
        }


        function showAddAnswer(count) {
            var count_field = jQuery('.question-' + count + ' .answers .field').length;
            answers = jQuery('.question-' + count + ' .answers');
            answers.append('<div class="field answer-' + count_field + '" style="text-align: left;margin-left: 204px;">\n\
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
            var str = [];
            $(".categories-multiple option:selected").each(function () {
                str.push($(this).val());
            });

            var categories = JSON.stringify(str);
            is_continue = true;;
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


            if (is_continue == false) {
                alert("Заполните, пожалуйста, все поля ");
            } else {
                jQuery.post('/admin/directory/savenew', {test: result, categories:categories}, function (data) {
                    console.log(data);
                    if (data == 'ok') window.location = '/admin/directory'; else console.log(data);
                });
            }
        }
        function removeBlock(num) {
            jQuery('.question-' + num).remove();
        }
    </script>