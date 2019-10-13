
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
      <li><a href="./meet.php" class="nav-item nav-link" title="Meet a friend"><img src="../images/map.svg" class="icons invert"></a></li>
      <!-- <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li> -->


      <li><a href="#" class="nav-item nav-link " data-toggle="dropdown" data-target=".userdrop" title="Your Profile"><img src="../images/user.svg" class="icons highlight-icon"></a>
      <div class="dropdown userdrop">
      <ul class="dropdown-menu">
      <li class="dropdown-header">Account</li>
      <li><a href="#" onclick="logout()">Log Out</a></li>
      <li><a href="#">Settings</a></li>
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
  <div class="settings">
    <h2>Account Settings</h2>
    <hr style="border: 1px solid silver;">
    <h4 style="margin-top: 30px !important;"> <i>General Information</i></h4><br>
    <table class="table">
        <thead>
        </thead>
        <tbody>
          <tr>
            <th style="padding:30px" scope="row">Email</th>
            <td style="padding:30px"><input type="email" readonly class="form-control-plaintext" id="userEmail" value="amishabw@gmail.com">
                <form>
                <div class="collapse" id="editEmail" style="width: 50%;"><br><br>
                              <input type="email" class="form-control" placeholder="New email"><br>
                              <input type="password" class="form-control" placeholder="Current password"><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input type="submit" class="btn" style="color: white; background-color: darkgray;" data-toggle="collapse" data-target="#editEmail" value="Cancel">
                </div>
              </form>
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editEmail" class="edit"></td>
          </tr>
          <tr> 
            <th style="padding:30px" scope="row">Name</th>
            <td style="padding:30px"><input type="email" readonly class="form-control-plaintext" id="userName" value="Amisha Bipin Waghela">
              <form>
              <div class="collapse" id="editName" style="width: 50%;"><br><br>
                            <!-- <label>First Name:</label> -->
                            <input type="text" class="form-control" placeholder="First Name"><br>
                            <!-- <label>Middle Name:</label> -->
                            <input type="text" class="form-control" placeholder="Middle Name"><br>
                            <!-- <label>Last Name:</label> -->
                            <input type="text" class="form-control" placeholder="Last Name">
                            <br>
                            <input type="submit" class="btn btn-primary" value="Save">
                            <input type="submit" class="btn" style="color: white; background-color: darkgray;" data-toggle="collapse" data-target="#editName" value="Cancel">
              </div>
            </form>
            </td> <!-- concat first middle last-->
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editName" class="edit"></td>
          </tr>
          <tr>
            <th style="padding:30px" scope="row">Password</th>
            <td style="padding:30px"><input type="password" readonly class="form-control-plaintext" id="userPass" value="amisha123">
              <form>
                <div class="collapse" id="editPass" style="width: 50%;"><br><br>
                              <input type="password" class="form-control" placeholder="Current password"><br>
                              <input type="password" class="form-control" placeholder="New password"><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input type="submit" class="btn" style="color: white; background-color: darkgray;" data-toggle="collapse" data-target="#editEmail" value="Cancel">
                </div>
              </form>
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editPass" class="edit"></td>
          </tr>
        </tbody>
    </table>
  </div>
</div>
</body>
</html>