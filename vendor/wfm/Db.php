<?php
// класс подключения к бд

namespace wfm;


use RedBeanPHP\R;

class Db
{
    use TSingleton;

    public function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['password']);
        if (!R::testConnection()) {
            throw new \Exception('Не удалось подключится к БД', 500);
        }
        R::freeze(true);// замарозка изменения в БД
        if (DEBUG) {
            R::debug(true, 3);
       }


    }
}
