<?php
defined('SYSPATH') or die('No direct script access.');

class Model_Response extends ORM
{

    protected $_table_name = 'response';
    protected $_primary_key = 'id';

    public function getNew() {
        return count($this->where('viewed', '=', '0')->find_all()->as_array());
    }

    public function makeAllOld() {
        $not_viewed = $this->where('viewed', '=', '0')->find_all()->as_array();
        foreach ($not_viewed as $nv) {
            $viewed = $this->where('id', '=', $nv->id)->find();
            $viewed->viewed = '1';
            $viewed->save();
        }
    }

    public function saveReview($data) {
        return $this->values($data)->save();
    }
}
