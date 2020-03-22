<?php

namespace app\controllers\admin;

use app\core\libs\Pagination;
use app\models\Address;
use app\models\admin\User;

class UserController extends Controller
{
    function indexAction()
    {
        $page       = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perpage    = 10;
        $count      = User::getCountUsers();
        $pagination = new Pagination($page, $perpage, $count);
        $start      = $pagination->getStart();
        $users      = User::getAll($start, $perpage);

        $this->set(compact('users', 'pagination', 'count'));
        $this->setMeta('Users');
    }
    
    function editAction()
    {
        if (!empty($_POST)) {
            if (User::update()) {
                $_SESSION['success'][]  = 'Changes saved';
            } else $_SESSION['error'][] = 'Changes not saved';

            redirect();
        }

        $id      = (int) $_GET['id'];
        $user    = User::get($id);
        $orders  = User::getOrders($id);
        $address = Address::get($user['address_id']);

        $countries = include_once CONFIG . '/countries.php';

        $this->set(compact('user', 'orders', 'address', 'countries'));
        $this->setMeta('Edit user');
    }

    function deleteAction()
    {
        $id = (int) $_GET['id'];

        if (User::delete($id)) {
            $_SESSION['success'][]  = 'User is deleted';
        } else $_SESSION['error'][] = 'User is not deleted';

        redirect(ADMIN . '/user');
    }
}
