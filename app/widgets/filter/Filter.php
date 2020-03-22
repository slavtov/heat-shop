<?php

namespace app\widgets\filter;

use app\core\base\Model;
use app\core\Cache;
use app\core\Db;
use PDO;

class Filter extends Model
{
    private $groups;
    private $attrs;
    private $tpl = 'filter_tpl.php';

    function __construct()
    {
        $this->run();
    }

    private function run()
    {
        $this->groups = Cache::get('filter_groups');
        if (!$this->groups) {
            $this->groups = $this->getGroups();
            Cache::set('filter_groups', $this->groups);
        }

        $this->attrs = Cache::get('filter_attrs');
        if (!$this->attrs) {
            $this->attrs = $this->getAttrs();
            Cache::set('filter_attrs', $this->attrs);
        }

        echo $this->getHtml();
    }

    private function getHtml()
    {
        ob_start();

        $filter = self::getFilter();
        if (!empty($filter)) {
            $filter = explode(',', $filter);
        }

        include $this->tpl;

        return ob_get_clean();
    }

    private function getGroups()
    {
        $stmt = Db::query("SELECT `id`, `title` FROM `attr_group`");
        $result = $stmt->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);
        return $result;
    }

    private function getAttrs()
    {
        $stmt = Db::query("SELECT * FROM `attr_value`");
        $data = $stmt->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);

        $attrs = [];
        foreach ($data as $key => $val) {
            $attrs[$val['attr_group_id']][$key] = $val['value'];
        }

        return $attrs;
    }

    static function getFilter()
    {
        $filter = null;
        
        if (!empty($_GET['filter'])) {
            $filter = preg_replace("/[^\d,]+/", '', $_GET['filter']);
            $filter = trim($filter, ',');
        }

        return $filter;
    }

    static function getCountGroups($filter)
    {
        $filters = explode(',', $filter);
        $attrs   = Cache::get('filter_attrs');

        if (!$attrs) $attrs = self::getAttrs();

        $data = [];
        foreach ($attrs as $key => $val) {
            foreach ($val as $k => $v) {
                if (in_array($k, $filters)) {
                    $data[] = $key;
                    break;
                }
            }
        }
        
        return count($data);
    }
}
