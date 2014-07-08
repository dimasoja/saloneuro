





jQuery(document).ready(function(){ 
    //check Same day with additional time
    jQuery('#users-fancy').fancybox({
        width: 300, 
        height: 600,
        scrolling: 'no',
        helpers : {
            overlay : {
                speedIn    : 0,
                speedOut   : 0,
                opacity    : 0.6
            }
        }
    });
        jQuery('#role-fancy').fancybox({
        width: 300, 
        height: 600,
        scrolling: 'no',
        helpers : {
            overlay : {
                speedIn    : 0,
                speedOut   : 0,
                opacity    : 0.6
            }
        }
    });
}); 
function checkUser() {

    var login=jQuery('#login').val();
//	var name=jQuery('#name').val();
//	var surname=jQuery('#surname').val();
    var password=jQuery('#password').val();
    var email=jQuery('#email').val();
	var error_text="Please, fill in the following fields: "
	var can_continue=1;

        if(login.length<2 || login == "Login"){
            can_continue=0;
            error_text+="'Login',";
        }
//        if(name.length<2 || name == "Name"){
//            can_continue=0;
//            error_text+="'Name',";
//        }
//        if(surname.length<2 || surname == "Surname"){
//            can_continue=0;
//            error_text+="'Surname',";
//        }
        if(email.length < 5 || email.length > 150 || !isValidEmail(email)){
            can_continue=0;
            error_text+="'Email',";
        }
        if(password.length<2){
            can_continue=0;
            error_text+="'Password',";
        }

	if(can_continue==0){
		alert(error_text);
	} else{
		jQuery('#add-users-form').submit();
	}
}
function checkRole() {

    var role=jQuery('#role').val();
    var error_text="Please, fill in the following fields: "
    var can_continue=1;
    if(role.length<2 || role == "Role"){
        can_continue=0;
        error_text+="'Role',";
    }
    if(can_continue==0){
        alert(error_text);
    } else{
        jQuery('#add-role-form').submit();
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
function isValidEmail (email, strict) {
    if ( !strict ) {
        email = email.replace(/^\s+|\s+$/g, '');
    }
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
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