<?php

    $sql = "select * from users where userid = :userid limit 1";
    $id = $_SESSION['userid'];
    $data = $DB->read($sql,['userid'=>$id]);

    $mydata = "";
    if(is_array($data)){
        $data = $data[0];

    //check if image exist
    $image = ($data->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" :
        "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
        if(file_exists($data->image)){
            $image = $data->image;
        }

    $gender_male = "";
    $gender_female = "";
    if($data->gender == "Male"){
        $gender_male = "checked";
    } else {
        $gender_female = "checked";
    }

    $mydata = '
   
    <style type="text/css">

        form{
            text-align: center;
            margin: auto;
            padding: 10px;
            width: 400px;
        }

        input[type=text], input[type=password]{
            padding: 10px;
            margin: 10px;
            width: 70%;
            border-radius: 5px;
            border: solid 1px white;
        }

        input[type=button]{
            margin: 1%;
            padding: 1%;
            width: 220px; /* 100% */
            border-radius: 5px;
            cursor:pointer;
            background-color: #1ac963ff;
            color: white;
        }

        input[type=radio]{
            transform: scale(1.1);

        }

        #error{
            text-align: center;
            padding: 0.5em;
            background-color: red;
            color: white;
            display: none;

        }

    </style>
    </head>
    <body>

        

        <div id="error">error</div>
            <div style="display: flex;">
                <div>
          
                    <img src="'.$image.'" style="width:200px;height:300px;margin:10px;">
                    <input type="button" value="Change Image" id="change_image_button"><br>    
                </div>
                <form action="" id="myform">
                    <input type="text" name="username" placeholder="username" value="'.$data->username.'"><br>
                    <input type="text" name="email" placeholder="email" value="'.$data->email.'"><br>
                    <div style="padding: 10px">
                        <br>Gender: <br>
                        <input type="radio" value = "male" name = "gender" '.$gender_male.'> Male <br>
                        <input type="radio" value = "female" name = "gender" '.$gender_female.'> Female <br>
                        
                    </div>
                    <input type="text" name="password" placeholder="password" value="'.$data->password.'"><br>
                    <input type="text" name="password2" placeholder="retype password" value="'.$data->password.'"><br>
                    <input type="button" value="Save Settings" id="save_settings_button" onclick="collect_data(event)"><br>
        
                </form>
        </div>

    </body>
    </html>

 ';

}

    $info->message = $mydata;
    $info->data_type = "settings";
    echo json_encode($info);

    die;

    $info->message = "No contacts are found";
    $info->data_type = "error";
    echo json_encode($info);

?>

