<?php


namespace app\models;


use RedBeanPHP\R;

class Cart extends AppModel
{
    public function get_product($id, $lang): array
    {
        return R::getRow("SELECT p.*, pd.* FROM product p 
    JOIN product_description pd on p.id = pd.product_id 
    WHERE p.status =1 
    AND p.id = ? 
    AND pd.language_id = ?", [$id, $lang['id']]);
    }

    public function add_to_cart($product, $qty = 1)
    {
        $qty = abs($qty); // только положительное число
        // формируем такой массив корзины
//        array(
//            [product_id] => array(
//                [qty] => QTY,
//                [title] => TITLE,
//                [price] => PRICE,
//                [img] => IMG,
//            )
//            [cart.qty] => QTY,
//            [cart.sum] => SUM
//    )


        // проверяем добавлен ли товар в сессию и он цифровой
        if ($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
            return false;
        }
        // добавим $qty кол-во товара в сессию
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                $qty = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
                'is_download' => $product['is_download'],

            ];
        }
        $_SESSION['cart.qty'] = $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product['price'] : $qty * $product['price'];
        return true;
    }
}
