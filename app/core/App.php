<?php

namespace app\core;

class App
{
    function __construct()
    {
        session_start();

        new ErrorHandler();
        new Router();
    }
}
