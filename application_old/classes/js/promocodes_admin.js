





function sendPromo() {
    var code=jQuery('#code').val();
    var sale=jQuery('#sale').val();
    var error_text="Please, fill in the following fields: "
    var can_continue=1;

    if(code.length<2 || code == "Promocode"){
        can_continue=0;
        error_text+="'Promocode',";
    }
    if(sale.length < 2 || sale== "Sale"){
        can_continue=0;
        error_text+="'Sale',";
    }
    if(can_continue==0){
        alert(error_text);
    } else{
        jQuery('#promo-form').submit();
    }
}

function deleteCodes() {
    var list = "";
    jQuery(".code_check:checked").each(function(index, el){
        id = jQuery(el).attr('id');
        list = list + id +",";
    });

    if (list != "") {
        if (confirm('This action is permanent. Are you sure?')) {
            jQuery.post(baseurl + 'admin/promocodes/deletegroup',
            {
                hash: list
            },
            function(data) {
                if (data == "ok") {
                    jQuery(".code_check:checked").each(function(index, el){
                        hash = jQuery(el).parent().parent().hide();
                    });
                } else {
                    alert('some error!');
                }
            }
            );
        }
    } else {
        alert('Nothing to delete! Check some items please.');
    }
}