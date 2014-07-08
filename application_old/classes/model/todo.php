<?php defined('SYSPATH') or die('No direct script access.');

class Model_Todo extends ORM {

    protected $_table_name  = 'onlinediary_todo';
    protected $_primary_key = 'id';
    
    public function changeStatus($id, $value) {
        $data = $this->where('id', '=', $id)->find();
        $data->done = $value;
        $data->save();
    }
    
    public function getPartOfTable($od_part) {
        $result = '';
        foreach($od_part as $todo) {
             $result .= '<tr id="line_todo_'.$todo->id.'"';
             if($todo->done=='0') $result .= 'class=lightgrey style="color: black; text-decoration: line-through"; >';
             $result .= '><td><input type="checkbox" class="todo_check" rel="'.$todo->id.'"/></td>
             <td>'.$todo->job_description.'</td>
             <td>'.$todo->start_date.'</td>
             <td>';
             if($todo->done=='0') {
                 $result .= '<img id="done_todo_img_'.$todo->id.'" rel="'.$todo->done.'" src="'.URL::base().'images/close-icon.gif" onClick="changeStatus('.$todo->id.',\'changestatusfortodo\');"/>';
             } else {
                 $result .= '<img id="done_todo_img_'.$todo->id.'" rel="'.$todo->done.'" src="'.URL::base().'images/green-mark.gif" onClick="changeStatus('.$todo->id.',\'changestatusfortodo\');"/>';
             }
             $result .= '</td>';
         $result .= '</tr>';
       }
       return $result;
    }
}