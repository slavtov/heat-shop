<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Cart extends Model
{
    static function getOne($id)
    {
        return Db::row('SELECT * FROM `product` WHERE `id` = :id', ['id' => $id]);
    }

    static function getColor($id, $product_id)
    {
        return Db::row('SELECT * FROM `mod_color` WHERE `id` = :id AND `product_id` = :product_id', ['id' => $id, 'product_id' => $product_id]);
    }

    static function deleteItem($id)
    {
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $qtyMinus * $_SESSION['cart'][$id]['price'];

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;

        unset($_SESSION['cart'][$id]);
    }

    static function qtyPlus($id)
    {
        $_SESSION['cart'][$id]['qty']++;
        $_SESSION['cart.qty']++;
        $_SESSION['cart.sum'] += $_SESSION['cart'][$id]['price'];
    }

    static function qtyMinus($id)
    {
        if ($_SESSION['cart'][$id]['qty'] > 1) {
            $_SESSION['cart.sum'] -= $_SESSION['cart'][$id]['price'];
            $_SESSION['cart'][$id]['qty']--;
            $_SESSION['cart.qty']--;
        }
    }

    static function addToCart($product, $qty = 1, $mod = null, $modSize = null)
    {
        if ($mod) {
            $id    = $modSize ? "{$product['id']}-{$mod['id']}-{$modSize}" : "{$product['id']}-{$mod['id']}";
            $title = "{$product['title']} ({$mod['title']})";
            $price = $product['price'] + $mod['price'];
        } else {
            $id	   = $modSize ? $product['id'] . '-' . $modSize : $product['id'];
            $title = $product['title'];
            $price = $product['price'];
        }

        if (isset($_SESSION['cart'][$id]['qty'])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'qty' 	=> $qty,
                'title' => $title,
                'alias' => $product['alias'],
                'size' 	=> $modSize,
                'price' => $price,
                'img' 	=> $product['img']
            ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $price : $qty * $price;
    }
}
