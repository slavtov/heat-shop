<?php

namespace app\core;

use PDO;

class Db
{
    private static $db = null;

    private static function connect()
    {
        if (!self::$db) {
            $config	  = include CONFIG . '/db.php';
            self::$db = new PDO($config['dsn'], $config['user'], $config['pass']);
        }

        return self::$db;
    }

    static function query($sql, $params = [])
    {
        $stmt = self::connect()->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $val) $stmt->bindValue(':'.$key, $val);
        }

        $stmt->execute();
        return $stmt;
    }

    static function row($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function rowAll($sql, $params = [])
    {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getId()
    {
        $stmt = self::connect()->lastInsertId();
        return $stmt;
    }
}
