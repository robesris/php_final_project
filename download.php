<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  
  if (!($_SESSION['auth_user']['perms'] & ADMIN)) {
    $_SESSION['error_msg'] = "You do not have permission to download files.";
    header('Location: ./index.php');
    exit();
  }
  
  $filepath = UPLOADDIR . "/" . $_GET['dl'];

  header('Content-Description: File Transfer');
  header('Content-Length' ) . filesize($filepath);
  header('Content-Disposition: attachment; filename=' . basename($filepath));
?>