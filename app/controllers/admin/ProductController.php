<?php

namespace app\controllers\admin;

use app\core\libs\Pagination;
use app\models\admin\Category;
use app\models\admin\Product;

class ProductController extends Controller
{
    function indexAction()
    {
        $page       = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perpage    = 10;
        $count      = Product::getCountProducts();
        $pagination = new Pagination($page, $perpage, $count);
        $start      = $pagination->getStart();
        $products   = Product::getAll($start, $perpage);

        $this->set(compact('products', 'pagination', 'count'));
        $this->setMeta('Products');
    }

    function addAction()
    {
        if (!empty($_POST)) {
            $this->validate([
                'title'       => 'required|min:2|alpha',
                'price'       => 'required|digit',
                'category_id' => 'required|digit'
            ]);

            if (Product::add()) {
                $_SESSION['success'][]  = 'The product is added successfully!';
            } else $_SESSION['error'][] = 'The product is not added';

            redirect(ADMIN . '/product');
        }
        
        $categories = Category::getAll();

        $arrColor      = include_once CONFIG . '/colors.php';
        $arrSize       = include_once CONFIG . '/sizes.php';
        $arrSizeNumber = include_once CONFIG . '/numberSizes.php';

        $this->set(compact('arrColor', 'arrSize', 'arrSizeNumber', 'categories'));
        $this->setMeta('Add product');
    }
    
    function editAction()
    {
        if (!empty($_POST)) {
            // $this->validate([
            //     'title'       => 'required|min:2|alpha',
            //     'price'       => 'required|digit',
            //     'category_id' => 'required|digit'
            // ]);

            if (Product::edit()) {
                $_SESSION['success'][]  = 'The product is changed';
            } else $_SESSION['error'][] = 'The product is not changed';

            redirect();
        }

        if (isset($_GET['id'])) {
            if (!$id = (int) $_GET['id']) redirect();
        } else redirect();

        $product = Product::get($id);
        $colors  = Product::getColors($id);
        $sizes   = Product::getSizes($id);

        $categories = Category::getAll();

        $arrColor      = include_once CONFIG . '/colors.php';
        $arrSize       = include_once CONFIG . '/sizes.php';
        $arrSizeNumber = include_once CONFIG . '/numberSizes.php';

        $this->set(compact('product', 'colors', 'sizes', 'arrColor', 'arrSize', 'arrSizeNumber', 'categories'));
        $this->setMeta('Edit product');
    }

    function deleteAction()
    {
        if (isset($_GET['id'])) {
            if (!$id = (int) $_GET['id']) redirect();
        } else redirect();

        if (Product::delete($id)) {
            $_SESSION['success'][]  = 'The order is deleted';
        } else $_SESSION['error'][] = 'The order is not deleted';

        redirect(ADMIN . '/product');
    }
}
