<?php 

    $info  = (Object)[];

    $data = [];
    $data['userid'] = $DB->generate_id(20);
    $data['username'] = $data_object->username;
    if(empty($data_object->username)){
        $Error .= "Enter a valid Username <br>";
    } else {

        if(strlen($data_object->username) < 3){
            $Error .= "username must be at least 3 characters long <br>";
        } 

        if(!preg_match("/^[a-z A-Z 0-9]*$/", $data_object->username)){
            $Error .= "Please enter a valid username <br>";
        }
    }

    $data['email'] = $data_object->email;
    if(empty($data_object->email)){

        $Error .= "Enter a valid Email <br>";
    } else {

        if(strlen($data_object->email) < 3){
            $Error .= "email must be at least 3 characters long <br>";
        } 

        if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $data_object->email)){
            $Error .= "Please enter a valid email <br>";
        }

    }

    #$data['gender'] = $data_object->gender;
    if(empty($data_object->gender)){
        $Error .= "select a gender <br>";

    } else {

        $gender = strtolower($data_object->gender ?? "");

        if($gender !== "male" && $gender !== "female"){
            $Error .= "Please select a gender <br>";
        }

        $data['gender'] = $gender;
    }

    $data['password'] = $data_object->password;
    $password = $data_object->password2;

    if(empty($data_object->password)){

        $Error .= "Enter a valid password <br>";
    } else {
        if($data_object->password != $data_object->password2){
            $Error .= "passwords dont match <br>";
        }
        if(strlen($data_object->password) < 3){
            $Error .= "password must be at least 3 characters long <br>";
        } 
    }

    //$data['password'] = password_hash($data_object->password, PASSWORD_DEFAULT);
    $data['date'] = date("Y-m-d H:i:s");

    if($Error == ""){
        $query = "insert into users (userid,username,gender,email,password,date) values (:userid,:username,:gender,:email,:password,:date)";
        $result = $DB->write($query, $data);

        if($result){
            $info->message = "Your profile is created";
            $info->data_type = "info";
            echo json_encode($info);
        } else {
            $info->message = "Your profile is not created";
            $info->data_type = "info";
            echo json_encode($info);
        }

    } else {
        $info->message = $Error;
        $info->data_type = "error";
        echo json_encode($info);
    }
