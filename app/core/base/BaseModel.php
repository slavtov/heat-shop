<?php

namespace app\core\base;

use app\core\Db;

abstract class BaseModel
{
    static function all($table)
    {
        return Db::rowAll("SELECT * FROM {$table}");
    }

    static function loadImage()
    {
        if (!empty($_FILES['image']['name'])) {
            $exts       = ['jpeg', 'jpg', 'png'];
            $ext        = explode('.', $_FILES['image']['name']);
            $fileExt    = strtolower(end($ext));
            $fileName   = date('YmdHis', time()) . mt_rand() . '.' . $fileExt;
            $uploadPath = getcwd() . '/img/' . $fileName;

            if (!in_array($fileExt, $exts)) {
                $_SESSION['error'][] = 'The file extension is not allowed. Please upload a JPG or PNG file';
                return null;
            }

            if ($_FILES['image']['size'] > 10000000) {
                $_SESSION['error'][] = 'The file is more than 10 MB';
                return null;
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $_SESSION['error'][] = 'Failed to upload image';
                return null;
            }

            return $fileName;
        }

        return null;
    }
    
    static function loadImages($product_id)
    {
        $exts   = ['jpeg', 'jpg', 'png'];
        $images = reArrayFiles($_FILES['gallery']);
        $values = '';

        foreach ($images as $key => $image) {
            if (!$image['name']) continue;

            $ext        = explode('.', $image['name']);
            $fileExt    = strtolower(end($ext));
            $fileName   = date('YmdHis', time()) . mt_rand() . '.' . $fileExt;
            $uploadPath = getcwd() . '/img/' . $fileName;

            if (!in_array($fileExt, $exts)) {
                $_SESSION['error'][] = 'The file extension is not allowed. Please upload a JPG or PNG file';
                return null;
            }

            if ($image['size'] > 10000000) {
                $_SESSION['error'][] = 'The file is more than 10 MB';
                return null;
            }

            if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $_SESSION['error'][] = 'Failed to upload image';
                return null;
            }

            $values .= "({$product_id}, '{$fileName}'),";
        }

        return rtrim($values, ',');
    }
}
