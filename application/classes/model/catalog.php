<?php defined('SYSPATH') or die('No direct script access.');

class Model_Catalog extends ORM {

    protected $_table_name  = 'catalog';
    protected $_primary_key = 'id';

    public function saveProduct($data) {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->category = $data['category'];
        if(isset($data['type']))
        $this->type = $data['type'];
        if(isset($data['additional_type']))
        $this->additional_type = $data['additional_type'];
        if(isset($data['leftright']))
            $this->leftright = $data['leftright'];
        if(isset($data['additional_type2']))
            $this->additional_type2 = $data['additional_type2'];
        if(isset($data['height']))
            $this->height = $data['height'];
        if(isset($data['form']))
            $this->form = $data['form'];
        if(isset($data['type_accessory']))
            $this->type_accessory = $data['type_accessory'];
        if(isset($data['type_shower']))
            $this->type_shower = $data['type_shower'];
        $this->width = $data['width'];
        $this->order = $data['order'];
        $this->published = $data['published'];
        $this->title_meta = $data['title_meta'];
        $this->keywords_meta = $data['keywords_meta'];
        $this->description_meta = $data['description_meta'];
        $this->short_description = $data['short_description'];
        $this->manufacturer = $data['manufacturer'];
        if(isset($data['featured']))
            $this->featured = $data['featured'][0];
        if(isset($data['base']))
            $this->featured = $data['base'][0];
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
        if(isset($data['leftright']))
            $this->leftright = $data['leftright'];
        if(isset($data['additional_type2']))
            $this->additional_type2 = $data['additional_type2'];
        if(isset($data['height']))
            $this->height = $data['height'];
        if(isset($data['form']))
            $this->form = $data['form'];
        if(isset($data['type_accessory']))
            $this->type_accessory = $data['type_accessory'];
        if(isset($data['type_shower']))
            $this->type_shower = $data['type_shower'];
        if(isset($data['type']))
            $product->type = $data['type'];
        if(isset($data['additional_type']))
            $product->additional_type = $data['additional_type'];
        $product->width = $data['width'];
        $product->published = $data['published'];
        $product->order = $data['order'];
        $product->title_meta = $data['title_meta'];
        $product->keywords_meta = $data['keywords_meta'];
        $product->description_meta = $data['description_meta'];
        $product->short_description = $data['short_description'];
        $product->manufacturer = $data['manufacturer'];
        if(isset($data['featured']))
            $product->featured = $data['featured'][0];
        if(isset($data['base']))
            $this->base = $data['base'][0];
        $product->length = $data['length'];
//        $this->technologies = $data['technologies'];
        $product->time = time();
        $product->category = $data['category'];
        
        $product->save();
        return $id;
    }
}