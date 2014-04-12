





jQuery(document).ready(function(){ 
    // check color on fancybox, change border, write to input value for database, change color for Description field
    for(i=1;i<8; i++) {
        jQuery('.color_'+i).click(
            function() {
                for(i=1; i<8; i++) {
                    jQuery('.color_'+i).attr('rel', '');
                    jQuery('.color_'+i).css('border', '');
                }
                jQuery(this).attr('rel','checked').css('border', '1px solid white');
                jQuery('#color').val($(this).attr('id'));
                jQuery('#discribe_work').css('color', jQuery('#color').val());
            }
            );
    }
    
    //check Same day with additional time
    jQuery('#diary-fancy').fancybox({
        width: 755, 
        height: 530,
        helpers : {
            overlay : {
                speedIn    : 0,
                speedOut   : 0,
                opacity    : 0.6
            }
        }
    });
    jQuery('#start_date').datetimepicker({
        dateFormat: "d M yy",
        altField: "#start_time"
    });
    jQuery('#start_date').datetimepicker(
       "setDate", new Date()
    );
    jQuery('#end_date').datetimepicker({
        dateFormat: "d M yy",
        altField: "#end_time"
    });
}); 
function checkEntrys() {

    var name=jQuery('#name').val();
	var address=jQuery('#address').val();
	var postcode=jQuery('#postcode').val();
    var quote_given=jQuery('#quote_given').val();
	var job_description=jQuery('#discribe_work').val();
	var start_date=jQuery('#start_date').val();
	var start_time=jQuery('#start_time').val();
	var end_date=jQuery('#end_date').val();
	var end_time=jQuery('#end_time').val();
	var error_text="Please, fill in the following fields: "
	var can_continue=1;
    if(jQuery('#floorsandentrysadd').is(':checked')) {
        if(name.length<2 || name == "First Name"){
            can_continue=0;
            error_text+="'First Name',";
        }
        if(address.length<2 || address == "Address"){
            can_continue=0;
            error_text+="'Address',";
        }
        if(postcode.length<2 || postcode == "Postcode" || isNaN(parseInt(postcode))){
            can_continue=0;
            error_text+="'Postcode',";
        }
        if(quote_given.length<2 || quote_given == "Quote Given" || isNaN(parseFloat(quote_given))){
            can_continue=0;
            error_text+="'Quote Given',";
        }
    }
	if(job_description.length<2 || job_description == "Description"){
		can_continue=0;
		error_text+="'Description',";
	}
	if(start_date.length<2){
		can_continue=0;
		error_text+="'Start Date',";
	}
    if(start_time.length<2){
		can_continue=0;
		error_text+="'Start Time',";
	}
    if(end_date.length<2){
		can_continue=0;
		error_text+="'End Date',";
	}
    if(end_time.length<2){
		can_continue=0;
		error_text+="'End Date',";
	}
    csd = start_date.split(" ");
    ced = end_date.split(" ");
    cst = start_time.split(":");
    cet = end_time.split(":");
    var month_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");	
    start = new Date(csd[2], jQuery.inArray(csd[1], month_names)+1, csd[0], cst[0], cst[1]);
    end = new Date(ced[2], jQuery.inArray(ced[1], month_names)+1, ced[0], cet[0], cet[1]);
    if(start>end) {
        can_continue=0;
        error_text+="'Please fill correct end date;'";
    }
	if(can_continue==0){
		alert(error_text);
	} else{
		jQuery('#add-entry-form').submit();
	}
}
function addActionToFancy(value) {
    var result = (value==1) ? '/admin/onlinediary/addonlinediary?save=onlinediary': '/admin/onlinediary/addonlinediary?save=todo';
    jQuery('#add-entry-form').attr('action', result);
}
function hidePersonalInfo() {
    jQuery('#personal-info').css('display','none');
}
function showPersonalInfo() {
    jQuery('#personal-info').css('display','block');
}
function setSameDay(value) {
    if(jQuery('#sameday').is(':checked')) {
        for(i=1; i<4; i++) {
            jQuery('#'+i+'_hour').removeAttr('checked');
        }
        jQuery('#'+value+'_hour').attr('checked', 'checked');
        var now = new Date();
        changedtime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours()+parseInt(value), now.getMinutes(), now.getSeconds());
        jQuery('#end_date').datetimepicker(
            "setDate", changedtime
        );
    }
}

//change status Done or not
function changeStatus(id, path) {
    if(path=='changestatusfortodo') {
        img=jQuery('#done_todo_img_'+id);
        line=jQuery('#line_todo_'+id);       
    } else {
        img=jQuery('#done_img_'+id);
        line=jQuery('#line_'+id);
    }
    if(img.attr('rel')=='0') rel='1'; else rel='0';
    jQuery.ajax({
        url     : '/admin/onlinediary/'+path+'?val='+rel+'&id='+id,
        timeout : 9000,
     error: function () {
         alert('Error!');
     },
     success : function(html) {
           if(rel=='0') {
               img.attr('src','/images/close-icon.gif').attr('rel','0');
               line.addClass('lightgrey');
               line.css('color', 'black');
               line.css('text-decoration','line-through');
           } else {
               img.attr('src','/images/green-mark.gif').attr('rel','1');
               line.removeClass('lightgrey');
               line.css('text-decoration','none');
           }
        }
   });
}
function deleteEntries(type) {
    response = '';
    jQuery("."+type+"_check:checked").each(
        function(i) {
            rel=jQuery(this).attr('rel');
            response += rel+',';
            if(type=='onlinediary') mess=''; else mess='todo_';
            jQuery('#line_'+mess+rel).remove();
        }
    );
    if(response!='') {
        jQuery.ajax({
            url     : '/admin/onlinediary/deleteentrys?type='+type+'&response='+response,
            timeout : 9000,
         error: function () {
             alert('Error!');
         },
         success : function(html) {
             enquiries_html_tbody = jQuery('.enquiries-table tbody').html();
             if(enquiries_html_tbody=='') window.location.href=window.location.href;
             todo_html_tbody = jQuery('.todo-table tbody').html();
             if(todo_html_tbody=='') window.location.href=window.location.href;
            }
       });        
    }
}
function paginate(start_from,type) {

    jQuery.ajax({
        url     : '/admin/onlinediary/getpartoftable?start_from='+start_from+'&type='+type,
        timeout : 9000,
        error: function () {
            alert('Error!');
        },
        success : function(html) {
            if(html=='') window.location.href=window.location.href;
            if(type=='onlinediary') jQuery('.enquiries-table tbody').html(html);
            if(type=='todo') jQuery('.todo-table tbody').html(html);
        }
    });   
}