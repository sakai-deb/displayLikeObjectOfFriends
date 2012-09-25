<!DOCTYPE HTML>
<html>
	<head>
    	<title>DISPLAY FRIENDS NUM OF SAME LIKES OBJECT</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
    	<h1>DISPLAY FRIENDS NUM OF SAME LIKES OBJECT</h1>
		<p><?php echo $user_info['data']->['name']."'s likes objects"?></p>
		<dl>
			<?php 
				foreach($array_likes[data] as $data){
					echo '<dt><a href="http://graph.facebook.com/'.$data['id'].'">'.$data['name'].'</a></dt>';
					echo '<dd><a href="http://YOUR DOMAIN NAME/index?obj_id='.$data['id'].'"><img src="https://graph.facebook.com/'.$data['id'].'/picture" alt="picture of '.$data['name'].'"></a></dd>';
					echo '<dd>category:'.$data['category'].'</dd>';
				}
			?>
		</dl>
	</body>
</html>