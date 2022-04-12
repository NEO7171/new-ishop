<?php
// таблица маршрутов
use \wfm\Router;

// правила для админа
Router::add('^admin/?$', [
    'controller' => 'Main',
    'action' => 'index',
    'admin_prefix' => 'admin']); // админка
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)/?$', [
    'controller' => 'Main',
    'action' => 'index',
    'admin_prefix' => 'admin']); // админка


// правила для пользователей
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); // если строка пустая
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$'); // если строка пустая
