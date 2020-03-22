<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Main;
use app\models\Search;

class SearchController extends Controller
{
    function indexAction()
    {
        include LIBS . '/sale.php';

        $s        = 
        $products = null;

        if (isset($_GET['q']) AND !empty(trim($_GET['q']))) {
            $s = trim(html($_GET['q']));
        }

        if ($s) $products = Search::findProducts("%{$s}%");

        $colors = Main::getColors();
        $sizes  = Main::getSizes();

        $this->set(compact('products', 's', 'colors', 'sizes'));
        $this->setMeta('Search: ' . $s, 'Search results', 'search, find, keywords...');
    }
}
