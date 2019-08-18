<?php
session_start();
//login error status set to 0 initially
$_SESSION["loginFail"]=0;
//config inclusion
include ('../config/db_connect.php');

//Google SignIn
if(isset($_POST["googleSignIn"])){
    $email=$_POST["email"];
    $sql="Select userID from user where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $userID=$row["userID"];
    }
    $_SESSION["name"]=$_POST["name"];
    $_SESSION["pic"]=$_POST["pic"];
    $_SESSION["userID"]=$userID;
    header("Location: ../templates/blogEditor.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: ../index.php");
    }
}

//Normal SignIn
if(!isset($_POST["googleSignIn"])){
    $username=$_POST["usrnm"];
    $password=$_POST["psw"];
    $sql="Select userID,fname,lname from user where username = '$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $userID=$row["userID"];
            $fname=$row["fname"];
            $lname=$row["lname"];
    }
    $_SESSION["name"]=$fname." ".$lname;
    $_SESSION["userID"]=$userID;
    header("Location: ../templates/blogEditor.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: ../index.php");
    }
}

