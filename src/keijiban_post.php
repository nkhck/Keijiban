<?php
//セッションの開始
session_start();
//タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');
//XSS対策
require('xss.php');
//エラーチェック
if (!empty($_POST)) {
  if (empty($_POST['message'])) {
    header('Location:keijiban.php');
    exit();
  }
  //CSRF-トークンチェック
  if (empty($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
    header('Location:keijiban.php');
  }    
}
else {
  header('Location:keijiban.php');
  exit();
}
$message = h($_POST['message']);
if (empty($_POST['name'])) {
  $name = '名無しさん';
}
else {
  $name = h($_POST['name']);
}
require('db_connect.php');
$sql = 'INSERT INTO msf_keijiban(message,name,time) VALUES (?, ?, ?)';
$stmt = $dbh->prepare($sql);
$data[] = $message;
$data[] = $name;
$data[] = date("Y-m-d H:i:s");
$stmt->execute($data);
$dbh = null;

header('Location:keijiban.php');
exit();
?>
