<?php

namespace app\models\admin;

use app\core\Db;
use app\models\User as AppUser;

class User extends AppUser
{
    static function get($id)
    {
        return Db::row("SELECT * FROM `users` WHERE `id` = :id", ['id' => $id]);
    }

    static function getAll($start, $perpage)
    {
        return Db::rowAll("SELECT * FROM `users` LIMIT $start, $perpage");
    }

    static function update()
    {
        $data   = cleanArray($_POST);
        $values = sqlPart($data);

        $data['id'] = (int) $_GET['id'];

        $stmt = Db::query("UPDATE `users` SET {$values} WHERE `id` = :id", $data);
        return $stmt->rowCount();
    }

    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `users` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }

    static function getOrders($id)
    {
        return Db::rowAll("SELECT `orders`.`id`, `orders`.`user_id`, `orders`.`status`, `orders`.`date`, `orders`.`update_at`, `orders`.`currency`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
		JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id` 
		WHERE `user_id` = :id 
		GROUP BY `orders`.`id` ORDER BY `orders`.`status`, `orders`.`id`", ['id' => $id]);
    }

    static function getCountUsers()
    {
        $stmt = Db::row('SELECT count(*) AS `count` FROM `users`');
        return $stmt['count'];
    }
}
