<?php
define('DB_NAME', getenv('C4SA_MYSQL_DB'));
define('DB_USER', getenv('C4SA_MYSQL_USER'));
define('DB_PASSWORD', getenv('C4SA_MYSQL_PASSWORD'));
define('DB_HOST', getenv('C4SA_MYSQL_HOST'));

$res = array(
	"key" => "value",
);
	
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8;';
try{
	$db = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOExeption $e){
	echo'Error:'.$e->getMessage();
	die();
}

if ($db->query("CREATE TABLE err_msg (cord int, status varchar(50)) ") == true){
	echo "テーブルが作成されました";
}

foreach ($res as $key => $value){
	$query = 'INSERT INTO err_msg VALUES (?,?)';
	$set_query = $db->prepare($query);
	$flag = $set_query->execute(array($key, $value));
	if ($flag){
		echo $query;
	}
	else {
		echo "INSERT ERROR";
	}
}

$db = null;