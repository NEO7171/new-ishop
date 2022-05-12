<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;
use wfm\App;


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

          // получаем ID языка
        $lang = App::$app->getProperty('language');
        $slides = R::findAll('slider');

        $products = $this->model->getHits($lang, 6);
        // передаем переменную в вид
        $this->set(compact('slides', 'products'));
        // пропишем тайтл
        $this->setMeta(
            ___('main_index_meta_title'),
            ___('main_index_meta_description'),
            ___('main_index_meta_keywords'));
    }
}
