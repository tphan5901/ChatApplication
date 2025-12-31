  <?php 

    $info  = (Object)[];
    $Error = "";
    
    $data = [];
    $data['userid'] = $_SESSION['userid'];
    $data['username'] = $data_object->username;
    $data['email'] = $data_object->email;
    $data['gender'] = $data_object->gender;
    $data['password'] = null;

    #store data from data obj properties to data list

    if(empty($data_object->username)){
        $Error .= "Enter a valid Username <br>";
    } else {
        if(strlen($data_object->username) < 3){
            $Error .= "username must be at least 3 characters long <br>";
        } 
        if(!preg_match("/^[a-z A-Z 0-9]*$/", $data_object->username)){
            $Error .= "Please enter a valid username <br>";
        }
    }

    
    if(empty($data_object->email)){
        $Error .= "Enter a valid Email <br>";
    } else {
        if(strlen($data_object->email) < 3){
            $Error .= "email must be at least 3 characters long <br>";
        } 

        if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $data_object->email)){
            $Error .= "Please enter a valid email <br>";
        }
    }

    if(empty($data_object->gender)){
        $Error .= "select a gender <br>";
    
    } else {

        $gender = strtolower($data_object->gender ?? "");

        if($gender !== "male" && $gender !== "female"){
            $Error .= "Please select a gender <br>";
        }
    }

    $password1 = $data_object->password ?? "";
    $password2 = $data_object->password2 ?? "";

    if ($password1 === "" || $password2 === "") {
        $Error .= "Enter a valid password<br>";
    } elseif ($password1 !== $password2) {
        $Error .= "Passwords do not match<br>";
    } elseif (strlen($password1) < 3 || strlen($password2) < 3) {
        $Error .= "Password must be at least 3 characters long <br>";
    } else {
        // ✅ ONLY set password if valid
        $data['password'] = $password1;
    }

    #handle errors
    if ($Error !== "") {
        $info->message = $Error;
        $info->data_type = "save_settings";
        echo json_encode($info);
        exit;
    }

        #update user table using data obtained from form fields
        $query = "UPDATE users SET username = :username, email = :email, gender = :gender, password = :password WHERE userid = :userid limit 1";
        $result = $DB->write($query, $data);

        if($result){
            $info->message = "Profile settings saved";
            $info->data_type = "save_settings";
            echo json_encode($info);
        } else {
            $info->message = "Error saving settings";
            $info->data_type = "save_settings"; 
            echo json_encode($info);
        }

