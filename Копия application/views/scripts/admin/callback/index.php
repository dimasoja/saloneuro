


<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>Телефон</th>                    
                    <th>Время с/до</th>                    
                    <th>Добавлено</th>   
                    <th>Удалить</th>   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($callbacks as $callback) { ?>
                    <tr>                
                        <td><?php echo $callback->name; ?></td>
                        <td><?php echo $callback->phone; ?></td>                        
                        <td><?php echo $callback->time_from . "/" . $callback->time_to; ?></td>
                        <td><?php echo date("y-m-d H:i:s", $callback->created); ?></td>
                        <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/callback/delete?id=<?php echo $callback->id; ?>"'/></td></tr>

                   
                <?php } ?>
            </tbody>
    </div>



