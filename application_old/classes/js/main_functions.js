






function initScrollLayer() {
    // arguments: id of layer containing scrolling layers (clipped layer), id of layer to scroll, 
    // if horizontal scrolling, id of element containing scrolling content (table?)
    var wndo = new dw_scrollObj('wn', 'lyr1', 't1');

    // pass id's of any wndo's that scroll inside tables
    // i.e., if you have 3 (with id's wn1, wn2, wn3): dw_scrollObj.GeckoTableBugFix('wn1', 'wn2', 'wn3');
    dw_scrollObj.GeckoTableBugFix('wn'); 
}

function newwin(url)
{
    //window.open('login.html?page='+url,"newwin20s2","toolbar=no,menubar=no,directories=no,left=0,width=400,height=600,resizable=yes,scrollbars=yes");
}

function chk1()
{
    var emailid = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    var name=document.getElementById('txt_name');
    var enquiry=document.getElementById('enquiry');
    if((name.value=='') ||(name.value=='Name'))
    {
        alert('Please enter your name');
        name.focus(); 
        return false;
    }
    if((!filter.test(emailid.value))||(emailid.value=='Email'))
    {
        alert('Please provide a valid email address');
        emailid.focus();
        return false;
    }
    if((enquiry.value=='')||(enquiry.value=='Enquiry'))
    {
        alert('Please enter your enquiry message');
        enquiry.focus(); 
        return false;
    }
    else
    {
        return true;
    }
}

jQuery(document).ready(function() {
    jQuery("#dropmenu ul").css({display: "none"}); // Opera Fix
    jQuery("#dropmenu li").hover(function() {
        jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);
    }, function() {
        jQuery(this).find('ul:first').css({visibility: "hidden"});
    });
});

function get_meta_tags(val) {
	if(val=='0') {
		jQuery('#meta_tag').css('display', 'none');
	} else {
		jQuery('#result').css('display', 'none');
		jQuery('#meta_tag').css('display', 'block');
		jQuery.ajax({
			url     : '/admin/meta/getkeydesc/?val='+val,
			type    : 'POST',
			dataType: 'html',
			timeout : 9000,
			error   : function() {
				alert('Error!');
			},
			success : function(html) {
				if(html != '') {
					result = html.split('~~');
					jQuery('#keywords').val(result['0']);
					jQuery('#description').val(result['1']);
				}
			}//success
		});//ajax
	}
}

function meta_submit() {
	jQuery('#meta_form').submit();
}