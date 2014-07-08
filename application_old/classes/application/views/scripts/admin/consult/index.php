<div class="users-table1" >
    <div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table stripped turquoise">
            <thead>
                <tr align="left">
                    <th width="50">Имя</th>
                    <th>E-mail</th>
                    <th>Время поступления</th>
                    <th>Вопрос</th>
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
                        <td><img id='off' src='/images/button_off.png' style='cursor:pointer;' onclick='window.location="/admin/consult/delete?id=<?php echo $contact->id; ?>"'/></td></tr>
                       

<?php } ?>
            </tbody>
    </div>
    <script type="text/javascript">
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

