<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  require_once './database.inc';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pw1   = $_POST['pw1'];
    $pw2   = $_POST['pw2'];
    if ($login && $pw1 && $pw2) {
      if ($pw1 == $pw2) {
        $pw_hash = md5($pw1);
        $db = open_db();
        $result = $db->query("SELECT login FROM users WHERE login='$login';");
        if (!$result->fetch_row()) {
          # Unique login and matching password - go ahead and create user
          $perms = $_POST['perms'] ? $_POST['perms'] : DOWNLOAD;
          $sql = $db->prepare("INSERT INTO users (login, perms, pass_hash) VALUES ('$login', $perms, '$pw_hash');");
          $sql->execute();
          $_SESSION['msg'] = "User created!";
          header('Location: ' . $_SERVER['PHP_SELF']);
          exit();
        } else {
          $error_msg = "Username already taken.";
        }
      } else {
        $error_msg = "Passwords did not match.";
      }
    } else {
      $error_msg = "Please fill in all required fields.";
    }
    $_SESSION['error_msg'] = $error_msg;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }
  
  $smarty->assign('error_msg', $_SESSION['error_msg']);
  $smarty->assign('msg', $_SESSION['msg']);
  $_SESSION['error_msg'] = '';
  $_SESSION['msg'] = '';
  $smarty->display(TDIR . 'admin_create_user.tpl');
