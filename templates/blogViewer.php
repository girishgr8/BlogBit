<?php
session_start();
include("../config/config.php");
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
}
date_default_timezone_set('Asia/Kolkata');
$p = $_GET['path'];
$parts = explode('_', $p);
$userNamee = $_SESSION['username'];
$title=$parts[1];
// $blogID = $parts[2];
// $blogID = $_GET['blogID'];


$comment=[];
$userName=[];
$timestamp=[];
$sql="SELECT username,comment,`date` from comments where blogID = '".$p."'";
$res=$conn->query($sql);
while($r=$res->fetch_assoc()){
  $userName[]=$r['username'];
  $comment[]=$r['comment'];
  $timestamp[]=($r['date']);
  // echo $r['username'];
}


?>

<!DOCTYPE html>
<html lang="en">
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="../styles/blogViewer.css"> -->
<script type="text/javascript">
    var path=<?php echo json_encode($path);?>;
	var p=<?php echo json_encode($p);?>;
    
	var pathNew= p.replace(' ', '%20');
    console.log(pathNew);
	$(function(){
        console.log(path+"Blogs/"+pathNew+".html");
		$("#blogContent").load(path+"Blogs/"+pathNew+".html"); 
	});
</script>


<head>
  <title>WordFlow</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

    function makeComment(){
        // echo '<div class="commentBox">';
        //     echo '<h5><b>'.$userName[$i].'</b><span class="date sub-text">&nbsp;·&nbsp;'.$timestamp[$i].'</span></h5>';
        //     echo '<p class="taskDescription">'.$comment[$i].'</p>';
        //     echo '</div>';
        // }
            var comment = document.getElementById('comm').value;
            var user = <?php  echo json_encode($userNamee ) ?>;
            var box = document.getElementById('currentComment');
            var iDiv = document.createElement('div');
            iDiv.className = "commentBox";
            var h5 = document.createElement('h5');
            var a = document.createElement('p');
            a.className = 'taskDescription';
            user = user.bold();
            h5.innerHTML = user+'<span class="date sub-text">&nbsp;·&nbsp;Just Now</span>';
            a.innerHTML = comment;
            iDiv.appendChild(h5);
            iDiv.appendChild(a);
            box.appendChild(iDiv);


            document.newComment.submit();
            $('#comm').val('');

        }

    </script>
    <!-- <link rel="stylesheet" type="text/css" href="../styles/blogViewer.css"> -->
	
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
            <li><a href="./messages.php" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>

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
            </div>
            </li>
            <button class="btn navbar-btn item writebtn3" title="Create" onclick="openEditor()"> &nbsp;<img src="../images/pencil.svg" class="icons">&nbsp;</button>
            </ul>
        </div>
        </nav>
<!-------------------------------------------------------------------------------------------------------------------------------------->



	<h1 id="blogTitle"><?php echo $title; ?></h1>
	<div id="blogContent" style="color: black;">

	</div>
	<div class="detailBox" id="dbox">
        
    <div class="titleBox"><h4><b>Comments</b></h4></div>
   


<?php


        for($i=0;$i<count($userName);$i++){
            echo '<div class="commentBox">';
            echo '<h5><b>'.$userName[$i].'</b><span class="date sub-text">&nbsp;·&nbsp;'.date("Y-m-d H:i:s",strtotime($timestamp[$i])).'</span></h5>';
            echo '<p class="taskDescription">'.$comment[$i].'</p>';
            echo '</div>';
        }

?>
 <div id="currentComment"></div>

<div class="commentBox">
        <form action="../db/saveComment.php" method="POST" name="newComment">
            <input value="<?php echo $p; ?>" name="blogID" type="hidden">
            <input type="text" class="form-control" style="text-align: left;" placeholder="Add a comment" name="comm" id="comm"/><br>
            <input type = "button"onclick="makeComment()" value="Comment" style=" font-size: 15px; margin: auto;" class="btn greenify" />
        </form>
        
    </div>
        
 </div> 
</div>
</body>
</html>