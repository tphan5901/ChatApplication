<?php
    $arr['userid'] = "null";
    // Get the target user if passed
    if(isset($data_object->find->userid)){
        $arr['userid'] = $data_object->find->userid;
    }

    $arr['sender'] = $_SESSION['userid'];
    $arr['receiver'] = $arr['userid'];

    //load user
    $sql = "SELECT * FROM messages WHERE (sender = :sender AND receiver = :receiver) 
    || (receiver = :sender AND sender = :receiver) ORDER BY id ASC";
    $result = $DB->read($sql, $arr);

    if(is_array($result)){
        foreach($result as $row){
        // allow deletion if the user is sender or receiver
            if($_SESSION['userid'] == $row->sender || $_SESSION['userid'] == $row->receiver){
                $sql = "DELETE FROM messages WHERE id = :id LIMIT 1";
                $DB->write($sql, ['id' => $row->id]);
            }
        }   
    }
?>
