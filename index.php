<?php

require_once 'model.php';

$uri = $_SERVER['REQUEST_URI'];
if ($uri == '/index.php' || $uri == '/' || isset($_GET['state'])) {
    listFriends();
} elseif (isset($_GET['fb_id'])) {
    getLikes($_GET['fb_id']);
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>ページが見つかりません(´・ω・｀)</h1></body></html>';
}