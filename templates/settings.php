
<?php
session_start();
include("../config/config.php");
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WordFlow</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" id="gauth"/>
  <script type="text/javascript">
    var authKey = <?php echo json_encode($authKey);?>;
    $("#gauth").attr("content", authKey);
  </script>
    <script>
      function openEditor(){
    window.location.href="./blogEditor.php";
  }
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
      <li><a href="./messages.php" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>      
      <li><a href="#" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
      <li><a href="./meet.php" class="nav-item nav-link" title="Meet a friend"><img src="../images/map.svg" class="icons invert"></a></li>
      <!-- <li><a href="#" class="nav-item nav-link" title="Liked Posts"><img src="../images/heart.svg" class="icons invert"></a></li> -->

      <li><a href="#" class="nav-item nav-link " data-toggle="dropdown" data-target=".userdrop" title="Your Profile"><img src="../images/user.svg" class="icons highlight-icon"></a>
      <div class="dropdown userdrop">
      <ul class="dropdown-menu">
      <li class="dropdown-header">Account</li>
      <li><a href="#" onclick="logout()">Log Out</a></li>
      <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
      <li><a href="#">Settings</a></li>
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

<?php
              $name = $_SESSION["name"];
              $email = $_SESSION["email"];
              $password=$_SESSION["password"];
              $username=$_SESSION["username"];
              $sql="Select phone, city, state, country, street, pincode from user where username = '$username'";
              $result = $conn->query($sql);
              if($result->num_rows>0){
                  while($row = $result->fetch_assoc()) {
                      $phone=$row["phone"];
                      $city=$row["city"];
                      $state=$row["state"];
                      $country=$row["country"];
                      $street=$row["street"];
                      $pin=$row["pincode"];

                }
                $addr = $street.", ".$city.", ".$pin." \r\n, ".$state.", ".$country;
              }
              ?>

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
            <td style="padding:30px"><input type="email" readonly class="form-control-plaintext"  value="<?php echo $email ?>">
                <form method="post" action="../db/updateEmail.php">
                <div class="collapse" id="editEmail" style="width: 50%;"><br><br>
                              <input type="email" name="newEmail" class="form-control" placeholder="New email" required><br>
                              <input type="password" name="pass" class="form-control" placeholder="Current password" required><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input  class="btn" style="color: white; background-color: darkgray; width: 70px;" data-toggle="collapse" data-target="#editEmail" value="Cancel">
                </div>
              </form>
              
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editEmail" class="edit"></td>
          </tr>
          <tr> 
            <th style="padding:30px" scope="row">Name</th>
            <td style="padding:30px"><input type="text" readonly class="form-control-plaintext"  value="<?php echo $name ?>">
              <form method="post" action="../db/updateName.php">
              <div class="collapse" id="editName" style="width: 50%;"><br><br>
                            <!-- <label>First Name:</label> -->
                            <input type="text" class="form-control" name="fname" placeholder="First Name" required><br>
                            <!-- <label>Middle Name:</label> -->
                            <input type="text" class="form-control" name="mname" placeholder="Middle Name"><br>
                            <!-- <label>Last Name:</label> -->
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required><br>
                            <input type="password" class="form-control" name="pass2" placeholder="Current Password" required>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Save">
                            <input  class="btn" style="color: white; background-color: darkgray; width: 70px;" data-toggle="collapse" data-target="#editName" value="Cancel">
              </div>
            </form>
            </td> <!-- concat first middle last-->
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editName" class="edit"></td>
          </tr>
          <tr>
            <th style="padding:30px" scope="row">Password</th>
            <td style="padding:30px"><input type="password" readonly class="form-control-plaintext"  value="<?php echo $password ?>">
              <form method="post" action="../db/updatePass.php">
                <div class="collapse" id="editPass" style="width: 50%;"><br><br>
                              <input type="password" class="form-control" placeholder="Current password" name="pass3" required><br>
                              <input type="password" class="form-control" placeholder="New password" name="newPass" required><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input  class="btn" style="color: white; background-color: darkgray; width: 70px;" data-toggle="collapse" data-target="#editEmail" value="Cancel">
                </div>
              </form>
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editPass" class="edit"></td>
          </tr>
          <tr>
            <th style="padding:30px" scope="row">Contact</th>
            <td style="padding:30px"><input type="text" readonly class="form-control-plaintext" value="<?php echo $phone ?>">
                <form method="post" action="../db/updatePhone.php">
                <div class="collapse" id="editPhone" style="width: 50%;"><br><br>
                              <input type="tel" class="form-control" placeholder="Phone" name="phone"  pattern="[0-9]{10}" required><br>
                              <input type="password" name="pass4" class="form-control" placeholder="Current password" required><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input  class="btn" style="color: white; background-color: darkgray; width: 70px;" data-toggle="collapse" data-target="#editPhone" value="Cancel">
                </div>
              </form>
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editPhone" class="edit"></td>
          </tr>
          <tr>
            <th style="padding:30px" scope="row">Address</th>
            <td style="padding:30px"><input type="text" readonly class="form-control-plaintext" style="width: 100%; text-align: left;" value="<?php echo $addr ?>">
                <form method="post" action="../db/updateAddr.php">
                <div class="collapse" id="editAddr" style="width: 50%;"><br><br>
                              <input type="text" name="street" class="form-control" placeholder="Street" required><br>
                              <input type="text" name="city" class="form-control" placeholder="City" required><br>
                              <input type="text" name="pin" class="form-control" placeholder="Pincode" required><br>
                              <input type="text" name="state" class="form-control" placeholder="State" required><br>
                              <input type="text" name="country" class="form-control" placeholder="Country" required><br>

                              <input type="password" name="pass5" class="form-control" placeholder="Current password" required><br>
                              <input type="submit" class="btn btn-primary" value="Save">
                              <input  class="btn" style="color: white; background-color: darkgray; width: 70px;" data-toggle="collapse" data-target="#editAddr" value="Cancel">
                </div>
              </form>
            </td>
            <td style="padding:30px"><img src="../images/editopt.svg" data-toggle="collapse" data-target="#editAddr" class="edit"></td>
          </tr>
        </tbody>
    </table>
  </div>
  <br><br>
</div>
<?php
if(isset($_SESSION["updateFail"]))
{
    if($_SESSION["updateFail"]==1){
        echo '<script language="javascript">';
        echo 'alert("Incorrect Password.")';
        echo '</script>';
        $_SESSION["updateFail"]=0;
    }
    
}?>
</body>
</html>