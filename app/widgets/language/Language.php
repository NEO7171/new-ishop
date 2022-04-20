<?php

namespace app\widgets\language;

use RedBeanPHP\R;
use wfm\App;

class Language
{
    protected $tpl; // HTML шаблон виджета
    protected $languages; // все языки
    protected $language; //текущий активный язык

    public function __construct()
    {
        $this->tpl = __DIR__ . '/lang.tpl.php';
        $this->run();
    }

    protected function run()
    {
        $this->languages = App::$app->getProperty('languages');
        $this->language = App::$app->getProperty('language');
        echo $this->getHTML();
    }

    public static function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
    }

    public static function getLanguage($languages)
    {
        $lang = App::$app->getProperty('lang');

        //проверка наличия язака в нашем списке
        if ($lang && array_key_exists($lang, $languages)) {
            $key = $lang;
        } elseif (!$lang) {
            $key = key($languages);
        } else {
            $lang = h($lang);
            throw new \Exception("not found language {$lang}", 404);
        }
        //var_dump($key);
        $lang_info = $languages[$key];
        $lang_info['code'] = $key;
        return $lang_info;
    }

    protected function getHTML(): string
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}
