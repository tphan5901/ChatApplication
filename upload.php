<?php

session_start();
$info = (object)[];

$raw_data = file_get_contents("php://input");
$data_object = json_decode($raw_data);

//check if logged in using brower session var
if(!isset($_SESSION['userid'])){
    
    if(isset($data_object->data_type) && $data_object->data_type != "login" && $data_object->data_type != "signup"){
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }

}

require_once("autoload.php");
$DB = new Database();

$data_type = "";
if(isset($_POST['data_type'])){
    $data_type = $_POST['data_type'];
}

$destination = "";
if(isset($_FILES['file']) && $_FILES['file']['name'] != ""){
    if($_FILES['files']['error'] == 0){
        $folder = 'uploads/';
        if(!file_exists($folder)){
            mkdir($folder,0777,true);
        }
    }
    $destination = $folder . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $destination);

    $info->message = "Image has been uploaded!";
    $info->data_type = $data_type;
    echo json_encode($info);

}


if($data_type == "change_profile_image"){
    if($destination != ""){
        $id = $_SESSION['userid'];
        $query = "update users set image = '$destination' where userid = '$id' limit 1";
        $DB->write($query, []);
    }

}