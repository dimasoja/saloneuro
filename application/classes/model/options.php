<?php defined('SYSPATH') or die('No direct script access.');

class Model_Options extends ORM {

    protected $_table_name  = 'options';
    protected $_primary_key = 'id';

    public function saveOptions($data, $type, $id_product) {
        foreach($data as $key=>$item) {
            $pos = strrpos($key, 'dir');

            if($pos!==false) {
                $id = str_replace('dir-','', $key);
                $this->clear();
                $this->name = $id;
                $this->value = $item;
                $this->id_product = $id_product;
                $this->type = $type;
                $this->save();
            }
        }
        return true;
    }

    public function saveMassage($data, $id_product) {
        if(isset($data['massage'])) {
            $count = 0;
            foreach($data['massage'] as $key=>$massage) {
                $array = array();
                $array[] = $key;
                if(isset($data['option_massage'][$count])) {
                    $array[] = $data['option_massage'][$count];
                }
                if(isset($data['forsun'][$count])) {
                    $array[] = $data['forsun'][$count];
                }
                if(isset($data['price_for_massage'][$count])) {
                    $array[] = $data['price_for_massage'][$count];
                }
                if(isset($data['default_for_massage'][$count])) {
                    $array[] = $data['default_for_massage'][$count];
                }
                if(isset($data['required_for_massage'][$count])) {
                    $array[] = $data['required_for_massage'][$count];
                }
                if(isset($data['underoption_for_massage'][$count])) {
                    $array[] = $data['underoption_for_massage'][$count];
                }
                $this->clear();
                $this->value = json_encode($array);
                $this->id_product = $id_product;
                $this->type = 'massage';
                $this->save();
                $count++;
            }
        }

        return true;
//        if(isset($data['massage'])) {
//            $massage = $data['massage'];
//            foreach($massage as $item) {
//                $this->clear();
//                $this->value = $item;
//                $this->id_product = $id_product;
//                $this->type = 'massage';
//                $this->save();
//            }
//        }
//        return true;
    }

    public function saveTechnologies($data, $id_product) {
        if(isset($data['techn'])) {
            $massage = $data['techn'];
            foreach($massage as $item) {
                $this->clear();
                $this->value = $item;
                $this->id_product = $id_product;
                $this->type = 'technologies';
                $this->save();
            }
        }
        return true;
    }

    public function saveProducts($data, $id_product) {
        if(isset($data['products'])) {
            $massage = $data['products'];
            foreach($massage as $item) {
                $this->clear();
                $this->value = $item;
                $this->id_product = $id_product;
                $this->type = 'products';
                $this->save();
            }
        }
        return true;
    }

    public function saveGrade($data, $id_product) {
        if(isset($data['grade'])) {
            $massage = $data['grade'];
            foreach($massage as $item) {
                $this->clear();
                $this->value = $item;
                $this->id_product = $id_product;
                $this->type = 'grade';
                $this->save();
            }
        }
        return true;
    }

    public function saveImages($data, $id_product) {
        if(isset($data['image'])) {
            $massage = $data['image'];
            foreach($massage as $key=>$item) {
                $this->clear();
                $this->value = $key;
                $this->id_product = $id_product;
                $this->type = 'image';
                $this->save();
            }
        }
        return true;
    }

    public function saveCustom($data, $id_product) {
        foreach($data as $key=>$item) {
            $pos = strrpos($key, 'customname');
            if($pos!==false) {
                $id = str_replace('customname-','', $key);
                $this->clear();
                $this->name = $data['customname-'.$id];
                $this->value = $data['custom-'.$id];
                $this->id_product = $id_product;
                $this->type = 'custom';
                $this->save();
            }
        }
        return true;
    }

    public function deleteAll($id) {
        $options = $this->where('id_product','=',$id)->find_all()->as_array();
        foreach($options as $option) {
            $option->delete();
        }
    }

    public function copyOptions($old, $new) {
        $options = $this->where('id_product','=', $old)->find_all()->as_array();
        foreach($options as $option) {
            $option_arr = $option->as_array();
            if(isset($option_arr['id'])) {
                unset($option_arr['id']);
            }
            $option_arr['id_product'] = $new;
            $this->clear();
            $this->values($option_arr)->save();
        }
        return true;
    }

    public function getMassageImage($id_product, $id_option) {
        $options = $this->where('id_product','=', $id_product)->find_all()->as_array();
        foreach($options as $option) {
            $json = json_decode($option->value, true);
            if(key($json)==$id_option) return $json[$id_option];
        }
        return false;
    }
}