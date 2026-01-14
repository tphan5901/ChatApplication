<?php

    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM users WHERE userid != :userid"; 
    $users = $DB->read($sql, ['userid' => $userid]);
    //$users = $DB->read($sql,[]); old code
    $htmlComponent =   
    '
    <style>
        @keyframes appear{
            0%{opacity:0; transform: translateY(50px);} 
            100%{opacity:1; transform: translateY(0px);}
        }

        #contact{
            cursor: pointer;
            transition: all 1s cubic-bezier(0.68, -2, 0.265, 1.55);
        }

        #contact:hover{
            transform: scale(1.1);
        }
    </style>

    <div style="text-align:center; animation: appear 1s ease;">';
        if(is_array($users)){
            $messagesArr = array();
            $query = "SELECT * from messages where receiver = '$userid' && received = 0";
            $messages = $DB->read($query,[]);
            
            if(is_array($messages)){
                foreach($messages as $row2){
                    $sender = $row2->sender;
                    if(isset($messagesArr[$sender])){
                        $messagesArr[$sender]++;
                    } else {
                        $messagesArr[$sender] = 1;
                    }
                } 
            }

            foreach($users as $row){
                $image = ($row->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
                if(file_exists($row->image)){
                    $image = $row->image;
                }
           
                $htmlComponent .= "   
                <div id='contact' userid='$row->userid' onclick='start_chat(event)' style='position: relative;'>
                    <img src='$image'>
                    <br>$row->username";
                    if(count($messagesArr) > 0 && isset($messagesArr[$row->userid])){
                        $htmlComponent .= "<div style='width:20px; height: 20px; border-radius: 50%; background-color: orange; color: white; position: absolute; left: 0px; top: 0px;'> 
                                            ".$messagesArr[$row->userid]."
                                           </div>";
                    }
            
                $htmlComponent .= "</div>";
            }
        }
 
    
    # $result = $result[0];
    $info->message = $htmlComponent;
    $info->data_type = "contacts";
    echo json_encode($info);

    die;

    $info->message = "No contacts are found";
    $info->data_type = "error";
    echo json_encode($info);

?>

