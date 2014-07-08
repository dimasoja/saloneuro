
<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>Телефон</th>
                    <th>Время поступления</th>
                    <th>Заказанная услуги</th>
                      <th>Удалить</th>   
                </tr>
            </thead>
            <tbody>
        <?php foreach ($contacts as $contact) { ?>
            <tr>                 
                <td><?php echo $contact->name; ?></td>
                <td><?php echo $contact->phone; ?></td>
                <td><?php if ($contact->created != '') echo date('Y/m/d H:i:s', $contact->created); ?></td>
                <td>
                    <?php
                    if ($contact->created != '') {
                        $array_ids = explode('~', $contact->order);
                        foreach ($array_ids as $id) {
                            if ($id != '') {
                                $product = ORM::factory('products')->where('id_product', '=', $id)->find();
                                if ($product->type == 'for_home')
                                    $type = "для дома"; else
                                    $type = "для бизнеса";
                                echo ''.$product->title . " (" . $type . ")<br/>";
                                $check = ORM::factory('productsitems')->where('to','=',$id)->find_all()->as_array();                               
                                $types = explode('~', $contact->types);                                
                                foreach($types as $type) {                                
                                    foreach($check as $ch) {
                                         if(isset($ch->id)) {
                                             if(isset($type)) {
                                                 if($ch->id==$type) { echo '<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ch->value; echo "</i><br/>"; }
                                             }
                                          }
                                    }
                                }
                            }
                        }
                    }
                    ?></td>
           <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/manysales/delete?id=<?php echo $contact->id; ?>"'/></td></tr>
<?php } ?>
            </tbody>
    </div>

