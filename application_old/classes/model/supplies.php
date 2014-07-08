<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supplies extends ORM {

    protected $_table_name  = 'supplies';
    protected $_primary_key = 'id_supplies';
    
    
    public function getSupplies($type = "") {
        if ("" != $type) {
            $this->where('type_column', '=', $type);
        }
        $supplies = $this->order_by('position')->find_all()->as_array();
        $sup_arr = array();
        
        $images = ORM::factory('suppliesimages')->select('images.path')->join('images')
                ->on('images.id_image', '=', 'supplies_images.id_image')
                ->find_all()->as_array();
        foreach ($supplies as $key => $val) {
            $sup_arr[$key]['id_supplies'] = $val->id_supplies;
            $sup_arr[$key]['title'] = $val->title;
            $sup_arr[$key]['code'] = $val->code;
            $sup_arr[$key]['price'] = $val->price;
            $sup_arr[$key]['type_star'] = $val->type_star;
            $sup_arr[$key]['type_column'] = $val->type_column;
            $sup_arr[$key]['info'] = $val->info;
            
            foreach ($images as $img) {
                if ($img->id_supplies == $val->id_supplies) {
                    $sup_arr[$key]['path'] = $img->path;
                }
            }
        }
        return $sup_arr;
    }
}