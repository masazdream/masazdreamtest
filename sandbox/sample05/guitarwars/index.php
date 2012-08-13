<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ギターウォーズ：ハイスコア</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>ギターウォーズ：ハイスコア</h2>
	<p>
		ようこそギターウォーズ競争へ！ハイスコアリストより勝っていますか？では<a href="addscore.php">スコアを入力してください</a>。
	</p>
	<hr />

	<?php
	require_once 'appvars.php';
	require_once 'connectvars.php';
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// Retrieve the score data from MySQL
	$query = "SELECT * FROM guitarwars order by score desc, date asc";
	$data = mysqli_query($dbc, $query);

	// Loop through the array of score data, formatting it as HTML
	echo '<table>';
	$i = 0;
	while ($row = mysqli_fetch_array($data)) {
		if($i == 0){
			echo '<tr><td colspan="2" class="topscoreheader">トップスコア:' . $row['score'] . '</td></tr>';
		}
		
		// Display the score data
		echo '<tr><td class="scoreinfo">';
		echo '<span class="score">' . $row['score'] . '</span><br />';
		echo '<strong>名前：</strong> ' . $row['name'] . '<br />';
		echo '<strong>日付：</strong> ' . $row['date'] . '</td>';
		$screenshot = $row['screenshot'];
		if(empty($screenshot)){
			$screenshot = 'unverified.gif';
		}
		echo '<td><img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score image" /></td></tr>';
		
		$i++;
	}
	echo '</table>';

	mysqli_close($dbc);
	?>

</body>
</html>
