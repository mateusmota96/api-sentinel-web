<?php

require __DIR__ . "/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ((isset($uri[1]) && !in_array($uri[1], supported_api)) || !isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
} 

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";


# Allowed ips
if (proxy_reverse == True) {
	$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (proxy_reverse == False){
	$IP = $_SERVER['REMOTE_ADDR'];
}
if (!in_array($IP, allowed_ips)){
    header("HTTP/1.1 418 I'm a Teapot");
    require_once PROJECT_ROOT_PATH . "/Model/Error418.php";
    exit();
}


if (in_array($uri[1], supported_api)){
    if ($uri[1] == 'error'){
        $objFeedController = new UserController();
        $strMethodName = $uri[2] . "Error";
        $objFeedController->{$strMethodName}();
    }
    elseif ($uri[1] == 'domain' || $uri[1] == 'delnotify') {
        $objFeedController = new UserController();
        $strMethodName = $uri[2] . "Action";
        $objFeedController->{$strMethodName}();
    } elseif ($uri[1] == 'notify') {
        $objFeedController = new UserController();
        $strMethodName = $uri[2] . "Send";
        $objFeedController->{$strMethodName}();  
    }
}

?>