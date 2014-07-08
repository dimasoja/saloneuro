



<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>E-mail</th>
                    <th>Вопрос</th>
                    <th>Открыт</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($contacts as $contact) { ?>
                    <tr>                
                        <td><?php echo $contact->name; ?></td>
                        <td><?php echo $contact->email; ?></td>
                        <td><?php echo $contact->question; ?></td>
                        <td><?php echo date('Y/m/d H:i:s', $contact->created); ?></td>                        
                    <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/contacts/delete?id=<?php echo $contact->id_contactus; ?>"'/></td></tr>
<?php } ?>
            </tbody>
    </div>

