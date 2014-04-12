<?php defined('SYSPATH') or die('No direct script access.');

class Model_Catalog extends ORM {

    protected $_table_name  = 'catalog';
    protected $_primary_key = 'id';

    public function saveProduct($data) {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->category = $data['category'];
        $this->time = time();
        return $this->save()->id;
    }

    public function editProduct($data, $id) {
        $product = $this->where('id','=',$id)->find();

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->time = time();
        $product->save();
        return $id;
    }
}