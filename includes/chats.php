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
        
        $row->image = $image;
        $mydata = "Now Chatting with: <br>  
                <div id='active_contact'>
                    <img src='$image'>
                    <br>$row->username
                </div>";

        $messages = "
            <div id = 'message_holder_parent' style='height: 100%;'>
                <div id = 'message_holder' style='height: 90%; overflow-y:scroll;'>";
            
                /*
                    $messages .= message_left($data,$row);
                    $messages .= message_right($data,$row);
                    $messages .= message_left($data,$row);
                    $messages .= message_right($data,$row);
                    $messages .= message_left($data,$row);
                    $messages .= message_right($data,$row);
                */

                // fetch messages between these two users
            /*
                $a['sender'] = $_SESSION['userid'];
                $a['receiver'] = $arr['userid'];
                $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender)
                    ORDER BY date ASC";

                $result2 = $DB->read($sql, $a);
    
                if(is_array($result2)){
                    $result2 = array_reverse($result2);

                    foreach($result2 as $data){
                        $myuser = $DB->get_user($data->sender);
                        if($_SESSION['userid'] == $data->sender){
                            $messages .= message_right($data, $myuser);
                        } else {
                            $messages .= message_left($data, $myuser);
                        }
                    }
                }
            */

        $messages .= message_controls();

        $info->user = $mydata;
        $info->message = $messages;
        $info->data_type = "chats";
        echo json_encode($info);

    } else {

        $info->message = "No contacts are found";
        $info->data_type = "error";
        echo json_encode($info);

    }

?>

