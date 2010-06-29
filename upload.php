<?php
  require_once './common.inc';
  require_once './constants.inc';
  
  session_start();
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
    }
  }
?>
<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>  
  <?php include './header.inc'; ?>
  <?php if ($_SESSION['upload_error_msg']): ?>
    <div class="error"><?php echo $_SESSION['upload_error_msg']; ?></div>
    <?php $_SESSION['upload_error_msg'] = ""; ?>
  <?php endif ?>
  <div id="upload_form">
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="question">
        <label for="file_ul">Choose a file to upload.</label>
        <div>
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
          <input type="file" name="file_ul" id="file_ul" />
        </div>
      </div>
  
      <input type="submit" name="submit" value="Upload" />
    </form>
  </div>
  <?php include './footer.inc'; ?>
</body>
