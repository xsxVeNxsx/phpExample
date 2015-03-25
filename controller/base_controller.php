<?php
include_once "session_handler.php";

class Base_Controller
{
    protected $model;
    protected $template = "base";
    protected $actions = ["index"];
    protected $title = "Main Page";
    protected $scripts = ["jquery"];
    protected $styles = ["style"];
    protected $need_auth = ["Profile_Controller"];
    protected $home_url;

    public function execute()
    {
        session_start();
        $this->home_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER["SCRIPT_NAME"];
        $action = $_REQUEST["action"];
        if (!isset($action) || !in_array($action, $this->actions))
            $action = "index";
        if (in_array(get_class($this), $this->need_auth) && !Sessions::is_logined())
        {
            header("Location: $this->home_url?controller=auth");
            return;
        }
        return $this->$action();
    }

    public function index()
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
