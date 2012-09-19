<?php

//ユーザがいいね！したオブジェクトの表示プログラム

config_init();
$config = array();
$config['appId'] = 'YOUR APP ID';
$config['secret'] = 'YOUR APP SECRET';
$config['fileUpload'] = false; // optional
$facebook = new Facebook($config);
$db;

//
$uid = $facebook->getUser();

//プログラムの初期設定
function config_init(){
	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");
	require_once("php_sdk/facebook.php");
}
//DBへの接続
function connect_database(){
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

function get_fb_user_info($fbid){
	return $GLOBALS['facebook']->api("/${fbid}", 'GET');
}

function http_to_friends($src_id, $dest_id){
	if (!is_null($dest_id) && !is_null($src_id)){
		connect_database();
	}
	else {
		echo '指定された友人がいません';
	}
}

function select_err_msg($cord, $src, $dest){
	$sql = 'SELECT * FROM err_msg WHERE cord = '.$cord;
	$exec = $GLOBALS['db']->query($sql);
	$result = $exec->fetch(PDO::FETCH_ASSOC);
	require 'templates/result.php';
	//
}

function list_friends(){
	$param = array(
		'scope' => 'user_about_me,friends_about_me,user_likes,friends_likes',
		'redirect_uri' => 'http://cent8ev-anf-app000.c4sa.net/index.php'
	);
	if($GLOBALS['uid']){
		try {
			//自分のいいね！オブジェクトの取得、DBに格納
			$user_likes = $GLOBALS['facebook']->api('/me/likes', 'GET');
			
			
			//友達一覧取得
			$user_friends = $GLOBALS['facebook']->api('/me/friends', 'GET');
			//友達一覧表示
            require 'templates/list.php';

		} catch(FacebookApiException $e){
       		login_to_fb($param);
	        error_log($e->getType());
        	error_log($e->getMessage());
   		}   
   	} else {
      	login_to_fb($param);
    }
}

function login_to_fb($param){
	$login_url = $GLOBALS['facebook']->getLoginUrl($param);
	//login.phpも作成(あとで)
	echo 'Please <a href="' . $login_url . '">login.</a>';
}