<?php
session_start();
include("../config/config.php");

$pass=$_POST["pass4"];
$new=$_POST["phone"];
$username=$_SESSION["username"];


$sql="Select password from user where username = '$username' and password='$pass'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        
		$sql = "UPDATE user SET phone='$new' WHERE username='$username'";

		if ($conn->query($sql) === TRUE) {
			// $_SESSION["password"]=$new;
		} else {
		    // echo "Error updating record: " . $conn->error;
		}
      header("Location: ../templates/settings.php");  
    }
   
   else{
   	$_SESSION["updateFail"]=1; 
   	header("Location: ../templates/settings.php"); 
   }

?>