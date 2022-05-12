<?php

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>' . '<hr>';
    if ($die) {
        die;
    }
}

// ф-ция обработки HTML перед пставкой htmlspecialchars
function h($str)
{
    return htmlspecialchars($str);
}


function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    die;
}

// ф-ция получения базового URL С en или без
function base_url()
{
    return PATH . '/' . (\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}

// получаем данные из массива GET
/**
 * @param string $key key of GET array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function get($key, $type = 'i')
{
    $param = $key;

    // делаем переменную в переменной
    $$param = $_GET[$param] ?? '';
    // приведение типов
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }

}

// получаем данные из массива POST
/**
 * @param string $key key of POST array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function post($key, $type = 'i')
{
    $param = $key;

    // делаем переменную в переменной
    $$param = $_POST[$param] ?? '';
    // приведение типов
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

function __($key)
{
    echo \wfm\Language::get($key);
}
function ___($key)
{
    return \wfm\Language::get($key);
}
