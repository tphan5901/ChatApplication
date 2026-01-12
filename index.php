<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>

<style type='text/css'>

    #wrapper{
        max-width: 1000px;
        min-height: 700px;
        max-height: 800px;
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
        background-color: #1c63c0ff;
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
        max-height: 700px;
    }

    #inner_right_panel{
        background-color: #503131ff;
        flex: 2;
        min-height: 630px;
        max-height: 700px;
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

    #active_contact{
        height: 140px;
        border: solid thin #aaa; 
        margin: 10px;
        padding: 4px;
        background-color: #eee;
        color: #444
    }

    #active_contact img{
        width: 100px;
        height: 130px;
        float: left;
        margin: 4px;
        border-radius: 50%;
    }

    #message_left{

        border: solid thin #aaa; 
        margin: 10px;
        padding: 2px;
        padding-right: 10px;
        background-color: #c979d5;
        color: white;
        float: left;
        box-shadow: 0px 0px 10px #aaa;
        border-radius: 1%;
    /*  border-bottom-left-radius: 50%; */
        position: relative;
        width: 60%;
        min-width: 200px;
    }

    #message_left #prof_img{
        width: 90px;
        height: 100px;
        float: left;
        margin: 4px;
        border-radius: 50%;
        border: solid 2px white;
    }

    #message_left div{
        width: 20px;
        height: 20px;
        background-color: #34474f;
        border-radius: 50%;
        position: absolute;
        border: solid 2px white;
        left: -10px;
        top: 20px;
    }

    #message_right{
        border: solid thin #aaa; 
        margin: 10px;
        padding: 2px;
        padding-right: 10px;
        background-color: #fbffee;
        color: black;
        float: right;
        box-shadow: 0px 0px 10px #aaa;
        border-radius: 1%;
    /*  border-bottom-right-radius: 50%; */
        position: relative;
        width: 60%;
        min-width: 200px;
    }

    #message_right #prof_img{
        width: 90px;
        height: 100px;
        float: left;
        margin: 4px;
        border-radius: 50%;
        border: solid 2px white;
    }

    #message_right div img{
        width: 20px;
        height: 20px;
        float: none;
        margin: 0px;
        border-radius: 50%;
        border: none;
        position: absolute;
        top: 30px;
        right: 10px;
    }

    #message_right #trash{
        width: 20px;
        height: 20px;
        position: absolute;
        top: 15px;
        left: -10px;
        cursor: pointer;
    }

    #message_left #trash{
        width: 20px;
        height: 20px;
        position: absolute;
        top: 15px;
        right: -10px;
        cursor: pointer;
    }

    #message_right div{
        width: 20px;
        height: 20px;
        background-color: #34474f;
        border-radius: 50%;
        position: absolute;
        border: solid 2px white;
        right: -10px;
        top: 20px;
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
                <img src="./images/5b80215ca600037c5f60ab9676e8c11c.jpg" id = "profile_image" style="height: 176px; width: 150px;">
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

    var CURRENT_CHAT_USER = "";
    var SEEN_STATUS = false;
    var sent_audio = new Audio('message_sent.mp3')
    var received_audio = new Audio('message_received.mp3')

    //select html element passed thru the constructor
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
            var inner_right_panel = _("inner_right_panel");     
            inner_right_panel.style.overflow = "visible"; 
            var obj = JSON.parse(result);
            //do not use ||
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
                        inner_right_panel.style.overflow = "hidden";
                        inner_left_panel.innerHTML = obj.message;
                        break;

                    case "chats_refresh":
                        SEEN_STATUS = false;
                        var message_holder = _("message_holder");
                    //  message_holder.innerHTML = obj.messages; this line causes undefined to appear when interval function refreshes(fetches) from message table
                        message_holder.innerHTML = obj.message;
                     
                        if(typeof obj.new_message != 'undefined'){
                            if(obj.new_message){
                                received_audio.play();
                            }
                        }
                        setTimeout(function(){
                            message_holder.scrollTo(0,message_holder.scrollHeight)
                            var message_text = _("message_text");
                            message_text.focus();
                        },100)

                        break;

                    case "send_message":
                        sent_audio.play();
                        break;
                        
                    case "chats":
                        SEEN_STATUS = false;
                        var inner_left_panel = _("inner_left_panel");
                        inner_left_panel.innerHTML = obj.user;
                        inner_right_panel.innerHTML = obj.message;
                        var message_holder = _("message_holder");
                        setTimeout(function(){
                            message_holder.scrollTo(0,message_holder.scrollHeight)
                            var message_text = _("message_text");
                            message_text.focus();
                        },100)
                        if(typeof obj.new_message != 'undefined'){
                            if(obj.new_message){
                                received_audio.play();
                            }
                        }
                        break;

                    case "settings":
                        var inner_left_panel = _("inner_left_panel");
                        inner_left_panel.innerHTML = obj.message;
                        break;

                    case "save_settings":
                        alert(obj.message);
                        get_data("", "user_info");
                        get_settings(true);
                        break;
                    case "send_image":
                        break;
                }
            }
        }
    }

    function upload_profile_image(files){
        var change_image_button  = _("change_image_button");
        change_image_button.disabled = true;
        change_image_button.value = "Uploading Image";
        var myform = new FormData();
        var xml = new XMLHttpRequest();

        xml.onload = function(){
            if(xml.readyState == 4 || xml.status == 200){
                get_data("", "user_info");
                get_settings(true);
                var change_image_button  = _("change_image_button");
                change_image_button.disabled = false;
                change_image_button.innerHTML = "Change Image";
            }
        }

        myform.append('file',files[0]);
        myform.append('data_type',"change_profile_image") 
        //send to middleware
        xml.open("POST", "upload.php", true);
        xml.send(myform);
    }

    function send_image(files){
        var file = files[0]
        var myform = new FormData();

        var xml = new XMLHttpRequest();

        xml.onload = function(){
                if(xml.readyState == 4 || xml.status == 200){
                  handle_result(xml.responseText, "send_image");
                  get_data({userid:CURRENT_CHAT_USER,
                    seen:SEEN_STATUS
                }, "chats_refresh");
                }
            }

            myform.append('file',files[0]);
            myform.append('data_type',"send_image") 
            myform.append('userid', CURRENT_CHAT_USER)
            //send to middleware
            xml.open("POST", "upload.php", true);
            xml.send(myform);

    }
    
    function handle_drag_and_drop(e){
        if(e.type == "dragover"){
            e.preventDefault();
            e.target.className = "dragging";

        } else if(e.type == "dragleave"){
            e.target.className = "";

        } else if(e.type == "drop"){
            e.preventDefault();
            e.target.className = "";
            upload_profile_image(e.dataTransfer.files);
        } else {
            e.target.className = "";
        }
    }

    function logout_user(){
        var answer = confirm("Are you sure you want to log out?");
        if(answer){
            get_data({}, "logout");
        }
    }

    get_data("", "user_info");
    get_data("", "contacts");

    var radio_contacts = _("radio_contacts");
    radio_contacts.checked = true;

    function get_contacts(e){
        get_data("", "contacts");
    }

    function get_chats(e){
        get_data({seen: SEEN_STATUS}, "chats");
    }

    //retrieves settings component
    function get_settings(e){
        get_data("", "settings");
    }

    function send_message(e){
        var message_text = _("message_text");
        if(message_text.value.trim() == ""){
            return;
        }

        get_data({
            message:message_text.value,
            userid:CURRENT_CHAT_USER,
        }, "send_message");
    }

    function enter_pressed(e){
        if(e.keyCode == 13){
            send_message(e);
        }
        SEEN_STATUS = true;
    }

    function set_seen(e){
        SEEN_STATUS = true;
    }

    function delete_message(e){
        if(confirm("Are you sure u want to delete this message?")){
            var msgid = e.target.getAttribute("msgid");
            get_data({rowid:msgid
            }, "delete_message");
            get_data({userid:CURRENT_CHAT_USER,
                seen:SEEN_STATUS
            }, "chats_refresh");
        }
    }

    function delete_thread(e){
        if(confirm("Are you sure u want to delete this thread?")){
            get_data({userid:CURRENT_CHAT_USER
            }, "delete_thread");
            get_data({userid:CURRENT_CHAT_USER,
                seen:SEEN_STATUS
            }, "chats_refresh");
        }
    }

    // auto-refresh for real-time chat
    setInterval(function(){
        // Only refresh if a chat is open
        if(CURRENT_CHAT_USER != ""){
            get_data({userid:CURRENT_CHAT_USER,
                seen:SEEN_STATUS
            }, "chats_refresh");
        }
    }, 5000);

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

            //log data being send
            console.log("Sending:", JSON.stringify(data));

        }

        function start_chat(e){
            var userid = e.target.getAttribute('userid');
            if(!userid){ 
                userid = e.target.parentNode.getAttribute("userid");
            }

            CURRENT_CHAT_USER = userid;
            var radio_chat = _("radio_chat");
            radio_chat.checked = true;

            get_data({userid: CURRENT_CHAT_USER}, "chats"); 
        }

    </script>
