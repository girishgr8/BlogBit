
<?php
session_start();
include("../config/config.php");
if(!isset($_SESSION['username'])){
  header("Location: ../index.php");
}
$username = $_SESSION['username'];
$querycheck ="SELECT savedBlogs FROM user WHERE username = '$username'";
$countrows = ($conn->query($querycheck))->num_rows;
$res=$conn->query($querycheck);
while($r=$res->fetch_assoc()){
  $temp = $r['savedBlogs'];
}

$parts = explode(',', $temp);

$querycheck ="SELECT likedBlogs FROM user WHERE username = '$username'";
$countrows = ($conn->query($querycheck))->num_rows;
$res=$conn->query($querycheck);
while($r=$res->fetch_assoc()){
  $liked_temp = $r['likedBlogs'];
}
$liked_parts = explode(',',$liked_temp);



$images=[];
$disclaimers=[];
$titles=[];
$postIDS=[];
// $blogIDs=[];
$usernames=[];
$likes = [];

$sql="SELECT username,title,disclaimer,likes from blog where username= '$username'";
$res=$conn->query($sql);
while($r=$res->fetch_assoc()){
  $images[]=$r['username'].'_'.$r['title'].'.png';
  $disclaimers[]=$r['disclaimer'];
  $titles[]=$r['title'];
  // $blogIDs=$r['blogID'];
  $postIDS[]=$r['username'].'_'.$r['title'];
  // '_'.$r['blogID']  
// arts[0].'_'.$parts[1]
  $usernames[]=$r['username'];  
  $likes[] = $r['likes']; 

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
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
  <script>
    var path=<?php echo json_encode($path);?>;
    function allowDrop(ev) {
      ev.preventDefault();
    }

    function drag(ev) {
      ev.dataTransfer.setData("text", ev.target.innerHTML);
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      ev.target.appendChild('<input   type="text" class="form-control" value='+data+' id="searchbox"/>');
      //ev.target.appendChild(document.getElementById(data));
    }
  </script>
  <script> 
    function openBlog(postID){

      window.location.href="./blogViewer.php?path="+postID;
    }
    function saveBlog(post){
      postID=post.id;
      res = postID.split(":");  
      source=post.src; 

      if(source.slice(-12,-4)=="saveBlog"){

        $.post(
          '../db/editSavedBlog.php',
          {
            save:1,
            postID:res[1]
          },

          function(result){
            alert("You have saved this blog");

          }

          );
        post.src = "../images/save2.svg";
      }


      else 
      {


        $.post(
          '../db/editSavedBlog.php',
          {
            remove:1,
            postID:res[1]
          },

          function(result){
            alert("Removed from your saved blogs");

          }

          );
        post.src = "../images/saveBlog.png";
      }
    }
    function likedBlog(post,likes){
      postID=post.id;      
      res = postID.split(":");  
      console.log(res[1].split('_')[0]);
      source=post.src;
      textID = "text:"+res[1];
      countID = "count:"+res[1];
      if(source.slice(-8,-4)== "like"){
        $.post(
          '../db/likedBlog.php',{
            like:1,
            postID:res[1],
            creator: res[1].split('_')[0],
            title: res[1].split('_')[1]
          },
          function(result){
            console.log(result);
          }
          );
        post.src = "../images/liked.svg";
        
        document.getElementById(countID).innerHTML = (likes+1)+" likes";
       
      }
      else {
        
        $.post(
          '../db/likedBlog.php',{
            unlike:1,
            postID:res[1],
            creator: res[1].split('_')[0],
             title: res[1].split('_')[1]
          },
          function(result){
          }
          );
        post.src = "../images/like.svg";
    
        document.getElementById(countID).innerHTML = (likes)+" likes";
        
      }
    }

  </script>
  <script>

    // function(path){
      // var p=<?php //echo json_encode($p);?>;
  // var pathNew= path.replace(' ', '%20');
    // console.log(pathNew);
        // console.log(path+"Blogs/"+pathNew+".html");
    // $("#blogContent").load(path+"Blogs/"+pathNew+".html"); 
  // }


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
                </div ondrop="drop(event)" ondragover="allowDrop(event)" id="div1">
                <input   type="text" class="form-control" placeholder="Search WordFlow" id="searchbox"/>
              </div>
            </div>
          </div>
        </form>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./dashboard.php" class="nav-item nav-link" title="Home"><img src="../images/home.svg" class="icons highlight-icon"></a></li>

        <li><a href="./messages.php" class="nav-item nav-link" title="Message"><img src="../images/msg.svg" class="icons invert"></a></li>

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
              <li><a href="./likedPosts.php">Likes</a></li>
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

      <div class="posts" id="timeline"> 

        <?php


        for($i=0;$i<count($postIDS);$i++){
          $saved=0;
          $liked=0;
          for ($x = 0; $x < count($parts); $x++) {
            if($parts[$x]==$postIDS[$i]){
              $saved=1;
              break;
            }
          }
          for ($x = 0; $x < count($liked_parts); $x++) {
            if($liked_parts[$x]==$postIDS[$i]){
              $liked=1;
              break;
            }
          }
          $myurl = "/blogViewer.php?path=".$postIDS[$i];
          echo '<div class="post" >';
          echo '<img src="../images/avatar2.jpg" class="card-user" alt="..." style="width:100%">';
          echo '<div class="card"><div class="card-header">';
          echo '<span>'.$usernames[$i].'</span>&nbsp; &nbsp;';
          echo '<img src="../images/follow.svg" class="icons" title="follow" style="margin-bottom: 3px;">
          </div><div class="card-image">';
          echo '<img src="'.$path.'blogForegroundImages/'.$images[$i].'" alt="." style="width:100%">';
          echo '<button class="card-btn btn"><img src="../images/rightarrow.svg" class="view-icon" 
          onclick="openBlog(this.id)" id="'.$postIDS[$i].'"></button></div><div class="card-body">';
          echo '<h1 class="card-title">'.$titles[$i].'</h1>';
          echo '<p class="card-text">'.$disclaimers[$i].'</p>';
          echo '<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p></div>
          <div class="card-header"><span style="font-weight: bold;"  class="text-muted" id="count:'.$postIDS[$i].'">'.$likes[$i].' likes</span>

          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($myurl) ?>"><img src="../images/share.svg" class="icons" style="position: absolute; right:150px;" title="Share" ></a>
          <img src="../images/blogging.svg" class="icons" style="position: absolute; right:100px;" title="Comment" 
          onclick="openBlog(this.id)" id="'.$postIDS[$i].'">';
          if($liked==0)
            echo '<img src="../images/like.svg" class="icons" id="like:'.$postIDS[$i].'" style="position: absolute; right:60px;" onclick="likedBlog(this,'.$likes[$i].')" title="Like" >';
            
          

          else
            echo '<img src="../images/liked.svg" class="icons" id="like:'.$postIDS[$i].'" style="position: absolute; right:60px;" onclick="likedBlog(this,'.$likes[$i].')" title="Liked !" >';
            
          


          if($saved==0)
            echo '<img src="../images/saveBlog.png" class="icons" id="id:'.$postIDS[$i].'" style="position: absolute; right:18px;" onclick="saveBlog(this)" title="Like" >';
          else
            echo '<img src="../images/save2.svg" class="icons" id="id:'.$postIDS[$i].'" style="position: absolute; right:18px;" onclick="saveBlog(this)" title="Like" >' ;
          echo '</div></div></div>';

        }



        ?>
        
      </div> 
      <!-- endposts -->
      <div class="recommendations">

        <div class="wrapper"><ul class="mat_list cardi">

         <h5 style="font-weight: bold;">Recommendations</h5>
         <li><p draggable="true" ondragstart="drag(event)">Girish Thatte</p></li>
         <li><p draggable="true" ondragstart="drag(event)">Amisha Waghela</p></li>
         <li><p draggable="true" ondragstart="drag(event)">Rahul Mistry</p></li>
         <li><p draggable="true" ondragstart="drag(event)">Sheldon Cooper</p></li>
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
