<?php

namespace app\models\admin;

use app\core\base\Model;

class Main extends Model
{
    static function getCountUsers()
    {
        $arr   = self::all('users');
        $count = [
            'admin' => 0,
            'today' => 0,
            'month' => 0,
            'year'  => 0,
            'all'   => count($arr)
        ];
        
        foreach ($arr as $val) {
            if ($val['role'] == 'admin') $count['admin']++;

            $dateToday = date('Y-m-d', strtotime($val['date']));
            $dateMonth = date('Y-m',   strtotime($val['date']));
            $dateYear  = date('Y',     strtotime($val['date']));

            if ($dateToday == date('Y-m-d')) $count['today']++;
            if ($dateMonth == date('Y-m'))   $count['month']++;
            if ($dateYear  == date('Y'))     $count['year']++;
        }

        return $count;
    }

    static function getCountProducts()
    {
        $arr   = self::all('product');
        $count = [
            'hit'  => 0,
            'show' => 0,
            'hide' => 0,
            'all'  => count($arr)
        ];
        
        foreach ($arr as $val) {
            $val['status'] == 0 ? $count['hide']++ : $count['show']++;
            if ($val['hit']) $count['hit']++;
        }

        return $count;
    }

    static function getCountCategories()
    {
        $arr   = self::all('category');
        $count = [
            'parent' => 0,
            'child'  => 0,
            'all'    => count($arr)
        ];
        
        foreach ($arr as $val) $val['parent_id'] == 0 ? $count['parent']++ : $count['child']++;

        return $count;
    }

    static function getCountOrders()
    {
        $arr   = self::all('orders');
        $count = [
            'complete'   => 0,
            'processing' => 0,
            'today'      => 0,
            'month'      => 0,
            'year'       => 0,
            'all'        => count($arr)
        ];
        
        foreach ($arr as $val) {
            $val['status'] == 1 ? $count['complete']++ : $count['processing']++;
            
            $dateToday = date('Y-m-d', strtotime($val['date']));
            $dateMonth = date('Y-m',   strtotime($val['date']));
            $dateYear  = date('Y',     strtotime($val['date']));

            if ($dateToday == date('Y-m-d')) $count['today']++;
            if ($dateMonth == date('Y-m'))   $count['month']++;
            if ($dateYear  == date('Y'))     $count['year']++;
        }
        
        return $count;
    }
}
