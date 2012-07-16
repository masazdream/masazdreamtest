<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>削除しました</title>
</head>
    <body>
    <?php
	    $dbc = mysqli_connect('localhost', 'masahiro', 'passwd', 'elvis_store')
	    or die('error: can not connect to database');
	    
	    $email = $_POST['email'];
	    $query = "delete from email_list where email='$email'";
	    
	    mysqli_query($dbc, $query)
	    or die('erro: failed query to database');
	    
	    echo 'delete ' . $email . '.';
	    
	    mysqli_close($dbc);
	?>
    </body>
</html>