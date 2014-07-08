<?php defined('SYSPATH') or die('No direct script access.');

class Model_Internal extends ORM {

    protected $_table_name  = 'internal_users';
    protected $_primary_key = 'id';
    
    public function getUserTable() {
        $query = "SELECT users.id, users.username, users.email, users.last_login, roles.name as role FROM users, roles_users, roles WHERE users.id = roles_users.user_id AND roles_users.role_id = roles.id";
        $users = DB::query(Database::SELECT, $query)->execute();
        $users = $users->as_array();
        $new_users = array();
        foreach ($users as $user) {
            $id = $user['id'];
            unset($user['id']);
            $role = $user['role'];
            $user['role'] = array($role);
            if (isset($new_users[$id])) {
                $new_users[$id]['role'][] = $role;
            } else {
                $new_users[$id] = $user;
                $new_users[$id]['id'] = $id;
            }
        }
        return $new_users;
    }
    
    public function getRoles($name) {
        $roles = ORM::factory('role')->where('name', '=', $name)->find();
        $roles = json_decode($roles->description);
        return $roles;
    }
    
    public function getUserInfo($id) {
        $query = "SELECT users.id, users.username, users.email, users.last_login, roles.name,roles.description as description FROM users, roles_users, roles WHERE users.id = ".$id." AND users.id = roles_users.user_id AND roles_users.role_id = roles.id";
        $users = DB::query(Database::SELECT, $query)->execute();
        $result = $users->as_array();
        return $result['0'];
    }
        
}