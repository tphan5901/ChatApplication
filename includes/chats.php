<?php


    $arr['userid'] = "null";
    $mydata = "";
    $messages = "";
    $new_message = false;
    // Get the target user if passed
    if(isset($data_object->find->userid)){
        $arr['userid'] = $data_object->find->userid;
    }

    $refresh = false;
    $seen = false;
    if($data_object->data_type == "chats_refresh"){
        $refresh = true;
        $seen = $data_object->find->seen;
    }

    //load user
    $sql = "SELECT * FROM users WHERE userid = :userid";
    $result = $DB->read($sql, $arr);

    if(is_array($result)){

        //get first result
        $row = $result[0];
        // Fetch all messages between current user and selected contact
        $a['sender']   = $_SESSION['userid'];
        $a['receiver'] = $arr['userid'];
        $sql2 = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) ORDER BY date ASC";
        $messages_list = $DB->read($sql2, $a);

        $mydata = "";

        // message holder
        if(!$refresh){
            $messages .= "
            <div id='message_holder_parent' onclick='set_seen(event)' style='height:100%;'>
                <div id='message_holder' style='height:90%; overflow-y:auto;'>";
        }

        if(is_array($messages_list)){
            foreach($messages_list as $data){
                $myuser = $DB->get_user($data->sender);

                if($data->receiver == $_SESSION['userid'] && $data->received == 0){
                    $new_message = true;
                }
                if($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen){
                    $DB->write("update messages set seen = 1 where id = '$data->id' limit 1");
                }
                if($data->receiver == $_SESSION['userid']){
                    $DB->write("update messages set received = 1 where id = '$data->id' limit 1");
                }
                if($_SESSION['userid'] == $data->sender){
                    $messages .= message_right($data, $myuser);
                } else {
                    $messages .= message_left($data, $myuser);
                }
            }
        }

        if(!$refresh){
            $messages .= message_controls();
            $messages .= "</div></div>";
        }

        // Only add chat header on first load
        if(!$refresh){
            $image = file_exists($row->image) ? $row->image : "./images/default.png";

            $mydata = "
            Now Chatting with:<br>
            <div id='active_contact' userid='{$row->userid}'>
                <img src='$image'><br>
                $row->username
            </div>";
        }

        $info->user = $refresh ? "" : $mydata;
        $info->message = $messages;
        $info->data_type = $refresh ? "chats_refresh" : "chats";

        echo json_encode($info);
        exit;

    } else {
        // Previews chats if no specific user selected
        $a['userid'] = $_SESSION['userid'];
        $sql = "SELECT * FROM messages WHERE id IN (SELECT MAX(id) FROM messages WHERE sender = :userid OR receiver = :userid
                    GROUP BY CASE WHEN sender = :userid THEN receiver ELSE sender END) ORDER BY id DESC";
        $result2 = $DB->read($sql, $a);

        $mydata = "Previews Chats:<br>";
        
        if(is_array($result2)){
            $added_users = [];
            foreach($result2 as $data){
                $other_user = $data->sender;
                
                // determine other user in conversation
                        if($data->sender == $_SESSION['userid']){
                            $other_user = $data->receiver;
                        } else {
                            $other_user = $data->sender;
                        }

                $myuser = $DB->get_user($other_user);
                $image = ($myuser->gender == "Male") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
                if(file_exists($myuser->image)){
                    $image = $myuser->image;
                }

            /*
                $image = (file_exists($myuser->image)) 
                            ? $myuser->image 
                            : (($myuser->gender == "Female") 
                            ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" 
                            : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg");
            */

                $mydata .= "<div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)' style='cursor:pointer;'>
                                <img src='$image'> $myuser->username <br>
                                <span style ='font-size: 11px;'>'$data->message'</span>
                            </div>";
            }
        }

        $info->user = $mydata;
        $info->message = ""; 
        $info->data_type = "chats";  
        $info->new_message = $new_message;
        if($refresh){
            $info->data_type = "chats_refresh";
          
        }
        echo json_encode($info);
        exit;
    }

?>
