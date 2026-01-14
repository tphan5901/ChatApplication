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
        display: flex;
        margin: auto;
        color: grey;
        font-size: 13px;
    }

    form{
        margin: auto;
        padding: 10px;
        width: 400px;
    }

    input[type=text], input[type=password]{
        padding: 10px;
        margin: 10px;
        width: 100%;
        border-radius: 5px;
        border: solid 1px white;
    }

    input[type=button]{
        padding: 1%;
        margin: 1%;
        width: 100%;
        border-radius: 5px;
        cursor:pointer;
        background-color: #1cc045ff;
        color: white;
    }

    input[type=radio]{
        transform: scale(1.1);
    }
    
    #header{
        background-color: #1f1c1cff;
        font-size:40px;
        align-items:center;
        padding: 1%;
        width: 70%;
        color: white;
    }

    #error{

    }

</style>
</head>
<body>

    <div id ='wrapper'>
        <div id = 'header'>SignUp Page</div>

        <div id="error" style="text-align: center; padding: 0.5em; background-color: red; color: white; display: none;">some text</div>
        
        <form action="" id="myform">
            <input type="text" name='username' placeholder='username'><br>
            <input type="text" name='email' placeholder='email'><br>
            <div style='padding: 10px'>
                <br>Gender: <br>
                <input type="radio" value = 'male' name = 'gender'> Male <br>
                <input type="radio" value = 'female' name = 'gender'> Female <br>
                
            </div>
            <input type="password" name='password' placeholder='password'><br>
            <input type="password" name='password2' placeholder='retype password'><br>
            <input type="button" value='SignUp' id='signup_button'><br>
            <br>
            <a href="login.php" style="display: block; text-align: center; text-decoration: none;">Already have an account?</a>
        </form>
    </div>

</body>
</html>

<script type="text/javascript">

    function _(element){
        return document.getElementById(element);        
    }

    var signup_button = _('signup_button');
    signup_button.addEventListener('click', collect_data);

    function collect_data(){
        signup_button.disabled = true;
        signup_button.value = "Loading....";

        var myform = _('myform')
        //get input from form
        var inputs = myform.getElementsByTagName('INPUT')

        var data={};

        //if each input element has strokestroke, record it 
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

        send_data(data, 'signup');

    }

    function send_data(data, type){
        var xml = new XMLHttpRequest()

        xml.onload = function(){
            if(xml.readyState === 4 && xml.status === 200){
                handle_result(xml.responseText);
                signup_button.disabled = false;
                signup_button.value = "Signup";
            }
    
        }
        data.data_type = type;
        var data_string = JSON.stringify(data)
        xml.open('POST', 'api.php', true);
        xml.send(data_string);
        console.log("Sending:", JSON.stringify(data));

    }

    function handle_result(result){
        var data = JSON.parse(result);
        if(data.data_type == "info"){
            window.location = "index.php";
        } else {
            var error = _("error");
            error.innerHTML = data.message;
            error.style.display = "block";
        }
    }

</script>