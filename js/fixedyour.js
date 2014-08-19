/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    }
    
});


//page switch logic
$('#menu ul li a').click(function() {
                switch ((this).text) {
                    case ("Mer info"):
                        $('section').hide();
                        $('#carousel').show();
                        $('#information').show();
                        break;
                    case ("CV"):
                        $('section').hide();
                        $('#carousel').show();
                        $('#cv').show();
                        break;
                    case ("Ønsker"):
                        $('section').hide();
                        $('#carousel').show();
                        $('#wishes').show();
                        break;
                    default:

                }
});

/*$('#cntForm').submit(function(event){
    event.preventDefault();
    alert( "Handler for .submit() called." );
    var data = {
        name: $('#ctnName').val(),
        email: $('#ctnMail').val(),
        message: $('#ctnMsg').val()
    };
       
    $.ajax({
        type: 'POST',
        url: 'contactmail.php',
        data: $('#cntForm').serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function(returnStatement){
            toastr.success('Din mail er nå sendt!'+returnStatement);
            setTimeout(function() {
                $('#contact').modal('hide');
            }, 2000);
        },
        error: function(returnStatement){
            toastr.error('En feil oppstod!'+returnStatement);
        }
    }).done(function(data){
        console.log(data);
    });
    return false;
});*/

/*var mailSender = function(event){
    event.preventDefault();
    alert( "Handler for .submit() called." );
    var data = {
        name: $('#ctnName').val(),
        email: $('#ctnMail').val(),
        message: $('#ctnMsg').val()
    };
       
    $.ajax({
        type: 'POST',
        url: 'contactmail.php',
        data: $('#cntForm').serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function(returnStatement){
            toastr.success('Din mail er nå sendt!'+returnStatement);
            setTimeout(function() {
                $('#contact').modal('hide');
            }, 2000);
        },
        error: function(returnStatement){
            toastr.error('En feil oppstod!'+returnStatement);
        }
    }).done(function(data){
        console.log(data);
    });
    return false;
};*/

/*$('#sendMail').click(function(){
    //alert( "Handler for .submit() called." );
    //event.preventDefault();
    var data = {
        name: $('#ctnName').val(),
        email: $('#ctnMail').val(),
        message: $('#ctnMsg').val()
    };
    
    console.log(data);
});*/


var sendMail = function(event){
    alert( "Handler for .submit() called." );
    event.preventDefault();
    var data = {
        name: $('#ctnName').val(),
        email: $('#ctnMail').val(),
        message: $('#ctnMsg').val()
    };
    
    console.log(data);
    
    $.ajax({
        type: 'POST',
        url: 'contactmail.php',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            toastr.success('Din mail er nå sendt!');
        },
        error: function(err){
            toastr.error('En feil oppstod!' + err);
        }
    })
    return false;
}


/*$(document).ready(function() {
    $('#ajax').submit(function(event){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'comments',
            data: $('form#ajax').serialize(),
            dataType: 'json',
        })

        .done(function(data) {
            console.log(data); 
        });
        //just to be sure its not submiting form
        return false;
    });
});*/


/*var form = new FormData($('#form_step4')[0]);
form.append('view_type','addtemplate');
$.ajax({
    type: "POST",
    url: "savedata.php",
    data: form,
    cache: false,
    contentType: false,
    processData: false,
    success:  function(data){
        //alert("---"+data);
        alert("Settings has been updated successfully.");
        window.location.reload(true);
    }
});*/