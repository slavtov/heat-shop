<?php

namespace app\models\admin;

use app\core\base\Model;
use app\core\Db;

class Product extends Model
{
    static function get($id)
    {
        return Db::row("SELECT * FROM `product` WHERE `id` = :id", ['id' => $id]);
    }

    static function getAll($start, $perpage)
    {
        return Db::rowAll("SELECT * FROM `product` LIMIT {$start}, {$perpage}");
    }

    static function add()
    {
        $data  = cleanArray($_POST);
        $color = $size = [];

        foreach ($data as $key => $val) {
            if (strpos($key, 'color') !== false) {
                $color = $val;
                unset($data[$key]);
            }

            if (strpos($key, 'size') !== false) {
                $size = $val;
                unset($data[$key]);
            }
        }

        $data['alias'] = slug($data['title']);
        $data['img']   = self::loadImage() ?: 'no_image.png';

        foreach ($data as $key => $val) {
            $arr['keys'][]   = '`'.$key.'`';
            $arr['values'][] = ':'.$key;
        }

        $keys   = implode(', ', $arr['keys']);
        $values = implode(', ', $arr['values']);

        $stmt = Db::query("INSERT INTO `product` ({$keys}) VALUES ({$values})", $data);
        $product_id = Db::getId();

        $values = self::loadImages($product_id);
        Db::query("INSERT INTO `gallery` (`product_id`, `img`) VALUES {$values}");

        if (!empty($color)) {
            $values = '';

            foreach ($color as $val) {
                $values .= "({$product_id}, '{$val}'),";
            }

            $values = rtrim($values, ',');

            Db::query("INSERT INTO `mod_color` (`product_id`, `title`) VALUES {$values}");
        }

        if (!empty($size)) {
            $values = '';

            foreach ($size as $val) {
                $val = strtr($val, '_', '.');
                $values .= "({$product_id}, '{$val}'),";
            }

            $values = rtrim($values, ',');

            Db::query("INSERT INTO `mod_size` (`product_id`, `title`) VALUES {$values}");
        }

        return $stmt->rowCount();
    }

    static function edit()
    {
        $data          = cleanArray($_POST);
        $data['alias'] = slug($data['title']);
        
        // $color = $data['color'];
        // $size  = $data['size'];

        unset($data['color']);
        unset($data['size']);

        $values = sqlPart($data);

        $data['id'] = (int) $_GET['id'];

        $stmt = Db::query("UPDATE `product` SET {$values} WHERE `id` = :id", $data);
        return $stmt->rowCount();
    }

    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `product` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }

    static function getColors($id)
    {
        $stmt = Db::query("SELECT `title` FROM `mod_color` WHERE `product_id` = :id", ['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function getSizes($id)
    {
        $stmt = Db::query("SELECT `title` FROM `mod_size` WHERE `product_id` = :id", ['id' => $id]);
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function getCountProducts()
    {
        $stmt = Db::row('SELECT count(*) AS `count` FROM `product`');
        return $stmt['count'];
    }

    static function getOrderProducts($id)
    {
        return Db::rowAll("SELECT `order_product`.*, `product`.`img` FROM `order_product` 
        JOIN `product` ON `order_product`.`product_id` = `product`.`id` 
        WHERE `order_id` = :id", ['id' => $id]);
    }
}
