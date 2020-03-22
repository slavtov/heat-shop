<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Category;
use app\models\Main;
use app\models\Product;

class ProductController extends Controller
{
    function indexAction()
    {
        include LIBS . '/sale.php';

        $product = Product::getProduct($this->alias);
        if (!$product) throw new \Exception("Page not found", 404);

        $related 		= Product::getRelated($product['id']);
        $recentlyViewed = Product::getRecentlyViewed($product['id']);
        $gallery 		= Product::getGallery($product['id']);
        $mods           = Product::getColor($product['id']);
        $modSize        = Product::getSize($product['id']);

        $breadcrumbs 	= Category::getBreadCrumbs($product['category_id']);

        $allColor 		= Main::getColors();
        $allSize		= Main::getSizes();

        $this->set(compact('product', 'breadcrumbs', 'related', 'recentlyViewed', 'gallery', 'mods', 'modSize', 'allColor', 'allSize'));
        $this->setMeta($product['title'], $product['description'], $product['keywords']);
    }
}
