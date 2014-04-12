<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>E-mail</th>
                    <th>Время поступления</th>
                    <th>Отзыв</th>
                    <th>Рейтинг</th>
                    <th>Тип услуги</th>
                    <th>Опубликовано</th>
                    <th>Удалить</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) { ?>
                    <tr>                
                        <td><?php echo $contact->name; ?></td>
                        <td><?php echo $contact->email; ?></td>
                        <td><?php echo date('Y/m/d H:i:s', $contact->created); ?></td>
                        <td><?php echo $contact->response; ?></td>
                        <td><?php echo $contact->rating; ?></td>
                       <!-- <td><?php // if ($contact->to != 'no') echo ORM::factory('products')->where('id_product', '=', $contact->to)->find()->title;
              //  else echo "Общий отзыв"; ?></td>-->
                        <td>
<div class="field noSearch">
                    <select onchange='sendTo(jQuery(this).attr("rel"), jQuery(this).attr("value"))' data-placeholder="Выберите услуги" style="width:350px;" rel="<?php echo $contact->id; ?>" class="chosen" tabindex="5">
                      <option value=""></option>
                      <optgroup label="Для бизнеса">
                        <?php foreach($for_business as $fb) { ?>
                              <option value="<?php echo $fb->id_product; ?>" <?php if($fb->id_product==$contact->to) echo 'selected' ?> ><?php echo $fb->title; ?></option>
                        <?php } ?>
                      <optgroup>
                      <optgroup label="Для дома">
                        <?php foreach($for_home as $fh) { ?>
                              <option value="<?php echo $fh->id_product; ?>" <?php if($fh->id_product==$contact->to) echo 'selected' ?>><?php echo $fh->title; ?></option>
                        <?php } ?>
                      </optgroup>                                           
                        <option value='no' <?php if('no'==$contact->to) echo 'selected' ?>>Общий отзыв</option>                      
                    </select>
                  </div>
                        </td>
                        <td align="center">
			  <?php
			    if ($contact->published == 'on') {
				echo "<div class='publish-ico' id='publ" . $contact->id . "' onclick='changepublish(" . $contact->id . ")'><img id='on' src='/images/button_on.png'/></div>";
			    } else {
				echo "<div class='publish-ico' id='publ" . $contact->id . "' onclick='changepublish(" . $contact->id . ")'><img id='off' src='/images/button_off.png'/></div>";
			    }
			  ?>
                </td>
                <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/response/delete?id=<?php echo $contact->id; ?>"'/></td></tr>
<?php } ?>

            </tbody>
            </table>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <script type="text/javascript">
            function sendTo(id, value) {
                jQuery.get('/admin/response/saveto', {id:id, to:value}, function(response) {
                    console.log(response);
                });
            }
            
            function changepublish(id) {       
            var yes_no = jQuery('#publ'+id+' img').attr('id');
            if(yes_no=='on') {
                var change='off';
            } else {
                var change='on';
            }
            jQuery.get(baseurl + 'admin/response/changepublished?id='+id+'&change='+change,
                function(data) {
                    if(data=='ok') {
                        jQuery('#publ'+id).html("<img id='"+change+"' src='/images/button_"+change+".png'/>");
                    }

                }        
            );
        }
    </script>
    <?php 


