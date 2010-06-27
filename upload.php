<?php
  require_once './common.inc';
  
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    if ($_FILES['file_ul']['tmp_name']):
      $file = $_FILES['file_ul'];
      $tmp = $file['tmp_name'];
      $name = $file['name'];
      if (move_uploaded_file($tmp, "./files/$name")): ?>
        <div>You successfully uploaded "<?php print($name); ?>".</div>
      <?php else: ?>
        <div>File did not upload successfully!</div>
      <?php endif;
    endif;
  endif;
  // logout();
?>
<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>  
  <?php include './header.inc'; ?>
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
