<?php

namespace app\models\admin;

use app\core\base\Model;
use app\core\Db;

class Order extends Model
{
    static function get($id)
    {
        return Db::row("SELECT `orders`.*, `users`.`username`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
        JOIN `users` ON `orders`.`user_id` = `users`.`id`
        JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id`
        WHERE `orders`.`id` = :id
        GROUP BY `orders`.`id` ORDER BY `orders`.`status`, `orders`.`id`", ['id' => $id]);
    }

    static function getAll($start, $perpage)
    {
        return Db::rowAll("SELECT `orders`.`id`, `orders`.`user_id`, `orders`.`status`, `orders`.`date`, `orders`.`update_at`, `orders`.`currency`, `users`.`username`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
        JOIN `users` ON `orders`.`user_id` = `users`.`id` 
        JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id`
        GROUP BY `orders`.`id` ORDER BY `orders`.`status`, `orders`.`id` LIMIT {$start}, {$perpage}");
    }

    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `orders` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }

    static function getCountOrders()
    {
        $stmt = Db::row('SELECT count(*) AS `count` FROM `orders`');
        return $stmt['count'];
    }

    static function updateStatus($id, $status)
    {
        $stmt = Db::query("UPDATE `orders` SET `status` = :status_at, `update_at` = :date_at WHERE `id` = :id", ['status_at' => $status, 'date_at' => date('Y-m-d H:i:s'), 'id' => $id]);
        return $stmt->rowCount();
    }
}
