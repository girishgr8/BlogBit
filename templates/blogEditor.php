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
        var title = prompt("Confirm the title for your blog","mytitle");
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


    <!--Editor Area-->
    <form >
        <textarea id="mytextarea" name="mytextarea" style="height: 500px;"></textarea>
    </form>

</body>

</html>