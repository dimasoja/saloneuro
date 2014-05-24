<?php
defined('SYSPATH') or die('No direct script access.');

class Safely {

    public function __construct() {
        
    }

    static function safelyGet($array) {
        $safely_arr = array();
        foreach($array as $key=>$value) {
            $safely_arr[$key] = $value;
        }
        return $safely_arr;
    }
}

?>
