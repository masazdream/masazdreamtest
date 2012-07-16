<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>メッセージの送信完了</title>
</head>
    <body>
    <?php
		$from = 'test@example.com';
		$subject = $_POST['subject'];
		$text = $_POST['elvismail'];
		
		$dbc = mysqli_connect('localhost', 'masahiro', 'passwd', 'elvis_store')
		or die('error: can not connect to database');
		
		$query = "select * from email_list";
		$result = mysqli_query($dbc, $query)
		or die('error: failed query to database');
		
		while($row = mysqli_fetch_array($result)){
			$last_name = $row['last_name'];
			$first_name = $row['first_name'];
			$msg = "$last_name $first_name さん, \n $text";
			$to = $row['email'];
			
			mb_internal_encoding("UTF-8");
			mb_send_mail($to, $subject, $msg, 'From: ' . $from);
			echo 'sent mail to ' . $to . '<br />';
		}
		mysqli_close($dbc);
	?>
    </body>
</html>