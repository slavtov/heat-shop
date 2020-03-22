<?php

namespace app\controllers\admin;

use app\models\admin\Main;

class MainController extends Controller
{
    function indexAction()
    {
        $orders 	= Main::getCountOrders();
        $products 	= Main::getCountProducts();
        $users 		= Main::getCountUsers();
        $categories = Main::getCountCategories();
        $questions  = count(Main::all('contact'));

        $this->set(compact('orders', 'products', 'users', 'categories', 'questions'));
        $this->setMeta('Admin Panel');
    }
}
