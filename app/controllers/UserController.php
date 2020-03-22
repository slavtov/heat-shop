<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\User;

class UserController extends Controller
{
    function __construct($route)
    {
        parent::__construct($route);

        // Check Auth except logout
        if (trim($_SERVER['REQUEST_URI'], '/') != 'user/logout') {
            if (User::auth()) redirect('/profile');
        }
    }

    function signupAction()
    {
        if (!empty($_POST) AND isset($_POST['checkbox'])) {
            $data = cleanArray(test_input($_POST, 'password', 'confirm-password'));
            
            if ($data['password'] == $data['confirm-password']) {
                $this->validate([
                    'email' 		   => 'required|min:5|email',
                    'username' 		   => 'required|min:2|alnum',
                    'password' 		   => 'required|min:6',
                    'confirm-password' => 'required|min:6'
                ]);
                
                $id = User::save($data);

                if ($id) {
                    $data['id']   = $id;
                    $data['role'] = 'user';
                    
                    if (isset($data['checkbox']))         unset($data['checkbox']);
                    if (isset($data['password']))         unset($data['password']);
                    if (isset($data['confirm-password'])) unset($data['confirm-password']);

                    $_SESSION['success'][] = 'You are successfully registered!';

                    updateSession('user', $data);
                } else User::unique();
            } else {
                $_SESSION['error'][]   = 'Passwords are not the same';
                $_SESSION['form-data'] = $_POST;
            }

            redirect();
        }

        $this->setMeta('Sign Up', 'Sign Up form', 'signup, sign, up, register, keywords...');
    }

    function loginAction()
    {
        if (!empty($_POST)) {
            $this->validate([
                'username' => 'required|min:2|alnum',
                'password' => 'required|min:6'
            ]);

            if (User::login()) {
                User::isAdmin() ? redirect(ADMIN) : redirect();
            } else {
                $_SESSION['error'][] = 'Username/password is incorrect';
            }

            redirect();
        }

        $this->setMeta('Log In', 'Log In form', 'login, keywords...');
    }

    function logoutAction()
    {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);

        redirect('/');
    }

    function passwordAction()
    {
        if (!empty($_POST)) {
            $this->validate([
                'data' => 'required|min:2'
            ]);
            if ($token = User::createToken()) {
                User::mailPassword($token);
            } else {
                $_SESSION['error'][] = "Email or Username are not found";
            }

            redirect();
        }

        $this->setMeta('Reset Password', 'Password reset form', 'password, reset, form, keywords...');
    }

    function resetAction()
    {
        if (isset($_GET['token']) AND !empty($_GET['token'])) {
            if (User::checkPassword()) {
                if (!empty($_POST)) {
                    if ($_POST['password'] == $_POST['confirm-password']) {
                        User::updatePassword();

                        $_SESSION['success'][] = 'The password is updated successfully!';
                        redirect('login');
                    } else {
                        $_SESSION['error'][] = 'The passwords are not equal';
                        redirect();
                    }
                }
            } else redirect('/');
        } else redirect('/');

        $this->setMeta('Set Password');
    }
}
