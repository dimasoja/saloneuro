<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Massage extends ORM {

    public function addCategory($data) {
        $this->name = $data['name'];
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
        $this->electronic = $data['electronic'];
        $this->time = time();
        $category = ORM::factory('information', $data['parent_id']);
        return $this->insert_as_first_child($category)->id;
    }

    public function saveImage($image, $id) {
        $info = $this->where('id', '=', $id)->find();
        $info->image = $image;
        return $info->save();
    }

    public function editMassage($data, $id) {
        $info = $this->where('id', '=', $id)->find();
        $this->values($data)->save();
        return true;
    }

    public function saveMassage($data) {
        $data['time'] = time();
        return $this->values($data)->save()->id;
    }

}