<?php defined('SYSPATH') or die('No direct script access.');

class Model_Productscat extends ORM {

    protected $_table_name  = 'productscat';
    protected $_primary_key = 'id';

    public function saveProductscat($data) {
        $data['time'] = time();
        if(isset($data['massage_on'])) {
            $data['massage_on'] = 'on';
        } else {
            $data['massage_on'] = 'off';
        }
        if(isset($data['grade_on'])) {
            $data['grade_on'] = 'on';
        } else {
            $data['grade_on'] = 'off';
        }
        $data['title'] = $data['title_meta'];
        return $this->values($data)->save()->id;
    }

    public function saveImage($image, $id) {
        $certificate = ORM::factory('certificates', $id);
        $certificate->image = $image;
        return $certificate->save();
    }

    public function editProductscat($data, $id) {
        $data['time'] = time();
        if(isset($data['massage_on'])) {
            $data['massage_on'] = 'on';
        } else {
            $data['massage_on'] = 'off';
        }
        if(isset($data['grade_on'])) {
            $data['grade_on'] = 'on';
        } else {
            $data['grade_on'] = 'off';
        }
        $certificate = ORM::factory('productscat', $id);
        $certificate->name = $data['name'];
        $certificate->title = $data['title_meta'];
        $certificate->keywords = $data['keywords'];
        $certificate->description = $data['description'];
        $certificate->massage_on = $data['massage_on'];
        $certificate->grade_on = $data['grade_on'];
        $certificate->type = $data['type'];
        $certificate->order = $data['order'];
        $certificate->save();
    }


}