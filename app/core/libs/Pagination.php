<?php

namespace app\core\libs;

class Pagination
{
    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;

    function __construct($page, $perpage, $total)
    {
        $this->perpage 	   = $perpage;
        $this->total 	   = $total;
        $this->countPages  = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri 		   = $this->getParams();
    }

    function __toString()
    {
        return $this->getHtml();
    }

    function getHtml()
    {
        $back       = 
        $forward    = 
        $startpage  = 
        $endpage    = 
        $page2left  = 
        $page1left  = 
        $page2right = 
        $page1right = null;

        if ($this->currentPage > 1) $back = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        if ($this->currentPage < $this->countPages) $forward = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        if ($this->currentPage > 3) $startpage = "<li class='page-item'><a class='page-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        if ($this->currentPage < ($this->countPages - 2)) $endpage = "<li class='page-item'><a class='page-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        if ($this->currentPage - 2 > 0) $page2left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        if ($this->currentPage - 1 > 0) $page1left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        if ($this->currentPage + 1 <= $this->countPages) $page1right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        if ($this->currentPage + 2 <= $this->countPages) $page2right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";

        return '<ul class="pagination justify-content-center">' . $startpage . $back . $page2left . $page1left . '<li class="page-item active"><span class="page-link"><a>' . $this->currentPage . ' <span class="sr-only">(current)</span></a></span></li>' . $page1right . $page2right . $forward . $endpage . '</ul>';
    }

    function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    function getCurrentPage($page)
    {
        if (!$page OR $page < 1)       $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;

        return $page;
    }

    function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        // Correct url after filters
        preg_match_all("/filter=[\d,&]/", $url, $matches);

        if (count($matches[0]) > 1) {
            $url = preg_replace("#filter=[\d,&]+#", "", $url, 1);
        }

        $url = explode('?', $url);
        $uri = $url[0] . '?';

        if (isset($url[1]) AND $url[1] != '') {
            $params = explode('&', $url[1]);

            foreach ($params as $val) {
                if (!preg_match("/page=/", $val)) $uri .= "{$val}&amp;";
            }
        }

        return urldecode($uri);
    }
}
