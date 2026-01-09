<?php

    $sql = "select * from users where userid = :userid";
    $id = $_SESSION['userid'];
    $data = $DB->read($sql,['userid'=>$id]);

    $mydata = "";
    if(is_array($data)){
        $data = $data[0];

    //check if image exist
    $image = ($data->gender == "Female") ? "./images/33988c20a002ec982dc72e8b184152c5.jpg" : "./images/euEsSe1jDmT59aqetVq2hLuD.jpeg";
    if(file_exists($data->image)){
        $image = $data->image;
    }

    $gender_male = "";
    $gender_female = "";

    if($data->gender == "male"){
        $gender_male = "checked";
    } else {
        $gender_female = "checked";
    }

    $mydata = '
   
    <style type="text/css">

        @keyframes appear{
            0%{oppacity:0; transform: translateY(50px) rotate(5deg); transform-origin: 100% 100%;}
            100%{oppacity:1; transform: translateY(0px) rotate(0deg); transform-origin: 100% 100%;}
        }

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

        .dragging{
            border: dashed 2px #aaa;
        }

    </style>
    </head>
    <body>
        <div id="error">error</div>
            <div style="display: flex; animation: appear 1s ease;">
                <div>
                    <img src="'.$image.'" ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)"  style="width: 200px; height:300px; margin:10px;">
                    <label for = "change_image_input" id = "change_image_button" style="background-color: #1ac963ff; color: white; display: inline-block; padding: 1em; border-radius: 5px; cursor: pointer;">
                        Change Image
                    </label>
                    <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display: none;"><br>    
              
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
    </html> ';

    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

} else {

    $info->message = "No contacts are found";
    $info->data_type = "error";
    echo json_encode($info);

}

?>

