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
            
                    $messages .= message_left($row);
                    $messages .= message_right($row);
                    $messages .= message_left($row);
                    $messages .= message_right($row);
                    $messages .= message_left($row);
                    $messages .= message_right($row);

                    $messages .="

                </div>

                <div style='display: flex; width: 100%; height:40px;'>
                    <label for ='file'> <img src='ui/icons/clip.png' style='width: 30px; margin: 5px; cursor: pointer; opacity: 0.8;'> </label>
                    <input id='message_file' type ='file' name= 'file' style='display:none;'/>
                    <input id='message_text' type='text' style='flex: 6; border: solid thin #ccc; border-bottom: none; font-size: 14px; padding: 4px;'placeholder='type your message'/>
                    <input type='button' style='flex: 1; cursor: pointer;' value='send'/>
                </div>
            </div>
                ";

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

