<?php
session_start();
//login error status set to 0 initially
$_SESSION["loginFail"]=0;
//config inclusion
$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "1234";
    $dbname = "wordflow";
  
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }

//Google SignIn
if(isset($_POST["googleSignIn"])){
    $email=$_POST["email"];
    $sql="Select user_id from user where email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $user_id=$row["user_id"];
    }
    $_SESSION["name"]=$_POST["name"];
    $_SESSION["pic"]=$_POST["pic"];
    $_SESSION["user_id"]=$user_id;
    header("Location: dashboard.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: landing.php");
        echo "fail";
    }
}

//Normal SignIn
if(!isset($_POST["googleSignIn"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="Select user_id, firstname, lastname from user where username = '$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()) {
            $user_id=$row["user_id"];
            $fname=$row["firstname"];
            $lname=$row["lastname"];
    }
    $_SESSION["name"]=$fname." ".$lname;
    $_SESSION["user_id"]=$user_id;
    header("Location: dashboard.php");
    }
    else{
        $_SESSION["loginFail"]=1;
        header("Location: landing.php");
    }
}
