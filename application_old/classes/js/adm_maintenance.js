





var price_sq = 0;
var total_price = 0;
var total_square = 0;
var photos_count = 0;

jQuery(document).ready(function() {
    /* Ajax upload images */
    var up_btn = jQuery('#uploadButton'), interval;
    jQuery.ajax_upload(up_btn, {
        action: baseurl + 'online-quotation/upload',
        name: 'imagefile',
        onSubmit: function(file, ext) {
            this.disable();
        },
        onComplete: function(file, responce) {
            this.enable();
            if ('0' == responce) {
                jQuery('#photos_block_error').html('The file you have uploaded is not a picture.');
                jQuery('#photos_block_error').show();
                setInterval(function() {
                    jQuery('#photos_block_error').hide()
                    }, 3000);
            } else {
                photos_count++;
                if (photos_count == 6) {
                    this.disable();
                    jQuery('#photos_block_error').html('Limit has reached.');
                    jQuery('#photos_block_error').show();
                } 
                var img_html = "<div id='ph_" + photos_count + "' style='position: relative; float: left; margin: 10px 9px; border: 1px solid #fff; padding: 5px; width: 200px; height: 150px; text-align: center;'>";
                img_html += "<div style='position: absolute; right: -5px; top: -5px; width: 24px; height: 24px;'><a href='javascript:void(0);' onclick='closeImg(" + photos_count + ")'><img src='" + baseurl + "images/closeicon.png' /></a></div>";
                img_html += "<img id='phi_" + photos_count + "' src='" + baseurl + "../uploads/users/" + responce + "' style='max-width: 190px; max-height: 140px;' />";
                img_html += "<input type='hidden' name='photos[]' value='" + responce + "' />";
                img_html += "</div>";
                
                jQuery('#photos_block').append(img_html);
            }
            
        }
    });
    /* Ajax upload images */
    
    jQuery('#rooms_count').keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    
    jQuery('#rooms_count').keyup(function(e) {
        var html = "";
        if (this.value > fs_max_count_rooms) {
            this.value = fs_max_count_rooms;
        }
        html += "<ul style='list-style-type: none'>";
        if (jQuery('#room_dimentions').is(':checked')) {
            for (i = 1; i <= this.value; i++) {
                html += "<li>";
                html += "<span>Room " + i + ":&nbsp;&nbsp; </span> ";
                html += "Width ";
                html += "<input type=\"text\" name=\"room_w[" + i + "]\" id=\"room_w_" + i + "\" value=\"\"  class=\"date-field numb inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Feet&nbsp;";
                html += "<input type=\"text\" name=\"room_w_i[" + i + "]\" id=\"room_w_i_" + i + "\" value=\"\"  class=\"date-field inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Inches&nbsp;";
                html += "&nbsp;   x&nbsp;&nbsp;   Length ";
                html += "<input type=\"text\" name=\"room_l[" + i + "]\" id=\"room_l_" + i + "\" value=\"\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Feet&nbsp;";
                html += "<input type=\"text\" name=\"room_l_i[" + i + "]\" id=\"room_l_i_" + i + "\" value=\"\"  class=\"date-field inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Inches = ";
                html += "<input type=\"text\" name=\"total_sq[" + i + "]\" id=\"total_sq_" + i + "\" value=\"\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                html += "Total Sq Feet&nbsp;&nbsp;&nbsp; Price £ ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        } else {
            for (i = 1; i <= this.value; i++) {
                html += "<li style='width: 100% !important'>";
                html += "<span>Room " + i + ":&nbsp;&nbsp; </span> ";
                html += "Width ";
                html += "<input type=\"text\" name=\"room_w[" + i + "]\" id=\"room_w_" + i + "\" value=\"\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Metres&nbsp;&nbsp;   x&nbsp;&nbsp;   Length ";
                html += "<input type=\"text\" name=\"room_l[" + i + "]\" id=\"room_l_" + i + "\" value=\"\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Metres = ";
                html += "<input type=\"text\" name=\"total_sq[" + i + "]\" id=\"total_sq_" + i + "\" value=\"\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                html += "Total Sq Metres&nbsp;&nbsp;&nbsp; Price £ ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        }
        html += "</ul>";
        jQuery('#ul_rooms').html(html);
    });
    
    jQuery('.numb').live('keypress', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    
    jQuery("body :input").live('change', function(event) {
        if (jQuery(this).is(':checkbox')) {
            var o;
            var name_checkbox = jQuery(this).attr('name');
            if (jQuery(this).is(':checked')) {
                o = jQuery(this);
            }
            jQuery('[name=' + name_checkbox + ']').each (function() {
                jQuery(this).removeAttr('checked');
                if (o) {
                    o.attr('checked', 'checked');
                }
            })
        }
        
        if (jQuery('#other_radio').is(':checked')) {
            jQuery('#other_text').show();
        } else {
            jQuery('#other_text').hide();
        }
        jQuery('.numb').each(function(e){
            var total_meters = 0;
            var ident;
            var strTotal = "";
            if (jQuery('#room_dimentions').is(':checked')) {
                ident = jQuery(this).attr('rel');
                var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
                var room_w_s = room_w.toString();
                var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
                var room_l_s = room_l.toString();
                total_meters = Number(room_w).toPrecision( ((-1 != room_w_s.indexOf('.')) ? room_w_s.indexOf('.') : room_w_s.length) + 2) * Number(room_l).toPrecision( ((-1 != room_l_s.indexOf('.')) ? room_l_s.indexOf('.') : room_l_s.length) + 2);
            } else {
                ident = jQuery(this).attr('rel');
                total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();
                
            }
            strTotal = total_meters.toString();
            jQuery('#total_sq_' + ident).val(Number(total_meters).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
            
        });
        
        // если отработавший по live элемент НЕ #payment_status то пересчитываем цену заново
        if(!jQuery(this).is('#payment_status'))
            calcPrice();
        
    });
});

function calcPrice() {
    price_sq = 0;
    var price_sq1 = 0;
    jQuery('.radio_price1').each(function() {
        if (jQuery(this).is(':checked')) {
            price_sq1 = parseInt(jQuery(this).attr('rel'));
        } 
    });
    var price_sq2 = 0;
    jQuery('.radio_price2').each(function() {
        if (jQuery(this).is(':checked')) {
            price_sq2 = parseInt(jQuery(this).attr('rel'));
        } 
    });
    var price_sq3 = 0;
    jQuery('.radio_price3').each(function() {
        if (jQuery(this).is(':checked')) {
            price_sq3 = parseInt(jQuery(this).attr('rel'));
        } 
    });
    price_sq = price_sq1 * fs_daily_clean + price_sq2 * fs_deep_clean + price_sq3 * fs_buff_n_coat;
    total_square = 0;
    jQuery('.numb').each(function(e){
        var total_meters = 0;
        var ident;
        if (jQuery('#room_dimentions').is(':checked')) {
            ident = jQuery(this).attr('rel');
            var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
            var room_w_s = room_w.toString();
            var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
            var room_l_s = room_l.toString();
            total_meters = Number(room_w).toPrecision( ((-1 != room_w_s.indexOf('.')) ? room_w_s.indexOf('.') : room_w_s.length) + 2) * Number(room_l).toPrecision( ((-1 != room_l_s.indexOf('.')) ? room_l_s.indexOf('.') : room_l_s.length) + 2);
        } else {
            ident = jQuery(this).attr('rel');
            total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();
        }
        var strTotal = total_meters.toString();
        total_meters = Number(total_meters).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 );
        jQuery('#total_sq_' + ident).val(total_meters);
        var tmp_tp = total_meters * price_sq;
        
        if (jQuery('#room_dimentions').is(':checked')) {
            tmp_tp = tmp_tp / 10.764;
        }
        var tmp_tps = tmp_tp.toString();
        jQuery('#price_' + ident).val(Number(tmp_tp).toPrecision( ((-1 != tmp_tps.indexOf('.')) ? tmp_tps.indexOf('.') : tmp_tps.length) + 2 ));
    });

    
   
    jQuery('.total_square_m').each(function() {
        total_square += parseFloat(jQuery(this).val());
    });
    
    //console.log("total square: " + total_square);
    var total_price_1 = 0;
    if (total_square * fs_daily_clean < fs_daily_clean_min) {
        total_price_1 = fs_daily_clean_min * price_sq1 * fs_daily_clean;
    } else {
        total_price_1 = total_square * price_sq1 * fs_daily_clean;
    }

    var total_price_2 = 0;
    if (total_square * fs_deep_clean < fs_deep_clean_min) {
        total_price_2 = fs_deep_clean_min * price_sq2 * fs_deep_clean;
    } else {
        total_price_2 = total_square * price_sq2 * fs_deep_clean;
    }

    var total_price_3 = 0;
    if (total_square * fs_buff_n_coat < fs_buff_n_coat_min) {
        total_price_3 = fs_buff_n_coat_min * price_sq3 * fs_buff_n_coat;
    } else {
        total_price_3 = total_square * price_sq3 * fs_buff_n_coat;
    }

    total_price = total_price_1 + total_price_2 + total_price_3;
    if (jQuery('#room_dimentions').is(':checked')) {
        total_price = total_price / 10.764;
    }

    var tpStr = total_price.toString();

    jQuery('#total_price_for_job').val(Number(total_price).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
    var user_name = jQuery('#option_type').val();
    var op1 = parseFloat(total_price - (total_price * 20) / 100);
    var op1Str = op1.toString();
    jQuery('#option_1').val(Number(op1).toPrecision( ((-1 != op1Str.indexOf('.')) ? op1Str.indexOf('.') : op1Str.length) + 2 ));
    var op1s = parseFloat(total_price - op1);
    var op1sStr = op1s.toString();
    jQuery('#option_1_saving').val(Number(op1s).toPrecision( ((-1 != op1sStr.indexOf('.')) ? op1sStr.indexOf('.') : op1sStr.length) + 2 ));

    var op2 = parseFloat(total_price / 12);
    var op2Str = op2.toString();
    jQuery('#option_2').val(Number(op2).toPrecision( ((-1 != op2Str.indexOf('.')) ? op2Str.indexOf('.') : op2Str.length) + 2 ));

    jQuery('#option_3').val(Number(total_price).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
    if(user_name=="option 1"){
        jQuery('#option_price').val(Number(op1).toPrecision( ((-1 != op1Str.indexOf('.')) ? op1Str.indexOf('.') : op1Str.length) + 2 ));
    }
    if(user_name=="option 2"){
        jQuery('#option_price').val(Number(op2).toPrecision( ((-1 != op2Str.indexOf('.')) ? op2Str.indexOf('.') : op2Str.length) + 2 ));
    }
    if(user_name=="option 3"){
        jQuery('#option_price').val(Number(total_price).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
    }
    
}

function totalMeters(ident) {
    var total_meters = 0;
    var strTotal = "";
    if (jQuery('#room_dimentions').is(':checked')) {
        var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
        var room_w_s = room_w.toString();
        var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
        var room_l_s = room_l.toString();
        total_meters = Number(room_w).toPrecision( ((-1 != room_w_s.indexOf('.')) ? room_w_s.indexOf('.') : room_w_s.length) + 2) * Number(room_l).toPrecision( ((-1 != room_l_s.indexOf('.')) ? room_l_s.indexOf('.') : room_l_s.length) + 2);
    } else {
        ident = jQuery(this).attr('rel');
        total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();

    }
    strTotal = total_meters.toString();
    jQuery('#total_sq_' + ident).val(Number(total_meters).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
    
}

function submitForm(is_checkout) {
    jQuery('#goto_checkout').val(is_checkout);
    if (jQuery('#terms_and_conditions').is(':checked')) {
        jQuery('#maintenance_form').submit();
    } else {
        if(jQuery.browser.safari){
            jQuery('body').animate( {
                scrollTop: jQuery("#terms_and_conditions_p").offset().top
                }, 1100 );
        }else{
            jQuery('html').animate( {
                scrollTop: jQuery("#terms_and_conditions_p").offset().top
                }, 1100 );
        }
    }
}

function calculatePrice() {
    var can_continue = true;
    
    var user_name = jQuery('#name').val();
    var user_email = jQuery('#email').val();
    var user_address = jQuery('#address').val();
    var user_alternative_address = jQuery('#alternative_address').val();
    var user_town = jQuery('#town').val();
    var user_alternative_town = jQuery('#alternative_town').val();
    var user_postcode = jQuery('#postcode').val();
    var user_alternative_postcode = jQuery('#alternative_postcode').val();
    var user_phone = jQuery('#phone').val();
    var user_mphone = jQuery('#mphone').val();
    var user_maintenance = jQuery('#id_maintenance').val();
    
    if (user_name == "Name") {
        user_name = "";
    }
    if (user_email == "Email") {
        user_email = "";
    }
    if (user_address == "Address") {
        user_address = "";
    }
    if (user_alternative_address == "Alternative Address") {
        user_alternative_address = "";
    }
    if (user_town == "Town") {
        user_town = "";
    }
    if (user_alternative_town == "Alternative Town") {
        user_alternative_town = "";
    }
    if (user_postcode == "Postcode") {
        user_postcode = "";
    }
    if (user_alternative_postcode == "Alternative Postcode") {
        user_alternative_postcode = "";
    }
    if (user_phone == "Telephone number") {
        user_phone = "";
    }
    if (user_mphone == "Mobile number") {
        user_mphone = "";
    }
    
    if (user_mphone.length < 5 || user_mphone.length > 20 || !isValidPhoneNumber(user_mphone)) {
        can_continue = false;
        jQuery('#mphone_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid mobile number.</div>');
        jQuery('#mphone').focus();
    }
    if (user_phone.length > 20 || !isValidPhoneNumber(user_phone)) {
        can_continue = false;
        jQuery('#phone_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid telephone number.</div>');
        jQuery('#phone').focus();
    }
    
    if (user_postcode.length < 3 || user_postcode.length > 20) {
        can_continue = false;
        jQuery('#postcode_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid postcode.</div>');
        jQuery('#postcode').focus();
    }
    
    if (user_town.length < 2 || user_town.length > 50) {
        can_continue = false;
        jQuery('#town_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid town.</div>');
        jQuery('#town').focus();
    }
    
    if (user_address.length < 5 || user_address.length > 255) {
        can_continue = false;
        jQuery('#address_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid address.</div>');
        jQuery('#address').focus();
    }
    
    if (user_email.length < 5 || user_email.length > 150 || !isValidEmail(user_email)) {
        can_continue = false;
        jQuery('#email_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">This is not a valid e-mail format. Please, check and re-enter your e-mail address</div>');
        jQuery('#email').focus();
    }
    
    if (user_name.length < 2 || user_name.length > 150) {
        can_continue = false;
        jQuery('#name_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin: 5px; padding: 5px; width: 366px;">Please, enter a valid name.</div>');
        jQuery('#name').focus();
    }
    
    if (can_continue) {
        calcPrice();
        jQuery.post(baseurl + 'online-maintenance/saveuser', 
        {
            name: user_name, 
            email: user_email, 
            address: user_address,
            alternative_address: user_alternative_address,
            town: user_town, 
            alternative_town: user_alternative_town,
            postcode: user_postcode,
            alternative_postcode: user_alternative_postcode,
            phone: user_phone, 
            mphone: user_mphone, 
            id_maintenance: user_maintenance
        },
        function(data) {
            jQuery('#id_maintenance').val(data);
        }
        )
    }
}

function isValidEmail (email, strict) {
    if ( !strict ) {
        email = email.replace(/^\s+|\s+$/g, '');
    }
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}

function isValidPhoneNumber(phoneNumber) {
    return !(/[^0-9\+\(\)]/i).test(phoneNumber);
}

function closeImg(id) {
    var name = jQuery('#phi_' + id).attr('src');
    jQuery.post(baseurl + 'online-quotation/delimg', {
        imgpath: name
    }, function(data) {
        if ("1" == data) {
            photos_count--;
            jQuery('#ph_' + id).remove();
        }
    });
}

function changeWorkDates() {
    jQuery.post(baseurl + 'booking-shedule/maintenancebooking', {
        p: 1
    }, function(data) {
        jQuery('#modal_block2').html(data); 
    });
    jQuery('#modal_block_hidden2').show();
    jQuery('#modal_block2').show();
}

function closeSubmitForm() {
    jQuery('#modal_block2').html("");
    jQuery('#modal_block_hidden2').hide();
    jQuery('#modal_block2').hide();
}

//by clicking on image
function checkDate(day,month,year, input) {
    img = jQuery('#img_'+day+month+year).parent();
    checkbox = jQuery('#check_'+day+month+year);
    image_rel = img.attr('rel');
    //check image
    if(input=='img') {
        if(image_rel=='busy') {
            img.attr('rel','free');           
            jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/green-mark.gif');
       } else {
            img.attr('rel','busy');            
            jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/close-icon.gif');           
        }
    } else {
        
    }
    //check images for ajax
    if(img.attr('rel')=='busy') {
        type='busy';
        booked_mess = 'booked';
    } else {
        type='free';
        booked_mess = '';
    }
    //check checkbox for ajax
    if(checkbox.attr('checked')=='checked') {
        partial = 'yes';
        partial_mess = '(half)';
    } else {
        partial = 'no';
        partial_mess = '';
    }
    //send ajax
    jQuery.post(baseurl + 'admin/maintenance/checkdate', {
        d: day, 
        m: month, 
        y: year, 
        checked:partial,
        type:type,
        idm: jQuery('#id_maintenance').val(), 
        s1: 1
    }, function(data) {
        if ("1" == data) {
            if((partial=='no') && (type=='free')) { 
                jQuery('.d' + day + month + year).remove();
            } else {
                jQuery('.d' + day + month + year).remove();
                var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+booked_mess + " " + partial_mess + " <a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
                jQuery('#work_dates').append(newdata);
            }
        }
    });
    //remove date if yes
    if((partial=='no') && (type=='free')) removeDate(day, month, year);
}
//function checkDate(day,month,year, obj) {
//    if (obj.rel == "free") {
//        jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/close-icon.gif');
//        obj.rel = "busy";
//        jQuery.post(baseurl + 'admin/maintenance/checkdate', {
//            d: day, 
//            m: month, 
//            y: year, 
//            checked:'no',
//            type:type,
//            idm: jQuery('#id_maintenance').val(), 
//            s1: 1
//        }, function(data) {
//            if ("1" == data) {
//                var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+mess + " " +mess_all_day+ "<a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
//                jQuery('#work_dates').append(newdata);
//            }
//        });
//    } else {
//        jQuery('#img_' + day + month + year).attr('src', baseurl + 'images/green-mark.gif');
//        jQuery('#check_' + day + month + year).attr('rel', 'free');
//        obj.rel = "free";
//        if(type=='free') {
//            removeDate(day, month, year);
//        } else {
//            jQuery.post(baseurl + 'admin/maintenance/checkdate', {
//                d: day, 
//                m: month, 
//                y: year, 
//                checked:'no',
//                type:type,
//                idm: jQuery('#id_maintenance').val(), 
//                s1: 1
//            }, function(data) {
//                if ("1" == data) {
//                    if(jQuery('.d' + day + month + year).html()==undefined) {
//                        var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + " <a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";       
//                    } else { 
//                        jQuery('.d' + day + month + year).remove();
//                        var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+mess + " " +mess_all_day+ "<a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
//                    }
//                    jQuery('#work_dates').append(newdata);
//                }   
//            }); 
//        }
//    }
//}
//
//function halfDate(day,month,year, obj) {
//    if(jQuery(obj).attr('checked')=='checked') {
//        type='busy'; checked='yes'; mess='h-b'; jQuery('#check_' + day + month + year).attr('rel', 'busy');
//    } else {
//        type='free'; checked='no'; mess='';jQuery('#check_' + day + month + year).attr('rel', 'free');
//    }
//    if(jQuery('#img_' + day + month + year).parent().attr('rel')=='busy') mess_all_day='all_day'; else mess_all_day='';
//    if (jQuery(obj).attr('rel') == "free") {
//        
//        jQuery.post(baseurl + 'admin/maintenance/checkdate', {
//            d: day, 
//            m: month, 
//            y: year, 
//            checked: checked,
//            type:type,
//            idm: jQuery('#id_maintenance').val(), 
//            s1: 1
//        }, function(data) {
//            if ("1" == data) {
//                jQuery('.d' + day + month + year).remove();
//                var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+mess + "<a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
//             
//               jQuery('#work_dates').append(newdata);
//              // if(image=='free') jQuery('.d' + day + month + year).html('');
//            }
//        });
//        if(mess_all_day=='') {jQuery('.d' + day + month + year).remove();}
//    } else { 
//        
//        jQuery.post(baseurl + 'admin/maintenance/updatepartial', {
//            d: day, 
//            m: month, 
//            y: year, 
//            checked: checked,
//            type: 'busy',
//            idm: jQuery('#id_maintenance').val() 
//        }, function(data) {
//            if ("1" == data) {
//               if(jQuery('.d' + day + month + year).html()==undefined) {
//                   var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+mess + mess_all_day + "<a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
//               } else {
//                   jQuery('.d' + day + month + year).html('');
//                   var newdata = "<span class='d" + day + month + year + "' id='d" + day + month + year + "'>" + day + "/" + month + "/" + year + "&nbsp;"+mess + mess_all_day + "<a href='javascript:void(0);' onclick='removeDate(" + day + "," + month + "," + year + ");'><img src='" + baseurl + "images/closeicon.png' alt='' /></a>;</span> ";
//               }
//            jQuery('#work_dates').append(newdata);
//            }
//        });
//        
//    }
//        if(jQuery(obj).attr('checked')=='checked') {
//            jQuery('#check_' + day + month + year).attr('rel', 'busy');
//        } else {
//            jQuery('#check_' + day + month + year).attr('rel', 'free');
//        }
//}

function removeDate(day, month, year) {
    jQuery.post(baseurl + 'admin/maintenance/checkdate', {
        d: day, 
        m: month, 
        y: year, 
        idm: jQuery('#id_maintenance').val(), 
        s1: 0
    }, function(data) {
        jQuery('.d'  + day + month + year).remove();
    });
}