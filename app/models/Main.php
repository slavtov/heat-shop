<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Main extends Model
{
    static function getHits()
    {
        return Db::rowAll("SELECT * FROM `product` WHERE `hit` = 'on' AND `status` = 'on'");
    }

    static function getColors()
    {
        $stmt = Db::query("SELECT `product_id` FROM `mod_color`");
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function getSizes()
    {
        $stmt = Db::query("SELECT `product_id` FROM `mod_size`");
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function addQuestion($data)
    {
        $stmt = Db::query("INSERT INTO `contact` (`email`, `question`) VALUES (:email, :question)", [
            'email'	   => $data['email'],
            'question' => $data['question']
        ]);
        return $stmt->rowCount();
    }
}
