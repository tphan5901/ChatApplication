<?php

//init session
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

//linked db 
require_once("autoload.php");
$DB = new Database();

$Error = "";

//middleware (manage apis)
if(isset($data_object->data_type) && $data_object->data_type == "signup"){
    //signup
    include("includes/signup.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "login"){
    //login
    include("includes/login.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "user_info"){
    //userinfo
    include("includes/user_info.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "logout"){
    //logout
    include("includes/logout.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "contacts"){
    //contacts
    include("includes/contacts.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "chats"){
    //chats
    include("includes/chats.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "settings"){
    //settings
    include("includes/settings.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "save_settings"){
    //save settings
    include("includes/save_settings.php");
}


function message_left($row){
    return "
        <div id='message_left'>
            <div></div>
            <img src='$row->image'>
            <b>$row->username</b><br>
            This is a test message<br><br>
            <span style='font-size: 10px; color: white;'>20 Jan 2020 </span>
        </div> ";
}

function message_right($row){
    return "
        <div id='message_right'>
            <div> </div>
            <img src='$row->image' style='float:right;'>
            <b>$row->username</b><br>
            This is a test message<br><br>
            <span style='font-size: 10px; color: white;'>20 Jan 2020 </span>
        </div>
    ";
}