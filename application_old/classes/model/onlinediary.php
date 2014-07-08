<?php defined('SYSPATH') or die('No direct script access.');

class Model_Onlinediary extends ORM {

    protected $_table_name  = 'onlinediary_enquiries';
    protected $_primary_key = 'id';
   
    public function changeStatus($id, $value) {
        $data = $this->where('id', '=', $id)->find();
        $data->done = $value;
        $data->save();
    }
    
    public function getPartOfTable($od_part) {
        $result = '';
        foreach($od_part as $enquiry) {
             $result .= '<tr id="line_'.$enquiry->id.'"';
             if($enquiry->done=='0') $result .= 'class=lightgrey style="color: black; text-decoration: line-through"; >';
             $result .= '><td><input type="checkbox" class="onlinediary_check" rel="'.$enquiry->id.'"/></td>
             <td>'.$enquiry->name.'</td>
             <td>'.$enquiry->address.'</td>
             <td>'.$enquiry->postcode.'</td>
             <td>'.$enquiry->job_description.'</td>
             <td>'.$enquiry->quote_given.'</td>
             <td>'.$enquiry->start_date.'</td>
             <td>'.$enquiry->start_time.'</td>
             <td>'.$enquiry->end_date.'</td>
             <td>'.$enquiry->end_time.'</td>
             <td>';
             if($enquiry->done=='0') {
                 $result .= '<img id="done_img_'.$enquiry->id.'" rel="'.$enquiry->done.'" src="'.URL::base().'images/close-icon.gif" onClick="changeStatus('.$enquiry->id.',\'changestatusforenquiries\');"/>';
             } else {
                 $result .= '<img id="done_img_'.$enquiry->id.'" rel="'.$enquiry->done.'" src="'.URL::base().'images/green-mark.gif" onClick="changeStatus('.$enquiry->id.',\'changestatusforenquiries\');"/>';
             }
             $result .= '</td>';
         $result .= '</tr>';
       }
       return $result;
    }
}