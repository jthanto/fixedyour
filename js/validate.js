
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
        submitHandler: function() {
            //$("#signupform").submit();
            //$('#cntForm').submit();
            sendMail(event);
        }
    });
});