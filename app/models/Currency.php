<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;

class Currency extends Model
{
    static function getCurrencies($currency)
    {
        return Db::query("SELECT EXISTS(SELECT `code` FROM `currency` WHERE `code` = :code)", ['code' => $currency]);
    }
}
