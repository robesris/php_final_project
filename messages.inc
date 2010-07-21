<?php
  $smarty->assign('error_msg', $_SESSION['error_msg']);
  $smarty->assign('msg', $_SESSION['msg']);
  $_SESSION['error_msg'] = "";
  $_SESSION['msg'] = "";
