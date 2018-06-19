<?php

session_start();

if (!isset($_SESSION["Auth_id"]) || $_SESSION["Auth_id"] == 0) {
  
    header("Location: ../Views/login.php");
    exit();
    
}

?>