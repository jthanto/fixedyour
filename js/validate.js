
$(document).ready(function() {
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Fjern spesialtegn"
    );
    
    $('#cntForm').validate({
        rules: {
            cntName: {
                required: true,
                regex: "^[æøåÆØÅA-Za-z -]+$"
            },
            cntMail:{
                required: true,
                email: true
            },
            cntMsg:{
                required: true,
                minlength: 5,
                maxlength: 300
            }
        },
        messages:{
            cntName:{
                required: "Denne er obligatorisk",
            },
            cntMail:{
                required: "Denne er obligatorisk",
                email: "eksempel@domene.no"
            },
            cntMsg:{
                required: "Denne er obligatorisk",
                minlength: "Minst fem tegn",
                maxlength: "Maksimalt 300 tegn! "
            }
        },
        submitHandler: function(form) {
            
            var data = {
                name: $(form)[0][0].value,
                email: $(form)[0][1].value,
                message: $(form)[0][2].value
            };
            console.log(data); //REMOVE ME!!!
            
            $.ajax({
                type: 'POST',
                url: 'contactmail.php',
                //data: data,
                //cache: false,
                //contentType: false,
                //processData: false,
                success: function(data){
                    if(data === "true"){
                        toastr.success('Din mail er nå sendt!');
                        $('#cntName').val('');
                        $('#cntMail').val('');
                        $('#cntMsg').val('');
                        $('#contact').modal('hide');
                    } else {
                        toastr.error('Random error!');
                        setTimeout(function() {
                        $('#contact').modal('hide');
                    }, 2000);
                    }
                },
                error: function(){
                    toastr.error('En feil oppstod, prøv igjen senere');
                    setTimeout(function() {
                        $('#contact').modal('hide');
                    }, 2000);
                    
                    
                }
            });
        }
    });
});