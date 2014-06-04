





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

function redirectToAdd() {
    window.location = '/admin/topmenu/add';
}

function redirectToAddMain() {
    window.location = '/admin/mainmenu/add';
}

function putToUri(uri) {
    jQuery('#uri').val(uri);
    parent.jQuery.fancybox.close();
}
function validateAndSubmit() {
    title = jQuery('#title').val();
    position = jQuery('#position').val();
    uri = jQuery('#uri').val();
    can_continue = true;
    if(title.length<2) {
        can_continue=false;
        jQuery('#title').css('border','1px dashed red');
    } else {
        jQuery('#title').css('border','1px solid lightgrey');
        
    }
    if(position.length<1) {
        can_continue=false;
        jQuery('#position').css('border','1px dashed red');
    } else {
        jQuery('#position').css('border','1px solid lightgrey');
        
    }
    if(uri.length<2) {
        can_continue=false;
        jQuery('#uri').css('border','1px dashed red');
    } else {
        jQuery('#uri').css('border','1px solid lightgrey');
        
    }

    if(can_continue===true) {
        jQuery('#topmenu-form-submit').submit();
    }
}

function validateAndSubmitEdit() {
    title = jQuery('#title').val();
    position = jQuery('#position').val();
    uri = jQuery('#uri').val();
    can_continue = true;
    if(title.length<2) {
        can_continue=false;
        jQuery('#title').css('border','1px dashed red');
    } else {
        jQuery('#title').css('border','1px solid lightgrey');
        
    }
    if(position.length<1) {
        can_continue=false;
        jQuery('#position').css('border','1px dashed red');
    } else {
        jQuery('#position').css('border','1px solid lightgrey');
        
    }
    if(uri.length<2) {
        can_continue=false;
        jQuery('#uri').css('border','1px dashed red');
    } else {
        jQuery('#uri').css('border','1px solid lightgrey');
        
    } 
    if(can_continue===true) {
        jQuery('#topmenu-form-submit').submit();
    }
}

function addToParent(id, name) {
    name = name.rel;
    jQuery('.parent').html(name);
    jQuery('#parent').val(id);
    parent.$.fancybox.close();
}

function deleteMenu(id) {
    if (confirm("Вы действительно хотите удалить этот пункт меню?")) {
        location.href = baseurl + 'admin/topmenu/delete/' + id;
    }   
}

function deleteMenuMain(id) {
    if (confirm("Вы действительно хотите удалить этот пункт меню?")) {
        location.href = baseurl + 'admin/mainmenu/delete/' + id;
    }   
}

