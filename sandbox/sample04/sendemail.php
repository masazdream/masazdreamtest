<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis：メール送信</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
  $from = 'seino@makemeelvis.com';
  $subject = $_POST['subject'];
  $text = $_POST['elvismail'];

  $dbc = mysqli_connect('data.makemeelvis.com', 'seino', 'theking', 'elvis_store')
    or die('エラー：MySQLサーバとの接続に失敗しました。');

  $query = "SELECT * FROM email_list";
  $result = mysqli_query($dbc, $query)
    or die('エラー：データベース問い合わせに失敗しました。');

  while ($row = mysqli_fetch_array($result)){
    $last_name = $row['last_name'];
    $first_name = $row['first_name'];
    $msg = "$last_name $first_name さん,\n$text";
    $to = $row['email'];

    mb_internal_encoding("UTF-8");
    mb_send_mail($to, $subject, $msg, 'From:' . $from);
    echo 'メールを' . $to . 'へ送信しました。<br />';
  } 
  mysqli_close($dbc);
?>

</body>
</html>
