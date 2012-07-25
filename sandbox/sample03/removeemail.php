<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Make Me Elvis：メールアドレス削除</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
    <body>
    <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
	<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
	<p>削除するメールアドレスを選択してください。</p>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
	    $dbc = mysqli_connect('localhost', 'masahiro', 'passwd', 'elvis_store')
	    or die('error: can not connect to database');
	    
		if(isset($_POST['submit'])){
			foreach($_POST['todelete'] as $delete_id){
				$query = "delete from email_list where id=$delete_id";
				mysqli_query($dbc, $query)
				or die('failed to query database for delete');
			}
			echo 'deleted customer\'s address <br />';
		}
	    
	    
	    $query = "select * from email_list";
	    $result = mysqli_query($dbc, $query)
	    or die('erro: failed query to database');

	    while($row = mysqli_fetch_array($result)){
	    	echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
	    	echo $row['last_name'];
	    	echo ' ' . $row['first_name'];
	    	echo ' ' . $row['email'];
	    	echo '<br />';
	    }
	    mysqli_close($dbc);
	?>
		<input type="submit" name="submit" value="削除" />
	</form>
    </body>
</html>