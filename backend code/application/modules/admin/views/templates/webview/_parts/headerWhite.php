<!-- Header -->
        <header class="white-header">
            <div class="row">
                <div class="col-lg-4 col-2 left">
                    <p class="d-none d-lg-block">
                        
                 <?php

?>
                    </p>
                    <a href="#menu-toggle" class="fa fa-bars d-block d-sm-block d-md-none" id="menu-toggle"></a>
                </div>
                <div class="col-lg-8 col-10 right">
                   
                    <p class="fa fa-sign-out search push" aria-hidden="true" onclick="logout()">Logout</p>
                </div>
            </div>
            <script type="text/javascript">
                function logout(){
            $.ajax({
                type: 'POST',
                url: 'api/index.php',
                data: {
                apiKey: API_KEY,
                api: "loginSignup",
                request:"103",//logout
            },
                dataType: 'json',
                success: function (data, status, xhr) {
                    console.log('status: ' + status + ', data: ' + ":"+data+":");
                    if(status=="success"){
                        if (data.status=="N200") {
                            window.open('index.php?page=login',"_self");
                        }
                    }else{
                        alert("Network Failed");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        console.log('Error' + errorMessage);
                    }
            });
                }
            </script>
        </header>