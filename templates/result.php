<!DOCTYPE HTML>
<html>
	<head>
    	<title>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
    	<h1>DISPLAY LIKES OBJECT OF FACEBOOK FRIENDS</h1>
		<p><?php echo $fb_id."'s likes objects"?></p>
		<dl>
			<?php 
				foreach($array_likes[data] as $data){
					echo '<dt><a href="http://graph.facebook.com/'.$data['id'].'">'.$data['name'].'</a></dt>';
					echo '<dd><img src="https://graph.facebook.com/'.$data['id'].'/picture" alt="picture of '.$data['name'].'"></dd>';
					echo '<dd>category:'.$data['category'].'</dd>';
				}
			?>
		</dl>
	</body>
</html>