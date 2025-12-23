<?php

    $mydata = '
    
   ';
   # $result = $result[0];
    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

    die;

    $info->message = "No contacts are found";
    $info->data_type = "error";
    echo json_encode($info);

?>

