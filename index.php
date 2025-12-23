<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Chat App</title>

<style type='text/css'>

    #wrapper{
        max-width: 1000px;
        min-height: 700px;
        display: flex;
        margin: auto;
        color: white;
        font-size: 13px;
    }

    #left_panel{
        min-height:660px;
        background-color: #1d1b1bff;     
        flex: 1;   
        padding: 10px;
        text-align: center;
    }
    
    #left_panel img{
        width: 80%;
        border: solid thin white;
        border-radius: 50%;
    }

    #left_panel label{
        width: 100%;
        height: 20px;
        display: block;
        background-color: #1cc045ff;
        border-bottom: solid thin white;
        cursor: pointer;
        padding: 5px;
        transition: all 1s ease;
    }

    #left_panel label:hover{
        background-color: white;
        color: black;
    }

    #left_panel label img{
        float: right;
        width: 25px;
    }

    #profile_image{
        width: 50%;
        border: solid thin white;
        margin: 10px;
        border-radius: 50%;
       
    }

    #right_panel{
        min-height:700px;   
        flex: 4;
        text-align:center;
    }

    #header{
        background-color: #1f1c1cff;
        height: 70px;
        font-size:40px;
        align-items:center;
        position: relative;
    }

    #inner_left_panel{
        background-color: #f1e9e9ff;
        flex: 1;
        color: black;
        min-height: 630px;
    }

    #inner_right_panel{
        background-color: #503131ff;
        flex: 2;
        min-height: 630px;
        transition: all 2s ease;
    }

    #radio_chat:checked ~ #inner_right_panel{
        flex: 0;
    }

    #radio_settings:checked ~ #inner_right_panel{
        flex: 0;
    }

    #contact{
        width: 150px; /*100px */
        height: 150px; /* 120px */
        margin: 10px;
        display: inline-block;
    /*  overflow: hidden; 
        vertical-align: top;*/
    }

    #contact img{
        width: 100%; /*100px */
        /*height: 100px; */
    }

    .loader_on{
        position: absolute;
        width: 30%;
    }
    .loader_off{
        display: none;
        position: absolute;
        width: 30%;
    }
</style>
</head>
<body>
    <div id ='wrapper'>
        <div id="left_panel">
            <div id = "user_info" style="padding: 10px;">
                <img src="./images/11c1de951326fdd816adc98f4a6e2cc9.jpg" id = "profile_image" alt="">
                <br>
                <span id="username">Asianbabe</span>
                <br>
                <span id="email" style="font-size: 12px; opacity: 0.5;"> tphan5901@gmail.com</span>
                <br>
                <br>
                <br>
                <div>
                    <label id= 'label_chat' for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id = 'label_contacts' for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id = 'label_settings' for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                    <label id = 'logout' for="radio_logout">Logout <img src="ui/icons/logout.png" alt=""></label>
           
                </div>
            </div>    
      
        </div>
        <div id="right_panel">
            <div id='header'>
                <div id="loader_holder" class="loader_on"><img style="width: 70px;" src="ui/icons/giphy.gif" alt=""></div>
                Chat logs
            </div>
            <div id='container' style='display: flex;'>
                
                <div id='inner_left_panel'>
                    <!--contacts will appear here--> 
                </div>

                <input type="radio" id ='radio_chat' name='myradio' style = 'display:none;'>
                <input type="radio" id ='radio_contacts' name='myradio' style = "display:none;">
                <input type="radio" id ='radio_logout' name='myradio' style = 'display:none;'>

                <div id="inner_right_panel">

                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script type="text/javascript">

    function _(element){
        return document.getElementById(element);
        
    }
  
    var label_contacts = _("label_contacts");
    label_contacts.addEventListener("click", get_contacts);

    var label_chat = _("label_chat");
    label_chat.addEventListener("click", get_chats);

    var label_settings = _("label_settings");
    label_settings.addEventListener("click", get_settings);

    var logout = _("logout");
    logout.addEventListener("click", logout_user);

    function get_data(find, type){
        var xml = new XMLHttpRequest();
        var loader_holder = _("loader_holder");
        loader_holder.className = "loader_off";
        xml.onload = function (){
            if(xml.readyState == 4 && xml.status == 200){
                loader_holder.className = "loader_off";
                handle_result(xml.responseText);
            }
        }

        var data = {};
        data.find = find;
        data.data_type = type;

        data = JSON.stringify(data);
        xml.open("POST", "api.php", true);
        xml.send(data);
    }

    function handle_result(result){
        
        if(result.trim() != ""){
            var obj = JSON.parse(result);
            if(typeof(obj.logged_in) !== "undefined" && !obj.logged_in){
                window.location = "login.php";
            } else {    
                switch(obj.data_type){
                    case "user_info":
                        var username = _("username");
                        var email = _("email");
                        var profile_image = _("profile_image");
                        username.innerHTML = obj.username;
                        email.innerHTML = obj.email;
                        profile_image.src = obj.image;
                        break;
                    case "contacts":
                        var inner_left_panel = _("inner_left_panel");
                        inner_left_panel.innerHTML = obj.message;
                        break;
                   case "chats":
                        var inner_left_panel = _("inner_left_panel");
                        inner_left_panel.innerHTML = obj.message;
                        break;
                   case "settings":
                        var inner_left_panel = _("inner_left_panel");
                        inner_left_panel.innerHTML = obj.message;
                        break;
                   case "save_settings":
                        alert(obj.message);
                        get_data({}, "user_info");
                        break;
                }
            }
        }
    }

    function logout_user(){
        var answer = confirm("Are you sure you want to log out?");
        if(answer){
            get_data({}, "logout");
        }
    }

    get_data("", "user_info");

    function get_contacts(e){
        get_data("", "contacts");
    }

    function get_chats(e){
        get_data("", "chats");
    }

    function get_settings(e){
        get_data("", "settings");
    }

</script>


    <script type="text/javascript">

        function collect_data(){
            var save_settings_button = _("save_settings_button");
            
            save_settings_button.disabled = true;
            save_settings_button.value = "Loading....";

            var myform = _("myform")
            //get input from form
            var inputs = myform.getElementsByTagName("INPUT")

            var data={};

            //if each input has strokestroke, record it 
            for(var i = inputs.length - 1; i >= 0; i--){
                var key = inputs[i].name;

                switch(key){
                    case "username":
                        data.username = inputs[i].value;
                        break;
                    case "email":
                        data.email = inputs[i].value;
                        break;
                    case "gender":
                        if(inputs[i].checked){
                            data.gender = inputs[i].value;   
                        }
                        break;
                    case "password":
                        data.password = inputs[i].value;
                        break;
                case "password2":
                        data.password2 = inputs[i].value;
                        break;

                }
            }

            send_data(data, "save_settings");

        }

        //send data to backend
        function send_data(data, type){
            var xml = new XMLHttpRequest()
            
            xml.onload = function(){
                if(xml.readyState === 4 && xml.status === 200){
                    handle_result(xml.responseText);
                    save_settings_button.disabled = false;
                    save_settings_button.value = "Save settings";
                }
        
            }
            data.data_type = type;
            //send data in json format
            var data_string = JSON.stringify(data)
            //send to middleware
            xml.open("POST", "api.php", true);
            xml.send(data_string);
            console.log("Sending:", JSON.stringify(data));

        }


    </script>
