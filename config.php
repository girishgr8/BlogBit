<?php

/*___________________Blog Folder and blogForegroundImages Folder Path_________________*/

$path = "../../WordflowData/";

/*___________________________GOOGLE AUTH CONFIGURATIONS_______________________________*/


$authKey = "431755900850-hj63duh4igs0cmhig2tke2t6h0c0gk0g.apps.googleusercontent.com";

/*___________________________TinyMCE CONFIGURATIONS___________________________________*/

$editorKey = "0rp9qijguo688adw7ay49oq2h5aexu3w8vp66bh38k8hpzls";

/*___________________________HEREMaps CONFIGURATIONS__________________________________*/

$app_id='zeI2BlhgRBZQiOrhtS1i';
$app_code = 'tS_8ziIKRg9jQkw_4lmezw';


/*___________________________DATABASE CONFIGURATIONS__________________________________*/

//Specify Credentials
$servername = "localhost";
$username = "root";
$password = "1234";
$port = 3306;
$dbname = 'wordflow3';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname,$port);

//Create Tables if Not Exists
//Create User Table
$querycheck='SELECT * FROM `user`';
$query_result=$conn->query($querycheck);
if(!$query_result){
	$sql = "CREATE TABLE `user` (
  `firstname` varchar(35) NOT NULL,
  `middlename` varchar(35) DEFAULT NULL,
  `lastname` varchar(35) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `city` varchar(35)  NOT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(35)  NOT NULL,
  `street` varchar(35) NOT NULL,
  `pincode` int(6) NOT NULL,
  `DOB` date NOT NULL,
  `savedBlogs` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`)
)";

if ($conn->query($sql) === TRUE) {
	//echo "Table user created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}
}


//Create blog Table
$querycheck='SELECT * FROM blog';
$query_result=$conn->query($querycheck);
if(!$query_result){
	$sql = "CREATE TABLE `blog` (
  `blogID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `disclaimer` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`blogID`,`username`)
)";

if ($conn->query($sql) === TRUE) {
	//echo "Table blog created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}
}

//Create meetup table
$querycheck='SELECT * FROM meetup';
$query_result=$conn->query($querycheck);
if(!$query_result){
	$sql = "CREATE TABLE `meetup` (
  `username` varchar(20) DEFAULT NULL,
  `sentBy` varchar(20) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `mailDate` varchar(20) DEFAULT NULL,
  `mailTime` varchar(20) DEFAULT NULL
) ";

if ($conn->query($sql) === TRUE) {
	//echo "Table meetup created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}
}


//Create comments table
$querycheck='SELECT * FROM comments';
$query_result=$conn->query($querycheck);
if(!$query_result){
	$sql = "CREATE TABLE `comments` (
  `blogID` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `comment` varchar(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
	//echo "Table comments created successfully";
} else {
	//echo "Error creating table: " . $conn->error;
}
}

?>
