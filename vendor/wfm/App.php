<?php


namespace wfm;


class App
{
    public static $app;

    public function __construct()
    {

        // получаем текущий URL
        $query = trim($_SERVER['QUERY_STRING'], '/');

        new ErrorHandler();
        // стартуем сессию
        session_start();
       // session_destroy();
        self::$app = Registry::getInstance();
        $this->getParams();
        // передаем в маршрутизатор текущий URL
        Router::dispatch($query);
    }

    protected function getParams()
    {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }


}
