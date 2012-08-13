<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ギターウォーズ：ハイスコアの管理</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>ギターウォーズ：ハイスコアの管理</h2>
	<p>
		ギターウォーズのハイスコアリストです。このページを使って、不要なスコアを削除します。</a>
	</p>
	<hr />
	<?php
	require_once 'appvars.php';
	require_once 'connectvars.php';
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	// Retrieve the score data from MySQL
	$query = "SELECT * FROM guitarwars order by score desc, date asc";
	$data = mysqli_query($dbc, $query);
	
	//$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$query = "select * from guitarwars order by score desc, data asc";
	//$data = mysqli_query($dbc, $query);

	echo '<table>';
	while ($row = mysqli_fetch_array($data)) {
		echo '<tr class="score"><td><strong>' . $row['name'] . '</strong></td>';
		echo '<td>' . $row['date'] . '</td>';
		echo '<td>' . $row['score'] . '</td>';
		echo '<td><a href=removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' .
				$row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">削除</a></td></tr>';
	}
	echo '</table>';
	mysqli_close($dbc);
	?>
</body>
</html>
