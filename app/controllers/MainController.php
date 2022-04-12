<?php

namespace app\controllers;

use RedBeanPHP\R;
use wfm\Controller;


/** @property Main $model */
class MainController extends Controller
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
        $names = $this->model->get_names();
        $one_name = R::getRow( 'SELECT * FROM name WHERE id = 2');
      //  debug($names);
        $this->setMeta('Главная страница', 'Description Главной стр', 'keywords главной');
        // $this->layout = 'default'; // переопределим layout
             $this->set(compact('names'));
    }
}
