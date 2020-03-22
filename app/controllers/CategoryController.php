<?php

namespace app\controllers;

use app\core\base\Controller;
use app\core\libs\Pagination;
use app\models\Main;
use app\models\Category;
use app\widgets\filter\Filter;

class CategoryController extends Controller
{
    function indexAction()
    {
        include LIBS . '/sale.php';

        $products    = 
        $breadcrumbs = 
        $sql_part    = null;
        $category_id = Category::getId($this->alias);

        if ($category_id) {
            $ids = Category::getIds($category_id);
            $ids = $ids ? $ids . $category_id : $category_id;

            $breadcrumbs = Category::getBreadCrumbs($category_id);
        } else throw new \Exception("Page not found", 404);

        $page 	 = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perpage = 6;

        if (!empty($_GET['filter'])) {
            $filter   = Filter::getFilter();
            $count    = Filter::getCountGroups($filter);
            $sql_part = "AND `id` IN (SELECT `product_id` FROM `attr_product` WHERE `attr_id` IN ({$filter}) GROUP BY `product_id` HAVING COUNT(`product_id`) = {$count})";
        }

        $total 		= Category::getCount($ids, $sql_part);
        $pagination = new Pagination($page, $perpage, $total);
        $start 		= $pagination->getStart();
        $products 	= Category::getProducts($ids, $start, $perpage, $sql_part);

        $colors = Main::getColors();
        $sizes  = Main::getSizes();

        // show Product js
        if ($this->isAjax()) $this->loadView('filter', compact('products', 'pagination', 'total', 'colors', 'sizes'));

        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total', 'colors', 'sizes'));
        $this->setMeta($_SESSION['category'][$category_id]['title'], $_SESSION['category'][$category_id]['description'], "category, categories, {$_SESSION['category'][$category_id]['title']}, keywords...");
    }
}
