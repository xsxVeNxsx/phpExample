<?php
require_once "base_controller.php";
require_once "model/photos_model.php";
require_once "model/users_model.php";

class Profile_Controller extends Base_Controller
{
    protected $img_dir = "img/";
    protected $thumb_dir = "img/thumb/";

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

    protected function create_thumbs($fname, $thumbWidth)
    {
        $img = imagecreatefromjpeg(getcwd()."/".$this->img_dir.$fname);
        $width = imagesx($img);
        $height = imagesy($img);
        $new_width = $thumbWidth;
        $new_height = floor($height * ( $thumbWidth / $width ));
        $tmp_img = imagecreatetruecolor($new_width, $new_height);
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($tmp_img, getcwd()."/".$this->thumb_dir.$fname);
    }

    public function load_photos()
    {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++)
        {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            $new_file = mt_rand().".jpg";
            if (move_uploaded_file($tmpFilePath, getcwd()."/".$this->img_dir.$new_file))
            {
                $this->create_thumbs($new_file, 100);
                $this->model->add(["user_id" => $_SESSION["id"], "name" => $new_file]);
            }
        }
    }
}

?>
