<?php


namespace app\controllers;


use wfm\App;

class LanguageController extends AppController
{
    public function chengeAction()
    {
        $lang = get('lang','s');
        //  debug(App::$app->getProperty('languages'), 1);
        if ($lang) {
            // проверим есть ли язык среди доступных
            if (array_key_exists($lang, App::$app->getProperty('languages'))) {
                // отрезаем базовый URL
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');

                //разбиваеи на 2 части 1 часть - возможный бывший язык
                $url_parts = explode('/', $url, 2);

                //ищем первую часть в массиве языков
                if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
                    // присваиваем первой части новый язык, если он не является базовым
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        //если это базовый язык, то удалим его из URL адреса
                        array_shift($url_parts); // удаляет 1й эл-т массива
                    }

                } else {
                    // присваиваем первой части новый язык, если он не является базовым
                    if ($lang != App::$app->getProperty('language')['code']) {
                        array_unshift($url_parts, $lang); // добавляет эл-т в начало массива
                    }

                }
                $url= PATH . '/' . implode('/', $url_parts);
                redirect($url);
            }
        }
        redirect();
    }
}
