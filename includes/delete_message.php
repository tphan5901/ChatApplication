<?php
    $arr['rowid'] = "null";
    // Get the target user if passed
    if(isset($data_object->find->rowid)){
        $arr['rowid'] = $data_object->find->rowid;
    }

    //load user
    $sql = "SELECT * FROM messages WHERE id = :rowid limit 1";
    $result = $DB->read($sql, $arr);

    if(is_array($result)){
        $row = $result[0];
        // allow deletion if the user is sender or receiver
        if($_SESSION['userid'] == $row->sender || $_SESSION['userid'] == $row->receiver){
            $sql = "DELETE FROM messages WHERE id = :id LIMIT 1";
            $DB->write($sql, ['id' => $row->id]);
        }
    }
?>
