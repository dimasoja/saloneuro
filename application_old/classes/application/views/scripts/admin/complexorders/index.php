


<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>Телефон</th>  
                    <th>Комментарий</th>                  
                    <th>Услуга</th>
                    <th>Время добавления</th>                    
                    <th>Удалить</th>                      
                </tr>
            </thead>
            <tbody>
                <?php foreach ($callbacks as $callback) { ?>
                    <tr>                
                        <td><?php echo $callback->name; ?></td>
                        <td><?php echo $callback->email; ?></td>
                        <td><?php echo $callback->response; ?></td>                        
                        <td><?php echo ORM::factory('complex')->where('id','=',$callback->id_product)->find()->name; ?></td>                        

                        <td><?php echo date("y-m-d H:i:s", $callback->created); ?></td>
<td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/complexorders/delete?id=<?php echo $callback->id; ?>"'/></td></tr>
                    </tr>
                <?php } ?>
            </tbody>
    </div>



