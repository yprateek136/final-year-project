<body>
    <div id="main-wrap">
        <!-- Header -->
        <header>
            <div class="row align-items-center">
                <div class="col-4 align-self-center"><h2 style="color: #fff;">Aqua Van</h2><!-- <img src="img/logo.png" /> --></div>
                <div class="col-8 text-right align-self-center">
                    <!-- <span class="d-none d-lg-inline-block">Need to create an account?</span>
                    <button type="button" class="btn outline-btn" onclick="location.href='index.php?page=signUp'">Sign Up</button> -->
                </div>
            </div>
        </header>
        
        <!-- Form -->
        <div class="login-form">
            <form>
                <h1>Log In to Aqua Van</h1>
                <h2>Enter your login details.</h2>
                <div class="form-cont">
                    <label>Email Address</label>
                    <input placeholder="Enter your email id" type="email" required maxlength="64" id="email"/>
                </div>
                <div class="form-cont">
                    <!-- <label>Password <span class="forgot-password">Forgot password?</span></label> -->
                     <label>Enter Password</label>
                    <input placeholder="Enter your password" type="password" required maxlength="64"  id="pass" />
                </div>
                <div class="form-cont text-center">
                    <!-- <button type="submit" class="btn btn-default"  id="loginButton"  onsubmit="return checkData()">Login</button> -->
                    <button type="button" class="btn btn-default" onclick="validateData()" id="loginButton">Login</button>
                    <button type="button" class="btn btn-default buttonload disabled" style="display: none;" id="postLoginButton"><i class="fa fa-circle-o-notch fa-spin"></i>Loading...</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    $this->load->view('templates/webview/_parts/foot');
    ?>
   <script type="text/javascript">
    function validateData() {
      $("#loginButton").hide();
      $("#postLoginButton").show();

      if($("#email").val().trim()==""){
        alert("Invalid Email");
      }

      if($("#pass").val().trim()==""){
        alert("Invalid Password");
        $("#pass").focus();
      }
     $.ajax({
                type: 'POST',  // http method
                url: "<?=base_url('Login_Ajaxcontroller/login'); ?>",
                data: {
                email:$("#email").val(),
                password:$("#pass").val(),
            },
                // data to submit
                dataType: 'json',
                success: function (data, status, xhr) {
                  $("#postLoginButton").hide();
                  $("#loginButton").show();
                    console.log('status: ' + status + ', data: ' + ":"+data+":");
                    if(status=="success"){
                        if (status=="success") {
                            console.log("1234");
                            window.open('dashboard',"_self");
        
                        }else{
                            alert(data.message);
                            console.log(data.log);
                        }
                    }else{
                        alert("Validation Failed");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        console.log('Error' + errorMessage);
                    }
            });
     return false;
    }
   </script>

