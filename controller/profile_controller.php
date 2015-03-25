<?php
require_once "base_controller.php";
require_once "model/photos_model.php";
require_once "model/users_model.php";

class Profile_Controller extends Base_Controller
{
    protected $img_dir = "img/";

    public function __construct()
    {
        $this->model = new Photos_Model();
        $this->title = "Profile";
        $this->scripts = array_merge($this->scripts, ["photos"]);
        $this->actions = array_merge($this->actions, ["load_photos", "get_photos"]);
    }

    public function index()
    {
        $photos = $this->model->get_user_photos($_SESSION["id"]);
        $user = (new Users_Model())->get(["id" => $_SESSION["id"]])[0];
        $blocks = [$this->render_block("user_info", ["user" => $user]),
                $this->render_block("photos_form"),
                $this->render_block("photo_album", ["photos" => $photos])];
        $this->render($blocks);
    }

    public function get_photos()
    {
        header('Content-Type: application/json');
        return json_encode($this->model->get_user_photos($_SESSION["id"]));
    }

    public function load_photos()
    {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++)
        {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            $new_file = $this->img_dir.mt_rand().".jpg";
            if (move_uploaded_file($tmpFilePath, getcwd()."/".$new_file))
                $this->model->add(["user_id" => $_SESSION["id"], "name" => $new_file]);
        }
    }
}

?>
