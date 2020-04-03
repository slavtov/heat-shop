<?php

namespace app\controllers\admin;

use app\core\libs\Pagination;
use app\models\admin\Order;
use app\models\admin\Product;

class OrderController extends Controller
{
    function indexAction()
    {
        $page		 = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perpage	 = 10;
        $count       = Order::getCountOrders();
        $pagination	 = new Pagination($page, $perpage, $count);
        $start		 = $pagination->getStart();
        $orders		 = Order::getAll($start, $perpage);

        $this->set(compact('orders', 'pagination', 'count'));
        $this->setMeta('Order list');
    }

    function viewAction()
    {
        $id 		   = (int) $_GET['id'];
        $orderProducts = Product::getOrderProducts($id);

        $order = Order::get($id);
        if (!$order) throw new \Exception('Page not found', 404);

        $this->set(compact('order', 'orderProducts'));
        $this->setMeta("Order №{$id}");
    }

    function updateAction()
    {
        $id 	= (int) $_GET['id'];
        $status = !empty($_GET['status']) ? 1 : 0;

        $order 	= Order::get($id);
        if (!$order) throw new \Exception('Page not found', 404);

        if (Order::updateStatus($id, $status)) {
            $_SESSION['success'][]  = 'Changes saved';
        } else $_SESSION['error'][] = 'Changes not saved';
        
        redirect();
    }

    function deleteAction()
    {
        $id = (int) $_GET['id'];

        if (Order::delete($id)) {
            $_SESSION['success'][]  = 'The order deleted successfully!';
        } else $_SESSION['error'][] = 'The order not deleted';

        redirect(ADMIN . '/order');
    }
}
