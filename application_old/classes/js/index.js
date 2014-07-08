






function sendFooterData() {
    var name = jQuery('#footer-name').val();
    var email = jQuery('#footer-email').val();
    var question = jQuery('#footer-question').val();
    var can_continue = true;
    var is_name = 'no';
    var is_email = 'no';
    var is_question = 'no';
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }
    if(email.length<2) {
        can_continue = false;
        is_email = 'yes';
    } else {
        if(!isValidEmailAddress(email)) {
            can_continue = false;
            is_email = 'not-email';
        } 
    }
    if(question.length<2) {
        can_continue = false;
        is_question = 'yes';
    }
    if(is_name=='yes') {
        jQuery('.err-name').html('Поле "Имя" обязательно к заполнению');
    } else {
        jQuery('.err-name').html('');
    }
    if(is_email=='yes') {
        jQuery('.err-email').html('Поле "E-mail" обязательно к заполнению');
    } else {
        if(is_email=='not-email') {
            jQuery('.err-email').html('Введенный адрес не является email.');
        } else {                    
            jQuery('.err-email').html('');
        }
    }
    if(is_question=='yes') {
        jQuery('.err-question').html('Поле "Ваш вопрос" обязательно к заполнению');
    } else {
        jQuery('.err-question').html('');
    }
    
    if(can_continue==false) {

    } else {     
        if(jQuery('.TxtStatus.dropSuccess').length==0) {
            jQuery('.QapTcha').css('display','block');
            jQuery('.TxtStatus').css('display','block');
        } else {
            var captcha_code = jQuery('.QapTcha input[type=hidden]').attr('name');            
            jQuery.ajax({
                url     : '/contact-us/ajaxform?name='+name+'&email='+email+'&question='+question+'&captcha_code='+captcha_code,
                type    : 'POST',
                dataType: 'html',
                timeout : 9000,
                error   : function(error) {                    
                    alert('Произошла ошибка');
                },
                success : function(html) {
                   // if(html=='yes') {
                        jQuery('.response').html('Спасибо! В ближайшее время мы свяжемся с Вами.');
                        jQuery('#footer-name').attr('disabled','disabled');
                        jQuery('#footer-email').attr('disabled','disabled');
                        jQuery('#footer-question').attr('disabled','disabled');
                        jQuery('.QapTcha').css('display','none');
                        jQuery('.TxtStatus').css('display','none');
                   // } else {
                      //  alert('Произошла ошибка. Возможно, мы вас перепутали со спам-ботом. Необходимо почистить кэш браузера и повторить попытку.');
                //    }
			
                }
           
            });
        }
    }
    
    
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
}

