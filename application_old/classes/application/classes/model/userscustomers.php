<?php defined('SYSPATH') or die('No direct script access.');

class Model_UsersCustomers extends ORM {

    protected $_table_name  = 'users_customers';
    protected $_primary_key = 'id_user';
    
    public function authorize($username, $password) {
        $user = $this->select("*")
                ->where('email', '=', $username)
                ->where('password', '=', md5($password))

                ->find();


        try {
            return ( isset($user->id_user) ) ? $user : false;
        }
        catch( ErrorException $e ) {
            return false;
        }
    }
    
}