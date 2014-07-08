<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Information extends ORM_MPTT {

    public function addCategory($data) {
        $this->name = $data['name'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->keywords = $data['keywords'];
        $this->order = $data['order'];
        $this->time = $data['time'];
        $this->make_root();
        return;
    }

    public function getPages() {
        return $this->where('lvl','=','2')->find_all()->as_array();
    }

    public function getCategories() {
        return $this->roots();
    }

    public function savePage($data) {
        $this->clear();
        $this->content = $data['content'];
        $this->name = $data['title'];
        if(isset($data['technologies']))
            $this->technologies = $data['technologies'];
        else
            $this->technologies = 'off';
        if(isset($data['featured'])) {
            $this->featured = 'on';
        } else {
            $this->featured = 'off';
        }
        $this->title = $data['title_meta'];
        $this->description = $data['description'];
        $this->keywords = $data['keywords'];
        $this->time = time();
        $category = ORM::factory('information', $data['parent_id']);
        return $this->insert_as_first_child($category)->id;
    }

    public function saveImage($image, $id) {
        $info = $this->where('id', '=', $id)->find();
        $info->image = $image;
        return $info->save();
    }

    public function editPage($data, $id) {
        $info = $this->where('id', '=', $id)->find();
        $info->name = $data['title'];
        $info->parent_id = $data['parent_id'];
        $info->content = $data['content'];
        $this->title = $data['title_meta'];
        $this->description = $data['description'];
        $this->keywords = $data['keywords'];
        if(isset($data['technologies']))
            $this->technologies = $data['technologies'];
        else
            $this->technologies = 'off';
        if(isset($data['featured'])) {
            $info->featured = 'on';
        } else {
            $info->featured = 'off';
        }
        $info->time = time();
        if(isset($data['delimage'])) {
            $info->image = '0';
        }
        $info->save();
        return true;
    }


}