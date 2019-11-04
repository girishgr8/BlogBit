<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>

 <!--Google Client ID-->
 <script src="https://apis.google.com/js/platform.js" async defer></script>
 <meta name="google-signin-client_id" content="431755900850-hj63duh4igs0cmhig2tke2t6h0c0gk0g.apps.googleusercontent.com" />
 <!--Including Editor API-->
 <script src="https://cdn.tiny.cloud/1/0rp9qijguo688adw7ay49oq2h5aexu3w8vp66bh38k8hpzls/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 <script
 src="https://code.jquery.com/jquery-3.4.1.min.js"
 integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
 crossorigin="anonymous"></script>

 <link rel="stylesheet" type="text/css" href="../styles/blogEditorStyle.css">

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
  .tox .tox-statusbar__path {
    display: none;
  }

  a {
    display: none;
  }

</style>

</head>

<body>


  <input placeholder="Enter your blog title" id="title" style="height: 50px; width: 900px; font-size: 45px;">
  <br>
  <hr>
  <br>

  <!--Editor Area Starts-->
  <div>
    <textarea id="mytextarea" name="mytextarea" style="height: 500px;"></textarea>
  </div>
  <!--Editor Area Ends-->
  <hr>
  <!--Foreground Image div Starts-->
  <div style="margin-top: 40px;">
    Select a foreground tile image for your blog
    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
      <div id="image_preview" style="text-align: center;">
        <img id="previewing" src="../images/noimage.png" /><br></div>
        <div>
          <input type="file" name="file" id="file" required /> <br>       
          <input type="submit" value="Upload" class="submit" />
        </div>

      </form>
    </div>
    <!--Foreground Image div Ends-->
    <hr>
    <!--Disclaimer div Starts-->
    <div style="margin-top: 60px;">
      Write a disclaimer for your blog
      <form id="blogDisclaimer">
        <input type="text" name="disclaimer"  id="disclaimer" required style="height: 200px; width: 500px;" /><br>
        <input type="submit" value="Save disclaimer" class="submit" />
      </form>
    </div>
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