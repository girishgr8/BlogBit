<?php
session_start();
include("../config/config.php");

date_default_timezone_set('Asia/Kolkata');
$username= $_SESSION["username"];
echo $username;
$blogID = $_POST['blogID'];
$datee = date("Y-m-d H:i:s");
$comment = $_POST['comm'];

// $querycheck ="SELECT * FROM blog WHERE username = '$username' and title = '$title'";
// $countrows = ($conn->query($querycheck))->num_rows;


  $sql = "INSERT INTO comments(blogID,username,comment,date) values('{$blogID}','{$username}','{$comment}','{$datee}')";
   if ($conn->query($sql) === TRUE){

    echo "Record Updated successfully";
    echo $blogID;
    echo $comment;
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  	header("location:javascript:./blogViewer.php?path='".$blogID."'"); 


?>