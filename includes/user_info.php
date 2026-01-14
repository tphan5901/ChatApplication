<?php 
    //retrieve userinfo to display on index.php
    $info  = (Object)[];

    $data = [];
    $data['userid'] = $_SESSION['userid'];

    if($Error == ""){
        $query = "SELECT * from users where userid = :userid";
        $result = $DB->read($query, $data);

        if(is_array($result)){
            $result = $result[0];
            $result->data_type = "user_info";
            //check if image
            $image = ($result->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/5b80215ca600037c5f60ab9676e8c11c.jpg";
            if(file_exists($result->image)){
                $image = $result->image;
            }
            $result->image = $image;
        
            echo json_encode($result);

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

