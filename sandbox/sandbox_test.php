<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<frameset>
    <frame>
    <frame>
    <noframes>
    <body>
    <?php
	    $when_it_happened = $_POST['whenithappened'];
	    $how_long = $_POST['howlong'];
	    $alien_description = $_POST['aliendescription'];
	    $fang_spotted = $_POST['fangspotted'];
	    $email = $_POST['email'];
	    $lastname = $_POST['lastname'];
	    $first_name = $_POST['firstname'];
	    $how_many = $_POST['howmany'];
	    $what_they_did = $_POST['whattheydid'];
	    $other = $_POST['other'];
    
		$dbc = mysql_connect('localhost', 'masahiro', 'passwd', 'aliendatabase')
		or die('error:disconnected mysql server');
		
		$query = "insert into aliens_abduction (last_name, first_name, when_it_happened, how_long, " . 
				"how_many, alien_description, what_they_did, fang_spotted, other, email) " . 
				"values ('$lastname', '$first_name', '$when_it_happened', " . 
				"'$how_long', '$how_many', '$alien_description', " . 
				"'$what_they_did', '$fang_spotted', '$other', " . 
				"'$email')";
		$result = mysql_query($dbc, $query)
		or die("error: can not query to database");
		
		mysql_close($dbc);
	?>
    </body>
    </noframes>
</frameset>
</html>