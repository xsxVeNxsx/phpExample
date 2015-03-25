<?php
require_once 'base_model.php';

class Photos_Model extends Base_Model
{
    public function __construct($db = null)
    {
        parent::__construct('photos', ['name', 'user_id'], $db);
    }

    public function get_user_photos($user_id)
    {
        $where = "WHERE user_id = ?";
        $q = $this->db->prepare("SELECT name FROM $this->table_name $where");
        $q->execute([$user_id]);
        return $q->fetchAll(PDO::FETCH_COLUMN);
    }
}

?>
