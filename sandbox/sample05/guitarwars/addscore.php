<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ギターウォーズ：新しいハイスコアの追加</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>ギターウォーズ：新しいハイスコアの追加</h2>

	<?php
	require_once 'appvars.php';
	require_once 'connectvars.php';
	if (isset($_POST['submit'])) {
		// Grab the score data from the POST
		$name = $_POST['name'];
		$score = $_POST['score'];
		$screenshot = $_FILES['screenshot']['name'];
		$screenshot_type = $_FILES['screenshot']['type'];

		if (!empty($name) && !empty($score) && !empty($screenshot)) {
			if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
					&& ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
				if($_FILES['file']['error'] == 0){
					$target = GW_UPLOADPATH . $screenshot;
					if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)){
						// Connect to the database
						$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

						// Write the data to the database
						$query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
						mysqli_query($dbc, $query);

						// Confirm success with the user
						echo '<p>新しいハイスコアを追加していただきありがとうございます！</p>';
						echo '<p><strong>名前：</strong> ' . $name . '<br />';
						echo '<strong>スコア：</strong> ' . $score . '<br />';
						echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score image" /></p>';
						echo '<p><a href="index.php">&lt;&lt; ハイスコアリストへ戻る</a></p>';

						// Clear the score data to clear the form
						$name = "";
						$score = "";
						$screenshot = "";

						mysqli_close($dbc);
					}
				}else{
					echo '<p class="error">エラー：何らかの問題が発生しスクリーンショットのイメージをアップロードできませんでした。</p>';
				}
			}else{
				echo '<p class="error">エラー：スクリーンショットのファイルはGIF, JPEG, またはPNGイメージで、サイズは' . (GW_MAXFILESIZE / 1024) . ' KBよりも小さくなければなりません。</p>';
				@unlink($_FILES['screenshot']['tmp_name']);
			}
		}else {
			echo '<p class="error">エラー：入力項目をすべて埋めてからハイスコアを追加してください。</p>';
		}
	}
	?>

	<hr />
	<form enctype="multipart/form-data" method="post"
		action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="hidden" name="MAX_FILE_SIZE"
			value="<?php echo GW_MAXFILESIZE; ?>" /> <label for="name">名前：</label>
		<input type="text" id="name" name="name"
			value="<?php if (!empty($name)) echo $name; ?>" /><br /> <label
			for="score">スコア：</label> <input type="text" id="score" name="score"
			value="<?php if (!empty($score)) echo $score; ?>" /><br /> <input
			type="file" id="screenshot" name="screenshot" />
		<hr />
		<input type="submit" value="追加" name="submit" />
	</form>
</body>
</html>
