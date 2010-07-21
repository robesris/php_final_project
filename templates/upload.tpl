<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  {include file=$header}
  <div id="upload_form">
    <form enctype="multipart/form-data" action="{$smarty.server.PHP_SELF}" method="POST">
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
  {include file=$footer}
</body>
