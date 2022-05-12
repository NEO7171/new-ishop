<?php


namespace app\controllers;

use app\models\AppModel;

use app\widgets\language\Language;
use wfm\App;
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
        new AppModel();
        // запишем языки в контейнер
        App::$app->setProperty('languages', Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));
//         debug(App::$app->getProperty('languages'));
//         debug(App::$app->getProperty('language'));

        $lang = App::$app->getProperty('language');
        //  debug($this->route);
        \wfm\Language::load($lang['code'], $this->route);

    }

}
