<?php

namespace app\models;

use app\core\base\Model;
use app\core\Db;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends Model
{
    static function save($order)
    {
        $arr = [
            'user'     => $order['user_id'],
            'currency' => $_SESSION['currency']['code'],
            'address'  => $order['address'],
            'note'     => $order['note'],
            'email'    => null
        ];

        if (!$order['user_id']) {
            $arr['email'] = $order['user_email'];
            $arr['user'] = 1;
        }

        Db::query("INSERT INTO `orders` (`user_id`, `email`, `currency`, `address`, `note`) VALUES (:user, :email, :currency, :address, :note)", $arr);
        $order_id = Db::getId();

        self::saveOrderProduct($order_id);
        self::mailOrder($order_id, $order['user_email']);
    }

    static function saveOrderProduct($order_id)
    {
        $values = '';

        foreach ($_SESSION['cart'] as $product_id => $product) {
            $product_id        = (int) $product_id;
            $product['price'] *= $_SESSION['currency']['value'];
            $values           .= "($order_id, $product_id, '{$product['size']}', {$product['qty']}, '{$product['title']}', {$product['price']}),";
        }

        $values = rtrim($values, ',');

        Db::query("INSERT INTO `order_product` (`order_id`, `product_id`, `size`, `qty`, `title`, `price`) VALUES {$values}");
    }

    static function mailOrder($order_id, $user_email)
    {
        $arr = include CONFIG . '/params.php';

        $transport = (new Swift_SmtpTransport($arr['smtp_host'], $arr['smtp_port'], $arr['smtp_protocol']))
          ->setUsername($arr['smtp_login'])
          ->setPassword($arr['smtp_password']);

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Wonderful Subject'))
          ->setFrom([$arr['smtp_login'] => $arr['shop_name']])
          ->setTo([$user_email, $arr['admin_email'] => $arr['shop_name']])
          ->setBody('Order №' . $order_id . '<br>Email:' . $user_email, 'text/html');

        $mailer->send($message);

        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);

        $_SESSION['cart.success'] = true;
    }
}
