<?php

    $arr['userid'] = "null";

    if(isset($data_object->find->userid)){
        $arr['userid'] = $data_object->find->userid;
    }

    // get user info
    $sql = "SELECT * FROM users WHERE userid = :userid";
    $result = $DB->read($sql, $arr);

    if(is_array($result)){

        // insert new message
        $arr['message'] = $data_object->find->message;
        $arr['date'] = date('Y-m-d H:i:s');
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] = get_random_string_max(60);
            // fetch messages between these two users
            $arr2['sender'] = $_SESSION['userid'];
            $arr2['receiver'] = $arr['userid'];
            $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver) OR (receiver = :sender AND sender = :receiver)
                ";

            $result2 = $DB->read($sql, $arr2);
        
        
        $query = "INSERT INTO messages (sender, receiver, message, date, msgid) 
            VALUES (:sender, :userid, :message, :date, :msgid)";
        $DB->write($query, $arr);

        $row = $result[0];  

        // user image
        $image = ($row->gender == "Female") 
                    ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" 
                    : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
        if(file_exists($row->image)){
            $image = $row->image;
        }
        $row->image = $image;

        $htmlComponent = "Now Chatting with: <br>  
                <div id='active_contact'>
                    <img src='$image'>
                    <br>$row->username
                </div>";

        $messages = "<div id='message_holder_parent' style='height:100%;'>
                        <div id='message_holder' style='height:90%; overflow-y:scroll;'>";


            $a['msgid'] = $arr['msgid'];
            $sql = "select * from messages where msgid = :msgid order by id desc";
            $result2 = $DB->read($sql, $a);
            
            if(is_array($result2)){
            //  $result2 = array_reverse($result2);

                foreach($result2 as $data){
                    $myuser = $DB->get_user($data->sender);
                    if($_SESSION['userid'] == $data->sender){
                        $messages .= message_right($data, $myuser);
                    } else {
                        $messages .= message_left($data, $myuser);
                    }
                }
            }

        $messages .= message_controls();

        $info->user = $htmlComponent;
        $info->message = $messages;
        $info->data_type = "send_message";
        echo json_encode($info);

    } else {
        $info->message = "No contacts are found";
        $info->data_type = "send_message";
        echo json_encode($info);
    }

    // random string generator
    function get_random_string_max($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $text = '';
        $length = rand(4, $length);
        for($i=0; $i<$length; $i++){
            $randomIndex = rand(0, strlen($characters)-1);
            $text .= $characters[$randomIndex];
        }
        return $text;
    }

?>
