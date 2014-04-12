






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
function putToUri(id, id_image) {            
    jQuery.ajax({
        url     : '/admin/slider/saveparent?id='+id+'&id_image='+id_image,
        type    : 'POST',
        dataType: 'html',
        timeout : 9000,
        error   : function() {
            alert('Произошла ошибка!');
        },
        success : function(html) {                      
            jQuery('#related-page-'+id_image).html(html);
            parent.jQuery.fancybox.close();
        }//success
    });//ajax
}

function getSlider(id, type) {
    jQuery('#slider-for-'+type+' .slider .slider-text-right.active').removeClass('active').addClass('not-active');
    jQuery('#slider-for-'+type+' .slider .str-'+id).removeClass('not-active').addClass('active');
    jQuery('#slider-for-'+type+' .slider .slider-image.active').removeClass('active').addClass('not-active');
    jQuery('#slider-for-'+type+' .slider .slider-'+id).addClass('active').removeClass('not-active');
    jQuery('#slider-for-'+type+' .circles .active').removeClass('active').addClass('not-active');
    jQuery('#slider-for-'+type+' .circles .circle-'+id).removeClass('not-active').addClass('active');
    
}
function changeSlider(from, to) { 
    jQuery('.order-'+from).removeClass('active').addClass('not-active');
    jQuery('.order-'+to).removeClass('not-active').addClass('active');
    jQuery('.for-'+from).removeClass('active').addClass('not-active');
    jQuery('.for-'+to).removeClass('not-active').addClass('active');
    jQuery('#slider-for-'+from).css('display', 'none');
    jQuery('#slider-for-'+to).css('display', 'block');
    jQuery('#type-slider').val(to);     
    jQuery('#main-nav-'+to).removeClass('not-active').addClass('active');
    jQuery('#main-nav-'+from).removeClass('active').addClass('not-active');
    jQuery('#hidemenu-item-'+from).css('display','none');
    jQuery('#hidemenu-item-'+to).css('display','none');
    jQuery('#nav-top-'+to+' #mainmenu-item').css('display','block');
    jQuery.ajax({
        url     : '/index/savetosession?to='+to,
        type    : 'POST',
        dataType: 'html',
        timeout : 9000,
        error   : function() {
            alert('Произошла ошибка!');
        },
        success : function(html) {                                  
           
        }//success
    });//ajax    
}
function getVisible() { 
  
    type=jQuery('#type-slider').val();              
    if(type=='business') {
      var hidden_type='home';      
    } else {
      var hidden_type='business';
    }

    jQuery('.col1-'+type+'-label span').css('border-bottom','1px solid');
    jQuery('.col1-'+hidden_type+'-label span').css('border-bottom','none');
    elem = jQuery('#hidemenu-item-'+type);
    if(elem.is(':visible')) {
        elem.css('display','none');
	 jQuery('#nav-top-' + type + ' #mainmenu-item').css('display','block');
    } else {
        elem.css('display','block');
	 jQuery('#nav-top-' + type + ' #mainmenu-item').css('display','none');
    }         
    
}
function getOrder() {
    getVisibleBlock();
    if(jQuery('.get-order-buttons').css('display')=='block') {
	jQuery('.get-order-buttons').css('display','block');
    } else {
        jQuery('.get-order-buttons').css('display','none');
    }
    id_product = jQuery('.order-item.active').attr('rel');
    jQuery('.order-home').removeClass('active').addClass('not-active');
    jQuery('.order-business').removeClass('active').addClass('not-active');
    jQuery('.order-form .ff1').removeClass('not-active').addClass('active');
   // jQuery('.get-order-buttons').css('height', '110px');
}
function checkOrder() {
    name = jQuery('#order-name').val();
    phone = jQuery('#order-phone').val();    
    if((name!='') &&(phone!='')) {
      //  jQuery('.get-order-buttons').css('height','156px');
        jQuery('.order-submit').show();
    }
}
function makeOrder() {
    var name = jQuery('#order-name').val();
    var phone = jQuery('#order-phone').val();    
    var can_continue = true;
    var is_name = 'no';
    var is_phone = 'no';    
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }    
    if(phone.length<15) {
        can_continue = false;
        is_phone = 'yes';
    }     
    if(is_name=='yes') {
        jQuery('.order-err-name').html('Поле "Имя" - неверное значение.');
    } else {
        jQuery('.order-err-name').html('');
    }
    if(is_phone=='yes') {
        jQuery('.order-err-phone').html('Поле "Телефон" - неверное значение');
    } else {
        jQuery('.order-err-phone').html('');
    }
    var strokes = '';
    jQuery('.ff1 input[type=checkbox]').each(function(){
      if(jQuery(this).is(':checked')) {
	   strokes += jQuery(this).val()+'~';
      }
    });    
    if(can_continue==false) {
         
    } else {   
        id=jQuery('.get-order-block-top').attr('rel');
        jQuery.ajax({
            url     : '/index/makeorder?name='+name+'&phone='+phone+'&id_product='+id+'&types='+strokes,
            type    : 'POST',
            dataType: 'html',
            timeout : 9000,
            error   : function() {
                alert('Произошла ошибка!');
            },
            success : function(html) {     
	      console.log(html);
                jQuery('.order-submit').hide();
                jQuery('.order-success').show();
                jQuery('#order-name').attr('disabled','disabled');
                jQuery('#order-phone').attr('disabled','disabled');                           
            }
        });
    }
}
function redirectToOrder() {
    window.location='/makeorder';
}
function makeMainOrder() {    
    var name = jQuery('#order-name').val();    
    var phone = jQuery('#order-phone').val();    
    var can_continue = true;
    var is_name = 'no';
    var is_checked = 'no';
    var is_phone = 'no';    
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }
    if(phone.length<2) {
        can_continue = false;
        is_phone = 'yes';
    }         
    if(is_name=='yes') {
        jQuery('.order-err-name').html('Поле "Имя" - неверное значение.');
    } else {
        jQuery('.order-err-name').html('');
    }
    if(is_phone=='yes') {
        jQuery('.order-err-phone').html('Поле "Телефон" - неверное значение');
    } else {
        jQuery('.order-err-phone').html('');
    }
    var check=false;
    jQuery('.order-check').each(function(index){
        if(jQuery(this).is(':checked')==true) {
            check=true;
	    var id_product = jQuery(this).attr('rel');
	    jQuery('.items'+id_product+' .productsitems .types-check').each(function(){
                 if(jQuery(this).is(':checked')) {
                     	   
		}
	    });	    
        }
    });
    if(check==false) {
        can_continue=false;
        is_checked = 'yes';
    }
    if(is_checked=='yes') {
        jQuery('.order-err-checked').html('Отметьте хотя бы одну услугу.');
    } else {
        jQuery('.order-err-checked').html('');
    }
    if(can_continue==false) {
         
    } else {
        jQuery('#makeorder-form').submit();
    }
}
function makeresponse(id) {
    if(id==undefined) {
        window.location = "/response";
    } else {
        window.location = "/response?id="+id;
    }
}
function doResponse() {
    var name = jQuery('#response-name').val();
    var email = jQuery('#response-email').val();    
    var question = jQuery('#response-question').val();
    var can_continue = true;
    var is_name = 'no';
    var is_question = 'no';
    var is_email = 'no';    
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }
    if(email.length<2) {
        can_continue = false;
        is_email = 'yes';
    }
    if(question.length<2) {
        can_continue = false;
        is_question = 'yes';
    }     
    if(is_name=='yes') {
        jQuery('.response-err-name').html('Поле "Имя" - неверное значение.');
    } else {
        jQuery('.response-err-name').html('');
    }
    if(is_email=='yes') {
        jQuery('.response-err-email').html('Поле "E-mail" - неверное значение');
    } else {
        jQuery('.response-err-email').html('');
    }
    if(is_question=='yes') {
        jQuery('.response-err-question').html('Неверное значение');
    } else {
        jQuery('.response-err-question').html('');
    }
    
    if(can_continue==false) {
         
    } else {
        jQuery('#response-form').submit();
    }   
}
function makeComplex() {
    var name = jQuery('#response-name').val();
    var email = jQuery('#response-email').val();    
    var question = jQuery('#response-question').val();
    var can_continue = true;
    var is_name = 'no';
    var is_question = 'no';
    var is_email = 'no';    
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }
    if(email.length<2) {
        can_continue = false;
        is_email = 'yes';
    }
    if(question.length<2) {
        can_continue = false;
        is_question = 'yes';
    }     
    if(is_name=='yes') {
        jQuery('.response-err-name').html('Поле "Имя" - неверное значение.');
    } else {
        jQuery('.response-err-name').html('');
    }
    if(is_email=='yes') {
        jQuery('.response-err-email').html('Поле "E-mail" - неверное значение');
    } else {
        jQuery('.response-err-email').html('');
    }
    if(is_question=='yes') {
        jQuery('.response-err-question').html('Неверное значение');
    } else {
        jQuery('.response-err-question').html('');
    }
    
    if(can_continue==false) {
         
    } else {
        jQuery('#response-form').submit();
    }   
}

function doCallBack() {
    var name = jQuery('#response-name').val();
    var phone = jQuery('#response-phone').val();        
    var can_continue = true;
    var is_name = 'no';    
    var is_phone = 'no';    
    if(name.length<2) {
        can_continue = false;
        is_name = 'yes';
    }
    if(phone.length<2) {
        can_continue = false;
        is_phone = 'yes';
    }    
    if(is_name=='yes') {
        jQuery('.response-err-name').html('Поле "Имя" - неверное значение.');
    } else {
        jQuery('.response-err-name').html('');
    }
    if(is_phone=='yes') {
        jQuery('.response-err-phone').html('Поле "Телефон" - неверное значение');
    } else {
        jQuery('.response-err-phone').html('');
    }
    if(can_continue==false) {
         
    } else {
        jQuery('#callback-form').submit();
    }   
}
