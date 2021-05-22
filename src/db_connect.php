<?php
//データベースへの接続
try 
{
  $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'root';
  $pass = 'root';
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) 
{
  echo 'ただいま障害によりご迷惑をおかけしております';
  exit();
}

?>