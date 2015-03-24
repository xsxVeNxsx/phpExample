<?php
require_once 'base_model.php';

class users_model extends base_model
{
    public function __construct()
    {
        parent::__construct('users', ['email', 'password']);
    }

    public function add($params)
    {
        $params["password"] = md5($params["password"]);
        parent::add($params);
    }

    public function is_has_user($params)
    {
        if (!isset($params["email"]) || !isset($params["password"]))
            return false;
        return count($this->get([
            "email" => $params["email"],
            "password" => md5($params["password"])
            ]
        )) > 0;
    }

    public function is_has_email($params)
    {
        if (!isset($params["email"]))
            return false;
        return count($this->get(["email" => $params["email"]])) > 0;
    }
}

?>