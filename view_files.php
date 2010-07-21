<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  
  $dir = opendir(UPLOADDIR);
  $files = array();
  while ($file = readdir($dir)) {
    if ($file[0] != ".") {
      $filepath = UPLOADDIR . "/$file";
      $files[] = array("name" => $file, "path" => $filepath, "size" => filesize($filepath));
    }
  }
  
  $smarty->assign('files', $files);
  $smarty->display(TDIR . 'view_files.tpl');
?>