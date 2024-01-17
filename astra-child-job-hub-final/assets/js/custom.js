jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 10) {
        jQuery(".job_head").addClass("stickyHead");
    } else {
        jQuery(".job_head").removeClass("stickyHead");
    }
});