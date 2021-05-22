<?php
//データベースへの接続
try 
{
  $dsn = 'mysql:dbname="DB名";host=localhost;charset=utf8';
  $user = 'ユーザー名';
  $pass = 'パスワード';
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) 
{
  echo 'ただいま障害によりご迷惑をおかけしております';
  exit();
}

?>
