<head>
  <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  {include file=$header}

  <div class="label">Create User</div>

  <form action="{$smarty.server.PHP_SELF}" method="POST">
    <div class="row">
      <div class="col">Login</div>
      <div><input type="text" name="login"></div>
    
      <div class="col">Password</div>
      <div><input type="password" name="pw1"></div>
    
      <div class="col">Retype Password</div>
      <div><input type="password" name="pw2"></div>
    
      <div class="col">Permissions</div>
      <div><input type="text" name="perms"></div>
    </div>
    <div><input type="Submit" value="Create" /></div>
  </form>

  {include file=$footer}
</body>