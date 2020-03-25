<?php

namespace app\models\admin;

use app\core\base\Model;
use app\core\Db;

class Question extends Model
{
    static function delete($id)
    {
        $stmt = Db::query("DELETE FROM `contact` WHERE `id` = :id", ['id' => $id]);
        return $stmt->rowCount();
    }
}
