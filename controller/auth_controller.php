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

    protected function index()
    {
        $message = "";
        if (!$this->model->is_has_user($_SESSION))
            $message = "You need to singin";
        $blocks = [$this->render_block("auth_form", ["errors" => $message])];
        $this->render($blocks);
    }

    protected function make_session($user)
    {
        $_SESSION["email"] = $user["email"];
        $_SESSION["id"] = $user["id"];
    }

    protected function signin()
    {
        $message = "";
        if (!$this->model->is_has_user($_REQUEST))
            $message = "Incorrect email or password";
        else
            $this->make_session($this->model->get($_REQUEST)[0]);
        $blocks = [$this->render_block("auth_form", ["errors" => $message])];
        $this->render($blocks);
    }

    protected function signup()
    {
        $message = "";
        if ($this->model->is_has_email($_REQUEST))
            $message = "Email is already in use";
        else
            $this->model->add($_REQUEST);
        $blocks = [$this->render_block("auth_form", ["errors" => $message])];
        $this->render($blocks);
    }
}

?>
