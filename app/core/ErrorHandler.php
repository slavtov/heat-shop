<?php

namespace app\core;

class ErrorHandler
{
    function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        
        set_exception_handler([$this, 'exceptionHandler']);
    }

    function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Error: {$message} | File: {$file} | Line: {$line}" . PHP_EOL, 3, ROOT . '/tmp/errors.log');
    }

    protected function displayError($type, $errstr, $errfile, $errline, $errno = 404)
    {
        http_response_code($errno);
        
        if (DEBUG) {
            require WWW . '/errors/development.php';
        } else {
            require WWW . '/errors/production.php';
        }
    }
}
