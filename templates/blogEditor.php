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
  
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <!--Including Editor API-->
  <script type="text/javascript">
    var editorKey = <?php echo json_encode($editorKey);?>;
    
    $("#editorAPI").attr("src",editorKey);
    document.write("<script type='text/javascript' referrerpolicy='origin' src='https://cdn.tiny.cloud/1/"+ editorKey + "/tinymce/5/tinymce.min.js'><\/scr" + "ipt>");
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

  <!-- <link rel="stylesheet" type="text/css" href="../styles/blogEditorStyle.css"> -->
  <!-------------------------------------------------------------------------------------------------------------------------------->
  <script>

    /*Instantiating the EditorAPI*/
    tinymce.init({

      selector: '#mytextarea', /*specify textarea tag*/

      plugins: "lists,advlist,emoticons,image,link,searchreplace,fullscreen,save,insertdatetime,table,print,wordcount" , 
      toolbar: 'undo redo  | bold italic| alignleft aligncenter alignright alignjustify|outdent indent| bullist numlist| link image table insertdatetime emoticons | searchreplace wordcount | fullscreen save print |' , 


      file_picker_types: 'image',
      /* and here's our custom image picker*/
      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.setAttribute('name', 'blog');
        input.onchange = function () {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function () {

            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      },
      save_onsavecallback: function () { 
        console.log('Saved');
        var title = document.getElementById("title").value;
        alert(tinyMCE.activeEditor.getContent());
        
        if(title!=null){
          alert(title);
          $.post(
            '../db/saveBlog.php',
            {
              save:1,
              blog:tinyMCE.activeEditor.getContent(),
              title:title
            },

            function(result){
              alert("Blog Saved");

            }

            );
        }
        else{
          alert("Please enter a valid title for your blog");
        }
      }


    });

  </script>

  <!--Hiding the watermarks of API-->
  <style>
    hr{
      border: 50px solid #022012;
    }
    body{
      text-align: center;
      color: white;
    }
    .tox .tox-statusbar__path {
      display: none;
    }

    a {
      display: none;
    }

  </style>

</head>

<body>


  <input placeholder="Enter your blog title" id="title" style="height: 50px; width: 90%; font-size: 45px; padding: 10px;color: black; margin-top: 80px !important;"/>
  <br>
  <!-- <hr> -->
  <br>

  <!--Editor Area Starts-->
  <div>
    <textarea id="mytextarea" name="mytextarea" style="height: 500px; margin: auto;"></textarea>
  </div>
  <!--Editor Area Ends-->
  <hr>
  <!--Foreground Image div Starts-->
  <div style="margin-top: 40px;">
    <h4>Select a foreground title image for your blog</h4>
    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
      <div id="image_preview" style="text-align: center;">
        <img id="previewing" src="../images/noimage.png" /><br></div>
        <div><br>
          <input type="file" name="file" id="file" class="btn greenify" style="margin: auto;" required /> <br>       
          <input type="submit" value="Upload" style=" font-size: 20px;" class="btn greenify" />
        </div>

      </form>
    </div>
    <!--Foreground Image div Ends-->
    <hr>
    <!--Disclaimer div Starts-->
    <div style="margin-top: 60px;">
      <h4>Write a description for your blog</h4>
      <form id="blogDisclaimer">
        <input type="text" name="disclaimer"  id="disclaimer" required style="height: 200px; width: 500px; color: black; font-size: 20px;" /><br><br>
        <input type="submit" value="Save Description" style=" font-size: 20px;" class="btn greenify"  />
      </form>
    </div><br><br>
    <!--Disclaimer div Ends-->

  </body>



  <script type="text/javascript">

    $(document).ready(function (e) {

      $("#blogDisclaimer").on('submit',(function(e){
        e.preventDefault();
        var title = document.getElementById("title").value;
        var d = document.getElementById("disclaimer").value;
        $.post(
          '../db/saveDisclaimer.php',
          {
            save:1,
            disclaimer:d,
            title:title
          },

          function(result){
            alert("Disclaimer Saved");

          }

          );
      }));


      $("#uploadimage").on('submit',(function(e) {
        e.preventDefault();
        $title = document.getElementById("title").value;
        alert($title);
        $("<input />").attr("type", "hidden")
        .attr("name", "title")
        .attr("value",$title)          
        .appendTo("#uploadimage");

        $.ajax({
          url: "../db/saveForegroundImage.php", 
          type: "POST",             
          data: new FormData(this), 
          contentType: false,       
          cache: false,             
          processData:false,        
          success: function(data)  
          {
            alert("Image Uploaded");
          }
        });
      }));

      // Function to preview image after validation
      $(function() {
        $("#file").change(function() {
          var file = this.files[0];
          var imagefile = file.type;
          var match= ["image/jpeg","image/png","image/jpg"];
          if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
          {
            $('#previewing').attr('src','../images/noimage.png');

            return false;
          }
          else
          {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
          }
        });
      });


      function imageIsLoaded(e) {
        $("#file").css("color","green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
      };

    });
  </script>

  </html>