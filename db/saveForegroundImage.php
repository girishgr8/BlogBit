<?php
session_start();
include("../config/config.php");
$username= $_SESSION["username"];
$title=$_POST['title'];
//$title="kjbkjb";
$filename="";

if(isset($_FILES["file"]["type"]))
{
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
)&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else
		{

			$filename = $username.'_'.$title.".".$file_extension;


$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = $path."blogForegroundImages/".$filename; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file


}
}

}
?>