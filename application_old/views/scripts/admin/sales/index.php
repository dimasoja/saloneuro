

<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>Телефон</th>
                    <th>Время поступления</th>
                    <th>Заказанная услуга</th>
                    <th>Типы услуг</th>
                    <th>Тип услуги</th>
                      <th>Удалить</th>   
                </tr>
            </thead>
            <tbody>
<?php foreach ($contacts as $contact) { ?>
                    <tr>                
                        <td><?php echo $contact->name; ?></td>
                        <td><?php echo $contact->phone; ?></td>
                        <td><?php echo date('Y/m/d H:i:s', $contact->created); ?></td>
                        <td><?php $product = ORM::factory('products', $contact->id_product)->find();
    echo $product->title; ?></td>
                        <td>
                        <?php $contact->types = explode('~', $contact->types); ?>
                        <?php foreach($contact->types as $type) { ?>
                             <?php $types = ORM::factory('productsitems')->where('id','=',$type)->find(); ?>
                             <?php if(isset($types->value)) { echo $types->value; echo "<br/>"; } ?>
                        <?php } ?>
                        </td>
                        <td><?php if ($product->type == 'for_home') echo "Для дома";
                else echo "Для бизнеса"; ?></td>
                  <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/sales/delete?id=<?php echo $contact->id; ?>"'/></td></tr>
<?php } ?>
            </tbody>
    </div>

