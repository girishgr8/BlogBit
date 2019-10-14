
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
      var r = confirm("Do you wish to logout?");
      if (r == true) {
       var auth2 = gapi.auth2.getAuthInstance();
       auth2.signOut().then(function () {
        document.location.href = '../db/logout.php';
      });
       auth2.disconnect();
       document.location.href = '../db/logout.php';
     }
   }
   /*initialising auth instance*/
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
        <li><a href="./dashboard.php" class="nav-item nav-link" title="Home"><img src="../images/home.svg" class="icons highlight-icon"></a></li>
        <li><a href="#" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>

        <li><a href="#" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
        <li><a href="./meet.php" class="nav-item nav-link" title="Meet a friend"><img src="../images/map.svg" class="icons invert"></a></li>
        <!-- <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li> -->

        
        <li><a href="#" class="nav-item nav-link " data-toggle="dropdown" data-target=".userdrop" title="Your Profile"><img src="../images/user.svg" class="icons invert"></a>
          <div class="dropdown userdrop">
            <ul class="dropdown-menu">
              <li class="dropdown-header">Account</li>
              <li><a href="#" onclick="logout()">Log Out</a></li>
              <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
              <li><a href="./settings.php">Settings</a></li>
              <li><a href="#">Help</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">WordFlow</li>
              <li><a href="#">Posts</a></li>
              <li><a href="#">Likes</a></li>
              <li><a href="#">Edit appearance</a></li>
            </ul>

          </div></li>
          <button class="btn navbar-btn item writebtn3" title="Create" onclick="openEditor()"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>

          <!-- edit and edit2-->
          <!-- <li><a href="#" class="nav-item nav-link"><span class="glyphicon glyphicon-user"></span></a></li> --> 
        </ul>
      </div>
    </nav>
    <!------------------------------------------------------------------------------------------------------------------------------------------------>

    <div class="container">
 <!--  <h2>jehrjweh</h2>
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
      </script>  -->

      <div class="posts">  
        <div class="post" id="p1">
          <img src="../images/avatar2.jpg" class="card-user" alt="..." style="width:100%">
          <div class="card">
            <div class="card-header">
             <span>bubblegumpinkcakeeeeee</span>&nbsp; &nbsp;
             <img src="../images/follow.svg" class="icons" title="follow" style="margin-bottom: 3px;">
           </div>
           <div class="card-image">
            <img src="../images/cardimg.jpg" alt="." style="width:100%">
            <button class="card-btn btn"><img src="../images/rightarrow.svg" class="view-icon"></button>
          </div>
          <div class="card-body">
            <h1 class="card-title">Benefits of Studying</h1>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
          <div class="card-header">
            <span style="font-weight: bold;" class="text-muted">124 likes</span>
            <img src="../images/share.svg" class="icons" style="position: absolute; right:100px;" title="Share" >
            <img src="../images/blogging.svg" class="icons" style="position: absolute; right:60px;" title="Comment" >
            <img src="../images/like.svg" class="icons" id="like" style="position: absolute; right:18px;" onclick="liked(this)" title="Like" >
          </div>
        </div>
      </div>

      <div class="post" id="p2">
        <img src="../images/avatar2.jpg" class="card-user" alt="..." style="width:100%">
        <div class="card">
          <div class="card-header">
            <span>bubblegumpinkcakeeeeee</span>&nbsp; &nbsp;
            <img src="../images/follow.svg" class="icons" title="follow" style="margin-bottom: 3px;">
          </div>
          <div class="card-image">
            <img src="../images/cardimg.jpg" alt="." style="width:100%">
            <button class="card-btn btn"><img src="../images/rightarrow.svg" class="view-icon"></button>
          </div>
          <div class="card-body">
            <h1 class="card-title">Benefits of Studying</h1>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
          <div class="card-header">
            <span style="font-weight: bold;" class="text-muted">124 likes</span>
            <img src="../images/share.svg" class="icons" style="position: absolute; right:100px;" title="Share" >
            <img src="../images/blogging.svg" class="icons" style="position: absolute; right:60px;" title="Comment" >
            <img src="../images/like.svg" class="icons" id="like" style="position: absolute; right:18px;" onclick="liked(this)" title="Like" >
          </div>
        </div>
      </div>

      <div class="post" id="p3">
       <img src="../images/avatar1.jpg" class="card-user" alt="..." style="width:100%">
       <div class="card">
        <div class="card-header">
         <span>gayatree</span>&nbsp; &nbsp;<img src="../images/follow.svg" class="icons" title="follow" style="margin-bottom: 3px;">
       </div>
       <div class="card-image">
        <img src="../images/1.jpg" alt="..." style="width:100%">
        <button class="card-btn btn"><img src="../images/rightarrow.svg" class="view-icon"></button>
      </div>
      <div class="card-body">
        <h1 class="card-title">Lets go to the library because why not</h1>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
      <div class="card-header">
        <span style="font-weight: bold;" class="text-muted">124 likes</span>
        <img src="../images/share.svg" class="icons" style="position: absolute; right:100px;" title="Share" >
        <img src="../images/blogging.svg" class="icons" style="position: absolute; right:60px;" title="Comment" >
        <img src="../images/like.svg" class="icons" id="like" style="position: absolute; right:18px;" onclick="liked(this)" title="Like" >
      </div>
    </div>
  </div>

</div> 
<!-- endposts -->
<div class="recommendations">

  <div class="wrapper"><ul class="mat_list cardi">
   somebody plej do this part its annoying
   <h5 style="font-weight: bold;">Recommendations</h5>
   <li><p>Username1</p></li>
   <li><p>AnotherUser123</p></li>
   <li><p>Lalalauser</p></li>
   <li><p>HEHEHEyey</p></li>
 </ul>
</div>

</div>

</div>
<!-- endcontainer -->

</body>

<script type="text/javascript">
  function openEditor(){
    window.location.href="./blogEditor.php";
  }
</script>

</html>
