<?php

namespace app\controllers;

use app\core\base\Controller;
use app\models\Main;

class MainController extends Controller
{
    function indexAction()
    {
        include LIBS . '/sale.php';

        $hits   = Main::getHits();
        $colors = Main::getColors();
        $sizes  = Main::getSizes();

        $this->set(compact('hits', 'colors', 'sizes'));
        $this->setMeta('Main', 'Main page of the shop', 'main, shop, store, keywords...');
    }

    function aboutUsAction()
    {
        $this->setMeta('About Us', null, 'about us, about, us, keywords...');
    }

    function contactUsAction()
    {
        if (!empty($_POST)) {
            $data = cleanArray(test_input($_POST));

            $this->validate([
                'email'    => 'required|min:5|email',
                'question' => 'required|min:1|max:500'
            ]);

            if (Main::addQuestion($data)) {
                $_SESSION['success'][] = 'Your Question was asked successfully!';
            }
        }

        $this->setMeta('Contact Us', null, 'contact us, contact, us, question, questions, keywords...');
    }
}
