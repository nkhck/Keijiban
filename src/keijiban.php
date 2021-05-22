<?php
//セッションの開始
session_start();
//クリックジャッキング対策
header('X-FRAME-OPTIONS:DENY');
//CSRF対策-トークンの発行
if (empty($_SESSION['token'])) {
  $token = bin2hex(random_bytes(24));
  $_SESSION['token'] = $token;
}
//xss対策
require('xss.php');
//DB接続
require('db_connect.php');
//SQLの実行
$sql = 'SELECT * FROM msf_keijiban';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メッセージ入力と一覧画面</title>
</head>

<body>
  <!--メッセージ一覧表示-->
  <?php
  if (!empty($messages)) {
    foreach ($messages as $message) {
      echo $message['code'] . '. ' . $message['name'] . '. ' . $message['time'] . '<br>';
      echo $message['message'] . '<br><br>';
    }
  } else {
    echo '投稿はまだありません';
  }

  ?>
  <br><br><br><br><br><br><br><br><br><br><br><br>
  <!--投稿フォーム-->
  <form action="keijiban_post.php" method="POST">
    名前(任意です)<br>
    <input type="text" name="name"><br>
    メッセージ投稿<br>
    <textarea name="message"></textarea>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="submit" value="投稿">
  </form>

</body>

</html>