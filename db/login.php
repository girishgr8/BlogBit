<?php
session_start();
include("../config/db_connect.php");
//login error status set to 0 initially
$_SESSION["loginFail"]=0;
//config inclusion
/*$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "wordflow";
  
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }*/

//Google SignIn
if(isset($_POST["googleSignIn"])){
    $email=$_POST["email"];
    $sql="Select username from user where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $username=$row["username"];
    }
    $_SESSION["name"]=$_POST["name"];
    $_SESSION["pic"]=$_POST["pic"];
    $_SESSION["username"]=$username;
    header("Location: ../templates/dashboard.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: ../index.php");
        echo "fail";
    }
}

//Normal SignIn
if(!isset($_POST["googleSignIn"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="Select username, firstname, lastname from user where username = '$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $username=$row["username"];
            $fname=$row["firstname"];
            $lname=$row["lastname"];
    }
    $_SESSION["name"]=$fname." ".$lname;
    $_SESSION["username"]=$username;
    header("Location: ../templates/dashboard.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: ../index.php");
    }
}