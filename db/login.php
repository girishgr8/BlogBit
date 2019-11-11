<?php
session_start();
include("../config/config.php");

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
    $sql="Select username, password from user where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $username=$row["username"];
            $password=$row["password"];
    }
    // $_SESSION["name"]=$_POST["name"];
    // $_SESSION["pic"]=$_POST["pic"];
    $_SESSION["username"]=$username;

    //need middle name 
    $sql="Select middlename, firstname, lastname from user where username = '$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $middlename=$row["middlename"];
            $fname=$row["firstname"];
            $lname=$row["lastname"];
        }
    }
    $_SESSION["name"]=$fname." ".$middlename." ".$lname;
    $_SESSION["username"]=$username;
    $_SESSION["email"]=$email;
    $_SESSION["password"]=$password;

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
    $sql="Select username, email, middlename, firstname, lastname from user where username = '$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $username=$row["username"];
            $email = $row["email"];
            $middlename=$row["middlename"];
            $fname=$row["firstname"];
            $lname=$row["lastname"];
    }
    $_SESSION["name"]=$fname." ".$middlename." ".$lname;
    $_SESSION["username"]=$username;
    $_SESSION["email"]=$email;
    $_SESSION["password"]=$password;
    header("Location: ../templates/dashboard.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: ../index.php");
    }
}