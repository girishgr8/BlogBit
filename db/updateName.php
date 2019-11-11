<?php
session_start();
include("../config/config.php");

$pass=$_POST["pass2"];
$username=$_SESSION["username"];
$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$name=$fname." ".$mname." ".$lname;


$sql="Select password from user where username = '$username' and password='$pass'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        
		$sql = "UPDATE user SET firstname='$fname', middlename='$mname', lastname='$lname' WHERE username='$username'";

		if ($conn->query($sql) === TRUE) {
			$_SESSION["name"]=$name;
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