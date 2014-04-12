





function chooseDate(day, month, year, el) {
    var html = jQuery('#is_date_not').html();
    html += "<input type='hidden' name='day' id='dayid' value='" + day + "' />";
    html += "<input type='hidden' name='month' value='" + month + "' />";
    html += "<input  type='hidden' name='year' value='" + year + "' />";
    jQuery('#is_date_not').html(html);
    
    // выставляем новые выбранные галочки
    var c = el.split(",");
    var flag = true;
    var holidayFlag = true;
    
    for(var ij = 0; ij < c.length; ij++) {
        if(trim(c[ij]) != "" && jQuery('#'+c[ij]).attr('src') == "/images/close-icon.gif") {
            flag = false;
        }
    }
    
    // убираем выбранные если они выбраны
    var eel = jQuery('#eel').val();
    if(eel != ""){
        var b = eel.split(",");
        for(var i = 0; i < b.length; i++) {
            if (trim(b[i]) != "" && jQuery('#'+c[ij]).attr('src') != "/images/close-icon.gif") {
                jQuery('#'+b[i]).attr("src","/images/green-mark.gif");        
            }
        }	
    }
    
    if(flag) {
        for(var j = 0; j < c.length; j++) {
            if (trim(c[j]) != "") {
                                    
                if(jQuery('#'+c[j]).attr("alt")=="1")
                    holidayFlag = false;
                
                jQuery('#'+c[j]).attr("src","/images/blue-mark.png");        
            }
        }
        jQuery('#eel').val(el);
    } else {
        var numOfDays = jQuery('#datepick').val();
        jQuery('#eel').val("");
        alert('Please select another date, as your job requires '+ numOfDays +' days.');
    }
    
    // если на пути встретился выходной день - надо выдать уведомление
    if(holidayFlag == false) {
		jQuery('#weekend_work').val('1');
        alert('The chosen date would extend your job into the weekend. Please either select an alternative date or send a request for weekend work by clicking Ok.');
    } else {
		jQuery('#weekend_work').val('0');
	}
    
}

function removeSelection() {
    var eel1 = jQuery('#eel').val();
    if(trim(eel1) != "") {
        var eel = jQuery('#eel').val();
        if(eel != ""){
            var b = eel.split(",");
            for(var i = 0; i < b.length; i++) {
                if (trim(b[i]) != "") {
                    jQuery('#'+b[i]).attr("src","/images/green-mark.gif");        
                }
            }	
        }
        jQuery('#eel').val("");
    }
}

function trim(str, chars) { 
    return ltrim(rtrim(str, chars), chars); 
} 
 
function ltrim(str, chars) { 
    chars = chars || "\\s"; 
    return str.replace(new RegExp("^[" + chars + "]+", "g"), ""); 
} 
 
function rtrim(str, chars) { 
    chars = chars || "\\s"; 
    return str.replace(new RegExp("[" + chars + "]+$", "g"), ""); 
}

function choose_option(id){
    if(jQuery('#fo'+id).attr("checked")){		
        jQuery('#fo'+id+"_form").val("yes");
        jQuery('#fo'+id+"_form").attr("checked",true);
    }else{
        jQuery('#fo'+id+"_form").val("no");
        jQuery('#fo'+id+"_form").attr("checked",false);
    }
}

function submitForm(is_checkout) {
    jQuery('#quotation_option').val(is_checkout);
    jQuery('#is_date_not_form').submit();
    	
}
