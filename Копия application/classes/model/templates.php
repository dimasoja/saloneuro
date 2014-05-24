<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Templates extends ORM {

    protected $_table_name = 'templates';
    protected $_primary_key = 'id';

    function savePaymentTransaction($data) {
        $this->values($data)->save();
    }           
    
    function getTemplate($event) {
        return $this->where('event','=', $event)->find()->as_array();
    }
}

