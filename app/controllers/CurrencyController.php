<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Currency;

class CurrencyController extends Controller
{
    function changeAction()
    {
        $currency = !empty($_GET['val']) ? $_GET['val'] : null;

        if ($currency) {
            $stmt = Currency::getCurrencies($currency);
            if ($stmt->fetch(\PDO::FETCH_NUM)[0]) {
                setcookie('currency', $currency, time() + 3600 * 24, '/');
            }
        }

        redirect();
    }
}
