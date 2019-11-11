<?php
session_start();
include("../config/config.php");

$username= $_SESSION["username"];
$postID = $_POST['postID'];

if(isset($_POST['save'])){

	$querycheck ="SELECT savedBlogs FROM user WHERE username = '$username'";
	$countrows = ($conn->query($querycheck))->num_rows;
	$res=$conn->query($querycheck);
	while($r=$res->fetch_assoc()){
		$temp = $r['savedBlogs'];
	}

	if($temp==""){
		$sql = "UPDATE user set savedBlogs = '$postID' where username='$username'";
		if ($conn->query($sql) === TRUE){
			echo "Record Updated successfully";
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{


		$parts = explode(',', $temp);
		for ($x = 0; $x < count($parts); $x++) {
			if($parts[$x]==$postID)
				exit();
		}
		$temp=$temp.",".$postID;
		$sql = "UPDATE user set savedBlogs = '$temp' where username='$username'";
		if ($conn->query($sql) === TRUE){
			echo "Record Updated successfully";
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


}else{


	$querycheck ="SELECT savedBlogs FROM user WHERE username = '$username'";
	$countrows = ($conn->query($querycheck))->num_rows;
	$res=$conn->query($querycheck);
	while($r=$res->fetch_assoc()){
		$temp = $r['savedBlogs'];
	}

	if($temp!=""){
		$parts = explode(',', $temp);
		$res='';
		$c=0;
		for ($x = 0; $x < count($parts); $x++) {
			if($parts[$x]!=$postID){
				if($c==0){
					$res = $res.$parts[$x];
					$c++;
				}else{
					$res = $res.",".$parts[$x];
				}
				
			}
		}
		
		$sql = "UPDATE user set savedBlogs = '$res' where username='$username'";
		if ($conn->query($sql) === TRUE){
			echo "Record Updated successfully";
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


}


?>