/*jshint esversion: 6 */

//remove errors
$('input,textarea').keyup(function(event) {
    /* Act on the event */
    $(this).removeClass('form-error-input');
    $(this).siblings(".form-error-msg").html("");
});

let showLoginModal = ()=>{
        hideAllModal();
        $("#loginModal").css({display: 'flex'});
      };
       let showSignupModal = ()=>{
        hideAllModal();
        $("#signupModal").css({display: 'flex'});
      };
      let showSignupPostModal = ()=>{
        hideAllModal();
        $("#signupPostModal").css({display: 'flex'});
      };

      let showPass=(curr)=>{
        if($(curr).attr('data-toggle-status')=="0"){
          $(curr).attr('data-toggle-status',"1");
          $(curr).addClass('open-eye');
          $(curr).removeClass('close-eye');
          $(curr).prev().get(0).type = 'text';

        }else{
          $(curr).attr('data-toggle-status',"0");
          $(curr).removeClass('open-eye');
          $(curr).addClass('close-eye');
          $(curr).prev().get(0).type = 'password';
        }
      };

      $(".login-modal").click(function (e) {
        hideAllModal();
      });
      $(".login-modal .inner-box").click(function (e) {
        e.stopPropagation();
      });

      let hideAllModal = ()=>{
        $(".login-modal").css({display: 'none'});
      };

  $("#mobile,#otp").keyup(function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        proceed();
    }
});

function sentOtp() {
    const contact = $("#mobile").val().trim();
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
        url: 'api/sentOtp',
        data: {contact: contact},
        dataType: 'json',
        success: function(data, status, xhr) {
            if (status == "success") {
                if (data.status == "B200" || data.status == "B201") {
                    console.log('status: ' + status + ', data: ' + ":" + data + ":");
                     setTimeout(function() {
                        $('.send-otp').html("Resend OTP");
                    }, 10000);
                    $('#mobileSucc').fadeIn().html(data.message);
                    setTimeout(function() {
                        $('#mobileSucc').fadeOut();
                    }, 2000);
                } 
            } else {
                console.log("ajax failed");
            }
        },
        error: function(xhr, textStatus, errorMessage) {
             console.log('Error:' + errorMessage+":::"+xhr.responseJSON.message);
              $("#otp").addClass('form-error-input');
              $('#otpErr').html(xhr.responseJSON.message);
               if (xhr.responseJSON.status == "B401") {
                    $("#mobile").addClass('form-error-input');
                    $('#mobileErr').html(xhr.responseJSON.message);
                } else {
                    $("#otp").addClass('form-error-input');
                    $('#otpErr').html(xhr.responseJSON.message);
                }
        }
    });
}





function proceed() {
    const contact = $("#mobile").val().trim();
    const otp = $("#otp").val().trim();

    // var Exp = /^[A-Za-z]+$/;
    // var Exp1 = /@/
    // if(contact.match(Exp1)){
    //     //email validation
    //      var emailExp = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
    //      if(!contact.match(emailExp)){
    //         document.getElementById('err').innerText = "Invalid Email ID";
    //      returnval =false;
    //      }
    // }
    //Phone No. validation
    var phoneExp = /^\d{10}$/;
    if (!phoneExp.test(contact)) {
        $("#mobile").addClass('form-error-input');
        $('#mobileErr').html("Mobile number is invalid");
        return false;
    }

    //OTP validation
    if (otp == "") {
        $("#otp").addClass('form-error-input');
        $('#otpErr').html("*O.T.P is required");
        return false;
    }

    var otpExp = /^\d{6}$/;
    if (!otpExp.test(otp)) {
        $("#otp").addClass('form-error-input');
        $('#otpErr').html("O.T.P is invalid");
        return false;
    }

    $.ajax({
        type: 'POST',
        url: "api/signupCheck",
        data: {contact: contact, otp: otp, signup: "register"},
        dataType: 'json',
        success: function(data, status, xhr) {
            console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                if (data.status) {
                  showSignupPostModal();
                }
            } else {
                console.log("ajax failed");
            }
        },
        error: function(xhr, textStatus, errorMessage) {
            console.log('Error:' + errorMessage+":::"+xhr.responseJSON.message);
              $("#otp").addClass('form-error-input');
              $('#otpErr').html(xhr.responseJSON.message);
            
        }
    });
}

$("#name,#passwordTemp,#password").keyup(function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        validate();
    }
});

function validate() {
    var name = $("#name").val().trim();
    var passTemp = $("#passwordTemp").val().trim();
    var password = $("#password").val().trim();
    const contact = $("#mobile").val().trim();
    //var id = document.getElementById("id").value;

    if (name == "") {
        $("#name").addClass('form-error-input');
        $('#nameErr').html("*Name is required");
        return false;
    }

    var alphaNumExp = /^([a-zA-Z0-9_]){3,24}$/;
    if (!alphaNumExp.test(name)) {
        $("#Name").addClass('form-error-input');
        $('#nameErr').html("Name is invalid");
        return false;
    }

    if (passTemp == "") {
        $("#passwordTemp").addClass('form-error-input');
        $('#passwordTempErr').html("*Password is required");
        return false;
    }

    if (passTemp.length < 5) {
        $("#passwordTemp").addClass('form-error-input');
        $('#passwordTempErr').html("Password should be at least 5 characters");
        return false;
    }

    if (password == "") {
        $("#password").addClass('form-error-input');
        $('#passwordErr').html("Password mismatch");
        return false;
    }

    if (passTemp != password) {
        $("#password").addClass('form-error-input');
        $('#passwordErr').html("Password mismatch");
        return false;
    }

    var phoneExp = /^\d{10}$/;
    if (!phoneExp.test(contact)) {
        $("#mobile").addClass('form-error-input');
        $('#mobileErr').html("Mobile number is invalid");
        return false;
    }

    $.ajax({
        type: 'POST',
        url: "api/signup",
        data: {name: name, password: password, profile: "profile", contact: contact},
        dataType: 'json',
        success: function(data, status, xhr) {
            if (status == "success") {   
                 console.log('status: ' + status + ', data: ' + ":" + data + ":");
                     setUserHeaderData(data.data);
            } else {
                console.log("ajax failed");
            }
        },
        error: function(xhr, textStatus, errorMessage) {
             console.log('Error:' + errorMessage+":::"+xhr.responseJSON.message);
              $("#name").addClass('form-error-input');
              $('#nameErr').html(xhr.responseJSON.message);
        }
    });
}

function login(){
    const contact = $("#mobile1").val().trim();
    const password = $("#password1").val().trim();

        //Phone No./username validation
        var phoneExp = /^\d{10}$/;
        var alphaNumExp = /^([a-zA-Z0-9_]){3,24}$/;
        if (phoneExp.test(contact) || alphaNumExp.test(contact)) {

        }else{
          $("#mobile1").addClass('form-error-input');
          $('#mobile1Err').html("Mobile No. is invalid");
          return false;
        }

      if (password == "") {
        $("#password1").addClass('form-error-input');
        $('#password1Err').html("*Password is required");
        return false;
    }

    if (password.length < 5) {
        $("#password1").addClass('form-error-input');
        $('#password1Err').html("Password should be at least 5 characters");
        return false;
    }
            $.ajax({
               type: 'POST',
               url: "api/login",
               data: {contact:contact, password:password, login:"login"},
               dataType: 'json',
               success: function(data, status, xhr) {
               console.log('status: ' + status + ', data: ' + ":" + data + ":");
            if (status == "success") {
                setUserHeaderData(data.data);
            } else {
                console.log("ajax failed");
            }

          },error: function(xhr, textStatus, errorMessage) {
             console.log('Error:' + errorMessage+":::"+xhr.responseJSON.message);
             $("#password1Err").html(xhr.responseJSON.message);
             $("#mobile1").addClass('form-error-input');
             $("#password1").addClass('form-error-input');
        }
            });

}

function logout(){
  $.ajax({
        type: 'POST',
        url: "api/logout",
        data: "",
        dataType: 'json',
        success: function(data, status, xhr) {
            if (status == "success") {   
                 console.log('status: ' + status + ', data: ' + ":" + data + ":");
                     unsetUserHeaderData();
            } else {
                console.log("ajax failed");
            }
        },
        error: function(xhr, textStatus, errorMessage) {
             console.log('Error:' + errorMessage+":::"+xhr.responseJSON.message);
        }
    });
}

function setUserHeaderData(d){
  hideAllModal();
  $("#preLoginView").hide();
  $("#loginName").html(d.name);
  $("#postLoginView").show();
}
function unsetUserHeaderData(d){
  $("#postLoginView").hide();
  $("#preLoginView").show();
  $("#loginName").html("");
}

$(document).ready(function() {
  $(".menu-btn").click(function() {
    $(this).toggleClass("active");
    $("#main-navigation ul").slideToggle();
  });
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();

    //>=, not <=
    if (scroll >= 50) {
      //clearHeader, not clearheader - caps H
      $("#header").addClass("sticky");
    } else {
      $("#header").removeClass("sticky");
    }
  });
});
