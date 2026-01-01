<?php

    $arr['userid'] = "null";
    
    if(isset($data_object->find->userid)){
           $arr['userid'] = $data_object->find->userid;
    }

    $sql = "select * from users where userid = :userid limit 1";
    $result = $DB->read($sql, $arr);

    if(is_array($result)){
      
        $row = $result[0];  
        $image = ($row->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
        if(file_exists($row->image)){
            $image = $row->image;
        }
        

        $mydata = "Now Chatting with: <br>  
                <div id='active_contact'>
                    <img src='$image'>
                    <br>$row->username
                </div>";

        $info->message = $mydata;
        $info->data_type = "chats";
        echo json_encode($info);

    } else {

        $info->message = "No contacts are found";
        $info->data_type = "error";
        echo json_encode($info);

    }

?>

