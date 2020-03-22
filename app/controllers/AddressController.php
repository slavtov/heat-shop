<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Address;
use app\models\User;

class AddressController extends Controller
{
    function __construct($route)
    {
        parent::__construct($route);

        if (!User::auth()) redirect();
    }
    
    function addAction()
    {
        if (!empty($_POST)) {
            if (Address::add()) {
                $_SESSION['success'][]  = 'The address is added successfully!';
            } else $_SESSION['error'][] = 'The address is not added';

            redirect('/profile/address');
        }

        $countries = include_once CONFIG . '/countries.php';

        $this->set(compact('countries'));
        $this->setMeta('Add address');
    }

    function editAction()
    {
        $id	= isset($_GET['id']) ? (int) $_GET['id'] : null;
        if (!$id) redirect();

        $address = Address::get($id);
        if ($address['user_id'] != $_SESSION['user']['id']) redirect();

        if (!empty($_POST)) {
            if (Address::edit($id)) {
                $_SESSION['success'][]  = 'The address is updated successfully!';
            } else $_SESSION['error'][] = 'The address is not changed';

            redirect('/profile/address');
        }

        $countries = include_once CONFIG . '/countries.php';
        
        $this->set(compact('address', 'countries'));
        $this->setMeta('Edit address');
    }

    function deleteAction()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($id) {
            $address = Address::get($id);
            if ($address['user_id'] != $_SESSION['user']['id']) redirect();

            if (Address::delete($id)) {
                $_SESSION['success'][]  = 'The address is deleted successfully!';
            } else $_SESSION['error'][] = 'The address is not deleted';
        }

        redirect('/profile/address');
    }
}
