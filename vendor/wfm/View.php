<?php


namespace wfm;

// базовый вид
use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    // отрисовываем страничку
    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        // admin\ меняем на admin/
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        // формируем путь до вида
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        // подключим вид
        if (is_file($view_file)) {
            //буферизируем вид
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
            // забираем вид из буфера
        } else {
            throw new \Exception("Не найден Файл вида {$view_file} ", 500);
        }
        // подключим шаблон
        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Не найден Файл шаблона {$layout_file} ", 500);
            }
        }
    }

    // формируем вывод метатегов
    public function getMeta()
    {
        $out = '<title>' . App::$app->getProperty('site_name') . '::' . h($this->meta['title']) . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content=" ' . h($this->meta['description']) . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
        return $out;
    }

    //получаем логи запросов к БД
    public function getDbLogs()
    {
        if (DEBUG) {
            $logs = R::getDatabaseAdapter()
                ->getDatabase()
                ->getLogger();
            $logs = array_merge($logs->grep('SELECT'),
                $logs->grep('select'),
                $logs->grep('INSERT'),
                $logs->grep('UPDATE'),
                $logs->grep('DELETE'));
            //debug($logs);
        }
    }

    // метод для подключения частей сайта хедера и футера
    public function getPart($file, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        $file = APP . "/views/{$file}.php";
        if (is_file($file)) {
            require $file;
        } else {
            echo "Файл {$file} не найден";
        }
    }
}
