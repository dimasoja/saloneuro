





function checkTestimonials() {
    var can_continue = '1';
	var error_text="Please, fill in the following fields: ";
    var error_text_questions = "Please answer all questions";
    var questions_check = '1';
    var fill_check = '1';
    var name=jQuery('#name').val();
	var surname=jQuery('#surname').val();
	var email=jQuery('#email').val();
    for(i=1; i<16; i++) {
        var value_questions = jQuery('input[name=quest'+i+']').filter(':checked').val();
        if(value_questions==undefined) {
             can_continue = 0;
             questions_check = '0';
        }
    }
	if(name.length<2 || name == "First Name"){
		can_continue=0;
        fill_check='0';
		error_text+="'Name',";
	}
	if(surname.length<2 || surname == "Last Name"){
		can_continue=0;
        fill_check='0';
		error_text+="'Last Name',";
	}
	if(email.length<2 || email == "E-mail"){
		can_continue=0;
        fill_check='0';
		error_text+="'Contact Email Address', ";
	}
    var adr_pattern=/[0-9a-z_]+@[0-9a-z_]+\.[a-z]{2,5}/i;
    if(adr_pattern.test(email) == false) {
         can_continue = 0;
         fill_check='0';
         error_text += "invalid format of 'Contact Email Address',"
    }

    if(can_continue==0){
        if(questions_check=='0') {
            if(fill_check=='0') {
                alert(error_text+error_text_questions); 
            } else {
                alert(error_text_questions); 
            }
        } else {
            alert(error_text);
        }
	} else {
		jQuery('#testimonials-form-add').submit();
	}
    
}



function slide1show() {
    jQuery('#slide1').css('display', 'block');
    jQuery('#slide2').css('display', 'none');
    jQuery('.big-arrow-left').attr('src','images/testimonials/arrow-left-fill.png');
    jQuery('.big-arrow-right').attr('src','images/testimonials/arrow-right-out.png');
    jQuery('#small-arrow-left').attr('src','images/testimonials/arrow-left-fill.png');
    jQuery('#small-arrow-right').attr('src','images/testimonials/arrow-right-out.png');
    jQuery('#num2').css('text-decoration', 'none');
    jQuery('#num1').css('text-decoration', 'underline');
}

function slide2show() {
    jQuery('#slide1').css('display', 'none');
    jQuery('#slide2').css('display', 'block');
    jQuery('.big-arrow-left').attr('src','images/testimonials/arrow-left-out.png');
    jQuery('.big-arrow-right').attr('src','images/testimonials/arrow-right-fill.png');
    jQuery('#small-arrow-left').attr('src','images/testimonials/arrow-left-out.png');
    jQuery('#small-arrow-right').attr('src','images/testimonials/arrow-right-fill.png');
    jQuery('#num1').css('text-decoration', 'none');
    jQuery('#num2').css('text-decoration', 'underline');
}