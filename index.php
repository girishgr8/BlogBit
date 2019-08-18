<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./styles/loginform.css" />
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="431755900850-hj63duh4igs0cmhig2tke2t6h0c0gk0g.apps.googleusercontent.com" />
    <!--<div id="fb-root"></div>
    <script
      async
      defer
      crossorigin="anonymous"
      src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0"
    ></script>-->
    <script>
        clicked = false;

        function login() {
            clicked = true;
        }

        function onSignIn(googleUser) {

            var profile = googleUser.getBasicProfile();
            var name = profile.getName();
            var pic = profile.getImageUrl();
            var email = profile.getEmail();
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.disconnect();
            if (clicked) {
                var Form, Input1, Input2,Input3;
                Form = document.createElement('form');
                Form.action = './db/login.php';
                Form.method = 'post';
                Input1 = document.createElement('input');
                Input1.type = 'hidden';
                Input1.name = 'name';
                Input1.value = name;
                Input2 = document.createElement('input');
                Input2.type = 'hidden';
                Input2.name = 'pic';
                Input2.value = pic;                
                Input3 = document.createElement('input');
                Input3.type = 'hidden';
                Input3.name = 'email';
                Input3.value = email;
                Input4 = document.createElement('input');
                Input4.type = "hidden";
                Input4.name = 'googleSignIn';
                Input4.value = 1;
                Form.appendChild(Input1);
                Form.appendChild(Input2);
                Form.appendChild(Input3); 
                Form.appendChild(Input4);               
                document.getElementById('hidden_form_container').appendChild(Form);
                Form.submit();


            }
        }
    </script>
</head>

<body>
    <button id="myBtn">Login</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="form-container">
                <form action="./db/login.php" method="post">
                    <div class="heading">LOGIN HERE</div>
                    <!--<img src="" alt="" srcset="" class="avatar-img" />-->
                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input class="input-field" type="text" placeholder="Enter Username" name="usrnm" id="username" />
                    </div>

                    <div class="input-container">
                        <i class="fa fa-key icon"></i>
                        <input class="input-field" type="password" placeholder="Enter Password" name="psw" autocomplete="on" id="password" />
                    </div>
                    <div class="show-pswd">
                        <div class="checkbox">
                            <input type="checkbox" name="remember" onclick="showPassword()" />
                        </div>
                        <div class="checkbox-text">Show Password</div>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <div style="width: 300px; height: 20px; border-bottom: 1px solid #f3f1a9; text-align: center; margin-left: 10px; margin-top: 10px" class="Or-options">
                        <span style="font-size: 12px; background-color: #f3f1a9; padding: 10px 10px">
                
                OR
              </span>
                    </div>
                    <div class="login-options">
                        <div class="g-signin2" onclick="login()" data-onsuccess="onSignIn"></div>
                        <div class="facebook">
                            <a href="#" class="fa fa-facebook"></a>
                            <a href="#" class="facebook-bg">Sign in</a>
                        </div>
                    </div>
                    <!--<div
              class="fb-login-button"
              data-width="150px"
              data-size="large"
              data-button-type="login_with"
              data-auto-logout-link="true"
              data-use-continue-as="true"
            ></div>-->
                </form>
            </div>
        </div>
    </div>
    <div id="hidden_form_container" style="display:none;"></div>
    <script src="./scripts/loginform.js"></script>
</body>

</html>

<?php

if(isset($_SESSION["loginFail"]))
{
	if($_SESSION["loginFail"]==1){
		echo '<script language="javascript">';
		echo 'alert("Login Failed. Input valid Credentials/ try using registered email")';
		echo '</script>';
		$_SESSION["loginFail"]=0;
	}
	
}?>