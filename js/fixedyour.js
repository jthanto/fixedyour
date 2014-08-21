$(document).ready(function() {
    //Initializing bigSlide menu;
    $('.menu-link').bigSlide();
    
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "positionClass": "toast-top-full-width",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
   
    /* Prevent default if menu links are "#". */
    $('#menu ul li a').each( function() {
        var nav = $(this); 
        if( nav.length > 0 ) {
            if( nav.attr('href') == '#' ) {
                //console.log(nav);
                $(this).click(
                    function(e) {
                        e.preventDefault();
                    }
                );
            }
        }
    });  
    
});

//page switch logic
$('#menu ul li a').click(function(event) {
    //alert('Inside logic');
    event.preventDefault(); // long press menu still apear
    switch ($(this).parent()[0]) {
        case ($('#menu ul li a').parent()[0]):
            $('section').not('#carousel').hide();
            $('#information').fadeIn(400);
            break;
        case ($('#menu ul li a').parent()[1]):
            $('section').not('#carousel').hide();
            $('#cv').fadeIn(400);
            break;
        case ($('#menu ul li a').parent()[2]):
            $('section').not('#carousel').hide();
            $('#wishes').fadeIn(400);
            break;
        case ($('#menu ul li a').parent()[3]):
            $('section').not('#carousel').hide();
            $('#projects').fadeIn(400);
            break;
        case ($('#menu ul li a').parent()[4]):
            location.href=$(this).attr('href');
            break;
        case ($('#menu ul li a').parent()[5]):
            location.href=$(this).attr('href');
            break;
        default:

    }
});