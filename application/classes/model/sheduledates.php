<?php defined('SYSPATH') or die('No direct script access.');

class Model_SheduleDates extends ORM {

    protected $_table_name  = 'shedule_dates';
    protected $_primary_key = 'id_date';
    
    public function getQuotation($id) {
        return $this->where('id_quotation', '=', $id)->find_all()->as_array();
    }
    
}