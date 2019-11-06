<?php
include("../config/db_connect.php");
require '../phpmailer/PHPMailerAutoload.php';
require_once('../phpmailer/class.phpmailer.php');
include("../phpmailer/class.smtp.php");

$name = $_GET['name'];
$user1 = $_GET['user1'];
$user2 = $_GET['user2'];
$email1 = $_GET['email1'];

$to;
$subject = "A WordFlow user requested for meetup";
$message = "Dear $user2,

            $user1 requested you for meet up.
            Contact him at $email1 for further details.....
            
            ";
 
$sql = "SELECT email from user where username = '$user2'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
    while($row = $result->fetch_assoc()) 
        $to = $row['email'];

$mail = new PHPMailer();
$mail ->IsSmtp();
$mail ->SMTPDebug = 0;
$mail ->SMTPAuth = true;
$mail ->SMTPSecure = 'ssl';
$mail ->Host = 'smtp.gmail.com';
$mail ->Port = 465; // or use 587
// Now set username & password as website email username and password....
$mail->Username = "codeintegrate1999@gmail.com";
$mail ->Password = "code@123";
// from whom it is being sent....
$mail ->SetFrom("codeintegrate1999@gmail.com");
$mail ->Subject = $subject;
$mail ->Body = $message;
$mail ->AddAddress($to);

if(!$mail ->Send())
    echo "Invitation Failed....!";
else
    echo "Invitation sent successfully to $user2...!";
       

?>