<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  
  if (!($_SESSION['auth_user']['perms'] & DOWNLOAD)) {
    $_SESSION['error_msg'] = "You do not have permission to view or download files.";
    header('Location: ./index.php');
    exit();
  }
  
  $dir = opendir(UPLOADDIR);
  $files = array();
  while ($file = readdir($dir)) {
    if ($file[0] != ".") {
      $filepath = UPLOADDIR . "/$file";
      $files[] = array("name" => $file, "path" => $filepath, "size" => filesize($filepath));
    }
  }
  
  $smarty->assign('files', $files);
  require_once './messages.inc';
  $smarty->display(TDIR . 'view_files.tpl');