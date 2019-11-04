<?php
session_start();
include ('../config/db_connect.php');
$path = $_GET['path'];
$parts = explode('_', $path);
$title=$parts[1];

?>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../styles/blogViewer.css">
<script type="text/javascript">
	var path=<?php echo json_encode($path);?>;
	var path2= path.replace(' ', '%20');
	$(function(){
		$("#blogContent").load("../Blogs/"+path2+".html"); 
	});
</script>


<!DOCTYPE html>
<html>
<head>
	<title>Blog Viewer</title>
</head>
<body >
	<h1><?php echo $title; ?></h1>
	<div id="blogContent" >

	</div>
</body>
</html>