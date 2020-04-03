<?php

namespace app\controllers\admin;

use app\models\admin\Question;

class QuestionController extends Controller
{
    function indexAction()
    {
        $questions = Question::all('contact');

        $this->set(compact('questions'));
        $this->setMeta('Questions');
    }

    function deleteAction()
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($id) {
            if (Question::delete($id)) {
                $_SESSION['success'][]  = 'The question deleted successfully!';
            } else $_SESSION['error'][] = 'The question not deleted';
        }

        redirect();
    }
}
