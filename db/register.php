<?php
session_start();
include("../config/config.php");

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$dt = $_POST['bday'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country= $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$street = $_POST['street'];
$pincode = $_POST['pincode'];



     $SELECT = "SELECT email from user where email = ? Limit 1";
     $SELECT2 = "SELECT username from user where username = ? Limit 1";
     $INSERT = "INSERT into user (username, firstname, middlename, lastname, password, gender, email, phone, country,state, city, street, pincode, DOB) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     $stmt2 = $conn->prepare($SELECT2);
     $stmt2->bind_param("s", $username);
     $stmt2->execute();
     $stmt2->bind_result($username);
     $stmt2->store_result();
     $rnum2 = $stmt2->num_rows;
     if ($rnum==0 && $rnum2==0) {
      $stmt->close();
      $stmt2->close();
      $stmt = $conn->prepare($INSERT); 
      $stmt->bind_param("sssssssissssis", $username, $firstname, $middlename, $lastname, $password, $gender, $email, $phone, $country, $state, $city, $street, $pincode, $dt );
      $stmt->execute();
      echo "New record inserted sucessfully";
    
     } else {
      echo '<script language="javascript">';
    echo 'alert("Username or Email already in use.")';
    echo '</script>';
     }
     $stmt->close();
     
   
        $_SESSION["name"]=$firstname." ".$lastname;
        $_SESSION["username"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["password"]=$password;
         header("Location: ../templates/dashboard.php");


?>