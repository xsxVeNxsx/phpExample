<?php
include_once "session_handler.php";

class base_controller
{
    protected $model;
    protected $template = "base";
    protected $actions = ["index"];
    protected $title = "Main Page";
    protected $scripts = ["jquery"];
    protected $styles = ["style"];

    public function execute()
    {
        $action = $_REQUEST["action"];
        if (!isset($action) || !in_array($action, $this->actions))
            $action = "index";
        return $this->$action();
    }

    protected function index()
    {
        $this->render($blocks);
    }

    protected function render($blocks, $vars = array())
    {
        $common_vars = [
            "blocks" => $blocks,
            "title" => $this->title,
            "scripts" => $this->scripts,
            "styles" => $this->styles,
        ];
        extract(array_merge($vars, $common_vars));
        include "view/$this->template.php";
    }

    protected function render_block($template, $vars = null)
    {
        ob_start();
        if ($vars != null)
            extract($vars);
        include "view/$template.php";
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}

?>
