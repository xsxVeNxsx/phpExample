<?php

class base_controller
{
    protected $model;
    protected $template;
    protected $actions;
    protected $title;
    public function __construct($model)
    {
        $this->model = $model;
        $this->template = "base";
        $this->title = "Main page";
    }

    protected function index()
    {
        $blocks = array("auth_form");
        $this->render($blocks);
    }

    public function execute()
    {
        $action = $_REQUEST["action"];
        if (!isset($action) || !in_array($action, $this->actions))
            $action = "index";
        return $this->$action();
    }

    protected function render($blocks, $vars = array())
    {
        for ($i = 0; $i < count($blocks); $i++)
            $blocks[$i] = $this->render_block($blocks[$i]);
        $common_vars = array(
            "blocks" => $blocks,
            "title" => $this->title,
        );
        extract(array_merge($vars, $common_vars));
        include "view/$this->template.php";
    }

    protected function render_block($template, $vars = array())
    {
        ob_start();
        extract($vars);
        include "view/$template.php";
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}

?>
