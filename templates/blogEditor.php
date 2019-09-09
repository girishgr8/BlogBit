<?php
session_start();
$name=$_SESSION["name"];
$userID=$_SESSION["userID"];
?>

<!DOCTYPE html>
<html>

<head>
    <!--Google Client ID-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="431755900850-hj63duh4igs0cmhig2tke2t6h0c0gk0g.apps.googleusercontent.com" />
    <!--Including Editor API-->
    <script src="../config/editorAPI/tinymce.min.js"></script>
    <script>
        /*logout of both Google and normal session*/
        function logout() {
            var r = confirm("Sure about Logout?");
            if (r == true) {
                 var auth2 = gapi.auth2.getAuthInstance();
                 auth2.signOut().then(function () {
                    document.location.href = '../db/logout.php';

                 });

            auth2.disconnect();
            }
        }
        /*initialising auth instance*/
        function onLoad() {
            gapi.load('auth2', function() {
            gapi.auth2.init();
      
            });
        }
        /*Instantiating the EditorAPI*/
        tinymce.init({
            selector: '#myTextarea'
           
        });
    </script>

    <!--Hiding the watermarks of API-->
    <style>
        .tox .tox-statusbar__path {
            display: none;
        }
        
        a {
            display: none;
        }
    </style>


</head>

<body>
    <div>
        <img src="../images/avatar.jpg" style="width:50px;height:50px;" id="pic">
        <p id="name" >UserName</p>
        <button id="logout" onclick="logout()">Logout</button>
        <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    </div>
    <br><br>
    <script type="text/javascript">
        document.getElementById("pic").src=<?php if(isset($_SESSION['pic'])){echo json_encode($_SESSION['pic']); }?>;
        document.getElementById("name").innerHTML=<?php echo json_encode($_SESSION['name']); ?>;
    </script> 

    <!--Editor Area-->
    <div>
        <textarea id="myTextarea">Simple Text Editor! Type in!</textarea>
    </div>
</body>

</html>