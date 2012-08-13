<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ギターウォーズ：ハイスコアの削除</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>ギターウォーズ：ハイスコアの削除</h2>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
  }
  else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
  }
  else {
    echo '<p class="error">エラー：削除するハイスコアが指定されていません。</p>';
  }

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Delete the screen shot image file from the server
      @unlink(GW_UPLOADPATH . $screenshot);

      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

      // Delete the score data from the database
      $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);

      // Confirm success with the user
      echo '<p>' . $name . 'のハイスコア：' . $score . 'を削除しました。';
    }
    else {
      echo '<p class="error">ハイスコアは削除されませんでした。</p>';
    }
  }
  else if (isset($id) && isset($name) && isset($date) && isset($score)) {
    echo '<p>以下のハイスコアを削除します。よろしいですか？</p>';
    echo '<p><strong>名前： </strong>' . $name . '<br /><strong>日付： </strong>' . $date .
      '<br /><strong>スコア： </strong>' . $score . '</p>';
    echo '<form method="post" action="removescore.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> はい ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> いいえ <br />';
    echo '<input type="submit" value="削除" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="score" value="' . $score . '" />';
    echo '</form>';
  }

  echo '<p><a href="admin.php">&lt;&lt; 管理画面へ戻る</a></p>';
?>

</body> 
</html>
