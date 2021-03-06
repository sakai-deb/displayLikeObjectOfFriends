<?php

/*
Facebook_app_demo_like

by Yuki Okawa
*/


initModel();
$config = array();
$config['appId'] = 'YOUR APP ID';
$config['secret'] = 'YOUR APP SECRET';
$config['fileUpload'] = false; // optional
$facebook = new Facebook($config);
$param = array(
	'scope' => 'user_about_me,friends_about_me,user_likes,friends_likes',
	'redirect_uri' => 'http://YOUR DOMAIN NAME/index.php'
);
$db;

/*
$uid include current user's Facebook ID 
*/
$uid = $facebook->getUser();

//Initialization Model
function initModel(){
	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");
	require_once("php_sdk/facebook.php");
}
//Connect to Database of C4SA's database.
function connectDatabase(){
	define('DB_NAME', getenv('C4SA_MYSQL_DB'));
	define('DB_USER', getenv('C4SA_MYSQL_USER'));
	define('DB_PASSWORD', getenv('C4SA_MYSQL_PASSWORD'));
	define('DB_HOST', getenv('C4SA_MYSQL_HOST'));

	$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8;';
	try{
		$GLOBALS['db'] = new PDO($dsn, DB_USER, DB_PASSWORD);
	}catch (PDOExeption $e){
		print('Error:'.$e->getMessage());
		die();
	}
}

/*
get_fb_user_info return 
id, name, username, link etc.. basic info about target user.
*/
function getFbUserInfo($fbid){
	return $GLOBALS['facebook']->api("/${fbid}", 'GET');
}

/*
this function execute when be accessed to http://xxx/index.php or http://xxx/ or redirected by Facebook.
*/
function listFriends(){
	if($GLOBALS['uid']){
		try {
			/*
			$user_friends include name and id of user friends.
			{
 			 "data": [
			    {
			      "name" 
			      "id" 
			    }
			    ]
			 }
			*/
			$user_friends = $GLOBALS['facebook']->api('/me/friends', 'GET');
			//Display for list of friends.
			$url = $GLOBALS['param']{'redirect_url'};
            require 'templates/start.php';

		} catch(FacebookApiException $e){
       		loginToFb($GLOBALS['param']);
	        error_log($e->getType());
        	error_log($e->getMessage());
   		}   
   	} else {
      	loginToFb($GLOBALS['param']);
    }
}

/*
this function is excecute when be accessed to http://xxxx/index.php/result?fb_id=xxx 
*/
function getLikes($fb_id){
	$count = 0;
	$number = 0;
	$uid = $GLOBALS['facebook']->getUser();
	$url = $url = $_SERVER['HTTP_REFERER'];
	if (!is_null($fb_id)){
		try{
			/*
			$array_my_likes include object which user likes.
			{
 			 "data": [
			    {
			      "name" 
			      "category" 
			      "id" 
			      "created_time"
			    }
			    ]
			} 
			*/
			$array_my_likes = $GLOBALS['facebook']->api("/me/likes", 'GET');
			$array_frd_likes = $GLOBALS['facebook']->api("/${fb_id}/likes", 'GET');
			
			foreach ($array_my_likes['data'] as $my_likes){
				foreach ($array_frd_likes['data'] as $frd_likes){
					if ($my_likes['id'] === $frd_likes['id']){
						$same_likes[] = $my_likes;
						$count++;
					}
				}
				$number++;
			}
			$percent = ($count / $number) * 100;
			$percent = round($percent);
			require 'templates/result.php';
		} catch(FacebookApiException $e){
       		loginToFb($GLOBALS['param']);
	        error_log($e->getType());
        	error_log($e->getMessage());
   		} 	
	}
	else {
		echo '指定された友人がいません';
	}
}

function loginToFb($param){
	/*
	$login_url include URL to authorize application.
	*/
	$login_url = $GLOBALS['facebook']->getLoginUrl($param);
	require 'templates/login.php';
	//echo 'Please <a href="' . $login_url . '">login.</a>';
}