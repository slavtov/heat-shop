<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class User extends Model
{
    static function auth()
    {
        return isset($_SESSION['user']);
    }

    static function isAdmin()
    {
        return (isset($_SESSION['user']) AND ($_SESSION['user']['role'] == 'admin'));
    }

    static function unique()
    {
        $user = Db::row("SELECT `username`, `email` FROM `users` WHERE `username` = :username OR `email` = :email", ['username' => $_POST['username'], 'email' => $_POST['email']]);

        if ($user) {
            if ($user['username'] == $_POST['username']) {
                $_SESSION['error'][] = 'This Username already exists';
            }
            
            if ($user['email'] == $_POST['email']) {
                $_SESSION['error'][] = 'This Email already exists';
            }
        }
    }

    static function login()
    {
        $username = !empty(trim($_POST['username'])) ? trim($_POST['username']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if ($username AND $password) {
            $user = Db::row("SELECT `id`, `username`, `email`, `role`, `password` FROM `users` WHERE `username` = :username", ['username' => $username]);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    foreach ($user as $key => $val) {
                        if ($key != 'password') $_SESSION['user'][$key] = $val;
                    }
                    
                    return true;
                }
            }
        }
        return false;
    }

    static function save($data)
    {
        Db::query("INSERT INTO `users` (`username`, `email`, `password`) VALUES (:username, :email, :password)", [
            'username' => $data['username'],
            'email'	   => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);

        return Db::getId();
    }

    static function checkPassword()
    {
        $stmt = Db::row("SELECT * FROM `users` WHERE `remember_token` = :token", ['token' => $_GET['token']]);
        if ($stmt) {
            $time = $stmt['time_token'] + 60*60;

            if ($time > time()) {
                return $stmt;
            } else {
                Db::query("UPDATE `users` SET `remember_token` = null, `time_token` = null WHERE `remember_token` = :token", ['token' => $_GET['token']]);
                return false;
            }
        }

        return false;
    }

    static function updatePassword()
    {
        $stmt = Db::query("UPDATE `users` SET `password` = :password, `remember_token` = null, `time_token` = null WHERE `remember_token` = :token", [
            'token'    => $_GET['token'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        return $stmt->rowCount();
    }

    static function createToken()
    {
        $stmt = Db::row("SELECT * FROM `users` WHERE `username` = :username", ['username' => $_POST['data']]);
        if ($stmt) {
            $token = bin2hex(random_bytes(50));
            $time  = time();

            $stmt = Db::query("UPDATE `users` SET `remember_token` = '{$token}', `time_token` = '{$time}' WHERE `username` = :username", ['username' => $_POST['data']]);
            return $token;
        }

        return false;
    }

    static function mailPassword($token)
    {
        $arr = include CONFIG . '/params.php';

        $transport = (new Swift_SmtpTransport($arr['smtp_host'], $arr['smtp_port'], $arr['smtp_protocol']))
          ->setUsername($arr['smtp_login'])
          ->setPassword($arr['smtp_password']);

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Wonderful Subject'))
          ->setFrom([$arr['smtp_login'] => $arr['shop_name']])
          ->setTo([$user_email, $arr['admin_email'] => $arr['shop_name']])
          ->setBody('Token valid 1 hour.<br>Password reset link: <a href="' . PATH . '/reset?token=' . $token . '">http://' . $_SERVER['HTTP_HOST'] . '/reset?token=' . $token . '</a>', 'text/html');

        $mailer->send($message);

        $_SESSION['success'][] = 'The letter was sent. Check your Email';
    }
}
