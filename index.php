<?php

require __DIR__ . "/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$supported_api = array('domain', 'notify', 'delnotify', 'error' );

if ((isset($uri[1]) && !in_array($uri[1], $supported_api)) || !isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
} 

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";

if (in_array($uri[1], $supported_api)){
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