<?php
  define('UPLOADDIR', './files');
  
  # The directory containing all the templates for this project
  define('TDIR', './');
  
  $smarty->assign('header', TDIR . 'header.tpl');
  $smarty->assign('footer', TDIR . 'footer.tpl');
?>
