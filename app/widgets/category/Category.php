<?php

namespace app\widgets\category;

use app\core\base\Model;
use app\core\Cache;
use app\core\Db;

class Category extends Model
{
    private $data;
    private $menuHtml;
    private $cache = 7200;
    private $cacheKey = 'shop_menu';
    private $tpl = APP . '/widgets/category/tpl/category.php';
    private $attrs = [];

    public function __construct($options = [])
    {
        $this->getOptions($options);
        $this->run();
    }

    protected function run()
    {
        $this->data = Cache::get($this->cacheKey);

        if (!$this->data) {
            $stmt = Db::query("SELECT * FROM `category`");
            $result = $stmt->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);

            Cache::set($this->cacheKey, $result, $this->cache);
            $this->data = Cache::get($this->cacheKey);
        }

        $this->menuHtml = $this->getMenuHtml($this->getTree());
        $this->output();

        $_SESSION['category'] = $this->data;
    }

    protected function output()
    {
        $attrs = '';

        if (!empty($this->attrs)) {
            foreach ($this->attrs as $key => $val) {
                $attrs .= "$key='$val'";
            }
        }

        echo $this->menuHtml;
    }

    protected function getOptions($options)
    {
        foreach ($options as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    protected function getTree()
    {
        $tree = [];

        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';

        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }

        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
