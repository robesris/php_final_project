<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  
  if (!($_SESSION['auth_user']['perms'] & UPLOAD)) {
    $_SESSION['error_msg'] = "You do not have permission to upload files.";
    header('Location: ./index.php');
    exit();
  }
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['file_ul']['tmp_name']) {
      $file = $_FILES['file_ul'];
      $tmp = $file['tmp_name'];
      $basename = preg_replace('/[^A-Za-z0-9_]/', '_', $file['name']);
      $name = $basename;
      $dupnum = 0;
      while (file_exists(UPLOADDIR . "/$name")) {
        $dupnum++;
        $name = $basename . "_$dupnum";
      }
      if (move_uploaded_file($tmp, UPLOADDIR . "/$name")) {
        $_SESSION['upload_ok'] = true;
        $_SESSION['upload_name'] = $name;
        header("Location: " . dirname($_SERVER['PHP_SELF']) . "/success.php");
        exit();
      } else {
        $_SESSION['upload_error_msg'] = "Your file did NOT upload successfully!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      }
    } else {
      $_SESSION['upload_error_msg'] = "Your file did NOT upload successfully!";
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }
  }
  

  require_once './messages.inc';
  $smarty->display(TDIR . 'upload.tpl');
?>
