


<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Контактное лицо</th>
                    <th>Телефон</th>                    
                    <th>Email</th>
                    <th>Название компании</th>
                    <th>Город</th>
                    <th>Сфера</th>
                    <th>Другое</th>
                    <th>Комментарий</th>
                    <th>Дата</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partners as $partner) { ?>
                    <tr>                
                        <td><?php echo $partner->contact; ?></td>
                        <td><?php echo $partner->phone; ?></td>
                        <td><?php echo $partner->email; ?></td>
                        <td><?php echo $partner->company; ?></td>
                        <td><?php echo $partner->city; ?></td>
                        <td><?php $sphere = json_decode($partner->sphere);
                        foreach($sphere as $sp) {
                            if($sp=='1') {
                                echo 'Продажа сантехники'; echo "<br/>";
                            }
                            if($sp=='2') {
                                echo 'Дизайнер'; echo "<br/>";
                            }
                            if($sp=='3') {
                                echo 'Строительная компания'; echo "<br/>";
                            }
                            if($sp=='4') {
                                echo 'Другое';
                            }
                        } ?>
                        </td>
                        <td><?php echo $partner->another; ?></td>
                        <td><?php echo $partner->comment; ?></td>
                        <td><?php echo date("y-m-d H:i:s", $partner->time); ?></td>
                        <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/partner/delete?id=<?php echo $partner->id; ?>"'/></td></tr>
                <?php } ?>
            </tbody>
    </div>



