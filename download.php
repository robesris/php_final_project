<?php
  require_once './common.inc';
  require_once('./smarty_connect.php');
  require_once './constants.inc';
  #echo UPLOADDIR . "/" . $_GET['dl'];
  $filepath = UPLOADDIR . "/" . $_GET['dl'];

  header('Content-Description: File Transfer');
  header('Content-Length' ) . filesize($filepath);
  header('Content-Disposition: attachment; filename=' . basename($filepath));
?>