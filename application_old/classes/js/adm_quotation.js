





var price_sq = 0; // price for 1 sq. meter
var total_price = 0;
var attached_photos = 0;
var total_square = 0;

jQuery(document).ready(function() {

    if (jQuery('#alternative_address').val() == "") {
        jQuery('#alternative_address').val('Alternative Address');
    }
    
    if (jQuery('#alternative_town').val() == "") {
        jQuery('#alternative_town').val('Alternative Town');
    }
    
    if (jQuery('#alternative_postcode').val() == "") {
        jQuery('#alternative_postcode').val('Alternative Postcode');
    }
    
    if (jQuery('#phone').val() == "") {
        jQuery('#phone').val('Telephone number');
    }

    jQuery('#rooms_count').keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    
    jQuery('#rooms_count').keyup(function(e) {
        jQuery('#total_price_for_job').val("");
        var html = "";
        if (this.value > fs_max_count_rooms) {
            this.value = fs_max_count_rooms;
        }
        html += "<ul style='list-style-type: none;'>";
        if (jQuery('#room_dimentions').is(':checked')) {
            for (i = 1; i <= this.value; i++) {
                var rmw2 = "";
                var rmwi2 = "";
                var rml2 = "";
                var rmli2 = "";
                var ts2 = "";
                var tpm2 = "";
                if (set2.room_w != undefined) {
                    rmw2 = set2.room_w[i - 1] || "";
                    rmwi2 = set2.room_w_i[i - 1] || "";
                    rml2 = set2.room_l[i - 1] || "";
                    rmli2 = set2.room_l_i[i - 1] || "";
                    ts2 = set2.total_square_m[i - 1] || "";
                    tpm2 = set2.tp[i - 1] || "";
                }
                
                html += "<li>";
                html += "<span>Room " + i + ":&nbsp;&nbsp; </span> ";
                html += "Width ";
                html += "<input type=\"text\" name=\"room_w[" + i + "]\" id=\"room_w_" + i + "\" value=\"" + rmw2 + "\"  class=\"date-field numb inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Feet&nbsp;";
                html += "<input type=\"text\" name=\"room_w_i[" + i + "]\" id=\"room_w_i_" + i + "\" value=\"" + rmwi2 + "\"  class=\"date-field inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Inches&nbsp;";
                html += "&nbsp;   x&nbsp;&nbsp;   Length ";
                html += "<input type=\"text\" name=\"room_l[" + i + "]\" id=\"room_l_" + i + "\" value=\"" + rml2 + "\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Feet&nbsp;";
                html += "<input type=\"text\" name=\"room_l_i[" + i + "]\" id=\"room_l_i_" + i + "\" value=\"" + rmli2 + "\"  class=\"date-field inches\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Inches = ";
                html += "<input type=\"text\" name=\"total_sq[" + i + "]\" id=\"total_sq_" + i + "\" value=\"" + ts2 + "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                html += "Total Sq Feet&nbsp;&nbsp;&nbsp; Price £ ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"" + tpm2 + "\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        } else {
            for (i = 1; i <= this.value; i++) {
                var rmw = "";
                var rml = "";
                var ts = "";
                var tpm = "";
                if (set.room_w != undefined) {
                    rmw = set.room_w[i - 1] || "";
                    rml = set.room_l[i - 1] || "";
                    ts = set.total_square_m[i - 1] || "";
                    tpm = set.tp[i - 1] || "";
                }
                
                html += "<li>";
                html += "<span>Room " + i + ":&nbsp;&nbsp; </span> ";
                html += "Width ";
                html += "<input type=\"text\" name=\"room_w[" + i + "]\" id=\"room_w_" + i + "\" value=\"" + rmw + "\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center; width: 50px;\" rel=\"" + i + "\" /> ";
                html += "Metres&nbsp;&nbsp;   x&nbsp;&nbsp;   Length ";
                html += "<input type=\"text\" name=\"room_l[" + i + "]\" id=\"room_l_" + i + "\" value=\"" + rml + "\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Metres = ";
                html += "<input type=\"text\" name=\"total_sq[" + i + "]\" id=\"total_sq_" + i + "\" value=\"" + ts + "\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                html += "Total Sq Metres&nbsp;&nbsp;&nbsp; Price £ ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"" + tpm + "\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        }
        html += "</ul>";
        jQuery('#ul_rooms').html(html);
    });
    
    jQuery('.numb').live('keypress', function(e) {
        if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    jQuery('.inches').live('keypress', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    jQuery('.measurements').live('click', function(event){
        jQuery('#rooms_count').val("");
        jQuery('#ul_rooms').html("");
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
        // Code to calculate
        jQuery('.numb').each(function(e){
            var total_meters = 0;
            var ident;
            var strTotal = "";
            if (jQuery('#room_dimentions').is(':checked')) {
                ident = jQuery(this).attr('rel');
                var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
                var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
                total_meters = room_w * room_l;
            } else {
                ident = jQuery(this).attr('rel');
                total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();
                
            }
            strTotal = total_meters.toString();
            jQuery('#total_sq_' + ident).val(Number(total_meters).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
            
        });
        
        total_square = 0;
        jQuery('.total_square_m').each(function(){
            
            total_square += parseFloat(jQuery(this).val());
        });
        var tsStr = total_square.toString();
        jQuery('#total_sq').val(Number(total_square).toPrecision( ((-1 != tsStr.indexOf('.')) ? tsStr.indexOf('.') : tsStr.length) + 2 ));
    });
});

function totalMeters(ident) {
    var total_meters = 0;
    var strTotal = "";
    if (jQuery('#room_dimentions').is(':checked')) {
        var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
        var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
        total_meters = room_w * room_l;
    } else {
        ident = jQuery(this).attr('rel');
        total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();

    }
    strTotal = total_meters.toString();
    jQuery('#total_sq_' + ident).val(Number(total_meters).toPrecision( ((-1 != strTotal.indexOf('.')) ? strTotal.indexOf('.') : strTotal.length) + 2 ));
    
}

function attachPhoto() {
    if (attached_photos < 12) {
        var html = "<p style='margin-top: 5px;'><input type='file' name='photo_" + attached_photos + "' /></p>";
        jQuery('#photos_block').append(html);    
        attached_photos++;
    }
}

function submitForm(id) {
    jQuery.post(baseurl + 'booking-shedule/booking/' + id, {
        total_m: total_square, 
        fu1: jQuery('#fu1').val(), 
        fu2: jQuery('#fu2').val()
        }, function(data) {
            jQuery('#modal_block2').html(data);
            jQuery('#modal_block_hidden2').show();
            jQuery('#modal_block2').show();
    });
}

function closeSubmitForm() {
    jQuery('#modal_block2').html("");
    jQuery('#modal_block_hidden2').hide();
    jQuery('#modal_block2').hide();
}

function chooseDate(day, month, year) {
    if (jQuery('#fo1').is(':checked')) {
        jQuery('#further_option_1').html('yes');
        jQuery('#fu1').val('yes');
    } else {
        jQuery('#further_option_1').html('no');
        jQuery('#fu1').val('no');
    }
    if (jQuery('#fo2').is(':checked')) {
        jQuery('#further_option_2').html('yes');
        jQuery('#fu2').val('yes');
    } else {
        jQuery('#further_option_2').html('no');
        jQuery('#fu2').val('no');
    }

    jQuery.post(baseurl + 'booking-shedule/savenew', {
        d: day, 
        m: month, 
        y: year, 
        tm: total_square, 
        id_q: jQuery('#id_quotation').val(), 
        fu1: jQuery('#fu1').val(), 
        fu2: jQuery('#fu2').val()
        }, function(data) {
            arr = data.split('~');
            jQuery('#id_quotation').val(arr[1]);
            jQuery('#book_date').html(data);
    });

    jQuery('#ddform').submit();
    closeSubmitForm();
}

function calcPrice() {
    jQuery('.not_valid_divs').each(function(){
        jQuery(this).remove();
    })
    
    if (jQuery('#plank_area').is(':checked')) {
        price_sq = fs_plank_area_price;
    } else {
        price_sq = fs_parquet_area_price;
    }

    if (jQuery('#staining_area').is(':checked')) {
        price_sq += fs_staining_area_price;
    }

    jQuery('.numb').each(function(e){
        var total_meters = 0;
        var ident;
        if (jQuery('#room_dimentions').is(':checked')) {
            ident = jQuery(this).attr('rel');
            var room_w = parseInt(jQuery('#room_w_' + ident).val()) + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0833);
            var room_l = parseInt(jQuery('#room_l_' + ident).val()) + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0833);
            total_meters = room_w * room_l;
        } else {
            ident = jQuery(this).attr('rel');
            total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();

        }
        var tmp_tp = total_meters * price_sq;
        if (jQuery('#room_dimentions').is(':checked')) {
            tmp_tp = tmp_tp / 10.76;
        }
        var tmp_tps = tmp_tp.toString();
        jQuery('#price_' + ident).val(Number(tmp_tp).toPrecision( ((-1 != tmp_tps.indexOf('.')) ? tmp_tps.indexOf('.') : tmp_tps.length) + 2 ));
    });
    total_price = 0;
    var rcnt = 0;
    jQuery('.total_price').each(function(){
        total_price += parseFloat(jQuery(this).val()); 
        rcnt++;
    });
    
    if (jQuery('#lift_removal').is(':checked')) {
        var lift_rem = rcnt * fs_lift_removal;
        total_price += lift_rem;
    }

    if (jQuery('#bitumen').is(':checked')) {
        var bit_rem = rcnt * fs_bitumen_removal;
        total_price += bit_rem;
    }
    
    if (total_price < fs_minimum_charge) {
        total_price = fs_minimum_charge;
    }
    
    var totalStr = jQuery("#tpfj").val();
    //console.log(jQuery("#tpfj").val());
    //var totalStr1 = jQuery("#tpfj").val();
    //console.log(totalStr1);
    //jQuery('#total_price_for_job').html(Number(total_price).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 ));
    //jQuery('#tpfj').val(Number(total_price).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 ));
    var discount=jQuery('#tpfjdiscount').val();
    var total_price_with_discount=Number(totalStr).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 );
    if(discount!="" && discount!=0){
        if(discount.indexOf("%")!=-1){
            discount=discount.substring(0,discount.length-1);
            total_price_with_discount=total_price_with_discount*(100-discount)/100;
        }
        else{
            total_price_with_discount-=discount;
        }
		
    }
    if(total_price_with_discount!=0.00) {
        jQuery('#tpfjtotal').val(total_price_with_discount.toFixed(2));
    } else {
        jQuery('#tpfjtotal').val(total_price.toFixed(2));
    }

    var dr = total_price * 5 / 100;
    var drStr = dr.toString();
    jQuery('#deposit_required').html('&pound;' + Number(dr).toPrecision( ((-1 != drStr.indexOf('.')) ? drStr.indexOf('.') : drStr.length) + 2 ));
    jQuery('#dr').val(Number(dr).toPrecision( ((-1 != drStr.indexOf('.')) ? drStr.indexOf('.') : drStr.length) + 2 ));
    
    var tp = total_price - (total_price * 10 / 100);
    var tpStr = tp.toString();
    jQuery('#total_price_for_job2').html(Number(tp).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
    jQuery('#tpfj2').val(Number(tp).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
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
    var user_quotation = jQuery('#id_quotation').val();
    
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
    
    if (!can_continue) {
        calcPrice();
        jQuery.post(baseurl + 'online-quotation/saveuser', 
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
            id_quotation: user_quotation
        },
        function(data) {
            jQuery('#id_quotation').val(data);
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