<!DOCTYPE HTML>
<html>
	<head>
    	<title>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/bootstrap/css/bootstrap.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
	<div id="wrapper">
    	<h1><img src="./images/title.png" alt="DISPLAY FRIENDS NUM OF SAME LIKES OBJECT"></h1>
		<p>
			<?php
				foreach($user_friends[data] as $data){
					//echo '<p>'.$num.'My friend\'s ID = '.$data['id'].'  NAME = '.$data['name'].'</p>';
					//$num++;
					echo '<div class="friends"><img src="https://graph.facebook.com/'.$data['id'].'/picture" alt="'.$data['name'].' Profile Photo"><br><a href="'.$url.'?fb_id='.$data['id'].'">'.$data['name'].'</a></div>';
				}
			?>
		</p>
	</div>
	</body>
</html>