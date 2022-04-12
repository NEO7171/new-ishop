<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__)); // корень сайта  new-shop.loc
define("WWW", ROOT . "/public"); // путь до  new-shop.loc/public
define("APP", ROOT . "/app"); // путь до  new-shop.loc/app
define("CORE", ROOT . "/vendor/wfm"); // путь до  new-shop.loc/vendor/wfm
define("HELPERS", ROOT . "/vendor/wfm/helpers"); // путь до  new-shop.loc/vendor/wfm/helpers
define("CASHE", ROOT . "/tmp/cache"); // путь до  new-shop.loc/tmp/cache
define("LOGS", ROOT . "/tmp/logs"); // путь до  new-shop.loc/tmp/logs
define("CONFIG", ROOT . "/config"); // путь до  new-shop.loc/config
define("LAYOUT", 'ishop'); //
define("PATH", 'http://new-chop.loc'); //путь сайта
define("ADMIN", 'http://new-chop.loc/admin'); //путь к админке сайта
define("NO_IMAGE", 'uploads/no_image.jpg'); //путь к картинке по умолчанию


//подключаем автозагрузчик
require_once ROOT . '/vendor/autoload.php';
