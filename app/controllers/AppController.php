<?php


namespace app\controllers;

use wfm\Controller;

class AppController extends Controller
{
    // унаследовали
//    public array $data = [];
//    public array $meta = [];
//    public false|string $layout = '';
//    public string $view = '';
//    public object $model;

    // public false|string $layout = 'test2';
// инициируем подключение к БД
    public function __construct($route)
    {
        parent::__construct($route);
    }

}
