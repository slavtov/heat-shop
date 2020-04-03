<?php

namespace app\controllers\admin;

use app\core\Cache;
use app\models\admin\Category;

class CategoryController extends Controller
{
    function indexAction()
    {
        Cache::delete('shop_menu');

        $this->setMeta('Category list');
    }

    function addAction()
    {
        if (!empty($_POST)) {
            if (Category::add()) {
                $_SESSION['success'][]  = 'The category added successfully!';
            } else $_SESSION['error'][] = 'The category not added';

            redirect(ADMIN . '/category');
        }

        $categories = Category::getAll();

        $this->set(compact('categories'));
        $this->setMeta('Add category');
    }

    function editAction()
    {
        if (isset($_GET['id'])) {
            if (!$id = (int) $_GET['id']) redirect();
        } else redirect();

        if (!empty($_POST)) {
            $this->validate([
                'title' => 'required|min:2|alnum',
                'alias' => 'required|min:2',
            ]);

            if (Category::edit()) {
                $_SESSION['success'][]  = 'The category updated successfully!';
            } else $_SESSION['error'][] = 'The category not updated';

            redirect();
        }

        $categories = Category::getAll();
        $category   = Category::get($id);

        $this->set(compact('category', 'categories'));
        $this->setMeta('Edit category');
    }
    
    function deleteAction()
    {
        if (isset($_GET['background']) AND !empty($background = (int) $_GET['background'])) {
            if (!Category::deleteBackground($background)) $_SESSION['error'][] = 'Error';

            redirect();
        }

        if (isset($_GET['id'])) {
            if (!$id = (int) $_GET['id']) redirect();
        } else redirect();
        
        if (Category::getCountParent($id)) {
            $_SESSION['error'][] = 'Cannot be deleted, the category has child categories';
            redirect();
        }

        if (Category::getCountProducts($id)) {
            $_SESSION['error'][] = 'Cannot be deleted, the category has products';
            redirect();
        }

        if (Category::delete($id)) {
            $_SESSION['success'][]  = 'The category deleted successfully!';
        } else $_SESSION['error'][] = 'The category not deleted';

        redirect();
    }
}
