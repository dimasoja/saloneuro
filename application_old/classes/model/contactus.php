<?php defined('SYSPATH') or die('No direct script access.');

class Model_ContactUs extends ORM {

    protected $_table_name  = 'contactus';
    protected $_primary_key = 'id_contactus';
    
    public function getNew() {
        return count($this->where('viewed','=','0')->find_all()->as_array());
    }
    
    public function makeAllOld() {
	$not_viewed = $this->where('viewed','=','0')->find_all()->as_array();
	foreach($not_viewed as $nv) {
	    $viewed = $this->where('id_contactus','=',$nv->id_contactus)->find();
	    $viewed->viewed = '1';
	    $viewed->save();
	}
    }
}