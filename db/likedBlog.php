<?php
session_start();
include("../config/config.php");

$username= $_SESSION["username"];
$postID = $_POST['postID'];
$creator = $_POST['creator'];
$title = $_POST['title'];
if(isset($_POST['like'])){
    $likes = 0 ;
	$sql ="SELECT likes FROM blog WHERE username = '$creator' AND title = '$title'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
        while($row = $result->fetch_assoc()) 
            $likes = $row['likes'];
    echo $likes."\n";
    $likes = $likes+1;
    $sql ="UPDATE blog set likes = $likes WHERE username = '$creator' AND title = '$title'";
    $res=$conn->query($sql);
    echo $likes."\n";
    
    $querycheck ="SELECT likedBlogs FROM user WHERE username = '$username'";
	$countrows = ($conn->query($querycheck))->num_rows;
	$res=$conn->query($querycheck);
	while($r=$res->fetch_assoc()){
		$temp = $r['likedBlogs'];
	}
	if($temp==""){
		$sql = "UPDATE user set likedBlogs = '$postID' where username='$username'";
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
		$sql = "UPDATE user set likedBlogs = '$temp' where username='$username'";
		if ($conn->query($sql) === TRUE){
			echo "Record Updated successfully";
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
else{
    $sql ="SELECT likes FROM blog WHERE username = '$creator' AND title = '$title'";
    $likes = 0 ;
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
        while($row = $result->fetch_assoc()) 
            $likes = $row['likes'];
    $likes = $likes-1;
    $sql ="UPDATE blog set likes = $likes WHERE username = '$creator' AND title = '$title'";
    $res=$conn->query($sql);
    echo $likes."\n";
    $querycheck ="SELECT likedBlogs FROM user WHERE username = '$username'";
	$countrows = ($conn->query($querycheck))->num_rows;
	$res=$conn->query($querycheck);
	while($r=$res->fetch_assoc()){
		$temp = $r['likedBlogs'];
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
		$sql = "UPDATE user set likedBlogs = '$res' where username='$username'";
		if ($conn->query($sql) === TRUE){
			echo "Record Updated successfully";
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
?>