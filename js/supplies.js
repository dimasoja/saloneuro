





var supplies_arr = {};
var automatically_send = "none";

function getCont(tabNo, page, button, norder, ser, manf) {
    if (undefined == page) {
        page = 1;
    }
    if (undefined == button) {
        button = "";
    }
    
    if (undefined == norder) {
        norder = "";
    }
    
    if (undefined == manf) {
        manf = 0;
    }
    
    ser = jQuery('#search_input').val();
    
    if (undefined == ser) {
        ser = "";
    }
    
    jQuery.post(baseurl + 'supplies/getsupplies', {tab: tabNo, p: page, arr: supplies_arr, auto_send: automatically_send, btn: button, name_order: norder, sch: ser, manufacturer: manf}, function(data) {
        jQuery('#supplies_container').html(data);
        jQuery('.fancy').fancybox({
            'type' : 'ajax'
        });
    });
}
function tabIt(obj, tabNo) {
    jQuery('.tabclass').each(function() {
        jQuery(this).removeClass('selected');
    });
    jQuery(obj).addClass('selected');
    
    getCont(tabNo);
    
}

function submitFrm() {
    jQuery('#supplies_arr').val(jQuery.toJSON(supplies_arr));
    jQuery('#auto_send').val(automatically_send);
    jQuery('#submit_frm').submit();
}

jQuery(document).ready(function(){
    getCont('abrasives');
    
    jQuery('.quantity_text').live('keypress', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    
    jQuery('.add_to_basket').live('change', function() {
        if (jQuery(this).is(':checked')) {
            if (jQuery('#quantity_' + jQuery(this).attr('rel')).val() == "0") {
                jQuery('#quantity_' + jQuery(this).attr('rel')).val('1');
            }
        } else {
            jQuery('#quantity_' + jQuery(this).attr('rel')).val('0');
        }
    });
    
    jQuery('body :input').live('change', function(e) {
        if (jQuery(this).is('.chkbox')) {
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
        jQuery('.add_to_basket').each(function() {
            var rel = jQuery(this).attr('rel');
            if (jQuery(this).is(':checked')) {
                supplies_arr[rel] = {
                   title: jQuery('#hidden_title_' + rel).val(),
                   price: jQuery('#hidden_price_' + rel).val(),
                   cnt: jQuery('#quantity_' + rel).val(),
                   code: jQuery('#hidden_code_' + rel).val()
               };

            } else {
                delete supplies_arr[rel];
            }
        });
        automatically_send = "none";
        jQuery('.chkbox').each(function() {
            if (jQuery(this).is(':checked')) {
                automatically_send = jQuery(this).val();
            }
        });
        
        var html = "";
        var ttl = 0;
        for (var i in supplies_arr) {
            html += "<li style='border-bottom: 1px solid #000;'><div style='width:290px;float:left;'>";
			var newstr=""; 
			if(supplies_arr[i].title.length>=39){
				var str = supplies_arr[i].title;
				//�������� �����:
				var from = 0; 
				var to = 39;
				newstr = str.substring(from,to);
				newstr+="...";
			}
			else{
				newstr=supplies_arr[i].title;
			}
			html += newstr;
            var price = parseFloat(supplies_arr[i].price) * parseInt(supplies_arr[i].cnt);
            ttl += price;
            var strPrice = price.toString();
            html +="</div><div style='float: right;'><span>&pound;" + Number(price).toPrecision( ((-1 != strPrice.indexOf('.')) ? strPrice.indexOf('.') : strPrice.length) + 2 ) + "</span></div>";
            html += "<div style='clear: both;'></div>";
            html += "</li>";
        }
        var strTtl = ttl.toString();
        jQuery('#total_prc').html(Number(ttl).toPrecision( ((-1 != strTtl.indexOf('.')) ? strTtl.indexOf('.') : strTtl.length) + 2 ));
        jQuery('#basket_ul').html(html);
    });
})