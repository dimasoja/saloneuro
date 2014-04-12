





function ValidateExpDate(Time_Field) {


}


function checkPymemt() {
    jQuery('#pymemt').css('display', 'none');
    var cardholdername=jQuery('#cardholdername').val();
	var cardholderadress=jQuery('#cardholderadress').val();
	var cardholdertown=jQuery('#cardholdertown').val();
	var cardholderpostcode=jQuery('#cardholderpostcode').val();
	var cardnumber=jQuery('#cardnumber').val();
	var card_date=jQuery('#card_date').val();
	var card_cvv=jQuery('#card_cvv').val();
	var cardholderemail=jQuery('#cardholderemail').val();
    var mobtel=jQuery('#mobtel').val();
    var landtel=jQuery('#landtel').val();
	var error_text="Please, fill in the following fields: "
	var can_continue=1;
	if(cardholdername.length<2 || cardholdername == "as it appears on the card"){
		can_continue=0;
		error_text+="'Name',";
	}
	if(cardholderadress.length<2 || cardholderadress == "where the card is registered"){
		can_continue=0;
		error_text+="'House Number & Street Address',";
	}
	if(cardholdertown.length<2 || cardholdertown == "where the card is registered"){
		can_continue=0;
		error_text+="'Town',";
	}
	if(cardholderpostcode.length<2){
		can_continue=0;
		error_text+="'Postcode',";
	}
	if(cardnumber.length<2 || cardnumber == "1234567898765432"){
		can_continue=0;
		error_text+="'Card Number',";
	}
	if(card_date.length<2 || card_date == "mm/yy"){
		can_continue=0;
		error_text+="'Expiry date',";
	} else {
      RegEx = "\([0-2][0-9])/([0-5][0-9])$";
      Err_Msg = "";
      if (Regs = card_date.match(RegEx)) {
         if ((Regs[1] > 23)) {
             can_continue=0;
             error_text+="'Expiry date',";
         }
     } else {
         can_continue=0;
		 error_text+="'Expiry date',";
     }
    }
	if(card_cvv.length<2 || card_cvv == "CVV"){
		can_continue=0;
		error_text+="'Security Code last 3 digits (CVV)',";
	}
	if(cardholderemail.length<2){
		can_continue=0;
		error_text+="'Contact Email Address', ";
	}
        
        var adr_pattern=/[0-9a-z_]+@[0-9a-z_]+\.[a-z]{2,5}/i;
        if(adr_pattern.test(cardholderemail) == false) {
                can_continue = 0;
                error_text += "invalid format of 'Contact Email Address',"
        }
    if(landtel != undefined) {    
        if((landtel.length<2)){
            can_continue=0;
            error_text+="'Landline Telephone Number',";
        }
    }
    if(mobtel != undefined) {
        if(mobtel.length<2){
            can_continue=0;
            error_text+="'Mobile Telephone Number',";
        }
    }
	if(can_continue==0){
        jQuery('#pymemt').css('display', 'inline');
		alert(error_text);
	}
	else{
		jQuery('#quotation_form').submit();
	}
}

