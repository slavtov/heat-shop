<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Address extends Model
{
    static function get($id)
    {
        return Db::row("SELECT * FROM `address` WHERE `id` = :id", ['id' => $id]);
    }

    static function add($data = null)
    {
        if (!$data) $data = cleanArray($_POST);

        $countries       = include CONFIG . '/countries.php';
        $data['country'] = in_array($data['country'], $countries) ? $data['country'] : null;
        if (!$data['country']) return false;

        $data['user_id']    = $_SESSION['user']['id'];
        $data['first_name'] = ucfirst($data['first_name']);
        $data['last_name']  = ucfirst($data['last_name']);

        if (!empty($data['middle_name'])) ucfirst($data['middle_name']);
        if (!empty($data['apartment']))   ucfirst($data['apartment']);

        foreach ($data as $key => $val) {
            $arr['keys'][]   = '`'.$key.'`';
            $arr['values'][] = ':'.$key;
        }

        $keys   = implode(', ', $arr['keys']);
        $values = implode(', ', $arr['values']);

        $stmt = Db::query("INSERT INTO `address` ({$keys}) VALUES ({$values})", $data);
        return $stmt->rowCount();
    }

    static function edit($id)
    {
        $data       = cleanArray($_POST);
        $data['id'] = $id;

        if (!isset($data['middle_name'])) $data['middle_name'] = true;
        if (!isset($data['apartment']))   $data['apartment']   = true;

        $values = sqlPart($data);

        if ($data['middle_name'] === true) $data['middle_name'] = null;
        if ($data['apartment'] === true)   $data['apartment']   = null;

        $stmt = Db::query("UPDATE `address` SET {$values} WHERE `id` = :id", $data);
        return $stmt->rowCount();
    }

    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `address` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }
}
