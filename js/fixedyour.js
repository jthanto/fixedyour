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
    console.log($('#menu ul li a').parent()[0]);
    console.log($(this).parent()[0]);
    switch ($(this).parent()[0]) {
        case ($('#menu ul li a').parent()[0]):
            $('section').hide();
            $('#carousel').show();
            $('#information').show();
            break;
        case ($('#menu ul li a').parent()[1]):
            $('section').hide();
            $('#carousel').show();
            $('#cv').show();
            break;
        case ($('#menu ul li a').parent()[2]):
            $('section').hide();
            $('#carousel').show();
            $('#wishes').show();
            break;
        case ($('#menu ul li a').parent()[3]):
            location.href=$(this).attr('href');
            break;
        case ($('#menu ul li a').parent()[4]):
            location.href=$(this).attr('href');
            break;
        default:

    }
});