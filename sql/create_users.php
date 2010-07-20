<?php
/* Open a connection */
$mysqli = new mysqli("localhost", "root", "root", "myshare");

/* check connection */
if (mysqli_connect_errno())
{
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$ret = $mysqli->query("create table users (
                       id int AUTO_INCREMENT PRIMARY KEY,
                       login varchar(64) NOT NULL,
                       first varchar(64),
                       last varchar(64),
                       perms int NOT NULL,
                       pass_hash varchar(32) NOT NULL);");
                       
if (!$ret)
{
  printf("Error occurred creating users table: %s", $mysqli->error);
  exit;
}

/* close connection */
$mysqli->close();

?>
