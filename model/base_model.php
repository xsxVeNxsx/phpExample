<?php

class Base_Model
{
    protected  $table_name, $fields, $db;

    protected function db_connect($host, $name, $user, $pass)
    {
        $db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
        $db->query('SET character_set_connection = utf8');
        $db->query('SET character_set_client = utf8');
        $db->query('SET character_set_results = utf8');
        return $db;
    }

    public function __construct($table_name, $fields, $db = null)
    {
        $this->table_name = $table_name;
        $this->fields = $fields;
        //$db = db_connect('localhost', 'u272679865_admin', 'u272679865_photo', '123123123');
        if ($db == null)
            $this->db = $this->db_connect('localhost', 'photos', 'admin', '123123123');
    }

    public function get($params)
    {
        $keys = array_intersect(array_keys($params), $this->fields);
        $keys = array_map(function ($i) {return "$i = ?";}, $keys);
        $where = "WHERE ".implode(" AND ", $keys);
        $q = $this->db->prepare("SELECT * FROM $this->table_name $where");
        $q->execute(array_values($params));
        return $q->fetchAll();
    }

    public function add($params)
    {
        $arr = array();
        foreach ($this->fields as $value)
            array_push($arr, $params[$value]);
        $query = "INSERT INTO $this->table_name VALUES('' ".str_repeat(",?", count($this->fields)).")";
        $this->db->prepare($query)->execute($arr);
    }

    public function db()
    {
        return $db;
    }
}

?>
