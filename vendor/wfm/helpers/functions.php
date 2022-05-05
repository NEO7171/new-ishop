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
    return PATH . '/' . (\wfm\App::$app->getProperty('lang')? \wfm\App::$app->getProperty('lang') . '/' : '');
}
