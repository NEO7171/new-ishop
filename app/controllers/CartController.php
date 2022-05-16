<?php


namespace app\controllers;


use app\models\Cart;
use wfm\App;

/**
 * Class CartController
 * @package app\controllers
 * @property Cart $model
 */
class CartController extends AppController
{
    public function addAction()
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('$qty');
//        var_dump($id, $qty);
//        die;
        // проаерка
        if (!$id) {
            return false;
        }
        $product = $this->model->get_product($id, $lang);
        debug($product, 1);
    }
}
