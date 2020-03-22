<?php

namespace app\models\admin;

use app\core\base\Model;
use app\core\Db;

class Category extends Model
{
    static function get($id)
    {
        return Db::row("SELECT * FROM `category` WHERE `id` = :id", ['id' => $id]);
    }

    static function getAll()
    {
        $stmt = Db::query("SELECT * FROM `category`");
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function add()
    {
        $data = cleanArray($_POST);

        $data['alias'] = slug($data['title']);
        $data['img']   = self::loadImage();

        foreach ($data as $key => $val) {
            $arr['keys'][]   = '`'.$key.'`';
            $arr['values'][] = ':'.$key;
        }

        $keys   = implode(', ', $arr['keys']);
        $values = implode(', ', $arr['values']);

        if ($data['parent_id'] == 'no') $data['parent_id'] = 0;

        $stmt = Db::query("INSERT INTO `category` ({$keys}) VALUES ({$values})", $data);
        return $stmt->rowCount();
    }

    static function edit()
    {
        $data = cleanArray($_POST);

        if ($img = self::loadImage()) $data['img'] = $img;

        $values = sqlPart($data);

        $data['id'] = (int) $_GET['id'];
        if ($data['parent_id'] == 'no') $data['parent_id'] = 0;

        $stmt = Db::query("UPDATE `category` SET {$values} WHERE `id` = :id", $data);
        return $stmt->rowCount();
    }

    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `category` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }

    static function deleteBackground($id)
    {
        $stmt = Db::query("UPDATE `category` SET `img` = NULL WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }

    static function getCountParent($id)
    {
        $stmt = Db::row("SELECT count(*) AS `count` FROM `category` WHERE `parent_id` = :id", ['id' => $id]);
        return (int) $stmt['count'];
    }

    static function getCountProducts($id)
    {
        $stmt = Db::row("SELECT count(*) AS `count` FROM `product` WHERE `category_id` = :id", ['id' => $id]);
        return (int) $stmt['count'];
    }
}
