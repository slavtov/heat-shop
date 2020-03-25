<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Search extends Model
{
    static function findProducts($title)
    {
        return Db::rowAll('SELECT * FROM `product` WHERE `title` LIKE :title', ['title' => $title]);
    }
}
