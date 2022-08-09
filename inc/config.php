<?php

define("DB_HOST", "localhost");
define("DB_USERNAME", "botmon");
define("DB_PASSWORD", "seila123");
define("DB_DATABASE_NAME", "monitoring");
define("supported_api", array('domain', 'notify', 'delnotify', 'error' ));

// Security
define("proxy_reverse", "True");
define("allowed_ips", array( '127.0.0.1' , '138.186.111.14', '192.168.70.49' ));
?>
