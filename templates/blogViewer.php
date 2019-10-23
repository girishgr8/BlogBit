<?php
session_start();
include ('../config/db_connect.php');
$path = $_GET['path'];
?>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
	var path=<?php echo json_encode($path);?>;
	 $(function(){
      $("body").load("../Blogs/"+path+".html"); 
    });
</script>


<!DOCTYPE html>
<html>
<head>
	<title>Blog Viewer</title>
</head>
<body>

</body>
</html>