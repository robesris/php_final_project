<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  {include file=$header}
  {$upload_error_div}

  <div class="row bold">
    <div class="col">Name</div>
    <div class="col">Size in Bytes</div>
  </div>
  {foreach from=$files item=file}
    <div class="row">
      <div class="file col"><a href="{$file.path}">{$file.name}</a></div>
      <div class="col">{$file.size}</div>
    </div>
  {/foreach}

  {include file=$footer}
</body>