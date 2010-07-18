<?php
  require_once('/Applications/MAMP/smarty/Smarty.class.php');
  $smarty = new Smarty();
  
  $smarty->template_dir = './templates';
  $smarty->compile_dir = './templates_c';
  $smarty->cache_dir = './cache';
  $smarty->config_dir = './configs';
?>