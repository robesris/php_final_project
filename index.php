<?php
  session_start();
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  require_once './database.inc';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Try to log in user
    $db = open_db();
    $sql = $db->prepare("SELECT login, first, last, perms, pass_hash FROM users WHERE login = ? AND pass_hash = ?;");
    $post_login = $_POST['login'];
    $post_pw = $_POST['pw'];
    $sql->bind_param('ss', $post_login, md5($post_pw));
    $sql->execute();
    $sql->bind_result($login, $first, $last, $perms, $pass_hash);
    if (!$sql->fetch()) {
      # Bad login
      $_SESSION['error_msg'] = 'Bad login. Try again.';
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $_SESSION['auth_user'] = array('login' => $login,
                                     'first' => $first,
                                     'last'  => $last,
                                     'perms' => $perms);
      $_SESSION['msg'] = "You have been successfully logged in.";
      if ($perms | ADMIN) {
        header('Location: ./admin_create_user.php');
      } elseif ($perms | DOWNLOAD) {
        header('Location: ./view_files.php');
      } elseif ($perms | UPLOAD) {
        header('Location: ./upload.php');
      } else {
        $_SESSION['msg'] = "You have been logged in, but don't have permission to do ANYTHING!";
        header('Location: ' . $_SERVER['PHP_SELF']);
      }
      exit();
    }
  }
  
  $smarty->assign('error_msg', $_SESSION['error_msg']);
  $smarty->assign('msg', $_SESSION['msg']);
  $_SESSION['error_msg'] = "";
  $_SESSION['msg'] = "";
  $smarty->display(TDIR . 'index.tpl');