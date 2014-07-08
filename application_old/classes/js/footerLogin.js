






jQuery(document).ready(function() {
    jQuery("#footerProtected1").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected1").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected2").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected2").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected3").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected3").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected4").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected4").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected5").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected5").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected6").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected6").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });
    
    jQuery("#footerProtected7").click(function(){
        var vall = jQuery(this).attr("rel"); 
        jQuery("#rel").val(vall);
    });
    jQuery("#footerProtected7").fancybox({
        'scrolling'		: 'no',
        'titleShow'		: false,
        'modal'             : false,
        'closeClick'        : false,
        'closeBtn'          : true,
        'onClosed'		: function() {
            $("#footer_login_error").hide();
        }
    });


    jQuery("#footer_login_form").bind("submit", function() {
        var cont = true;
        if (jQuery("#login_pass").val().length < 1) {
            jQuery("#footer_login_error").show();
            cont = false;
        }

        if(cont) {
            var rel = jQuery("#rel").val();
            jQuery.post('/index/footerLogin', 
            {
                login_pass : jQuery("#login_pass").val(),
                rel: rel
            },
            function(data) {
                jQuery("#footer_login_error").hide();
                if(data != "true" && data != "false") {
                    jQuery("#footer_login_error").html(data);
                    jQuery("#footer_login_error").show();
                } else {
                    if(data == "true")
                        window.location.href = "/" + rel;
                    if(data == "false")
                        window.location.href = "/";
                }
            }
            )
        }

        return false;
    });
});

function relVal(obj) {
    jQuery("#rel").val(obj.valueOf());
}