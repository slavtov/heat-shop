<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Profile;
use app\models\User;

class ProfileController extends Controller
{
    function __construct($route)
    {
        parent::__construct($route);

        if (!User::auth()) redirect();
    }

    function indexAction()
    {
        $limit	 = 3;
        $orders	 = Profile::getLatestOrders($limit);
        $address = Profile::getUserAddress();

        $this->set(compact('orders', 'address'));
        $this->setMeta('My profile');
    }
    
    function ordersAction()
    {
        $orders = Profile::getOrders();

        $this->set(compact('orders'));
        $this->setMeta('My orders');
    }

    function orderAction()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        if (!$id) redirect();

        $order 		   = Profile::getOrder($id);
        $orderProducts = Profile::getOrderProducts($id);

        $this->set(compact('order', 'orderProducts'));
        $this->setMeta('Order');
    }

    function addressAction()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($id) {
            if (Profile::updateAddress($id)) {
                $_SESSION['success'][]  = 'The address updated successfully!';
            } else $_SESSION['error'][] = 'The address not updated';

            redirect();
        }
        
        $address	 = Profile::getAddress();
        $addresses	 = Profile::getAddresses();
        $userAddress = $addresses[$address] ?? null;
        unset($addresses[$address]);

        $this->set(compact('address', 'addresses', 'userAddress'));
        $this->setMeta('Address');
    }
    
    function editAction()
    {
        if (!empty($_POST)) {
            if (Profile::updateUser()) {
                updateSession('user', $_POST);

                $_SESSION['success'][]   = 'The data updated successfully!';
            } else  $_SESSION['error'][] = 'The data not updated';
            
            redirect();
        }

        $this->setMeta('Edit personal data');
    }

    function passwordAction()
    {
        if (!empty($_POST)) {
            $oldPassword	 = $_POST['old_password'];
            $newPassword	 = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            $user          = Profile::getUser();
            $checkPassword = password_verify($oldPassword, $user['password']);

            if ($checkPassword) {
                if ($newPassword == $confirmPassword) {
                    $newPassword   = password_hash($newPassword, PASSWORD_DEFAULT);
                    $checkPassword = Profile::updatePassword($newPassword);

                    if ($checkPassword) {
                        $_SESSION['success'][] = 'The password updated successfully!';
                    }
                } else $_SESSION['error'][] = "The passwords don't match";
            } else $_SESSION['error'][]     = 'Old password is incorrect';
            
            redirect();
        }

        $this->setMeta('Change password');
    }
}
