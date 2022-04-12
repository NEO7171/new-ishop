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
