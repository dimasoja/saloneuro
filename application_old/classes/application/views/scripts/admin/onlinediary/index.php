<script type="text/javascript">
    jQuery(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		jQuery('#calendar').fullCalendar({
			editable: true,
            events: [
            <?php foreach($enquiries as $enquiry) { 
                  $date = explode(" ", $enquiry->start_date); 
                  $date_month = date_parse($date[1]);?>
                  {
                      className: '<?php echo $enquiry->color; ?>',
                      title: "<?php echo $enquiry->job_description; ?>",
                      start: new Date('<?php echo $date['2'] ?>', '<?php echo (int)$date_month['month']-1;  ?>', '<?php echo $date['0']; ?>')
                  },
            <?php } ?>
            <?php foreach($todolist as $todo) {
                  $date = explode(" ", $todo->start_date); 
                  $date_month = date_parse($date[1]);?>
                  {
                      className: '<?php echo $todo->color; ?>',
                      title: "<?php echo $todo->job_description; ?>",
                      start: new Date('<?php echo $date['2'] ?>', '<?php echo (int)$date_month['month']-1;  ?>', '<?php echo $date['0']; ?>')
                  },
            <?php } ?>
            <?php foreach ($quotations as $quotation) { 
                  if ($quotation->work_date != 0) {
                    $start_date = date("d m Y", $quotation->work_date);
                    $start_date = explode(" ", $start_date);
                    $booking = $model_shedule->getQuotation($quotation->id_quotation);
                    if (count($booking) > 1)  { 
                        $end_date = date("d m Y", $booking[count($booking) - 1]->datetime);
                        $end_date = explode(" ", $end_date);
                    }
                    ?>
                    {
                        className: 'black',
                        title: "<?php echo $quotation->name." ".$quotation->surname; ?>",
                        start: new Date('<?php echo $start_date['2'] ?>', '<?php echo (int)$start_date['1']-1;  ?>', '<?php echo $start_date['0']; ?>'),
                        <?php if(isset($end_date['2'])) { ?>
                        end: new Date('<?php echo $end_date['2'] ?>', '<?php echo (int)$end_date['1']-1;  ?>', '<?php echo $end_date['0']; ?>'),
                        <?php } ?>
                        url: '<?php echo URL::base().'admin/quotation/details/'.$quotation->id_quotation; ?>'
                    },            
            <?php }} ?>
            ]
		});
	});
</script>
<div style="width: 900px; float: left;"><h1>Floorsand Enquiries</h1></div>
<a id="diary-fancy" href="#add-entry-form"><br/><br/>
    <input class="submit" type="button" value="ADD ENTRY"/>
</a><br/><br/><br/>
<div id="add-entry-fancy" style="display:none">
    <form id="add-entry-form" method="post" action="/admin/onlinediary/addonlinediary?save=onlinediary">
        <div style="width: 750px">
        <div id="left-and-entry">
            <div id="title-entry">
                <h3>FloorSand UK - Add Entry</h3>
            </div>
            <div id="options-entry">
                <b>FloorSand Enquiries</b> <input type="radio" id="floorsandentrysadd" name="option_entry" onClick="addActionToFancy(1); showPersonalInfo();" checked/>
                <b>To Do</b> <input type="radio" id="todoadd" name="option_entry" onClick="addActionToFancy(0); hidePersonalInfo();"/>            
            </div>
            <div class="clearboth">
                <div id="enquires-add">
                    <div id="personal-info">
                        <ul>
                           <li>
                               <div class="franchisee-name-small-div">
                                   <input id="name" type="text" name="name" value="First Name" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='First Name'){this.value=''};" onblur="if(this.value==''){this.value='First Name'};" />
                               </div>
                           </li>
                           <li>
                               <div class="franchisee-name-small-div">
                                   <input id="address" type="text" name="address" value="Address" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Address'){this.value=''};" onblur="if(this.value==''){this.value='Address'};" />
                               </div>
                           </li>
                           <li>
                               <div class="franchisee-name-small-div">
                                   <input id="postcode" type="text" name="postcode" value="Postcode" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Postcode'){this.value=''};" onblur="if(this.value==''){this.value='Postcode'};" />
                               </div>
                           </li>
                           <li>
                               <div class="franchisee-name-small-div">
                                   <input id="quote_given" type="text" name="quote_given" value="Quote Given" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Quote Given'){this.value=''};" onblur="if(this.value==''){this.value='Quote Given'};" />
                               </div>
                           </li>
                       </ul>
                   </div>
                   <div id="todo-add">
                   
                   </div>
                </div>
            </div>
            <div class="clearboth main-form-entry">
                    <textarea class="textarea-entry" class="job_description" name="job_description"  id="discribe_work" onfocus="if(this.value=='Description'){this.value=''};" onblur="if(this.value==''){this.value='Description'};" >Description</textarea>
            </div>
            <div class="clearboth main-form-entry">
                <div class="floatleft yesno_entry">
                    <b>Reccuring Entry</b><input type="checkbox" class="radio_price1" onclick="jQuery('.reccuring-entrys').css('visibility', this.checked ? 'visible' : 'hidden')"/>
                </div>
                <div class="floatleft reccuring-entrys" id="rec_entrys" style="visibility:hidden">
                    Every Day<input type="radio" name="reccuring" value="day"/> 
                    Every Week<input type="radio" name="reccuring" value="week"/> 
                    Every Month<input type="radio" name="reccuring" value="month"/> 
                    Every Quarter<input type="radio" name="reccuring" value="quarter"/> 
                </div>
            </div>
            <div class="clearboth main-date-entrys">
                <div class="date-entrys">
                    Starting from: <input type="text" class="start_date" name="start_date" id="start_date" value="" /><br/>
                    <div class="floatleft">
                        Start time: 
                    </div>
                    <div class="floatleft starttimehours">
                        <input type="text" class="start_time" name="start_time" id="start_time" value=""/>
                    </div>
                </div>
                <div class="date-entrys">
                    Ending:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="start_date" name="end_date" id="end_date" value="" /><br/>
                    <div class="floatleft">
                        End Time: 
                    </div>
                    <div class="floatleft endtimehours">
                        <input type="text" class="start_time" name="end_time" id="end_time" value=""/>
                    </div>
                </div>
                <div class="date-entrys">
                    Same day: <input type="checkbox" class="radio_price1" id="sameday" onclick="jQuery('#hours-div').css('visibility', this.checked ? 'visible' : 'hidden')"/>
                    <div id="hours-div" style="visibility: hidden;">
                        1hr<input type="radio" id="1_hour" name="hours" onClick="setSameDay('1')"/> 
                        2hr<input type="radio" id="2_hour" name="hours" onClick ="setSameDay('2')"/> 
                        3hr<input type="radio" id="3_hour" name="hours" onClick ="setSameDay('3')"/> 
                    </div>
                </div>
            </div>
            <div class="clearboth">
            </div>
        </div>
        <div id="right-add-entry">
            <span id="red" class="color_1">&nbsp;</span>
            <span id="yellow" class="color_2"></span>
            <span id="green" class="color_3"></span>
            <span id="darkblue" class="color_4"></span>
            <span id="violette" class="color_5"></span>
            <span id="orange" class="color_6"></span>
            <span id="black"  class="color_7" rel="checked" style="border: 1px solid white;"></span>
            <input type="hidden" value="black" id="color" name="color"/>
        </div>
        <div class="clearboth submit-entry">
             <input type="hidden" name="id_user" value="<?php echo Auth::instance()->get_user()->id; ?>"/>
            <br/><input class="submit" type="button" value="ADD ENTRY" onClick="checkEntrys()"/>
        </div>
    </div>
    </form>

</div>
<div class="enquiries-table" >
     <table>
         <thead>
             <tr> 
                 <td></td><td>Name</td><td>Address</td><td>Post Code</td><td>Job Description</td><td>Quote Given</td><td>Visit Booked</td><td>Time</td><td>Job Booked</td><td>Time</td><td id="done">Done</td>
             </tr>
         </thead>
         <?php foreach($enquiries as $enquiry) { ?>
         <tr id="line_<?php echo $enquiry->id; ?>" <?php if($enquiry->done=='0') echo 'class=lightgrey style="color: black; text-decoration: line-through"'; ?>>
             <td><input type="checkbox" class="onlinediary_check" rel="<?php echo $enquiry->id; ?>"/></td>
             <td><?php echo $enquiry->name; ?></td>
             <td><?php echo $enquiry->address; ?></td>
             <td><?php echo $enquiry->postcode; ?></td>
             <td><?php echo $enquiry->job_description; ?></td>
             <td><?php echo $enquiry->quote_given; ?></td>
             <td><?php echo $enquiry->start_date; ?></td>
             <td><?php echo $enquiry->start_time; ?></td>
             <td><?php echo $enquiry->end_date; ?></td>
             <td><?php echo $enquiry->end_time; ?></td>
             <td>
                 <?php if($enquiry->done=='0') { ?>
                        <img id="done_img_<?php echo $enquiry->id; ?>" rel="<?php echo $enquiry->done;?>" src="<?php echo URL::base()."images/close-icon.gif"; ?>" onClick="changeStatus('<?php echo $enquiry->id; ?>','changestatusforenquiries');"/>
                 <?php } else { ?>
                         <img id="done_img_<?php echo $enquiry->id; ?>" rel="<?php echo $enquiry->done;?>" src="<?php echo URL::base()."images/green-mark.gif"; ?>" onClick="changeStatus('<?php echo $enquiry->id; ?>','changestatusforenquiries');"/>
                 <?php } ?>
             </td>
         </tr>
         <?php } ?>
    </table><br/>
    <?php $count_pages = floor($count_enquiries/7)+1; 
    if(($count_pages>1) and($count_enquiries!=7)) { ?>
        <div id="pagination">
            <div id="items_pagination">
                <?php for($i=1; $i<$count_pages+1; $i++) { ?>
                     <font href="/" onClick="paginate('<?php echo $i-1; ?>','onlinediary')" id="items"><?php echo $i; ?></font>  
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div><br/>
<input class="submit" type="button" value="DELETE ENTRY/ENTRIES" onClick="deleteEntries('onlinediary')"/>
<div class="clearboth calendar-enquiry">
    <h1>Diary Sheet for Lucy Wilkinson</h1><br/>
    <div id='calendar'></div>
</div>
<div class="todo-table" >
     <table>
         <thead>
             <tr> 
                 <td></td><td>Things To Do</td><td>Date</td><td id="done_todo">Done</td>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($todolist as $todo) { ?>
                 <tr id="line_todo_<?php echo $todo->id; ?>" <?php if ($todo->done == '0') echo 'class=lightgrey style="color: black; text-decoration: line-through"'; ?>>
                     <td><input type="checkbox" class="todo_check" rel="<?php echo $todo->id; ?>"/></td>
                     <td><font class="<?php echo $todo->color; ?>"><?php echo $todo->job_description; ?></font></td>
                     <td><?php echo $todo->start_date; ?></td>
                     <td>
                         <?php if ($todo->done == '0') { ?>
                             <img id="done_todo_img_<?php echo $todo->id; ?>" rel="<?php echo $todo->done; ?>" src="<?php echo URL::base() . "images/close-icon.gif"; ?>" onClick="changeStatus('<?php echo $todo->id; ?>','changestatusfortodo');"/>
                         <?php } else { ?>
                             <img id="done_todo_img_<?php echo $todo->id; ?>" rel="<?php echo $todo->done; ?>" src="<?php echo URL::base() . "images/green-mark.gif"; ?>" onClick="changeStatus('<?php echo $todo->id; ?>','changestatusfortodo');"/>
                         <?php } ?>
                     </td>
                 </tr>
             <?php } ?>
         </tbody>
    </table><br/>
    <?php $count_pages = floor($count_todo/7)+1; 
    if(($count_pages>1) and($count_todo!=7)) { ?>
        <div id="pagination">
            <div id="items_pagination">
                <?php for($i=1; $i<$count_pages+1; $i++) { ?>
                     <font href="/" onClick="paginate('<?php echo $i-1; ?>','todo')" id="items"><?php echo $i; ?></font>  
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div><br/>
<input class="submit" type="button" value="DELETE ENTRY/ENTRIES" onClick="deleteEntries('todo')"/>
