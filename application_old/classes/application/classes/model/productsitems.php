<?php defined('SYSPATH') or die('No direct script access.');

class Model_Productsitems extends ORM {

    protected $_table_name  = 'productsitems';
    protected $_primary_key = 'id';
    
    public function savePi($values, $id_product) {
        $this->where('to','=',$id_product)->delete_all();
        foreach($values as $value) {            
            $newpi = ORM::factory('productsitems'); 
            $newpi->value = $value;
            $newpi->to = $id_product;
            $newpi->save();
        }
    }
}
