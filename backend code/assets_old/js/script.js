
// function clearErrors() {
//     $(".form-error-msg").html("");
//     $(".form-error-input").;
// }

function sentOtp(from) {
    const contact = $("#contact").val().trim();
    //   var Exp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    // var Exp = /^[A-Za-z]+$/;
    // var Exp1 = /@/
    // if(contact.match(Exp1)){
    //     //email validation
    //      var emailExp = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/; 
    //      if(!contact.match(emailExp)){
    //         document.getElementById('err').innerText = "Email Id is Invalid"; 
    //   returnval =false;
    //      }

    // }
    // else if(contact.match(Exp) && !contact.match(Exp1)){
    //         document.getElementById('err').innerText = " Invalid Email ID"; 
    //   returnval =false;
    //  }
    // else{

    //Phone No. validation
    var phoneExp = /^\d{10}$/;
    if (!phoneExp.test(contact)) {
        $("#contact").addClass('form-error-input');
        $('#phoneErr').html("Mobile number is invalid");
        return false;
    }

    $.ajax({
        type: 'POST',
        url: (from==1?"signuplogin/sentOtp1":"signuplogin/sentOtp"),
        data: {contact: contact},
        dataType: 'json',
        success: function(data, status, xhr) {
            if (status == "success") {
                if (data.status == "N200" || data.status == "N201") {
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                    $('#resendotp').html("Resend OTP");
                    $('#successMsg').fadeIn().html(data.message);
                    setTimeout(function() {
                        $('#successMsg').fadeOut();
                    }, 2000);
                } else if (data.status == "N401") {
                    $("#contact").addClass('form-error-input');
                    $('#phoneErr').html(data.message);
                } else {
                    $("#otp").addClass('form-error-input');
                    $('#otpErr').html(data.message);
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(jqXhr, textStatus, errorMessage) {
            console.log('Error' + errorMessage);
        }
    });
}



