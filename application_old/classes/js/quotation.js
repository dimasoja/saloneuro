





var price_sq = 0; // price for 1 sq. meter
var total_price = 0;
var total_square = 0;
var photos_count = 0;
var staining_count=1;
var carpet_count=1;
var resin_count=1;
var wood_count=1;
var bitumen_count=1;
var check_date_button_pressed=0;


jQuery(document).ready(function() {

    //    
    //    
    //    var links = document.getElementsByTagName('a');
    //    for(var i = 0, l = links.length; i < l; i++) {
    //        links[i].onclick = function(){
    //            return false;
    //        };
    //    }
	  
    //    jQuery('a').click(function(){
    //        if (confirm('Do you really want to leave Online Quotation page? All the info would be lost!')) {
    //            location = this.href;
    //        }
    //    })
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
        // РІС‹РєР»СЋС‡Р°РµРј РІСЃРµ РІС‹Р±СЂР°РЅРЅС‹Рµ РєРѕРјРЅР°С‚С‹ РёР· Extra Options
        staining_off();
        carpet_off();
        resin_off();
        wood_off();
        bitumen_off();
        /// РІС‹РєР»СЋС‡Р°РµРј РІСЃРµ РІС‹Р±СЂР°РЅРЅС‹Рµ РєРѕРјРЅР°С‚С‹ РёР· Extra Options
        
        jQuery('#total_price_for_job').val("");
        var html = "";
        if (this.value > fs_max_count_rooms) {
            this.value = fs_max_count_rooms;
        }
        html += "<ul>";
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
                html += "Total Sq Feet&nbsp;&nbsp;&nbsp; Price 	&#163 ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        } else {
            for (i = 1; i <= this.value; i++) {
                html += "<li>";
                html += "<span>Room " + i + ":&nbsp;&nbsp; </span> ";
                html += "Width ";
                html += "<input type=\"text\" name=\"room_w[" + i + "]\" id=\"room_w_" + i + "\" value=\"\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center; width: 50px;\" rel=\"" + i + "\" /> ";
                html += "Metres&nbsp;&nbsp;   x&nbsp;&nbsp;   Length ";
                html += "<input type=\"text\" name=\"room_l[" + i + "]\" id=\"room_l_" + i + "\" value=\"\"  class=\"date-field numb\" onkeyup=\"totalMeters(" + i + ")\" style=\"text-align: center\" rel=\"" + i + "\" /> ";
                html += "Metres = ";
                html += "<input type=\"text\" name=\"total_sq[" + i + "]\" id=\"total_sq_" + i + "\" value=\"\"  class=\"date-field total_square_m\" style=\"text-align: center\" />  ";
                html += "Total Sq Metres&nbsp;&nbsp;&nbsp; Price 	&#163 ";
                html += "<input type=\"text\" name=\"price[" + i + "]\" id=\"price_" + i + "\" value=\"\" class=\"date-field total_price\" />";
                html += "</li>";
            }
        }
        html += "</ul>";
        jQuery('#ul_rooms').html(html);
                jQuery("#options").hide();
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
    
    jQuery("body :input").live('change mouseover', function(event) {
        /*if (jQuery(this).is(':checkbox')) {
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
        }*/
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
        
        jQuery('.total_square_m').each(function(e){
            var smth = jQuery(this).val();
            if(smth.toString()=="NaN") {
                jQuery(this).val("0");
            }
        });
        
        // РµСЃР»Рё РЅРµ РІС‹Р±СЂР°РЅ С‡РµРєР±РѕРєСЃ Yes, СЃС…Р»РѕРїС‹РІР°РµРј РґРёРІС‹
        if (!jQuery('#staining_area').is(':checked')) 
            staining_off();
        if (!jQuery('#lift_removal').is(':checked')) 
            carpet_off();
        if (!jQuery('#gap_filling').is(':checked')) 
            resin_off();
        if (!jQuery('#gap_filling_w').is(':checked')) 
            wood_off();
        if (!jQuery('#bitumen').is(':checked')) 
            bitumen_off();
        
        // --- STAINING
        var total_st_price=0;
        jQuery('.stainig').each(function(e){
            var id_st_room = jQuery(this).val();
            
            var sq_st_room=jQuery("#total_sq_"+id_st_room).val();
            var price_st_room=sq_st_room*fs_staining_area_price;
            if(id_st_room!="")
                total_st_price+=price_st_room;
            
        });
        if(total_st_price.toString()!="NaN") {
            var sq_st_room=jQuery("#total_price_stainig").val(total_st_price.toFixed(2));
        }
        // --- STAINING
        
        // --- CARPET
        var fs_carpet_removal = parseFloat(jQuery('#fs_carpet_removal').val());	
        var total_ca_price = 0;
        jQuery('.carpet').each(function(e){
            var id_ca_room = jQuery(this).val();
            /*var sq_ca_room=jQuery("#total_sq_"+id_ca_room).val();
            var price_ca_room=sq_ca_room*fs_carpet_removal;
            if(id_ca_room!="")
                total_ca_price+=price_ca_room;
            */
            if(id_ca_room!="")
                total_ca_price = total_ca_price+fs_carpet_removal;
        });
        if(total_ca_price.toString()!="NaN") {
            //var sq_ca_room=jQuery("#total_price_carpet").val(total_ca_price);
            jQuery("#total_price_carpet").val(total_ca_price.toFixed(2).toString());
        }
        // --- CARPET
		
        // --- RESIN
        var fs_resin_price=jQuery('#fs_resin_price').val();
        var total_re_price=0;
        jQuery('.resin').each(function(e){
            var id_re_room = jQuery(this).val();
            var sq_re_room=jQuery("#total_sq_"+id_re_room).val();
            var price_re_room=sq_re_room*fs_resin_price;
            if(id_re_room!="")
                total_re_price+=price_re_room;
        });
        if(total_re_price.toString()!="NaN") {
            var sq_re_room=jQuery("#total_price_resin").val(total_re_price.toFixed(2));
        }
        // --- RESIN
        
        // --- WOOD
        var fs_wood_price=jQuery('#fs_wood_price').val();
        var total_wo_price=0;
        jQuery('.wood').each(function(e){
            var id_wo_room = jQuery(this).val();
            var sq_wo_room=jQuery("#total_sq_"+id_wo_room).val();
            var price_wo_room=sq_wo_room*fs_wood_price;
            if(id_wo_room!="")
                total_wo_price+=price_wo_room;
        });
        if(total_wo_price.toString()!="NaN") {
            var sq_wo_room=jQuery("#total_price_wood").val(total_wo_price.toFixed(2));
        }
        // --- WOOD
        
        // --- BITUMEN
        var fs_bitumen_price=jQuery('#fs_bitumen_price').val();
        var total_bi_price=0;
        jQuery('.bitumen').each(function(e){
            var id_bi_room = jQuery(this).val();
            //var sq_bi_room=jQuery("#total_sq_"+id_bi_room).val();
            //var price_bi_room=sq_bi_room*fs_bitumen_price;
            if(id_bi_room!="")
                total_bi_price+=parseInt(fs_bitumen_price);
        });
        if(total_bi_price.toString()!="NaN") {
            var sq_bi_room=jQuery("#total_price_bitumen").val(total_bi_price.toFixed(2));
        }
        // --- BITUMEN
        
        total_square = 0;
        jQuery('.total_square_m').each(function(){
            
            total_square += parseFloat(jQuery(this).val());
        });
        var tsStr = total_square.toString();
        jQuery('#total_sq').val(Number(total_square).toPrecision( ((-1 != tsStr.indexOf('.')) ? tsStr.indexOf('.') : tsStr.length) + 2 ));
    });
    
                
});

function totalMeters(ident) {
    jQuery("#options").hide();
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

function submitForm(is_checkout) {
    //calcPrice();
    var html = "";
    //html += "<input type='hidden' name='day' value='" + "1"+ "' />";
    //html += "<input type='hidden' name='month' value='" + "1" + "' />";
    //html += "<input type='hidden' name='year' value='" + "1" + "' />";
    html += "<input type='hidden' name='primary' value='true' />";
    if (jQuery('#fo1').is(':checked')) {
        jQuery('#further_option_1').val('yes');
    }
    if (jQuery('#fo2').is(':checked')) {
        jQuery('#further_option_2').val('yes');
    }
    jQuery('#is_date_not').html(html);
    closeSubmitForm();
    window.onbeforeunload = null;
    
    jQuery('#quotation_form').submit();
	
}

function closeSubmitForm() {
    jQuery('#modal_block').html("");
    jQuery('#modal_block_hidden').hide();
    jQuery('#modal_block').hide();
}
function showSubmitForm() {
    check_date_button_pressed=1;
    calcPrice();
	
    jQuery.post(baseurl + 'booking-shedule/booking', {
        total_m: total_square
    }, function(data) {
        jQuery('#modal_block').html(data);
        jQuery('#modal_block_hidden').show();
        jQuery('#modal_block').show();
    });
    
     
}
function chooseDate(day, month, year) {
    var html = "";
    html += "<input type='hidden' name='day' value='" + day + "' />";
    html += "<input type='hidden' name='month' value='" + month + "' />";
    html += "<input type='hidden' name='year' value='" + year + "' />";
    if (jQuery('#fo1').is(':checked')) {
        jQuery('#further_option_1').val('yes');
    }
    if (jQuery('#fo2').is(':checked')) {
        jQuery('#further_option_2').val('yes');
    }
    jQuery('#is_date_not').html(html);
    closeSubmitForm();
    window.onbeforeunload = null;
    
    jQuery('#quotation_form').submit();
	
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

    /*if (jQuery('#staining_area').is(':checked')) {
        price_sq += fs_staining_area_price;
    }*/

    jQuery('.numb').each(function(e){
        var total_meters = 0;
        var ident;
        if (jQuery('#room_dimentions').is(':checked')) {
            ident = jQuery(this).attr('rel');
            var room_w = parseInt(jQuery('#room_w_' + ident).val())*0.3048 + parseFloat(jQuery('#room_w_i_' + ident).val() * 0.0254);
            var room_l = parseInt(jQuery('#room_l_' + ident).val())*0.3048 + parseFloat(jQuery('#room_l_i_' + ident).val() * 0.0254);
			total_meters = room_w * room_l;
        } else {
            ident = jQuery(this).attr('rel');
            total_meters = jQuery('#room_w_' + ident).val() * jQuery('#room_l_' + ident).val();

        }
        total_meters = total_meters.toFixed(2);
        var tmp_tp = total_meters * price_sq;

//        if (jQuery('#room_dimentions').is(':checked')) {
//            tmp_tp = tmp_tp / 10.76;
//        }
        var tmp_tps = tmp_tp.toString();
        jQuery('#price_' + ident).val(Number(tmp_tp).toPrecision( ((-1 != tmp_tps.indexOf('.')) ? tmp_tps.indexOf('.') : tmp_tps.length) + 2 ));
    });
    total_price = 0;
    var rcnt = 0;
    jQuery('.total_price').each(function(){
        total_price += parseFloat(jQuery(this).val()); 
        rcnt++;
    });


    
    /*if (jQuery('#lift_removal').is(':checked')) {
        var lift_rem = rcnt * fs_lift_removal;
        total_price += lift_rem;
    }*/

    /*if (jQuery('#bitumen').is(':checked')) {
        var bit_rem = rcnt * fs_bitumen_removal;
        total_price += bit_rem;
    }*/
    
    if (total_price < fs_minimum_charge) {
        total_price = fs_minimum_charge;
        var total_price_count=1;
        var user_rooms_count = jQuery('#rooms_count').val();
        var once_price=fs_minimum_charge/user_rooms_count;
        jQuery('.total_price').each(function(e){
            jQuery('#price_'+total_price_count).val(once_price.toFixed(2));
            total_price_count++;
        });
		
    }
    
    if(jQuery('#staining_area').is(':checked'))
        total_price+=parseFloat(jQuery("#total_price_stainig").val());
        
    if(jQuery('#lift_removal').is(':checked'))
        total_price+=parseFloat(jQuery("#total_price_carpet").val());

    if(jQuery('#gap_filling').is(':checked'))
        total_price+=parseFloat(jQuery("#total_price_resin").val());

    if(jQuery('#gap_filling_w').is(':checked'))
        total_price+=parseFloat(jQuery("#total_price_wood").val());

    if(jQuery('#bitumen').is(':checked'))
        total_price+=parseFloat(jQuery("#total_price_bitumen").val());

    /*if(jQuery("#total_price_carpet").val()!="")
	total_price+=jQuery("#total_price_carpet").val();
	if(jQuery("#total_price_resin").val()!="")
	total_price+=jQuery("#total_price_resin").val();
	if(jQuery("#total_price_wood").val()!="")
	total_price+=jQuery("#total_price_wood").val();*/
    
    var totalStr = total_price.toString();

    jQuery('#total_price_for_job').html(Number(total_price).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 ));
    jQuery('#tpfj').val(Number(total_price).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 ));
    //deposit required  
    var dr = total_price * 5 / 100;
    var drStr = dr.toString();
    jQuery('#deposit_required').html('&pound;' + Number(dr).toPrecision( ((-1 != drStr.indexOf('.')) ? drStr.indexOf('.') : drStr.length) + 2 ));
    jQuery('#dr').val(Number(dr).toPrecision( ((-1 != drStr.indexOf('.')) ? drStr.indexOf('.') : drStr.length) + 2 ));
    
    
    
    var tp = total_price - (total_price * 10 / 100);
    var tpStr = tp.toString();
    jQuery('#total_price_for_job2').html(Number(tp).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
   // jQuery('#tpfj2').val(Number(tp).toPrecision( ((-1 != tpStr.indexOf('.')) ? tpStr.indexOf('.') : tpStr.length) + 2 ));
   jQuery('#tpfj2').val(Number(total_price).toPrecision( ((-1 != totalStr.indexOf('.')) ? totalStr.indexOf('.') : totalStr.length) + 2 ));
   

       //promocodes
    code = jQuery('#hidden-code').val();
     jQuery.ajax({
         type: "POST", 
        url     : '/online-quotation/checkpromo?code='+code+'&nocache='+Math.random(),
        timeout : 9000,
        cache:false,
        success : function(html) {
            if(html=='no') {jQuery('.promo1').css('margin-top','15px');jQuery('#hidden-code').val('');} else {
                jQuery('#promocode1').css('display', 'block');
                jQuery('#promocode2').css('display', 'block');
                jQuery('.promo1').css('margin-top','5px');
                result = html.split('~');
                sale = result[1];
                var with_sale = total_price - (total_price/100)*(parseFloat(sale));
                sale_summ = (total_price/100)*parseFloat(sale);
                dr_with_sale = (total_price/100)*5;
                dr_with_sale = (dr_with_sale)*(1-parseFloat(sale)/100);
                var ssStr = with_sale.toString();
                jQuery('#sale_summ').html('&pound;' + sale_summ.toFixed(2));
                jQuery('#percent-promocode').html(sale);
                jQuery('#percent-promocode-1').html(sale);
                jQuery('#total_price_for_job').html(with_sale.toFixed(2));
                jQuery('#deposit_required').html('&pound;' + dr_with_sale.toFixed(2));
                jQuery('#ss').val(with_sale.toFixed(2));
                var percent10 = (total_price/100)*10;
                var totalprice = total_price - percent10 - sale_summ;       
                jQuery('#total_price_for_job2').html(totalprice.toFixed(2));
                jQuery('#sale_summ-1').html('&pound;' + sale_summ.toFixed(2));
                
            }
        }
    });
   
}

function calculatePrice() {
    var can_continue = true;
    
    var user_name = jQuery('#name').val();
    var user_surname = jQuery('#surname').val();
    var user_email = jQuery('#email').val();
    var user_address = jQuery('#address').val();
    var user_alternative_address = jQuery('#alternative_address').val();
    var user_town = jQuery('#town').val();
    var user_rooms_count = jQuery('#rooms_count').val();
    var user_alternative_town = jQuery('#alternative_town').val();
    var user_postcode = jQuery('#postcode').val();
    var user_alternative_postcode = jQuery('#alternative_postcode').val();
    var user_phone = jQuery('#phone').val();
    var user_mphone = jQuery('#mphone').val();
    var user_quotation = jQuery('#id_quotation').val();
    var user_discribe = jQuery('#discribe_work').val();
    var user_area_type;
	var which_finish = jQuery('.which_finish').is(':checked');
    
    if (jQuery('#parquet_area').is(':checked')) {
        user_area_type = "parquet";
    } else {
        user_area_type = "plank";
    }
    
    var user_which_finish = "";
    jQuery('.which_finish').each(function(){
        if(jQuery(this).is(':checked'))
            user_which_finish += jQuery(this).val();
    })
    
    // ---------------
    var user_staining = "";
    if(jQuery('.staining').is(':checked')) {
        jQuery("input[onkeyup='staining_change(this)']").each(function(){
            if(jQuery(this).val() != "")
                user_staining += jQuery(this).val() + ",";
        })
    }
    
    var user_lift = "";
    if(jQuery('.lift_removal').is(':checked')) {
        jQuery("input[onkeyup='carpet_change(this)']").each(function(){
            if(jQuery(this).val() != "")
                user_lift += jQuery(this).val() + ",";
        })
    }
        
    var user_gap = "";
    if(jQuery('.gap_filling').is(':checked')) {
        jQuery("input[onkeyup='resin_change(this)']").each(function(){
            if(jQuery(this).val() != "")
                user_gap += jQuery(this).val() + ",";
        })
    }
        
    var user_gap_w = "";
    if(jQuery('.gap_filling_w').is(':checked')) {
        jQuery("input[onkeyup='wood_change(this)']").each(function(){
            if(jQuery(this).val() != "")
                user_gap_w += jQuery(this).val() + ",";
        })
    }
    
    var user_bitumen = "";
    if(jQuery('.bit').is(':checked')) {
        jQuery("input[onkeyup='bitumen_change(this)']").each(function(){
            if(jQuery(this).val() != "")
                user_bitumen += jQuery(this).val() + ",";
        })
    }
    
    var user_find_about_us = jQuery('#find_about_us').val();
    var user_dimentions = "metres";
    
    if (jQuery('#room_dimentions').is(':checked')) {
        user_dimentions = "feet";
    }
    
    if (user_name == "First Name") {
        user_name = "";
    }
    if (user_surname == "Last Name") {
        user_surname = "";
    }
    if (user_email == "Email") {
        user_email = "";
    }
    if (user_address == "Address") {
        user_address = "";
    }
    if (user_discribe == "Description") {
        user_discribe = "";
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
	if (user_rooms_count == "Description") {
        user_rooms_count = "";
    }

	if (user_find_about_us.length == 0) {
	    can_continue = false;
        jQuery('#find_about_us_block').html('<div class="not_valid_divs" style="float: left; margin-left:10px;border: 1px solid red; font-weight: normal; color: white; font-size: 11px;margin-top: 5px; padding: 5px; width: 215px;">Please fill this field in.</div>');
    } else {
        jQuery('#find_about_us_block').html('');        
    }
	
    if (user_rooms_count.length == 0) {
        can_continue = false;
        jQuery('#rooms_count_block').html('<div class="not_valid_divs" style="float: left; margin-left:10px;border: 1px solid red; margin-top: 5px; padding: 5px; width: 209px;">Please enter a valid number of rooms.</div><div id="clear">&nbsp;</div>');
        jQuery('#rooms_count').focus();
    } else {
        jQuery('#rooms_count_block').html('');        
    }
	
	if (which_finish == false) {
        can_continue = false;
        jQuery('#which_finish_block').html('<div class="not_valid_divs" style="float: left; border: 1px solid red; font-weight: normal; color: white; font-size: 11px; margin-top: 5px; padding: 5px; width: 544px;">Please enter a valid type of Varnish.</div>');
    } else {
        jQuery('#which_finish_block').html('');        
    }
	
    if (user_mphone.length < 5 || user_mphone.length > 20 || !isValidPhoneNumber(user_mphone)) {
        can_continue = false;
        jQuery('#mphone_block').html('<div class="not_valid_divs" style="margin-left:10px;border: 1px solid red; margin-top: 5px; padding: 5px; width: 209px;">Please enter a valid mobile number.</div>');
        jQuery('#mphone').focus();
    } else {
        jQuery('#mphone_block').html('');        
    }
    
    if (user_phone.length > 20 || !isValidPhoneNumber(user_phone)) {
        can_continue = false;
        jQuery('#phone_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top: 5px; padding: 5px; width: 209px;">Please enter a valid telephone number.</div>');
        jQuery('#phone').focus();
    } else {
        jQuery('#phone_block').html('');        
    }
    
    if (user_postcode.length < 3 || user_postcode.length > 20) {
        can_continue = false;
        jQuery('#postcode_block').html('<div class="not_valid_divs" style="margin-left:10px;border: 1px solid red; margin-top: 5px; padding: 5px; width: 209px;">Please enter a valid postcode.</div>');
        jQuery('#postcode').focus();
    } else {
        jQuery('#postcode_block').html('');        
    }
    
    if (user_town.length < 2 || user_town.length > 50) {
        can_continue = false;
        jQuery('#town_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top: 5px; padding: 5px; width: 209px;">Please enter a valid town.</div>');
        jQuery('#town').focus();
    } else {
        jQuery('#town_block').html('');        
    }
    
    if (user_address.length < 5 || user_address.length > 255) {
        can_continue = false;
        jQuery('#address_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top: 5px; padding: 5px; width: 438px;">Please enter a valid address.</div>');
        jQuery('#address').focus();
    } else {
        jQuery('#address_block').html('');        
    }
    
    if (user_email.length < 5 || user_email.length > 150 || !isValidEmail(user_email)) {
        can_continue = false;
        jQuery('#email_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top: 5px; padding: 5px; width: 438px;">This is not a valid e-mail format. Please check and re-enter your e-mail address</div>');
        jQuery('#email').focus();
    } else {
        jQuery('#email_block').html('');        
    }
    
    if (user_surname.length < 2 || user_surname.length > 50) {
        can_continue = false;
        jQuery('#surname_block').html('<div class="not_valid_divs" style="margin-left: 10px;border: 1px solid red; margin-top:5px; padding: 5px; width: 209px;">Please enter a valid last name.</div>');
        jQuery('#surname').focus();
    } else {
        jQuery('#surname_block').html('');        
    }
	
	if (user_discribe.length < 2) {
        can_continue = false;
        jQuery('#discribe_work_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top:5px; padding: 5px; width: 912px;">Please enter a valid description.</div><br/>');
        jQuery('#discribe_work').focus();
    } else {
        jQuery('#discribe_work_block').html('');        
    }
    
    if (user_name.length < 2 || user_name.length > 150) {
        can_continue = false;
        jQuery('#name_block').html('<div class="not_valid_divs" style="border: 1px solid red; margin-top:5px; padding: 5px; width: 209px;">Please enter a valid first name.</div>');
        jQuery('#name').focus();
    } else {
        jQuery('#name_block').html('');        
    }

    if (can_continue) {
        calcPrice();
        jQuery("#options").show();
        
        var rooms_w_i = [];
        var rooms_l_i = [];
        var rooms_total_sq = [];
        var rooms_price = [];
        var rooms_w = [];
        var rooms_l = [];
        
        jQuery("input[name^='room_l']").each(function(index, element){
            if (!jQuery(element).hasClass('inches')) {
                var rel = jQuery(element).attr('rel');
		
                if(jQuery("input[name='room_w\["+rel+"\]']").val() != undefined)
                    rooms_w[rel] = jQuery("input[name='room_w\["+rel+"\]']").val(); // 1
                if(jQuery("input[name='room_l\["+rel+"\]']").val() != undefined)
                    rooms_l[rel] = jQuery("input[name='room_l\["+rel+"\]']").val(); // 2
                if(jQuery("input[name='total_sq\["+rel+"\]']").val() != undefined)
                    rooms_total_sq[rel] = jQuery("input[name='total_sq\["+rel+"\]']").val(); // 3
                if(jQuery("input[name='price\["+rel+"\]']").val() != undefined)
                    rooms_price[rel] = jQuery("input[name='price\["+rel+"\]']").val(); // 4
				
                if (jQuery('input[name=room_dimentions]:checked').val() == "feet") {
                    if(jQuery("input[name='room_w_i\["+rel+"\]']").val() != undefined)
                        rooms_w_i[rel] = jQuery("input[name='room_w_i\["+rel+"\]']").val(); // 5
                    if(jQuery("input[name='room_l_i\["+rel+"\]']").val() != undefined)
                        rooms_l_i[rel] = jQuery("input[name='room_l_i\["+rel+"\]']").val();  // 6
                }
            }
        });
        link=jQuery('#link_rel').val();
        var tpfj = jQuery("#tpfj").val();

        jQuery.post(baseurl + 'online-quotation/saveuser', 
        {
            name: user_name, 
            surname: user_surname,
            email: user_email, 
            address: user_address,
            alternative_address: user_alternative_address,
            town: user_town, 
            alternative_town: user_alternative_town,
            postcode: user_postcode,
            alternative_postcode: user_alternative_postcode,
            phone: user_phone, 
            mphone: user_mphone, 
            id_quotation: user_quotation,
            discribe_work: user_discribe,
            area_type: user_area_type,
            staining_area: user_staining,
            lift_removal: user_lift,
            gap_filling: user_gap,
            gap_filling_w: user_gap_w,
            bitumen: user_bitumen,
            find_about_us: user_find_about_us,
            room_dimentions: user_dimentions,
            rooms_count: user_rooms_count,
            is_complete : 0,
            room_w: rooms_w,
            room_l: rooms_l,
            room_w_i: rooms_w_i,
            room_l_i: rooms_l_i,
            total_sq: rooms_total_sq,
            tpfj: tpfj,
            which_finish: user_which_finish,
            price: rooms_price,
            link: link
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
    return !(/[^0-9\+\(\)\-x\s]/).test(phoneNumber);
//return !(/[^0-9\+\(\)]/i).test(phoneNumber);
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

function serialize( mixed_val ) {    // Generates a storable representation of a value
    // 
    // +   original by: Ates Goral (http://magnetiq.com)
    // +   adapted for IE: Ilia Kantor (http://javascript.ru)
 
    switch (typeof(mixed_val)){
        case "number":
            if (isNaN(mixed_val) || !isFinite(mixed_val)){
                return false;
            } else{
                return (Math.floor(mixed_val) == mixed_val ? "i" : "d") + ":" + mixed_val + ";";
            }
        case "string":
            return "s:" + mixed_val.length + ":\"" + mixed_val + "\";";
        case "boolean":
            return "b:" + (mixed_val ? "1" : "0") + ";";
        case "object":
            if (mixed_val == null) {
                return "N;";
            } else if (mixed_val instanceof Array) {
                var idxobj = {
                    idx: -1
                };
                var map = []
                for(var i=0; i<mixed_val.length;i++) {
                    idxobj.idx++;
                    var ser = serialize(mixed_val[i]);
 
                    if (ser) {
                        map.push(serialize(idxobj.idx) + ser)
                    }
                }                                       

                return "a:" + mixed_val.length + ":{" + map.join("") + "}"

            }
            else {
                var class_name = get_class(mixed_val);
 
                if (class_name == undefined){
                    return false;
                }
 
                var props = new Array();
                for (var prop in mixed_val) {
                    var ser = serialize(mixed_val[prop]);
 
                    if (ser) {
                        props.push(serialize(prop) + ser);
                    }
                }
                return "O:" + class_name.length + ":\"" + class_name + "\":" + props.length + ":{" + props.join("") + "}";
            }
        case "undefined":
            return "N;";
    }
 
    return false;
}
function get_class(obj) {	

    if (obj instanceof Object && !(obj instanceof Array) &&
        !(obj instanceof Function) && obj.constructor) {
        var arr = obj.constructor.toString().match(/function\s*(\w+)/);

        if (arr && arr.length == 2) {
            return arr[1];
        }
    }

    return false;
}

function stainig_on(){
    var html='<div style="float:left;"><span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span></div>';
    html+='<div id="st_fields" style="float:left;"><input type="text" style="width:23px;" onkeyup="staining_change(this)" class="stainig" name="stainig1">';	
    html+='<input type="button" onclick="addStainigField()" value="+"></div>';	
    html+='<div style="float:left;"><span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span><input type="text" style="width:50px;" value="" id="total_price_stainig"></div>';
    html+="<div style='width:100%;clear:both;'></div>"			
    jQuery('#staining_div').html(html);
//jQuery("#rooms_count").attr('disabled', 'true');
}

function addStainigField(){
	
    staining_count++;
    if(staining_count>jQuery("#rooms_count").val()){
        alert("Please check the amount of rooms");
    }else{
        var html="";
        html+='<input type="text" style="width:23px;" class="stainig" onkeyup="staining_change(this)" name="stainig'+staining_count+'">';
        if(staining_count<jQuery("#rooms_count").val()){
            html+='<input type="button" onclick="addStainigField()" value="+">';
        }
        var st_c=1;
        var html_old="";
        jQuery('.stainig').each (function() {
            html_old+=	'<input type="text" style="width:23px;" class="stainig" onkeyup="staining_change(this)" name="stainig'+st_c+'" value="'+jQuery(this).val()+'">';
            html_old+='<input type="button" onclick="addStainigField()" value="+">';
            st_c++;
        });
		
        jQuery('#st_fields').html(html_old+html);
    }
}

function staining_off(){
    jQuery('#staining_area').removeAttr('checked');
    jQuery('#staining_div').html("");
    staining_count=1;
}

function staining_change(obj){
    var c = 0;
    jQuery('#st_fields input').each(function(e){
        if(jQuery(this).val() == obj.value) {
            c++;
            if(c > 1 || obj.value > jQuery('#rooms_count').val())
                obj.value = "";
        }
            
    });
    jQuery("#options").hide();}


function showOptionalExtas(){
    jQuery('#extas_text').show();
    jQuery('#extas_op').show();
}

function carpet_on(){
    var html='<div style="float:left;"><span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span></div>';
    html+=	'<div id="ca_fields" style="float:left;"><input type="text" style="width:23px;" onkeyup="carpet_change(this)" class="carpet" name="carpet1">';	
    html+='<input type="button" onclick="addCarpetField()" value="+"></div>';	
    html+='<div style="float:left;"><span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span><input type="text" style="width:50px;" value="" id="total_price_carpet"></div>';
    html+="<div style='width:100%;clear:both;'></div>"			
    jQuery('#carpet_div').html(html);
//jQuery("#rooms_count").attr('disabled', 'true');
}

function carpet_off(){
    jQuery('#lift_removal').removeAttr('checked');
    jQuery('#carpet_div').html("");
    carpet_count=1;
}

function addCarpetField(){
    carpet_count++;
    if(carpet_count>jQuery("#rooms_count").val()){
        alert("Please check the amount of rooms");
    }else{
        var html="";
        html+='<input type="text" style="width:23px;" onkeyup="carpet_change(this)" class="carpet" name="carpet'+carpet_count+'">';
        if(carpet_count<jQuery("#rooms_count").val()){
            html+='<input type="button" onclick="addCarpetField()" value="+">';
        }
        var st_c=1;
        var html_old="";
        jQuery('.carpet').each (function() {
            html_old+=	'<input type="text" style="width:23px;" class="carpet" onkeyup="carpet_change(this)" name="carpet'+st_c+'" value="'+jQuery(this).val()+'">';
            html_old+='<input type="button" onclick="addCarpetField()" value="+">';
            st_c++;
        });
        jQuery('#ca_fields').html(html_old+html);
    }
}

function carpet_change(obj){
    var c = 0;
    jQuery('#ca_fields input').each(function(e){
        if(jQuery(this).val() == obj.value) {
            c++;
            if(c > 1 || obj.value > jQuery('#rooms_count').val())
                obj.value = "";
        }
            
    });
    jQuery("#options").hide();
}


function resin_on(){
    var html='<div style="float:left;"><span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span></div>';
    html+=	'<div id="re_fields" style="float:left;"><input type="text" style="width:23px;" onkeyup="resin_change(this)" class="resin" name="resin1">';	
    html+='<input type="button" onclick="addResinField()" value="+"></div>';	
    html+='<div style="float:left;"><span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span><input type="text" style="width:50px;" value="" id="total_price_resin"></div>';
    html+="<div style='width:100%;clear:both;'></div>"			
    jQuery('#resin_gap').html(html);
//jQuery("#rooms_count").attr('disabled', 'true');
}

function resin_off(){
    jQuery('#gap_filling').removeAttr('checked');
    jQuery('#resin_gap').html("");
    resin_count=1;
}

function addResinField(){
    resin_count++;
    if(resin_count>jQuery("#rooms_count").val()){
        alert("Please check the amount of rooms");
    }else{
        var html="";
        html+='<input type="text" style="width:23px;" onkeyup="resin_change(this)" class="resin" name="resin'+resin_count+'">';
        if(resin_count<jQuery("#rooms_count").val()){
            html+='<input type="button" onclick="addResinField()" value="+">';
        }
        var st_c=1;
        var html_old="";
        jQuery('.resin').each (function() {
            html_old+=	'<input type="text" style="width:23px;" class="resin" onkeyup="resin_change(this)" name="resin'+st_c+'" value="'+jQuery(this).val()+'">';
            html_old+='<input type="button" onclick="addResinField()" value="+">';
            st_c++;
        });
        jQuery('#re_fields').html(html_old+html);
    }
}

function resin_change(obj){
    var c = 0;
    jQuery('#re_fields input').each(function(e){
        if(jQuery(this).val() == obj.value) {
            c++;
            if(c > 1 || obj.value > jQuery('#rooms_count').val())
                obj.value = "";
        }
            
    });
    jQuery("#options").hide();
}

function wood_on(){
    var html='<div style="float:left;"><span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span></div>';
    html+=	'<div id="wo_fields" style="float:left;"><input type="text" style="width:23px;" onkeyup="wood_change(this)" class="wood" name="wood1">';	
    html+='<input type="button" onclick="addWoodField()" value="+"></div>';	
    html+='<div style="float:left;"><span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span><input type="text" style="width:50px;" value="" id="total_price_wood"></div>';
    html+="<div style='width:100%;clear:both;'></div>"			
    jQuery('#wood_gap').html(html);
//jQuery("#rooms_count").attr('disabled', 'true');
}

function wood_off(){
    jQuery('#gap_filling_w').removeAttr('checked');
    jQuery('#wood_gap').html("");
    wood_count=1;
}

function addWoodField(){
    wood_count++;
    if(wood_count>jQuery("#rooms_count").val()){
        alert("Please check the amount of rooms");
    }else{
        var html="";
        html+='<input type="text" style="width:23px;" class="wood" onkeyup="wood_change(this)" name="wood'+wood_count+'">';
        if(wood_count<jQuery("#rooms_count").val()){
            html+='<input type="button" onclick="addWoodField()" value="+">';
        }
        var st_c = 1;
        var html_old="";
        jQuery('.wood').each (function() {
            html_old+=	'<input type="text" style="width:23px;" class="wood" onkeyup="wood_change(this)" name="wood'+st_c+'" value="'+jQuery(this).val()+'">';
            html_old+='<input type="button" onclick="addWoodField()" value="+">';
            st_c++;
        });
        jQuery('#wo_fields').html(html_old+html);
    }
}

function wood_change(obj){
    var c = 0;
    jQuery('#wo_fields input').each(function(e){
        if(jQuery(this).val() == obj.value) {
            c++;
            if(c > 1 || obj.value > jQuery('#rooms_count').val())
                obj.value = "";
        }
            
    });
    jQuery("#options").hide();
}

function bitumen_on(){
    var html='<div style="float:left;"><span style="display:inline-block; width: 180px;color:#FF6819;font-size:1.5em;margin-left:2px;">If yes, which room(s)?</span></div>';
    html+=	'<div id="bi_fields" style="float:left;"><input type="text" style="width:23px;" onkeyup="bitumen_change(this)" class="bitumen" name="bitumen1">';	
    html+='<input type="button" onclick="addBitumenField()" value="+"></div>';	
    html+='<div style="float:left;"><span style="color:#FF6819;font-size:1.5em;">&nbsp;= Price £&nbsp;</span><input type="text" style="width:50px;" value="" id="total_price_bitumen"></div>';
    html+="<div style='width:100%;clear:both;'></div>"			
    jQuery('#bitumen_div').html(html);
//jQuery("#rooms_count").attr('disabled', 'true');
}

function bitumen_off(){
    jQuery('#bitumen').removeAttr('checked');
    jQuery('#bitumen_div').html("");
    bitumen_count=1;
}

function addBitumenField(){
    bitumen_count++;
    if(bitumen_count>jQuery("#rooms_count").val()){
        alert("Please check the amount of rooms");
    }else{
        var html="";
        html+='<input type="text" style="width:23px;" class="bitumen" onkeyup="bitumen_change(this)" name="bitumen'+bitumen_count+'">';
        if(bitumen_count<jQuery("#bitumen_count").val()){
            html+='<input type="button" onclick="addBitumenField()" value="+">';
        }
        var st_c = 1;
        var html_old="";
        jQuery('.bitumen').each (function() {
            html_old+=	'<input type="text" style="width:23px;" class="bitumen" onkeyup="bitumen_change(this)" name="bitumen'+st_c+'" value="'+jQuery(this).val()+'">';
            html_old+='<input type="button" onclick="addBitumenField()" value="+">';
            st_c++;
        });
        jQuery('#bi_fields').html(html_old+html);
    }
}

function bitumen_change(obj){
    var c = 0;
    jQuery('#bi_fields input').each(function(e){
        if(jQuery(this).val() == obj.value) {
            c++;
            if(c > 1 || obj.value > jQuery('#rooms_count').val())
                obj.value = "";
        }
            
    });
    jQuery("#options").hide();
}
function getPromo() {
    jQuery("#options").hide();
     code = jQuery('#promocode').val();
     jQuery.ajax({
        url     : '/online-quotation/checkpromo?code='+code,
        timeout : 9000,
error: function(xhr,err){
    alert("Error");
},
     success : function(html) {
         if(html=='no') {
             jQuery('#result-promo').html('<img src="/images/check_yes.png" width=40 height=40 style="padding: 3px 0 0 3px"/>');
             jQuery('#hidden-code').val('');
              jQuery('#promocode1').css('display','none');
               jQuery('#promocode2').css('display','none');
         } else {
             jQuery('#result-promo').html("<img src='/images/check_no.png' width=40 height=40 style='padding: 2px 0 0 3px'/>");
             result = html.split('~');
             jQuery('#hidden-code').val(result[2]);
         }
     }
   });
}