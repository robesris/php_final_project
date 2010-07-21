<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  {include file=$header}

  <div>
    <div class="row bold">
      <div class="col">Login</div>
      <div class="col">Password</div>
    </div>
    <form action="{$smarty.server.PHP_SELF}" method="POST">
      <div class="row">
        <div class="col"><input type="text" name="login" /></div>
        <div class="col"><input type="password" name="pw" /></div>
      </div>
      <div class="clear"><input type="Submit" value="Login" /></div>
    </form>
  </div>

  {include file=$footer}
</body>