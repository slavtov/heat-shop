<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Category extends Model
{
    static function getProducts($ids, $start, $perpage, $sql_part)
    {
        return Db::rowAll("SELECT * FROM `product` WHERE `category_id` IN ({$ids}) $sql_part LIMIT {$start}, {$perpage}");
    }

    static function getId($alias)
    {
        $arr = $_SESSION['category'];
        foreach ($arr as $key => $val) {
            if ($arr[$key]['alias'] == $alias) return $key;
        }
    }

    static function getIds($id)
    {
        $ids = null;
        $arr = $_SESSION['category'];
        
        foreach ($arr as $key => $val) {
            if ($val['parent_id'] == $id) {
                $ids .= $key . ',';
                $ids .= self::getIds($key);
            }
        }

        return $ids;
    }

    static function getCount($ids, $sql_part)
    {
        $result = Db::row("SELECT count(*) as `count` FROM `product` WHERE `category_id` IN ({$ids}) $sql_part");
        return (int) $result['count'];
    }

    static function getBreadCrumbs($id)
    {
        $cat = $_SESSION['category'];
        $val = $cat[$id];

        $res = [];
        $i 	 = 0;

        while (true) {
            $res[$i]['title'] = $val['title'];
            $res[$i]['url']   = $val['alias'];

            if ($val['parent_id'] != 0) {
                $val = $cat[$val['parent_id']];
            } else break;

            $i++;
        }

        return array_reverse($res);
    }
}
