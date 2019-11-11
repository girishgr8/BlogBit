<?php
session_start();
include("../config/config.php");

$username= $_SESSION["username"];
$disclaimer=$_POST['disclaimer'];
$title=$_POST['title'];



$querycheck ="SELECT * FROM blog WHERE username = '$username' and title = '$title'";
$countrows = ($conn->query($querycheck))->num_rows;

if($countrows==0){
	$sql = "INSERT INTO blog(username,title,disclaimer) values('{$username}','{$title}','{$disclaimer}')";
	if ($conn->query($sql) === TRUE){
		echo "Record Updated successfully";
	} else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}else{
	$sql = "UPDATE blog set disclaimer = '$disclaimer' WHERE username = '$username' and title = '$title'";
	if ($conn->query($sql) === TRUE){
		echo "Record Updated successfully";
	} else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>