<?php defined('SYSPATH') or die('No direct script access.');

class Model_Catalog extends ORM {

    protected $_table_name  = 'catalog';
    protected $_primary_key = 'id';

    public function saveProduct($data) {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->category = $data['category'];
        $this->type = $data['type'];
        $this->width = $data['width'];
        if(isset($data['featured']))
            $this->featured = $data['featured'][0];
        $this->length = $data['length'];
//        $this->technologies = $data['technologies'];
        $this->time = time();
        return $this->save()->id;
    }

    public function editProduct($data, $id) {
        $product = $this->where('id','=',$id)->find();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->price = $data['price'];
        $this->type = $data['type'];
        $this->width = $data['width'];
        if(isset($data['featured']))
            $this->featured = $data['featured'][0];
        $this->length = $data['length'];
//        $this->technologies = $data['technologies'];
        $product->time = time();
        $product->save();
        return $id;
    }
}