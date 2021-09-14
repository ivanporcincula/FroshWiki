<?php

session_start();
$sqlConnect = mysqli_connect('localhost','root','');

if(!$sqlConnect){
    die("Failed to connect to the database: " .mysqli_error());
}

$selectDB = mysqli_select_db($sqlConnect,'froshwiki');

if(!$selectDB){
    die("Failed to connect to the database: " .mysqli_error());
}

?>

<?php
$username = test_input($_SESSION['currentUser']);
$init = "SELECT * FROM profileInfo WHERE username='$username'";
$first_query = mysqli_query($sqlConnect, $init);

$email = $firstName = $lastName = $id_no = "";

while($SR=mysqli_fetch_array($first_query)){
    $email = $SR['email'];
    $firstName = $SR['firstName'];
    $lastName = $SR['lastName'];
    $id_no = $SR['id_no'];
    $profilePicture = $SR['path'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frosh Wiki</title>

    <meta name="author" content="Codeconvey" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

    <!--Only for demo purpose - no need to add.-->
</head>

<style>
    body {
        background:url(backgrounds/loginbackground.jpg);
        padding: 0;
        margin: 0;
        font-family: 'Lato', sans-serif;
        color: #000;
    }

    .student-profile .card {
        border-radius: 10px;
    }

    .student-profile .card .card-header .profile_img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 10px auto;
        border: 10px solid #ccc;
        border-radius: 50%;
    }

    .student-profile .card h3 {
        font-size: 20px;
        font-weight: 700;
    }

    .student-profile .card p {
        font-size: 16px;
        color: #000;
    }

    .student-profile .table th,
    .student-profile .table td {
        font-size: 14px;
        padding: 5px 10px;
        color: #000;
    }

    .edit-button{

        color:white;
        background-color: #4CAF50;
        border-radius: 15px;
        border-color: transparent;
    }

    .edit-button:hover{

        border-radius: 15px;
        border-color:transparent;
        color:white;
        background-color: lightgray;
    }

    .custom-search-bar{
        border-color: #aaaaaa;
        border-radius: 15px;
        width: 100%;
    }

    .rows{
        text-align: center;
    }

    .table-style{
        width: 80%;
    }

    .custom-search-bar{
        border-top: transparent;
        border-right: transparent;
        border-left: transparent;
        border-bottom-color: #aaaaaa;
    }

    .custom-locate-button{
        border-radius: 15px;
        border-color:transparent;
        color:white;
        background-color: #4CAF50;
    }

    .custom-locate-button:hover{
        border-radius: 15px;
        border-color:transparent;
        color:white;
        background-color: lightgray;
    }

    .slang-bar{
        border-top: transparent;
        border-right: transparent;
        border-left: transparent;
        border-bottom-color: #aaaaaa;
        width:28%;
    }

    input[type="file"]{
        display: none
    }

    .file-upload{
        display: inline-block;
        color: white;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 15px;
        background-color: #4CAF50

    }


    /* ******************************************************
        Author URI: https://codeconvey.com/
        Demo Purpose Only - May not require to add.
        font-family: "Raleway",sans-serif;
    *********************************************************/

    @import url('https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900');



    html {
        box-sizing: border-box;
    }
    *, *:before, *:after {
        box-sizing: inherit;
    }

    article, header, section, aside, details, figcaption, figure, footer, header, hgroup, main, nav, section, summary {
        display: block;
    }
    body {
        color: #222;
        font-size: 100%;
        line-height: 24px;
        margin: 0;
        padding:0;
        font-family: "Raleway",sans-serif;
    }
    a{
        font-family: "Raleway",sans-serif;
        text-decoration: none;
        outline: none;
    }
    a:hover, a:focus {
        color: #373e18;
    }
    section {
        float: left;
        width: 100%;
        padding-bottom:3em;
    }
    h2 {
        color: #1a0e0e;
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        line-height: normal;
        text-transform:uppercase;
    }
    h2 span {
        display: block;
        padding: 0;
        font-size: 18px;
        opacity: 0.7;
        margin-top: 5px;
        text-transform:uppercase;
    }

    #float-right{
        float:right;
    }


    /* ******************************************************
        Author URI: https://codeconvey.com/
        Demo Purpose Only - May not require to add.
        font-family: "Raleway",sans-serif;
    *********************************************************/

    @import url('https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900');



    html {
        box-sizing: border-box;
    }
    *, *:before, *:after {
        box-sizing: inherit;
    }

    article, header, section, aside, details, figcaption, figure, footer, header, hgroup, main, nav, section, summary {
        display: block;
    }
    body {
        color: #222;
        font-size: 100%;
        line-height: 24px;
        margin: 0;
        padding:0;
        font-family: "Raleway",sans-serif;
    }
    a{
        font-family: "Raleway",sans-serif;
        text-decoration: none;
        outline: none;
    }
    a:hover, a:focus {
        color: #373e18;
    }
    section {
        float: left;
        width: 100%;
        padding-bottom:3em;
    }
    h2 {
        color: #1a0e0e;
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        line-height: normal;
        text-transform:uppercase;
    }
    h2 span {
        display: block;
        padding: 0;
        font-size: 18px;
        opacity: 0.7;
        margin-top: 5px;
        text-transform:uppercase;
    }

    #float-right{
        float:right;
    }

    /* ******************************************************
        Script Top
    *********************************************************/



    /* To Navigation Style 1*/
    .ScriptTop ul {
        margin: 24px 0;
        padding: 0;
        text-align: left;
    }
    .ScriptTop li{
        list-style:none;
        display:inline-block;
    }
    .ScriptTop li a {
        background: #4CAF50 none repeat scroll 0 0;
        color: #fff;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        padding: 5px 18px;
        text-decoration: none;
        text-transform: capitalize;
        border-radius: 15px;
    }
    .ScriptTop li a:hover{
        background:#000;
        color:#fff;
    }


    /* ******************************************************
        Script Header
    *********************************************************/

    .ScriptHeader {
        float: left;
        width: 100%;
        padding: 2em 0;
    }
    .rt-heading {
        margin: 0 auto;
        text-align:center;
    }
    .Scriptcontent{
        line-height:28px;
    }
    .ScriptHeader h1{
        font-family: "brandon-grotesque", "Brandon Grotesque", "Source Sans Pro", "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        color: #4CAF50;
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        line-height: normal;

    }
    .ScriptHeader h2 {
        color: #312c8f;
        font-size: 20px;
        font-weight: 400;
        margin: 5px 0 0;
        line-height: normal;

    }
    .ScriptHeader h1 span {
        display: block;
        padding: 0;
        font-size: 22px;
        opacity: 0.7;
        margin-top: 5px;

    }
    .ScriptHeader span {
        display: block;
        padding: 0;
        font-size: 22px;
        opacity: 0.7;
        margin-top: 5px;
    }




    /* ******************************************************
        Live Demo
    *********************************************************/





    /* ******************************************************
        Responsive Grids
    *********************************************************/

    .rt-container {
        margin: 0 auto;
        padding-left:12px;
        padding-right:12px;
    }
    .rt-row:before, .rt-row:after {
        display: table;
        line-height: 0;
        content: "";
    }

    .rt-row:after {
        clear: both;
    }
    [class^="col-rt-"] {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        padding: 0 15px;
        min-height: 1px;
        position: relative;
    }


    @media (min-width: 768px) {
        .rt-container {
            width: 750px;
        }
        [class^="col-rt-"] {
            float: left;
            width: 49.9999999999%;
        }
        .col-rt-6, .col-rt-12 {
            width: 100%;
        }

    }

    @media (min-width: 1200px) {
        .rt-container {
            width: 1170px;
        }
        .col-rt-1 {
            width:16.6%;
        }
        .col-rt-2 {
            width:30.33%;
        }
        .col-rt-3 {
            width:50%;
        }
        .col-rt-4 {
            width: 67.664%;
        }
        .col-rt-5 {
            width: 83.33%;
        }


    }

    @media only screen and (min-width:240px) and (max-width: 768px){
        .ScriptTop h1, .ScriptTop ul {
            text-align: center;
        }
        .ScriptTop h1{
            margin-top:0;
            margin-bottom:15px;
        }
        .ScriptTop ul{
            margin-top:12px;
        }

        .ScriptHeader h1,
        .ScriptHeader h2,
        .scriptnav ul{
            text-align:center;
        }
        .scriptnav ul{
            margin-top:12px;
        }
        #float-right{
            float:none;
        }

    }












</style>
<body>

<div class="ScriptTop">
    <div class="rt-container">
        <div class="col-rt-4" id="float-right">

            <!-- Ad Here -->

        </div>
        <div class="col-rt-2">
            <ul>
                <li><a href="index.php" title="Back to Home">Back to Home</a></li>
            </ul>
        </div>
    </div>
</div>

<header class="ScriptHeader">
    <div class="rt-container">
        <div class="col-rt-12">
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
        <div class="col-rt-12">
            <div class="Scriptcontent">

                <!-- Student Profile -->
                <div class="student-profile py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent text-center">
                                        <img class="profile_img" src="<?php echo $profilePicture ?>" alt="student dp">
                                        <?php echo '<h3>'.$firstName.' '.$lastName.'</h3>'; ?>
                                    </div>
                                    <div class="card-body">
                                        <?php echo '<p class="mb-0"><strong class="pr-1">Username:</strong>'.$username.'</p>'; ?>
                                        <?php echo '<p class="mb-0"><strong class="pr-1">Email:</strong>'.$email.'</p>'; ?>
                                        <?php echo '<p class="mb-0"><strong class="pr-1">ID Number:</strong>'.$id_no.'</p>'; ?>



                                        <form action="profile.php" method="post">
                                            <p class="mb-0"><button class="edit-button" type="submit" name="editPP" style="width: 100%">Edit profile picture</button></p>
                                        </form><br>
                                        <?php
                                        if(isset($_POST["editPP"])){

                                            echo '<form action="profile.php" method="post" enctype="multipart/form-data">
                                                Select image to upload:
                                                <label for="fileToUpload" class="file-upload">Upload Image</label>
                 
                                                <input type="file" name="fileToUpload" id="fileToUpload">
                                                <p><input class="edit-button" type="submit" name="savePP" value="Save" style="width: 47.5%" >
                                                <button class="edit-button" type="submit" name="cancelPP" style="width: 47.5%">Cancel</button>
                                                </p>
                                            </form>';

                                        }
                                        
                                        if(isset($_POST["savePP"])){

                                            $target_dir = "profile-pictures/";
                                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                            $uploadOk = 1;
                                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                            if($check != false) {
                                                echo $target_file;
                                                $updateProfilePicture = "UPDATE profileInfo SET path='$target_file' WHERE username='$username'";

                                                $profileQuery =  mysqli_query($sqlConnect, $updateProfilePicture);
                                                echo "<meta http-equiv='refresh' content='0'>";
                                                $uploadOk = 1;
                                            } else {
                                                echo "<label>Your file is not an image.</label>l";
                                                $uploadOk = 0;
                                            }
                                            if ($_FILES["fileToUpload"]["size"] > 500000) {
                                                echo "<label>Sorry, your file is too large.</label>";
                                                $uploadOk = 0;
                                            }

                                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                                && $imageFileType != "gif" ) {
                                                echo "<label>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</label>";
                                                $uploadOk = 0;
                                            }

                                            if ($uploadOk == 0) {
                                                echo "<label>Sorry, your file was not uploaded.</label>";
                                            } else {
                                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                                                } else {
                                                    echo "<label>Sorry, there was an error uploading your file.</label>";
                                                }
                                            }



                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Abbreviation/Slangs Contribution</h3>
                                    </div>
                                    <div class="card-body pt-0">
                                        <table class="table-style">
                                            <?php
                                            $tablePresent = true;
                                            $getTable = "SELECT * FROM Slangs WHERE User='$username'";
                                            $query = mysqli_query($sqlConnect, $getTable);
                                            $query2 = mysqli_query($sqlConnect, $getTable);

                                            $check = "";
                                            while ($SR = mysqli_fetch_array($query)) $check = $SR['User'];

                                            if($check != ""){
                                                $tablePresent = true;
                                                echo '<tr class="rows">
                                                      <th>Abbreviation/Slangs</th>
                                                        <th>Meaning</th>
                                                        </tr>
                                                      ';
                                                while ($SR = mysqli_fetch_array($query2)){
                                                    $databaseAbbreviaton= $SR['Abbreviation'];
                                                    $databaseMeaning = $SR['Meaning'];
                                                    echo '<tr class="rows"> 
                                                      <td>'.$databaseAbbreviaton.'</td> 
                                                      <td>'.$databaseMeaning.'</td> 
                                                      </tr>';
                                                }
                                            } else {
                                                echo '<label>None</label>';
                                                $tablePresent = false;
                                            }
                                            ?>
                                        </table>
                                        <?php
                                        if($tablePresent){
                                            echo '<form action="profile.php" method="post">
                                                   <div class="w3-section">                                              
                                                <span>     <button type="submit" class="custom-locate-button" name="deleteSlang">Delete</button></span>
                                                <span>     <button type="submit" class="custom-locate-button" name="editSlang">Edit</button></span>
                                                </div></form>';
                                        }

                                        if(isset($_POST["deleteSlang"])){
                                            echo '<form action="profile.php" method="post">
                                                    <div class="w3-section">
                                                        <label>Type the abbreviation/slang to delete</label>
                                                        <br>
                                                        <input class="slang-bar" type="text" name="abbreviation">
                                                         <br><br>
                                                        <button type="submit" name="okDelete" class="custom-locate-button" style="width: 28%">Delete</button>
                                                    </div>
                                                </form>';

                                        }

                                        if(isset($_POST["editSlang"])){

                                            echo '<form action="profile.php" method="post">
                                                    <div class="w3-section">
                                                        <label>Desired Abbreviation/Slang to change</label>
                                                        <br>
                                                        <input class="slang-bar" type="text" name="abbreviation1" required>
                                                        <br><br>
                                                        <label>New Abbreviation/Slang</label><br>
                                                        <input class="slang-bar" type="text" name="abbreviation2" required>
                                                        <br><br>
                                                        <label>Meaning</label><br>
                                                        <input class="slang-bar" type="text" name="meaning" required><br><br>
                                                        <button type="submit" name="saveNewSlang" class="custom-locate-button" style="width: 28%">Save</button>
                                                    </div>
                                                </form>';

                                        }


                                        echo isset($_POST["saveNewSlang"]);
                                        if(isset($_POST["saveNewSlang"])){
                                            $abbreviation1 = test_input($_POST["abbreviation1"]);
                                            $abbreviation2 = test_input($_POST["abbreviation2"]);
                                            $meaning = test_input($_POST["meaning"]);
                                            $update = "UPDATE Slangs SET abbreviation='$abbreviation2', 
                                                        meaning='$meaning' WHERE abbreviation='$abbreviation1' AND user='$username'";

                                            $query = mysqli_query($sqlConnect, $update);
                                            echo "<meta http-equiv='refresh' content='0'>";

                                        }

                                        if(isset($_POST["okDelete"])){
                                            $abbreviation = test_input($_POST["abbreviation"]);
                                            $delete = "DELETE FROM Slangs
                                                       WHERE abbreviation='$abbreviation' AND user='$username'";
                                            $query = mysqli_query($sqlConnect, $delete);
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div style="height: 26px"></div>
                                <div class="card shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Conference Room Reservation</h3>
                                    </div>
                                    <div class="card-body pt-0">
                                        <?php
                                        $checkIfUserExists = "SELECT * FROM Conference WHERE username='$username'";
                                        $count = $currentRoom='';
                                        $query = mysqli_query($sqlConnect, $checkIfUserExists);

                                        if (!$query) {
                                            die("Failed to connect: " . mysqli_error());
                                        }

                                        while ($SR = mysqli_fetch_array($query)){
                                            $count =  $SR['username'];
                                            $currentRoom = $SR['room_id'];
                                        }

                                        if($count == ''){
                                            echo '<form action="profile.php" method="post">
                                                <div class="w3-section">
                                                <label>Reserve a conference room!</label><br>
                                                <p><input class="custom-search-bar" type="text" style="width: 28%"name="room" required></p>
                                                <button type="submit" name="reserve" class="custom-locate-button">Reserve</button>
                                                </div>
                                                </form>';
                                        }

                                        else if($count != '') {
                                            echo '<form action="profile.php" method="post">
                                                <label>You are reserved to Conference Room '.$currentRoom.' Pressing "Done" will cancel 
                                                your reservation to the current room you reserved. Pressing edit will allow you to change
                                                room reservation. A user is only allowed to reserve one room at a time.</label>
                                                <span>     <button type="submit" class="custom-locate-button" name="done">Done</button></span>
                                                <span>     <button type="submit" class="custom-locate-button" name="edit">Edit</button></span>
                                                </form>';
                                        }

                                        if(isset($_POST["reserve"])){
                                            if(filter_var($_POST["room"], FILTER_VALIDATE_INT)){
                                                $room_no = (int) $_POST["room"];
                                                if($room_no >= 1 && $room_no <= 20){
                                                    $checkIfReserved = "SELECT * FROM Conference WHERE room_id='$room_no' AND status ='Vacant'";
                                                    $queryLine = mysqli_query($sqlConnect, $checkIfReserved);
                                                    $status = "";
                                                    while($SR = mysqli_fetch_array($queryLine)) $status = $SR['status'];
                                                    if($status != ""){
                                                        $updateRoom = "UPDATE Conference SET username='$username', status='Occupied' 
                                                                   WHERE room_id=$room_no";
                                                        $query = mysqli_query($sqlConnect, $updateRoom);
                                                        echo "<meta http-equiv='refresh' content='0'>";
                                                    } else echo '<label>Room has been reserved by another person. Please try again.</label>';
                                                } else echo '<label>Room not found. Please try again.</label>';
                                            } else echo '<label>Please enter an integer number only!</label>';
                                        }

                                        else if(isset($_POST["done"])){
                                            $updateRoom = "UPDATE Conference SET username='', status='Vacant' WHERE username='$username'";
                                            $query = mysqli_query($sqlConnect, $updateRoom);
                                            if (!$query) die("Failed to connect: " . mysqli_error());
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }

                                        else if(isset($_POST["edit"])){
                                            echo '<form action="profile.php" method="post">
                                                    <div class="w3-section">
                                                     
                                                        <label>What room do you want to reserve instead?</label><br>
                                                        <input class="slang-bar" type="text" name="room1" required><br><br>
                                                        <button type="submit" name="saveEDIT" class="custom-locate-button" style="width: 28%">Save</button>
                                                    </div>
                                                </form>';
                                        }

                                        if(isset($_POST["saveEDIT"])){
                                            $updateRoom1 = "UPDATE Conference SET username='', status='Vacant' WHERE username='$username'";
                                            if(filter_var($_POST["room1"], FILTER_VALIDATE_INT)){
                                                $room_no = (int) test_input($_POST["room1"]);
                                                if($room_no >= 1 && $room_no <= 20){
                                                    $checkIfReserved = "SELECT * FROM Conference WHERE room_id='$room_no' AND status ='Vacant'";
                                                    $queryLine = mysqli_query($sqlConnect, $checkIfReserved);
                                                    $status = "";
                                                    while($SR = mysqli_fetch_array($queryLine)) $status = $SR['status'];
                                                    if($status != ""){
                                                        $updateRoom2 = "UPDATE Conference SET username='$username', status='Occupied' 
                                                                   WHERE room_id=$room_no";
                                                        $query = mysqli_query($sqlConnect, $updateRoom1);
                                                        $query2 = mysqli_query($sqlConnect, $updateRoom2);
                                                        echo "<meta http-equiv='refresh' content='0'>";
                                                    } else echo '<label>Room has been reserved by another person. Please try again.</label>';
                                                } else echo '<label>Room not found. Please try again.</label>';
                                            } else echo '<label>Please enter an integer number only!</label>';
                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }

                                        ?>
                                        <br><br>
                                        <table class="table-style rows">
                                            <tr>
                                                <th>Room Number</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php
                                            $getTable = "SELECT * FROM Conference WHERE STATUS= 'Vacant'";
                                            $query = mysqli_query($sqlConnect, $getTable);
                                            while ($SR = mysqli_fetch_array($query)){
                                                $databaseRoom = $SR['room_id'];
                                                $databaseStatus = $SR['status'];
                                                echo '<tr class="rows"> 
                                                      <td>'.$databaseRoom.'</td> 
                                                      <td>'.$databaseStatus.'</td>                                                   
                                                     </tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- partial -->
            </div>
        </div>
    </div>
</section>
<!-- Analytics -->

</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: profile.php".$_SERVER['PHP_SELF']);
    exit;
}

if (@$_SESSION['postdata']){
    $_POST=$_SESSION['postdata'];
    unset($_SESSION['postdata']);
}

?>
<?php
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    ?>