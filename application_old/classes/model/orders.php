<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Orders extends ORM {

    protected $_table_name = 'orders';
    protected $_primary_key = 'id';
    
    public function getNew() {
        return count($this->where('viewed','=','0')->find_all()->as_array());
    }
    
     public function makeAllOld() {
	$not_viewed = $this->where('viewed','=','0')->find_all()->as_array();
	foreach($not_viewed as $nv) {
	    $viewed = $this->where('id','=',$nv->id)->find();
	    $viewed->viewed = '1';
	    $viewed->save();
	}
    }
}