<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;


/** @property Main $model */
class MainController extends AppController
{
    // унаследовали
//    public array $data = [];
//    public array $meta = [];
//    public false|string $layout = '';
//    public string $view = '';
//    public object $model;

    // public false|string $layout = 'test2';
    public function indexAction()
    {
        $slides = R::findAll('slider');
        // передаем переменную в вид
        $this->set(compact('slides'));
    }
}
