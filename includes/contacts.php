<?php

    $sql = "select * from users limit 10";
    $myusers = $DB->read($sql,[]);
    $mydata =   
    '<div style="text-align:center;">';
        if(is_array($myusers)){

            foreach($myusers as $row){
                $image = ($row->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
                if(file_exists($row->image)){
                    $image = $row->image;
                }
                $mydata .= "     
                <div id='contact'>
                    <img src='$image'>
                    <br>$row->username
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

