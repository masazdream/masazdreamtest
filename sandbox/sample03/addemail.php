<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ありがとう！</title>
</head>
<body>
<?php
	$dbc = mysqli_connect('localhost', 'masahiro', 'passwd', 'elvis_store')
	or die('error:can not connect.');
	
	$last_name = $_POST['lastname'];
	$first_name = $_POST['firstname'];
	$email = $_POST['email'];
	
	$query = "insert into email_list(last_name, first_name, email) " . 
			"values ('$last_name', '$first_name', '$email')";
	mysqli_query($dbc, $query)
	or die('error: can not query.');
	
	echo  '顧客を追加しました！';
	
	mysqli_close($dbc);
?>
</body>
</html>
	