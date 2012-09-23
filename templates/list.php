<!DOCTYPE HTML>
<html>
	<head>
    	<title>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
    	<h1>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</h1>
		<p>
			<?php
				foreach($user_friends[data] as $data){
					//echo '<p>'.$num.'My friend\'s ID = '.$data['id'].'  NAME = '.$data['name'].'</p>';
					//$num++;
					echo '<div class="friends"><img src="https://graph.facebook.com/'.$data['id'].'/picture" alt="'.$data['name'].' Profile Photo"><br><a href="http://YOUR DOMAIN NAME/index.php/result?fb_id='.$data['id'].'">'.$data['name'].'</a></div>';
				}
			?>
		</p>
	</body>
</html>