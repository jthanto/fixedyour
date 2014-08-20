
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
            JSON.stringify(data)
            
            
            $.ajax({
                type: 'POST',
                url: 'contactmail.php',
                data: data,
                success: function(data){
                    toastr.success(data+'Din mail er nå sendt!');
                    $('#cntName').val('');
                    $('#cntMail').val('');
                    $('#cntMsg').val('');
                    $('#contact').modal('hide');
                },
                error: function(err , exception){
                    if(err.status == 500){
                        toastr.error(err.status+' Tjenesten er for øyeblikket utilgjengelig.');
                    }
                    else if(err.status == 403){
                        toastr.error(err.status+' Ulovlig tilgang.');
                    }
                    setTimeout(function() {
                        $('#contact').modal('hide');
                    }, 5000);
                    
                    
                }
            });
        }
    });
});