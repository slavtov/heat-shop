<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Product extends Model
{
    static function getProduct($alias)
    {
        return Db::row("SELECT * FROM `product` WHERE `alias` = :alias AND `status` = 'on'", ['alias' => $alias]);
    }

    static function getRelated($id)
    {
        return Db::rowAll("SELECT * FROM `related_product` 
		JOIN `product` ON `product`.`id` = `related_product`.`related_id` 
		WHERE `related_product`.`product_id` = :id", ['id' => $id]);
    }

    static function getGallery($id)
    {
        return Db::rowAll("SELECT * FROM `gallery` WHERE `product_id` = :id", ['id' => $id]);
    }

    static function getColor($id)
    {
        return Db::rowAll("SELECT * FROM `mod_color` WHERE `product_id` = :id", ['id' => $id]);
    }

    static function getSize($id)
    {
        return Db::rowAll("SELECT `title` FROM `mod_size` WHERE `product_id` = :id", ['id' => $id]);
    }

    static function getRecentlyViewed($id)
    {
        if (isset($_COOKIE['recently_viewed'])) {
            $arr = explode('-', $_COOKIE['recently_viewed']);
            $arr = intArray($arr);

            if (!in_array($id, $arr)) setcookie('recently_viewed', $_COOKIE['recently_viewed'] . '-' . $id, time() + 60 * 60 * 24);

            $values = implode(', ', $arr);

            return Db::rowAll("SELECT * FROM `product` WHERE `id` IN ({$values})");
        } else setcookie('recently_viewed', $id, time() + 60*60*24);

        return null;
    }
}
