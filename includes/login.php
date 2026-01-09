<?php 

  $info  = (Object)[];

  $data = [];
  $data['username'] = $data_object->username;
//$data['password'] = $data_object->password;

  if(empty($data_object->username)){
    $Error = "please enter a valid username";
  }

  if(empty($data_object->password)){
    $Error = "please enter a valid password";
  }

  if($Error == ""){
        $query = "select * from users where username = :username limit 1";
        $result = $DB->read($query, $data);

    if(is_array($result)){
        $result = $result[0];
        if($result->password == $data_object->password){
            $_SESSION['userid'] = $result->userid;
            $info->message = "Login success!";
            $info->data_type = "info";
            echo json_encode($info);
        } else {
            $info->message = "Wrong password";
            $info->data_type = "error";
            echo json_encode($info);
        }
        
    } else {
        $info->message = "Wrong Username";
        $info->data_type = "error";
        echo json_encode($info);
    } 
    
  } else {
        $info->message = $Error;
        $info->data_type = "error";
        echo json_encode($info);
  }

