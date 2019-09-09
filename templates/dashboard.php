
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WordFlow</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
       
    </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../styles/dashboard.css"/>
</head>
<body>

<nav class="navbar navbar-default navbar-inverse navbar-expand-lg fixed-top ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><span class="brand">WordFlow</span></a>
    </div>
    <div class="nav navbar-nav navbar-form">
    <form action="" method="GET" class="form-inline"> 
      <div class="row">
        <div class="col-md-40">
          <div class="input-group">
            <div class="input-group-btn">
              <button class="btn searchbtn" type="submit">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </div>
            <input type="text" class="form-control" placeholder="Search WordFlow" id="searchbox"/>
          </div>
        </div>
      </div>
    </form>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" class="nav-item nav-link" title="Home"><img src="../images/home.svg" class="icons invert"></a></li>
      <li><a href="#" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>
      
      <li><a href="#" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
      <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li>
      <li><a href="#" class="nav-item nav-link" title="Your Profile"><img src="../images/user.svg" class="icons invert"></a></li>
      <button class="btn navbar-btn item writebtn3" title="Create"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>
      
       <!-- edit and edit2-->
      <!-- <li><a href="#" class="nav-item nav-link"><span class="glyphicon glyphicon-user"></span></a></li> --> 
    </ul>
  </div>
</nav>

<div class="container">
  <h2>Welcome</h2>
    <div>
        <img src="../images/avatar.jpg" style="width:50px;height:50px;" id="pic">
        <p id="name" >UserName</p>
        <button id="logout" onclick="logout()">Logout</button>
        <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    </div>
    <br><br>
    <script type="text/javascript">
        
        document.getElementById("name").innerHTML=<?php echo json_encode($_SESSION['name']); ?>;
        // document.getElementById("pic").src=<?php if(isset($_SESSION['pic'])){echo json_encode($_SESSION['pic']); }?>;
    </script> 
</div>

</body>
</html>
