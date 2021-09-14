<?php
session_start();
$sqlConnect = mysqli_connect('localhost','root','');

if(!$sqlConnect){
    die("Failed to connect to the database: " .mysqli_error());
}

$selectDB = mysqli_select_db($sqlConnect,'Accounts');

if(!$selectDB){
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
<title>Frosh Wiki Login</title>
<head>

    <style>
        body{
            margin:0;
            color:white;
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

        .login-wrap{
            width:100%;
            margin:auto;
            max-width:525px;
            min-height:470px;
            position:relative;
            background:url(backgrounds/henrysy.jpg) no-repeat center;
            box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
        }
        .login-html{
            width:100%;
            height:100%;
            position:absolute;
            padding:90px 70px 50px 70px;
            background:rgba(0,100,0,.9);
        }
        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check{
            font:600 16px/18px 'Open Sans',sans-serif;
            font-size:22px;
            margin-right:10px;
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

        .login-html .sign-up{
            font:600 16px/18px 'Open Sans',sans-serif;
            font-size:22px;
            color:#aaa;
        }

        .login-form .group .label,
        .login-form .group .button{
            text-transform:uppercase;
        }


        .login-form .group{
            margin-bottom:15px;
        }
        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button{
            width:100%;
            color:#fff;
            display:block;
        }
        .login-form .group .input,
        .login-form .group .button{
            border:none;
            padding:15px 20px;
            border-radius:25px;
            background:rgba(255,255,255,.1);
        }
        .login-form .group input[data-type="password"]{
            text-security:circle;
            -webkit-text-security:circle;
        }
        .login-form .group .label{
            color:#aaa;
            font-size:12px;
        }
        .login-form .group .button{
            background:#4CAF50;
        }


        .login-html .froshwiki .label{
            font-size: 64px;
            width:100%;
            color:#fff;
            display:block;
        }


        .login-form .group .check:checked + label{
            color:#fff;
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

$message = "";
if(!empty($_POST["userLogin"]) && !empty($_POST["passwordLogin"])) {
    $username = test_input($_POST["userLogin"]);
    $password = test_input($_POST["passwordLogin"]);
    $getCredentials = "SELECT * FROM userInfo where username=" . "'$username'";

    echo $username;
    $query = mysqli_query($sqlConnect, $getCredentials);
    if (!$query) {
        die("Failed to connect: " . mysqli_error());
    }

    $dbUsername = $dbPassword = "";

    while ($SR = mysqli_fetch_array($query)) {
        $dbUsername = $SR['username'];
        $dbPassword = $SR['password'];
    }

    if ($dbUsername == "") {
        $message = "Account does not exist. Please register.";
    } else {
        if ($password != $dbPassword) {
            $message = "You entered the wrong password. Please try again.";
        } else {
            $_SESSION['currentUser'] = $username;
            header("Location: index.php");
        }
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<body>
<div class="login-wrap">
    <div class="login-html">
        <a href="login.php"><input id="tab-1" type="button" name="tab" class="sign-in" value="SIGN IN" /></a>
        <a href="register.php"><input id="tab-2" type="button" name="tab" class="sign-up" value="SIGN UP" /></a><br>
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="login-form">
                <div class="sign-in-html">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" name="userLogin" type="text" class="input" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" name="passwordLogin" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign In">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label><?php echo $message;?></label>
                    </div>

                </div>
        </form>
    </div>
</div>
</div>
</body>
</html>






