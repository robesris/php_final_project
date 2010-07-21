<?php
  session_start();
  
  if (basename($_SERVER['PHP_SELF']) != 'index.php' && !($_SESSION['auth_user'])) {
    $_SESSION['error_msg'] = "Please log in.";
    header('Location: ./index.php');
    exit();
  }