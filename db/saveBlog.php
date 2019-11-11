<?php
session_start();
include("../config/config.php");

$username= $_SESSION["username"];
$blog=$_POST['blog'];
$title=$_POST['title'];

$filename = $username.'_'.$title.".html";

file_put_contents($path.'Blogs/'.$filename, $blog);

$querycheck ="SELECT * FROM blog WHERE username = '$username' and title = '$title'";
$countrows = ($conn->query($querycheck))->num_rows;

if($countrows==0){
  $sql = "INSERT INTO blog(username,title) values('{$username}','{$title}')";
   if ($conn->query($sql) === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


?>