<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Profile extends Model
{
    static function getUser()
    {
        return Db::row("SELECT * FROM `users` WHERE `id` = :id", ['id' => (int) $_SESSION['user']['id']]);
    }

    static function getLatestOrders($limit)
    {
        return Db::rowAll("SELECT `orders`.`id`, `orders`.`user_id`, `orders`.`status`, `orders`.`date`, `orders`.`update_at`, `orders`.`currency`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
		JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id` 
		WHERE `user_id` = :id 
        GROUP BY `orders`.`id` ORDER BY `orders`.`date` DESC LIMIT {$limit}", ['id' => (int) $_SESSION['user']['id']]);
    }

    static function getOrders()
    {
        return Db::rowAll("SELECT `orders`.`id`, `orders`.`user_id`, `orders`.`status`, `orders`.`date`, `orders`.`update_at`, `orders`.`currency`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
		JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id` 
		WHERE `user_id` = :id 
		GROUP BY `orders`.`id` ORDER BY `orders`.`status`, `orders`.`id` DESC", ['id' => (int) $_SESSION['user']['id']]);
    }
    
    static function getOrder($id)
    {
        return Db::row("SELECT `orders`.*, `users`.`username`, SUM(`order_product`.`qty`) AS `qty`, ROUND(SUM(`order_product`.`price`*`order_product`.`qty`), 2) AS `sum` FROM `orders` 
        JOIN `users` ON `orders`.`user_id` = `users`.`id`
        JOIN `order_product` ON `orders`.`id` = `order_product`.`order_id`
        WHERE `orders`.`id` = :id
        GROUP BY `orders`.`id` ORDER BY `orders`.`status`, `orders`.`id`", ['id' => $id]);
    }

    static function getOrderProducts($id)
    {
        return Db::rowAll("SELECT `order_product`.*, `product`.`img` FROM `order_product` 
        JOIN `product` ON `order_product`.`product_id` = `product`.`id` 
        WHERE order_id = :id", ['id' => $id]);
    }

    static function getAddress()
    {
        $stmt = Db::row("SELECT `address_id` FROM `users` WHERE `id` = :id", ['id' => (int) $_SESSION['user']['id']]);
        return $stmt['address_id'];
    }

    static function getAddresses()
    {
        $stmt = Db::query("SELECT * FROM `address` WHERE `user_id` = :id", ['id' => (int) $_SESSION['user']['id']]);
        return $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
    }

    static function getUserAddress()
    {
        return Db::row("SELECT `address`.* FROM `users` 
		JOIN `address` ON `users`.`address_id` = `address`.`id` 
		WHERE `user_id` = :id", ['id' => (int) $_SESSION['user']['id']]);
    }

    static function updateAddress($id)
    {
        $stmt = Db::query("UPDATE `users` SET `address_id` = '{$id}' WHERE `id` = :id", ['id' => (int) $_SESSION['user']['id']]);
        return $stmt->rowCount();
    }

    static function updatePassword($newPassword)
    {
        $stmt = Db::query("UPDATE `users` SET `password` = '{$newPassword}' WHERE `id` = :id", ['id' => (int) $_SESSION['user']['id']]);
        return $stmt->rowCount();
    }

    static function updateUser()
    {
        $data = cleanArray($_POST);
        $values = sqlPart($data);

        $data['id'] = $_SESSION['user']['id'];

        $stmt = Db::query("UPDATE `users` SET {$values} WHERE `id` = :id", $data);
        return $stmt->rowCount();
    }
}
