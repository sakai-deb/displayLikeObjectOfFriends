<!DOCTYPE HTML>
<html>
	<head>
    	<title>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css" />
		<link rel="stylesheet" type="text/css" href="./css/bootstrap/css/bootstrap.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<div id="wrapper">
    	<h1><img src="./images/title.png" alt="DISPLAY FRIENDS NUM OF SAME LIKES OBJECT"></h1>
		<p>
			<?php 
				echo '<img src="https://graph.facebook.com/'.$uid.'/picture" alt="picture of me">and<img src="https://graph.facebook.com/'.$fb_id.'/picture" alt="picture of '.$fb_id.'"> Match Percentage is <strong>'.$percent.'</strong>';
			?>
		</p>
		<p>You and friends likes these Object.</p>
		<dl>
			<?php 
				foreach($same_likes as $data){
					echo '<dt><a href="http://graph.facebook.com/'.$data['id'].'">'.$data['name'].'</a></dt>';
					echo '<dd><img src="https://graph.facebook.com/'.$data['id'].'/picture" alt="picture of '.$data['name'].'"></dd>';
					echo '<dd>category:'.$data['category'].'</dd>';
				}
			?>
		</dl>
		</div>
	</body>
</html>