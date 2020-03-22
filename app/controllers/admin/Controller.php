<?php

namespace app\controllers\admin;

use app\core\base\BaseController;
use app\models\User;

class Controller extends BaseController
{
    // protected $layout = 'admin';

    function __construct($route)
    {
        parent::__construct($route);

        if (!User::isAdmin()) redirect('/login');
    }
}
