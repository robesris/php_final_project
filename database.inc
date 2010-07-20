<?php
  function open_db() {
    return new mysqli("localhost", "root", "root", "myshare");
  }
