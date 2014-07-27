<div class="users-table1">
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
            <tr align="left">
                <th width="50">Номер заказа</th>
                <th width="50">Имя</th>
                <th>E-mail</th>
                <th>Время поступления</th>
                <th>Товар</th>
                <th>Товар наименование</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?php echo $contact->id; ?></td>
                    <td><?php echo $contact->name; ?></td>
                    <td><?php echo $contact->email; ?></td>
                    <td><?php echo date('Y/m/d H:i:s', $contact->created); ?></td>
                    <td>Товар <?php echo ORM::factory('catalog')->where('id','=', $contact->productid)->find()->name; ?></td>
                    <td>


                        <?php //echo $contact->order; ?>
                    <?php $arr = json_decode($contact->order); ?>
                        <?php foreach($arr as $key=>$item) {
                            if($key=='lr') {
                                if($item=='right') echo "Правая ванна"; else echo "Левая ванна";
                             }
                             if($key=='grades') {
                                 echo "<h1>Комплектация</h1>";
                                 foreach($arr->grades as $key_grade=>$item_grade) {
                                     $grade_item = ORM::factory('grade')->where('id','=', $key_grade)->find();
                                     echo $grade_item->name; echo "<br/>";
                                 }
                             }
                            if($key=='massages') {
                                echo "<h1>Массаж</h1>";
                                 foreach($arr->massages as $key_massage=>$item_massage) {
                                     $massage_item = ORM::factory('massage')->where('id','=', $key_massage)->find();
                                     echo $massage_item->name; echo "<br/>";
                                 }
                             }
                            if($key=='accessories') {
                                echo "<h1>Аксессуары</h1>";
                                 foreach($arr->accessories as $key_accessories=>$item_accessories) {
                                     $accessories_item = ORM::factory('catalog')->where('id','=', $key_accessories)->find();
                                     echo $accessories_item->name; echo "<br/>";
                                 }
                             }
                        } ?>




                    </td>
                    <td><?php echo $contact->phone; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    <script type="text/javascript">
        function sendTo(id, value) {
            jQuery.get('/admin/response/saveto', {id: id, to: value}, function (response) {
                console.log(response);
            });
        }

        function changepublish(id) {
            var yes_no = jQuery('#publ' + id + ' img').attr('id');
            if (yes_no == 'on') {
                var change = 'off';
            } else {
                var change = 'on';
            }
            jQuery.get(baseurl + 'admin/response/changepublished?id=' + id + '&change=' + change,
                function (data) {
                    if (data == 'ok') {
                        jQuery('#publ' + id).html("<img id='" + change + "' src='/images/button_" + change + ".png'/>");
                    }

                }
            );
        }
    </script>
<?php


