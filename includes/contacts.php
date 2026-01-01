<?php

    $myid = $_SESSION['userid'];
    $sql = "SELECT * FROM users WHERE userid != :userid LIMIT 10"; 
    $myusers = $DB->read($sql, ['userid' => $myid]);
    //$myusers = $DB->read($sql,[]); old code
    $mydata =   
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
        if(is_array($myusers)){

            foreach($myusers as $row){
                $image = ($row->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
                if(file_exists($row->image)){
                    $image = $row->image;
                }
                $mydata .= "   
                <div id='contact' userid='$row->userid' onclick='start_chat(event)'>
                    <img src='$image'>
                    $row->username
                </div>";
            }
        }
    $mydata .= '</div>';

    # $result = $result[0];
    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

    die;

    $info->message = "No contacts are found";
    $info->data_type = "error";
    echo json_encode($info);

?>

