<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis：メールアドレス削除</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
  $dbc = mysqli_connect('data.makemeelvis.com', 'seino', 'theking', 'elvis_store')
    or die('エラー：MySQLサーバとの接続に失敗しました。');

  $email = $_POST['email'];

  $query = "DELETE FROM email_list WHERE email = '$email'";
  mysqli_query($dbc, $query)
    or die('エラー：データベースの問い合わせに失敗しました。');

  echo 'メールアドレス：' . $email . 'を削除しました。';

  mysqli_close($dbc);
?>

</body>
</html>
