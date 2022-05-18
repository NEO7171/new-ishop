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
    public function addAction(): bool
    {
        $lang = App::$app->getProperty('language');
        $id = get('id');
        $qty = get('qty');
     // var_dump($id, $qty);
    // die;
        // проверка
        if (!$id) {
            return false;
        }
        $product = $this->model->get_product($id, $lang);
       // debug($product, 1);
        if(!$product){
            return false;
        }
        $this->model->add_to_cart($product, $qty);
       if($this->isAjax()){
          // debug($_SESSION['cart'], 1);
           $this->loadView('cart_modal');
       }
       redirect();
       return true;
    }
}
