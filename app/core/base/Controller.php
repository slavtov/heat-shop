<?php

namespace app\core\base;

use app\widgets\currency\Currency;

class Controller extends BaseController
{
    function __construct($route)
    {
        parent::__construct($route);

        $_SESSION['currencies'] = Currency::getCurrencies();
        $_SESSION['currency']   = Currency::getCurrency($_SESSION['currencies']);
    }
}
