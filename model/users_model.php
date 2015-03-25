<?php
require_once 'base_model.php';

class Users_Model extends Base_Model
{
    public function __construct($db = null)
    {
        parent::__construct('users', ['email', 'password'], $db);
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
