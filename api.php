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
} else if(isset($data_object->data_type) && ($data_object->data_type == "chats" || $data_object->data_type == "chats_refresh")){
    //chats
    include("includes/chats.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "settings"){
    //settings
    include("includes/settings.php");
} else if(isset($data_object->data_type) && $data_object->data_type == "save_settings"){
    //save settings
    include("includes/save_settings.php");
}  else if(isset($data_object->data_type) && $data_object->data_type == "send_message"){
    //send message
    include("includes/send_message.php");
}


function message_left($data, $row){
    
    $image = ($row->gender == "Female") 
            ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" 
            : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
    if(file_exists($row->image)){
        $image = $row->image;
    }

    return "
        <div id='message_left'>
            <div></div>
            <img src='{$row->image}'>
            <b>{$row->username}</b><br>
            {$data->message}<br><br>
            <span style='font-size: 10px; color: black;'>{$data->date}</span>
        </div>";
}

function message_right($data, $row){

    return "
        <div id='message_right'>
            <div></div>
            <img src='{$row->image}' style='float:right;'>
            <b>{$row->username}</b><br>
            {$data->message}<br><br>
            <span style='font-size: 10px; color: black;'>".date("jS M Y H:i:s a",strtotime($data->date))."</span>
        </div>";
}


function message_controls(){

    return 
        "</div>
            <div style='display:flex; width:100%; height:40px;'>
            <label for='message_file'>
                <img src='ui/icons/clip.png' style='width:30px; background-color:white; margin:5px; cursor:pointer; opacity:0.8;'>
            </label>
            <input id='message_file' type='file' name='file' style='display:none;'/>
            <input id='message_text' onkeyup='enter_pressed(event)' type='text' style='flex:6; border:solid thin #ccc; padding: 5px; font-size:14px;' placeholder='Type your message'/>
            <input type='button' onclick='send_message(event)' style='flex:1; cursor:pointer; background-color:#1ac963ff; border-radius: 5px; color:white;' value='Send'/>
            </div>
        </div> ";

}