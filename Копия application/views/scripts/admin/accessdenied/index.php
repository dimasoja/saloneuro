<br/><br/><br/><div style="width: 900px; float: left;"><h1>Internal Users</h1></div>
<a class="submit" id="users-fancy" href="#add-users-form"><br/><br/>
    <input class="submit" type="button" value="ADD USER"/>
</a><br/><br/><br/>
<div id="add-entry-fancy" style="display:none">
    <form id="add-users-form" method="post" action="/admin/internal/adduser">
        <div class="users-wrapper">
            <div id="personal-info" class="users-fancy">
                <ul>
                    <li>
                        <div class="franchisee-name-small-div">
                            <input id="login" type="text" name="username" value="Login" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Login'){this.value=''};" onblur="if(this.value==''){this.value='Login'};" />
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
                        <div class="franchisee-name-small-div">
                            <input id="email" type="text" name="email" value="Email" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" />
                        </div>
                    </li>
                    <li>
                        <div class="custom-field">
                            Password:
                            <input id="password" type="password" name="password" class="franchisee-name-small franchisee-name" style="margin-top: 0px !important;" />
                        </div>
                    </li>
                    <li>
                        <div class="custom-field">
                            Role:
                            <select name="role">
                                <option value="superadministrator">SuperAdministrator</option>
                                <option value="administrator">Administrator</option>
                                <option value="supplier">Supplier</option>
                            </select>
                        </div>
                    </li>
                </ul>
                <div class="clearboth submit-entry users-submit">
                    <br/><input class="submit" type="button" value="ADD USER" onClick="checkUser()"/>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="users-table" >
    <table>
        <tr> 
            <td></td><td>Login</td><td>e-mail</td><td>Role</td><td></td>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr id="line_<?php echo $user['id']; ?>">
                <td><input type="checkbox" class="users_check" id="<?php echo $user['id'] ?>"</td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php print_r($user['role']['0']); ?></td>
                <td><a href="#">Details</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<br/>
<input type="button" onclick="deleteSomeSuppliesCheck()" class="submit" value="DELETE">
<script type='text/javascript'>
    function deleteSomeSuppliesCheck() {
        var list = "";
        jQuery(".users_check:checked").each(function(index, el){
            id = jQuery(el).attr('id');
            list = list + id +",";
        });

        if (list != "") {
            if (confirm('This action is permanent. Are you sure?')) {
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
<div style="width: 900px; float: left;"><h1>Roles</h1></div>
<div style="clear: both"></div><br/>
<form id="roles" action="<?php echo URL::base(); ?>admin/internal/addrole" method="POST">
<select name="role" onClick="changeRoles(this.value)" >
    <option value="superadministrator">SuperAdministrator</option>
    <option value="administrator">Administrator</option>
    <option value="supplier">Supplier</option>
</select><br/>
<?php
$uri = Auth::uri();
?><br/>
<?php foreach ($uri as $key => $value) { ?>
    <input type="checkbox" name = "<?php echo $value; ?>" value="<?php echo $value; ?>" <?php if(in_array($value, $roles_superadmin)) echo "checked"; ?>><?php echo $key; ?></option><br/>
<?php } ?>
</form>
<br/>
<input type="button" value="Apply" class='role-submit submit'/>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.role-submit').click(function(){
            jQuery('#roles').submit();
        });
    });
    function changeRoles(action) {
        jQuery.post('/admin/internal/getroleajax',
        {
            name: action
        },
        function(data) {
            result = jQuery.parseJSON(data);
            jQuery("input:checkbox").removeAttr("checked");
            jQuery.each(result, function(i, item) {
                jQuery("input[type='checkbox'][name='"+item+"']").attr('checked','checked');
            });
        }
    );
        
    }
</script>

