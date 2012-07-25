<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Make Me Elvis：メール送信</title>
</head>
    <body>
    <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  				<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
 				<p><strong>管理用：</strong>管理者以外使用禁止<br />
 				 メールを書いてメーリングリストのメンバに送りますぜ。</p>
    <?php
	    if (isset($_POST['submit'])){
			$from = 'test@example.com';
			$subject = $_POST['subject'];
			$text = $_POST['elvismail'];
			
			$output_form = false;
			
			if(empty($subject) && empty($text)){
				$output_form = true;
				echo '件名と本文を入力してください。<br />';
			}
			
			if(empty($subject) && !empty($text)){
				$output_form = true;
				echo '件名を入力してください。<br />';
			}
			
			if(!empty($subject) && empty($text)){
				$output_form = true;
				echo '本文を入力してください。<br />';
			}
	    }else{
	    	$output_form = true;
	    	$subject = '';
	    	$text = '';
	    }
		
		if(!empty($subject) && !empty($text)){
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
		}
		
		if($output_form){
			?>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			    <label for="subject">メールの件名：</label><br />
			    <input id="subject" name="subject" type="text" size="30" value="<?php echo $subject; ?>"/><br />
			    <label for="elvismail">メール本文：</label><br />
			    <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
			   	<input type="submit" name="submit" value="送信" />
	 		 	</form>
			<?php
		}
	?>
    </body>
</html>