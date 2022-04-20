<?php


namespace wfm;


class Router
{
    protected static array $routes = []; // таблица маршрутов
    protected static array $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    // метод отсекания GET параметров
    protected static function removeQueryString($url)
    {
        if ($url) {
            // формируем массив [0] => url, [1] => GET параметры
            $params = explode('&', $url, 2);
            // проверим емть ли знак = в GET параметрах
            if (false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }

        }
        return '';
    }

    public static function dispatch($url)
    {
        //var_dump($url);
        // удалим GET параметры
        $url = self::removeQueryString($url);
        // var_dump($url);
        // проверка найдено или нет в таблице маршрутов
        if (self::matchRoute($url)) {
            // проверим наличие языка в маршруте
            if(!empty(self::$route['lang'])){
                //запишем язык в контейнер
                App::$app->setProperty('lang', self::$route['lang']);
            }
            // формируем путь, объект для найденого контроллера
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
            // проверяем наличие такого контроллера
            if (class_exists($controller)) {
                /** @var Controller $controllerObject */
                // создадим экземпляр контроллера и передадим ему текущий маршрут
                $controllerObject = new $controller(self::$route);
                $controllerObject->getModel();
                // вызываем метод контроллера
                $action = self::lowerCamelCase(self::$route['action'] . 'Action');
                // проверяем наличие такого экшана
                if (method_exists($controllerObject, $action)) {
                    //вызываем данный метод
                    $controllerObject->$action();
                    // Вызываем вид view
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);

                }
            } else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }

    // ф-ция сравнония регулярного выражения с полученным url
    public static function matchRoute($url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                // debug($matches);
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //Формируем правильное имя класса например из new-product в NewProduct
    protected static function upperCamelCase($name): string
    {
        // new-product => new product
        $name = str_replace('-', ' ', $name);
        // new product => New Product
        $name = ucwords($name);
        // New Product => NewProduct
        $name = str_replace(' ', '', $name);
        return $name;
    }

    //Формируем  из NewProduct в newProduct
    protected static function lowerCamelCase($name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}
