<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Address;
use app\models\Cart;
use app\models\Main;
use app\models\Order;
use app\models\Profile;
use app\models\User;

class CartController extends Controller
{
    function viewAction()
    {
        $this->setMeta('Cart');
    }

    function addAction()
    {
        $id 	  = !empty($_GET['id'])    ? (int) $_GET['id']    : null;
        $qty 	  = !empty($_GET['qty'])   ? (int) $_GET['qty']   : 1;
        $mod_id   = !empty($_GET['color']) ? (int) $_GET['color'] : null;
        $modSize  = !empty($_GET['size'])  ? $_GET['size']        : null;
        $modColor = null;

        if ($id) {
            $product = Cart::getOne($id);
            if (!$product OR $product['stock'] != 'on') return false;

            if ($mod_id) $modColor = Cart::getColor($mod_id, $id);
        }

        if (!$this->isAjax() AND !isset($_SERVER['HTTP_REFERER'])) {
            $allColor = Main::getColors();
            $allSize  = Main::getSizes();

            if (isset($allColor[$id]) OR isset($allSize[$id])) redirect('/');
        }

        Cart::addToCart($product, $qty, $modColor, $modSize);

        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect('/cart/view');
    }

    function showAction()
    {
        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect('cart/view');
    }

    function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;

        if (isset($_SESSION['cart'][$id])) Cart::deleteItem($id);
        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect();
    }

    function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);

        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect();
    }

    function qtyPlusAction()
    {
        $id = !empty($_GET['id']) ? html($_GET['id']) : null;

        if (isset($_SESSION['cart'][$id])) Cart::qtyPlus($id);
        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect();
    }

    function qtyMinusAction()
    {
        $id = !empty($_GET['id']) ? html($_GET['id']) : null;

        if (isset($_SESSION['cart'][$id])) Cart::qtyMinus($id);
        if ($this->isAjax()) $this->loadView('cart_modal');

        redirect();
    }

    function checkoutAction()
    {
        if (!isset($_SESSION['cart']) OR empty($_SESSION['cart'])) redirect();

        $address          = 
        $addresses        = 
        $userAddress      = 
        $order['user_id'] = null;

        if (!empty($_POST)) {
            if (!User::auth()) {
                $this->validate([
                    'email'       => 'required|min:5|email',
                    'first_name'  => 'required|alpha',
                    'middle_name' => 'alpha',
                    'last_name'   => 'required|alpha',
                    'city'        => 'required|alnum',
                    'street'      => 'required|alnum',
                    'house'       => 'required|min-num:1|digit',
                    'apartment'   => 'min-num:1|digit',
                    'region'      => 'required|alnum',
                    'zip'         => 'required|min:5|digit'
                ]);
            }

            // If Register Form exists
            if (!User::auth() 
            AND !empty($_POST['username']) 
            AND !empty($_POST['password']) 
            AND !empty($_POST['confirm-password'])) {
                $data = cleanArray(test_input($_POST, 'password', 'confirm-password'));

                $this->validate([
                    'username'         => 'min:2|alnum',
                    'password'         => 'min:6',
                    'confirm-password' => 'min:6'
                ]);

                // Save user
                $id = User::save($data);

                if ($id) {
                    $user['id']       = $id;
                    $user['email']    = $data['email'];
                    $user['username'] = $data['username'];
                    $user['role']     = 'user';

                    updateSession('user', $user);
                } else {
                    User::unique();
                    $_SESSION['form-data'] = $_POST;

                    redirect();
                }
            }

            $data = cleanArray(test_input($_POST));

            // Address
            if (User::auth()) $address = Profile::getUserAddress();

            if ($address) {
                $order['address'] = serialize($address);
            } else {
                // Address from the form
                if (User::auth()) {
                    if (Profile::getAddresses()) {
                        $_SESSION['error'][] = 'Select address';
                        redirect();
                    }

                    $this->validate([
                        'first_name'  => 'required|alpha',
                        'middle_name' => 'alpha',
                        'last_name'   => 'required|alpha',
                        'city'        => 'required|alnum',
                        'street'      => 'required|alnum',
                        'house'       => 'required|min-num:1|digit',
                        'apartment'   => 'min-num:1|digit',
                        'region'      => 'required|alnum',
                        'zip'         => 'required|min:5|digit'
                    ]);
                }

                // Check country
                $countries = include CONFIG . '/countries.php';
                $country   = in_array($_POST['country'], $countries) ? $_POST['country'] : null;
                if (!$country) redirect();

                // Check optional
                $middleName = !empty($data['middle_name']) ? $data['middle_name'] : null;
                $apartment 	= !empty($data['apartment'])   ? $data['apartment']	  : null;

                $arr = [
                    'first_name'  => $data['first_name'],
                    'middle_name' => $middleName,
                    'last_name'   => $data['last_name'],
                    'country'     => $data['country'],
                    'region'      => $data['region'],
                    'city'        => $data['city'],
                    'street'      => $data['street'],
                    'house'       => $data['house'],
                    'apartment'   => $apartment,
                    'zip'         => $data['zip']
                ];

                $order['address'] = serialize($arr);

                // Check save-info
                if (isset($_POST['save-info']) 
                AND !empty($_POST['username']) 
                AND !empty($_POST['password'])) Address::add($arr);
            }

            // Save order
            if (User::auth()) {
                $order['user_id']	    = $_SESSION['user']['id'];
                $order['user_email']    = $_SESSION['user']['email'];
            } else $order['user_email'] = $data['email'];

            $order['note'] = !empty($data['note']) ? $data['note'] : null;

            Order::save($order);

            redirect('/cart/success');
        }

        if (User::auth()) {
            $address   = Profile::getAddress();
            $addresses = Profile::getAddresses();

            if (isset($addresses[$address])) {
                $userAddress = $addresses[$address];
                unset($addresses[$address]);
            }
        }

        $countries = include CONFIG . '/countries.php';

        $this->set(compact('countries', 'address', 'addresses', 'userAddress'));
        $this->setMeta('Checkout');
    }

    function successAction()
    {
        if (empty($_SESSION['cart.success'])) redirect('/');

        $this->setMeta('Order completed');
    }
}
