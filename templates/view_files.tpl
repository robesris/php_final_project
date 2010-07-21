<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  {include file=$header}

  <div class="row bold">
    <div class="col">Name</div>
    <div class="col">Size in Bytes</div>
  </div>
  {foreach from=$files item=file}
    <div class="row">
      <div class="file col"><a href="./download.php?dl={$file.name}">{$file.name}</a></div>
      <div class="col">{$file.size}</div>
    </div>
  {/foreach}

  {include file=$footer}
</body>