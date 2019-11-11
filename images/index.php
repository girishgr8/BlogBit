<?php
session_start();
if(isset($_SESSION['username'])){

	header("Location: ../templates/dashboard.php");

}else{

	header("Location: ../index.php");
}

?>
