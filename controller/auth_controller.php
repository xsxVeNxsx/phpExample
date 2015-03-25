<?php
require_once "base_controller.php";
require_once "model/users_model.php";

class auth_controller extends base_controller
{
    public function __construct()
    {
        $this->model = new users_model();
        $this->title = "Authentication";
        $this->scripts = array_merge($this->scripts, array("auth"));
        $this->actions = array_merge($this->actions, array("signin", "signup"));
    }

    public function index()
    {
        $blocks = [$this->render_block("auth_form")];
        $this->render($blocks);
    }

    public function signin()
    {
        if ($this->model->is_has_user($_REQUEST))
        {
            Sessions::set($this->model->get(["email" => $_REQUEST["email"]])[0]["id"]);
            header("Location: $this->home_url");
            return;
        }
        $message = "Incorrect email or password";
        $blocks = [$this->render_block("auth_form", ["errors" => $message])];
        $this->render($blocks);
    }

    public function signup()
    {
        if (!$this->model->is_has_email($_REQUEST))
        {
            $this->model->add($_REQUEST);
            Sessions::set($this->model->get(["email" => $_REQUEST["email"]])[0]["id"]);
            header("Location: $this->home_url");
            return;
        }
        $message = "Email is already in use";
        $blocks = [$this->render_block("auth_form", ["errors" => $message])];
        $this->render($blocks);
    }

    public function signout()
    {
        Sessions::clear();
        $blocks = [$this->render_block("auth_form")];
        $this->render($blocks);
    }
}

?>
