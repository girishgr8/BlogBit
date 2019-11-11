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
            auth2.signOut().then(() => {
            document.location.href = '../db/logout.php';
        });
        auth2.disconnect();
        document.location.href = '../db/logout.php';
        }
    }
   
   function onLoad() {
		gapi.load('auth2', () => {
			GoogleAuth = gapi.auth2.init();
		});
   }

    function liked(heart) {
        console.log('liked');
        source=heart.src;	
        if (source.slice(-8,-4) == "like") {
            heart.src = "../images/liked.svg";
        }else {
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
            <li><a href="./messages.php" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons highlight-icon"></a></li>

            <li><a href="./displaySavedBlogs.php" class="nav-item nav-link" title="Saved Posts"><img src="../images/save2.svg" class="icons invert"></a></li>
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
            </div>
            </li>
            <button class="btn navbar-btn item writebtn3" title="Create" onclick="openEditor()"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>
            </ul>
        </div>
        </nav>
        <!------------------------------------------------------------------------------------------------------------------->
        <div class="container" id="myContainer"></div>
        <script>
        window.onload = function(){
            var output = `<?php
            $username = $_SESSION["username"];
            $sql = "SELECT sentBy, place, mailDate, mailTime from meetup where username='$username'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) 
                while($row = $result->fetch_assoc()) 
                    echo $row['sentBy'].">".$row['place'].">".$row['mailDate'].">".$row['mailTime']."\n";
            ?>`;
            
            document.getElementById("myContainer").innerHTML+= `
                <div class="container" style="color: white; font-weight: bold;">           
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Invite From</th>
                            <th>Meet Place</th>
                            <th>Mailed Date</th>
                            <th>Mailed Time</th>
                        </tr>
                    </thead>
                    <tbody id="appendIt">
                `
            var rows = output.split("\n");
            console.log(rows);
            for(var i=0;i<rows.length-1;i++) {
                var obj = rows[i].split(">");
                document.getElementById("appendIt").innerHTML+= `
                    <tr>
                        <td>${obj[0]}</td>
                        <td>${obj[1]}</td>
                        <td>${obj[2]}</td>
                        <td>${obj[3]}</td>
                    </tr>
                `;
            }
            document.getElementById("myContainer").innerHTML+= `</tbody></table></div>`;
        }
        </script>
    </body>
</html>