<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Extend extends Controller_Template
{

    private static $libs_included = FALSE;

    public function after() {
        
        $user = Myauth::instance()->get_user();
        if (isset($user->id)) {
            $this->template->set('userid', $user->id);
        }

        parent::after();
    }

    public static function include_libs() {
        // Два раза повторять не надо
        if (self::$libs_included) {
            return TRUE;
        }

        define('IN_PHPBB', true);
        define('PHPBB_DB_NEW_LINK', 1);
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './forum/';
        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        $GLOBALS['phpbb_root_path'] = $phpbb_root_path;
        $GLOBALS['phpEx'] = $phpEx;
        require_once($phpbb_root_path . 'common_kohana.' . $phpEx);


        $kohanauser = Myauth::instance()->get_user();
        setcookie('kohanauser', $kohanauser->username, time() * 2, '/');
//        $_COOKIE['kohanauser'] = $kohanauser->username;

        // Start session management
        $user->session_begin(true, $kohanauser->username);

        self::$libs_included = TRUE;
        return TRUE;
    }

    public function login($user_id, $persist_login = FALSE) {
        global $user;
        $kohanauser = Myauth::instance()->get_user();
        self::include_libs();
        $user->session_create($user_id, false, true, 1, $kohanauser->username);
    }

    public function logged_in()
    {
        global $user;
        $this->include_libs();

        return ($user->data['user_id'] == ANONYMOUS)
            ? FALSE
            : TRUE;
    }

    public function logout() {
        global $user;

        self::include_libs();

        $user->session_kill(FALSE);
        return TRUE;
    }

    public function register_newuser($username, $password, $email) {
        global $user;
        self::include_libs();

        $user_row = array('username' => $username, 'user_password' => phpbb_hash($password), 'user_email' => $email, 'group_id' => 2, 'user_timezone' => 10.00, 'user_dst' => 1, 'user_lang' => 'ru', 'user_type' => 0, 'user_actkey' => '', 'user_ip' => Request::$client_ip, 'user_regdate' => time(), 'user_inactive_reason' => 0, 'user_inactive_time' => 0,);

        try {
            $user_id = user_add($user_row, FALSE);
            die(var_dump($user_id));
            return $user_id ? $user_id : FALSE;
        } catch (Exception $e) {
            die($e);
            return FALSE;
        }
    }

    public function return_id($username) {
        global $user;
        self::include_libs();
        try {
            $user_id = return_id($username, FALSE);
            return $user_id ? $user_id : FALSE;
        } catch (Exception $e) {
            die($e);
            return FALSE;
        }
    }


}

