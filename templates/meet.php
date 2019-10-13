
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
            window.onload = gapi.load('auth2', function() {
  auth2 = gapi.auth2.init({
      client_id: '431755900850-hj63duh4igs0cmhig2tke2t6h0c0gk0g.apps.googleusercontent.com',
      scope: 'profile'
  });
});
        /*logout of both Google and normal session*/
        function logout() {
            var r = confirm("Do you wish to logout?");
            if (r == true) {
                 var auth2 = gapi.auth2.getAuthInstance();
                 auth2.signOut().then(function () {
                  console.log("tried to logout");
                    document.location.href = '../db/logout.php';
                 });
            auth2.disconnect();
            document.location.href = '../db/logout.php';
            }
        
}        /*initialising auth instance*/
        function onLoad() {
            gapi.load('auth2', function() {
            gapi.auth2.init();
      
            });
        }

      function liked(heart) {
      	console.log('liked');
         source=heart.src;	
        if (source.slice(-8,-4) == "like") 
        {
            heart.src = "../images/liked.svg";
        }
        else 
        {
            heart.src = "../images/like.svg";
        }
    }
       
    </script>
   
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../styles/dashboard.css"/>
</head>
<body>

<nav class="navbar navbar-default  navbar-expand-lg fixed-top ">
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
                <span class="glyphicon glyphicon-search invert"></span>
              </button>
            </div>
            <input type="text" class="form-control" placeholder="Search WordFlow" id="searchbox"/>
          </div>
        </div>
      </div>
    </form>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="./dashboard.php" class="nav-item nav-link" title="Home"><img src="../images/home.svg" class="icons invert"></a></li>
      <li><a href="#" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>
      
      <li><a href="#" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
      <li><a href="./meet.php" class="nav-item nav-link" title="Meet a friend"><img src="../images/map.svg" class="icons highlight-icon"></a></li>
      <!-- <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li> -->


      <li><a href="#" class="nav-item nav-link " data-toggle="dropdown" data-target=".userdrop" title="Your Profile"><img src="../images/user.svg" class="icons invert"></a>
      <div class="dropdown userdrop">
      <ul class="dropdown-menu">
      <li class="dropdown-header">Account</li>
      <li><a href="#" onclick="logout()">Log Out</a></li>
      <li><a href="./settings.php">Settings</a></li>
      <li><a href="#">Help</a></li>
      <li class="divider"></li>
      <li class="dropdown-header">WordFlow</li>
      <li><a href="#">Posts</a></li>
      <li><a href="#">Likes</a></li>
      <li><a href="#">Edit appearance</a></li>
    </ul>

      </div></li>
      <button class="btn navbar-btn item writebtn3" title="Create"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>
      
       <!-- edit and edit2-->
      <!-- <li><a href="#" class="nav-item nav-link"><span class="glyphicon glyphicon-user"></span></a></li> --> 
    </ul>
  </div>
</nav>
<!------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="container" style="padding-top: 120px;">
  <div class="map">
    <img src="../images/map2.svg" style="float: left; height: 500px; width: 500px;">
  </div>
  <div class="meet-info" style="color: black;">
    <div class="text-center" style="">
                    <h2 class="">Meet in Middle</h2>
                    <hr class="">
                    <p><i>Connect with people across the globe, meet in the middle.</i></p>
               
                
                    <form class="mx-auto" style="text-align: center;" action="./db/map.php" method="POST"><br>
                        <div class="mx-auto" style=" text-align: center;" >
                        <div class="col-md-9 col-lg-offset-1"><br>                      
                            <h4>Friend's username</h4><br>
                            <input type="Username" class="col-md-12 text" placeholder="Username" name="username" required>
                        </div>
                        <div class="col-md-9 col-lg-offset-1"><br>
                           <h4>Your Location</h4><br>
                            <input class="col-md-12 text" placeholder="Location" name="password" required>
                        </div>
                        <div class="mx-auto col-md-4 col-lg-offset-4">
                            <label></label><br>
                            <input type="submit" class="mx-auto col-md-11 btn btn-primary btn-lg center-block" value="Request meetup" name="submit">
                            <!-- <button type="submit" class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true" onclick="">Submit</button> -->
                        </div>
                        </div>
                    </form>
      </div>     
  </div>
</div>
</body>
</html>