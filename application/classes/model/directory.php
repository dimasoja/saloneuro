<?php defined('SYSPATH') or die('No direct script access.');

class Model_Directory extends ORM
{

    protected $_table_name = 'directory';
    protected $_primary_key = 'id';

    public function saveAll($data, $id, $categories) {
        $root = $this->where('id', '=', $id)->find();
        $root->name = $data['0'];
        $root->categories = $categories;
        $root->save();

        $childrens = $this->where('parent_id', '=', $id)->find_all()->as_array();
        foreach ($childrens as $children) {
            $children->delete();
        }
        unset($data['0']);

        foreach ($data as $item) {
            $this->clear();
            $this->name = $item;
            $this->parent_id = $id;
            $this->save();
        }
        return TRUE;
    }

    public function saveNew($data, $categories) {

        $this->name = $data['0'];
        $this->parent_id = '0';
        $this->categories = $categories;
        $last = $this->save();
        unset($data['0']);
        foreach ($data as $item) {
            $model = ORM::factory('directory');
            $model->name = $item;
            $model->parent_id = $last->id;
            $model->save();
        }
        return TRUE;
    }

    public function getAll($type) {
        if (!$type) {
            return $this->where('parent_id', '=', '0')->find_all()->as_array();
        } else {
            $model = $this->where('parent_id', '=', '0')->find_all()->as_array();
            foreach ($model as $key => $item) {
                $categories = json_decode($item->categories);
                if ($categories) {
                    if (!in_array($type, $categories)) {
                        unset($model[$key]);
                    }
                } else {
                    unset($model[$key]);
                }
            }
            return $model;
        }
    }
}