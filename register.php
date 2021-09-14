

<?php

$sqlConnect = mysqli_connect('localhost','root','');
$sqlConnect2 = mysqli_connect('localhost','root','');

if(!$sqlConnect){
    die("Failed to connect to the database: " .mysqli_error());
}

if(!$sqlConnect2){
    die("Failed to connect to the database: " .mysqli_error());
}

$selectDB = mysqli_select_db($sqlConnect,'Accounts');
$selectDB2 = mysqli_select_db($sqlConnect2,'Froshwiki');

if(!$selectDB){
    die("Failed to connect to the database: " .mysqli_error());
}

if(!$selectDB2){
    die("Failed to connect to the database: " .mysqli_error());
}

?>
<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if (@$_SESSION['postdata']){
    $_POST=$_SESSION['postdata'];
    unset($_SESSION['postdata']);
}

?>

<html>

<title>Frosh Wiki Register</title>
<head>

    <style>

        body{
            margin:0;
            background:url(backgrounds/loginbackground.jpg);

            position: center;
            top: 50%;
            left: 0;
            width: 100%;
            height: 400px;
            margin-top: 50px;
            overflow: hidden;
            font:600 16px/18px 'Open Sans',sans-serif;
        }
        *,:after,:before{box-sizing: border-box; border-radius:15px;}

        a{color:inherit;text-decoration:none}

        .register-wrap{
            width:100%;
            margin:auto;
            max-width:525px;
            min-height:870px;
            position:relative;
            background:url(backgrounds/henrysy.jpg) no-repeat center;
            box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
        }
        .register-html{
            width:100%;
            height:100%;
            position:absolute;
            padding:90px 70px 50px 70px;
            background:rgba(0,100,0,.9);
        }

        .register-html .sign-in,
        .register-html .sign-up,
        .register-form .group .check{
            font:600 16px/18px 'Open Sans',sans-serif;
            font-size:22px;
            margin-right:15px;
            padding-bottom:5px;
            margin:0 15px 10px 0;
            display:inline-block;
            background-color:transparent;
            border-top: transparent;
            border-left: transparent;
            border-right: transparent;
            border-bottom:2px solid transparent;
            color:#fff;
            border-color:#008000;
        }

        .register-html .sign-in{
            font:600 16px/18px 'Open Sans',sans-serif;
            font-size:22px;
            color:#aaa;
        }


        .register-form .group .label,
        .register-form .group .button{
            text-transform:uppercase;
        }

        .register-form .group{
            margin-bottom:15px;
        }
        .register-form .group .label,
        .register-form .group .input,
        .register-form .group .button{
            width:100%;
            color:#fff;
            display:block;
        }
        .register-form .group .input,
        .register-form .group .button{
            border:none;
            padding:15px 20px;
            border-radius:25px;
            background:rgba(255,255,255,.1);
        }
        .register-form .group input[data-type="password"]{
            text-security:circle;
            -webkit-text-security:circle;
        }
        .register-form .group .label{
            color:#aaa;
            font-size:12px;
        }
        .register-form .group .button{
            background:#4CAF50;
        }
        .register-form .group label .icon{
            width:15px;
            height:15px;
            border-radius:2px;
            position:relative;
            display:inline-block;
            background:rgba(255,255,255,.1);
        }

        .hr{
            height:2px;
            margin:60px 0 50px 0;
            background:rgba(255,255,255,.2);
        }
        .foot-lnk{
            text-align:center;
        }

    </style>
</head>


<?php

$message= "";

if(isset($_POST["register"])) {


    $username = test_input($_POST["userRegister"]);
    $email = test_input($_POST["emailRegister"]);
    $firstName = test_input($_POST["firstNameRegister"]);
    $lastName = test_input($_POST["lastNameRegister"]);
    $idNumber = test_input($_POST["idNumberRegister"]);
    $password = test_input($_POST["passRegister"]);
    $confPassword = test_input($_POST["confRegister"]);

    $addUser = "INSERT INTO userInfo(username, password, email) VALUES ('$username','$password','$email')";
    $addProfile = "INSERT INTO profileInfo(username, email, firstName, lastName, id_no, password)
                    VALUES('$username','$email','$firstName','$lastName','$idNumber','$password')";
    $checkUser = "SELECT * FROM userInfo WHERE username='$username'";
    $checkEmail = "SELECT * FROM userInfo WHERE email='$email'";

    $query = mysqli_query($sqlConnect, $checkEmail);
    $query1 = mysqli_query($sqlConnect, $checkUser);

    if (!$query1) {
        die("Failed to connect: " . mysqli_error());
    }

    $databaseUsername = $databaseEmail = "";

    while ($SR = mysqli_fetch_array($query1)) $databaseUsername = $SR['username'];
    while ($SR = mysqli_fetch_array($query)) $databaseEmail = $SR['email'];

    if ($databaseUsername == "") {
        if ($databaseEmail == ""){
            if ($password == $confPassword ) {
                if(filter_var($email, FILTER_SANITIZE_EMAIL)){
                    if(filter_var($idNumber, FILTER_VALIDATE_INT)){
                        $idArray = str_split($idNumber);
                        $checkId = (int) ($idArray[0])*8 +  (int) ($idArray[1])*7 + (int) ($idArray[2])*6
                            + (int) ($idArray[3])*5 +  (int) ($idArray[4])*4 + (int) ($idArray[5])*3
                            + (int) ($idArray[6])*2 +  (int) ($idArray[7])*1;
                        if($checkId % 11 == 0 and strlen($idNumber) == 8 ){
                            $query2 = mysqli_query($sqlConnect, $addUser);
                            $query3 = mysqli_query($sqlConnect2, $addProfile);
                            if (!$query2) die("Failed to connect: " . mysqli_error());
                            $message = "Registered Successfully!";
                        } else $message="Invalid ID Number. You are not a student of this university.";
                    } else $message="Invalid ID Number. Please enter integers only.";
                } else $message = "This is not a valid email address. Please try again.";
            } else $message= "Password and confirm password did not match. Please try again.";
        }  else $message = "Failed to Register. E-mail has been taken by another user.";
    } else $message = "Failed to Register. Username has been taken by another user.";



}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


    <body>
        <div class="register-wrap">
            <div class="register-html">
                <form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <a href="login.php"><input id="tab-1" type="button" name="tab" class="sign-in" value="SIGN IN" /></a>
                    <a href="register.php"><input id="tab-2" type="button" name="tab" class="sign-up" value="SIGN UP" /></a>

                    <div class="register-form">
                        <div class="sign-up-html">
                            <div class="group">


                                <label for="user" class="label">Username</label>
                                <input id="user" name="userRegister" type="text" class="input" required>
                            </div>

                            <div class="group">
                                <label for="email" class="label">Email Address</label>
                                <input id="email" name="emailRegister" type="text" class="input" required>
                            </div>

                            <div class="group">
                                <label for="firstName" class="label">First Name</label>
                                <input id="firstName" name="firstNameRegister" type="text" class="input" required>
                            </div>

                            <div class="group">
                                <label for="lastName" class="label">Last Name</label>
                                <input id="lastName" name="lastNameRegister" type="text" class="input" required>
                            </div>

                            <div class="group">
                                <label for="idNumberRegister" class="label">ID Number</label>
                                <input id="idNumberRegister" name="idNumberRegister" type="text" class="input" required>
                            </div>


                            <div class="group">
                                <label for="pass" class="label">Password</label>
                                <input id="pass" name="passRegister"type="password" class="input" data-type="password" required>
                            </div>
                            <div class="group">
                                <label for="pass" class="label">Confirm Password</label>
                                <input id="pass" name="confRegister" type="password" class="input" data-type="password" required>
                            </div>


                            <div class="group">
                                <input type="submit" name="register" class="button" value="Sign Up">
                            </div>
                            <div class="hr"></div>
                            <div class="foot-lnk">
                                <label><?php echo $message;?></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>



