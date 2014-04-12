
<a id="users-fancy" href="#add-users-form">
    <input class="submit button button-turquoise" type="button" value="Добавить пользователя"/>
</a>
<a id="role-fancy" href="#add-role-form">
    <input class="submit button button-turquoise" type="button" value="Добавить роль"/>
</a><br/><br/>
<div id="add-entry-fancy" style="display:none">
    <form id="add-users-form" method="post" action="/admin/internal/adduser" style="width: 330px">
        <div class="users-wrapper">
            <div id="personal-info" class="users-fancy">
                <ul style="list-style:none">
                    <li>
                        <h4>Логин:</h4>
                        <div class="franchisee-name-small-div">
                            <input id="login" type="text" name="username" value="" placeholder="Логин пользователя" class="franchisee-name-small franchisee-name" />
                        </div>
                    </li>
<!--                    <li>
                        <div class="franchisee-name-small-div">
                            <input id="name" type="text" name="l" value="Name" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Name'){this.value=''};" onblur="if(this.value==''){this.value='Name'};" />
                        </div>
                    </li>
                    <li>
                        <div class="franchisee-name-small-div">
                            <input id="surname" type="text" name="surname" value="Surname" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Surname'){this.value=''};" onblur="if(this.value==''){this.value='Surname'};" />
                        </div>
                    </li>-->
                    <li>
                        <h4>Почта:</h4>
                        <div class="franchisee-name-small-div">
                            <input id="email" type="text" name="email" class="franchisee-name-small franchisee-name" />
                        </div>
                    </li>
                    <li>
                        <h4>Пароль:</h4>
                        <div class="custom-field1">
                            <input id="password"type="password" name="password" placeholder="Пароль" class="franchisee-name-small franchisee-name" style="margin-top: 0px !important;" />
                        </div>
                    </li>
                    <li >
                        <div class="custom-field1">
                            <h4>Роль:</h4>
                            <select name="role" class="uniform">
                               <?php foreach($all_roles as $role) { ?>
                                <option value="<?php echo $role->name; ?>" <?php if($role->name=='superadministrator') echo 'selected'; ?>><?php echo $role->name; ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </li>
                </ul>
                <div class="clearboth submit-entry users-submit" style="clear: both;
height: 50px;
text-align: left;">
                    <br/><button class="button button-turquoise" style="margin-left:-10px" type="button" onClick="checkUser()"/>Добавить пользователя</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="add-role-fancy" style="display:none">
    <form id="add-role-form" method="post" action="/admin/internal/addnewrole">
        <div class="users-wrapper">
            <div id="personal-info" class="users-fancy">

<h4>Роль:</h4>
                            <input id="role" type="text" name="role" class="franchisee-name-small franchisee-name" />


                <div class=" submit-entry users-submit">
                    <br/><button class="button button-turquoise" type="button" onClick="checkRole()">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="table-container">
    <table cellpading="0" cellspacing="0" border="0" class="default-table blue">
        <thead>
        <tr align="left">
            <th></th><th>Логин</th><th>e-mail</th><th>Роль</th><th>Пароль</th>
        </tr>
        </thead>
        <?php foreach ($users as $user) { ?>
            <tr id="line_<?php echo $user['id']; ?>">
                <td><input type="checkbox" class="users_check" id="<?php echo $user['id'] ?>"</td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']['0']; ?></td>
                <td>
<input type="text" id="pass_<?php echo $user['id']; ?>"/>
                    <input type="button" onclick="redirectCP(<?php echo $user['id']; ?>)" class="submit button small-button button-turquoise" value="Изменить"></td>
            </tr>
        <?php } ?>
    </table>
</div>
<br/>
<input type="button" onclick="deleteSomeSuppliesCheck()" class="submit button button-turquoise" value="Удалить">
<script type='text/javascript'>
function redirectCP(id) {
    var pass = jQuery('#pass_'+id).val();
    window.location = '/admin/internal/changepassword?id='+id+'&password='+pass;
}
    function deleteSomeSuppliesCheck() {
        var list = "";
        jQuery(".users_check:checked").each(function(index, el){
            id = jQuery(el).attr('id');
            list = list + id +",";
        });

        if (list != "") {
            if (confirm('Это навсегда. Вы уверены?')) {
                jQuery.post(baseurl + 'admin/internal/deletegroup',
                {
                    hash: list
                },
                function(data) {
                    if (data == "ok") {
                        jQuery(".users_check:checked").each(function(index, el){
                            hash = jQuery(el).parent().parent().hide();
                        });
                    } else {
                        alert('some error!');
                    }
                }
            );
            }
        } else {
            alert('Nothing to delete! Check some items please.');
        }
    }
</script>
<div style="clear: both"></div><br/>
<div style="width: 900px; float: left;"><h3>Роли пользователей</h3></div>
<div style="clear: both"></div><br/>
<form id="roles" action="<?php echo URL::base(); ?>admin/internal/addrole" method="POST">
    <select name="role" class="role uniform" >
        <?php foreach ($all_roles as $role) { ?>
            <option value="<?php echo $role->name; ?>" <?php if($role->name=='superadministrator') echo 'selected'; ?>><?php echo $role->name; ?></option>
        <?php } ?>
    </select><br/>
    <?php
$uri = Auth::uri();
?><br/>
<?php foreach ($uri as $key => $value) { ?>
    <input  type="checkbox" name = "<?php echo $value; ?>" value="<?php echo $value; ?>" <?php if(in_array($value, $roles_superadmin)) echo "checked"; ?>><?php echo $key; ?></option><br/>
<?php } ?>
</form>
<br/>
<input type="button" value="Сохранить" class='role-submit submit submit button button-turquoise'/>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.role-submit').click(function(){
            jQuery('#roles').submit();
        });
        jQuery('.role').change(function() {
            var action = jQuery(this).val();
            jQuery.post('/admin/internal/getroleajax',
                {
                    name: action
                },
                function(data) {
                    result = jQuery.parseJSON(data);
                    if(result==null) {
                        jQuery("input:checkbox").removeAttr("checked");
                        jQuery.uniform.update();
                    } else {
                        jQuery("input:checkbox").removeAttr("checked");
                        jQuery.each(result, function(i, item) {
                            jQuery("input[type='checkbox'][name='"+item+"']").attr('checked','checked');
                            jQuery.uniform.update();
                        });
                    }
                }
            );

        });
    });

</script>

