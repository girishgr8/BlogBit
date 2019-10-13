<?php

 session_start();
 session_destroy();
 echo "logged out";

 header("Location: ../index.php");
 exit();
 
?>