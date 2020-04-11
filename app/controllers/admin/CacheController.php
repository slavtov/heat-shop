<?php

namespace app\controllers\admin;

use app\core\Cache;

class CacheController extends Controller
{
    function indexAction()
    {
        $this->setMeta('Cache');
    }

    function deleteAction()
    {
        $key = $_GET['key'] ?? null;

        switch ($key) {
            case 'category':
                Cache::delete('shop_menu');
                break;

            case 'filter':
                Cache::delete('filter_groups');
                Cache::delete('filter_attrs');
                break;

            default:
                $_SESSION['error'][] = 'The link is incorrect';
                redirect();
                break;
        }

        $_SESSION['success'][] = 'The cache deleted successfully!';

        redirect();
    }
}
