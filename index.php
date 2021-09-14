<?php
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

<?php
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

<?php
$username = test_input($_SESSION['currentUser']);
$init = "SELECT * FROM profileInfo WHERE username='$username'";
$first_query = mysqli_query($sqlConnect, $init);
if (!$first_query) {
    die("Failed to connect: " . mysqli_error());
}
$email = $firstName = $lastName = $id_no = "";


while($SR=mysqli_fetch_array($first_query)){
    $email = $SR['email'];
    $firstName = $SR['firstName'];
    $lastName = $SR['lastName'];
    $id_no = $SR['id_no'];
}

?>


<!DOCTYPE html>
<html lang="en">
<title>Frosh Wiki</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<script src="https://kit.fontawesome.com/9560b283f1.js" crossorigin="anonymous"></script>

<style>
    body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
    body {font-size:16px;}
    .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
    .w3-half img:hover{opacity:1}

    .custom-search-bar{
        border-top: transparent;
        border-right: transparent;
        border-left: transparent;
        border-bottom-color: #aaaaaa;
    }

    .slang-bar{
        border-top: transparent;
        border-right: transparent;
        border-left: transparent;
        border-bottom-color: #aaaaaa;
        width:50%;
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
        color:black;
        background-color: lightgray;
    }

    .table-style{
        width: 95%;
    }

    .row{
        text-align: center;
    }

    .rows{
        display: flex;
    }

    .column {
        flex: 50%;
    }
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-green w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
    <div class="w3-container">
        <h3 class="w3-padding-64"><b>FROSH<br>WIKI</b></h3>
    </div>
    <div class="w3-bar-block">
        <form action="profile.php" method="post">
            <button type="submit" id="profile" name="profile" class="w3-bar-item w3-button w3-hover-white">Profile</button>
        </form>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
        <a href="#abbreviation" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Abbreviations & Slangs</a>
        <a href="#warpzones" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Warp Zones & Gates</a>
        <a href="#applications" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Mobile Applications</a>
        <a href="#perks" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">DLSU Email Perks</a>
        <a href="#offices" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Offices & Faculty</a>
        <a href="#study" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Study Areas</a>
        <a href="#food" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Food Establishments</a>
        <a href="#organizations" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Organizations</a>
        <a href="#recreation" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Recreational Establishments</a>
        <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact & Extras</a>
        <form action="login.php" method="post">
            <button type="submit" id="logout" name="logout" class="w3-bar-item w3-button w3-hover-white">Logout</button>
        </form>

        <?php
        if(isset($_POST["logout"])){
            session_destroy();
            unset($_SESSION['username']);
        }
        ?>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-green w3-xlarge w3-padding">
    <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
    <span>FROSH WIKI</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

    <!-- Header -->
    <div class="w3-container" style="margin-top:80px" id="abbreviation">
        <h1 class="w3-jumbo"><b>FROSHIE TIPS! ✔</b></h1>
        <h1 class="w3-xxxlarge w3-text-green"><b>LaSallian Abbreviations and Slangs</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>To get you started, we are pretty sure that while your stay in La Salle, you will hear a lot
        of abbreviations, jargons and slangs often! We prepared a list of common abbreviations and slangs
        and its meaning that are often used by LaSallians. Make sure to familiarize with them so won't feel
        lost while your stay in De La Salle University!
        </p>

        <table class="table-style" style="align-content: center">
            <tr>
                <th>Abbreviation/Slangs</th>
                <th>Meaning</th>
            </tr>
            <?php
            $getTable = "SELECT * FROM Slangs";
            $query = mysqli_query($sqlConnect, $getTable);
            while ($SR = mysqli_fetch_array($query)){
                $databaseAbbreviaton= $SR['Abbreviation'];
                $databaseMeaning = $SR['Meaning'];
                echo '<tr class="row"> 
                      <td>'.$databaseAbbreviaton.'</td> 
                      <td>'.$databaseMeaning.'</td> 
                     </tr>';
            }
            ?>
        </table>
        <br><br>
        Heard a new slang? Add them now!<br>
        <form action="index.php#abbreviation" method="post">
            <div class="w3-section">
                <label>Abbreviation/Slang</label>
                <br>
                <input class="slang-bar" type="text" name="abbreviation" required>
                <br><br>
                <label>Meaning</label><br>
                <input class="slang-bar" type="text" name="meaning" required><br><br>
                <button type="submit" name="add" class="custom-locate-button" style="width: 50%">Add</button>
            </div>
        </form>
    </div>
    <br>
    <?php

    if(isset($_POST["add"])) {
        $username = $_SESSION['currentUser'];
        $abbreviation = test_input($_POST["abbreviation"]);
        $meaning = test_input($_POST["meaning"]);
        $addUser = "INSERT INTO Slangs(User, Abbreviation, Meaning) VALUES ('$username','$abbreviation','$meaning')";
        $query = mysqli_query($sqlConnect, $addUser);
        if (!$query) {
            die("Failed to connect: " . mysqli_error());
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>



    <!-- Warp Zones -->
    <div class="w3-container" id="warpzones" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Warp Zones and Gates.</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>In La Salle, there are a lot of shortcuts between two buildings! LaSallians call these shortcuts "Warp Zones". </p>
        <p>So what's the significance of these warp zones? These warp zones help you arrive to your class faster so you won't be marked absent or late by our professor.
            Warp zones exist because some buildings are so far from each other, which could take a lot of your time and energy. If your class are on one of these buildings,
            then these shortcuts could hugely help you!
        </p>
    </div>

    <!-- Photo grid (modal) -->
    <div class="w3-row-padding">
        <img src="map/map.jpg" style="width:100%" onclick="onClick(this)" alt="DE LA SALLE UNIVERSITY CAMPUS MAP">
    </div>

    <div class="rows">
        <div class="column">
            <h1 class="w3-xlarge w3-text-black"><b>Campus Warp Zones</b></h1>
            <p> Henry Sy Sr. Hall ⇌ Enrique Yuchengco Hall <br>
                Henry Sy Sr. Hall 5th floor ⇌ Enrique Yuchengco Hall floor 7A<br><br>
                St. Joseph Hall ⇌ William Hall<br>
                St. Joseph Hall 6th floor ⇌ William Hall 6th floor<br><br>
                St. Miguel Hall ⇌ Gokongwei Hall<br>
                St. Miguel Hall 2nd floor ⇌ Gokongwei Hall 2nd floor<br><br>

            </p>
        </div>

        <div class="column">
            <h1 class="w3-xlarge w3-text-black"><b>Gates</b></h1>
            <p> Gate 1 or South Gate (near Mcdo) <br>
                Gate 2 or North Gate (Henry)<br>
                Gate 3 (Velasco)<br>
                Gate 4 (Gokongwei)<br>
                Gate 5 (Andrew)<br>
                Gate 6 (Razon)<br>
                Gate 7 (STRC)<br>
                Gate 8 (Agno)<br>
                Gate 9 (Leveriza)<br>

            </p>
        </div>

    </div>

    <!-- Modal for full size images on click-->
    <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
        <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
            <img id="img01" class="w3-image">
            <p id="caption"></p>
        </div>
    </div>

    <!-- Mobile Applications -->
    <div class="w3-container" id="applications" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Mobile Applications</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>In La Salle, whether you are a person who does tasks on a whim or procedurally, these mobile applications
            will certainly help you throughout your stay in the university.
        </p>
        <p>Try them out now and get to organizing
            your things!
        </p>
    </div>

    <!-- Mobile Application Pictures -->
    <div class="w3-row-padding">

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://telegram.org/"><img src="applications/telegram.png" alt="Telegram" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Telegram</h3>
                    <p>A messaging application like Facebook messenger,
                        except you can send bigger files and you can see the links you previously sent</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://dlsu.instructure.com/"><img src="applications/canvas.png" alt="Canvas" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Canvas</h3>
                    <p>Canvas is also known as Animo Space in LaSallian terms.</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://kahoot.it/"><img src="applications/kahoot.png" alt="Kahoot!" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Kahoot!</h3>
                    <p>A free student-response tool for all platforms which allows teachers to run gamelike multiple-choice answer quizzes</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row-padding">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.khanacademy.org/"><img src="applications/khanacademy.jpg" alt="Khan Academy" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Khan Academy</h3>
                    <p> App with free online lessons and exercises on topics
                        including Calculus, Programming, and other science-related
                        courses as well arts and economics courses</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.symbolab.com/"><img src="applications/symbolab.png" alt="Symbolab" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Symbolab</h3>
                    <p>Online calculator for Math-related subjects such as Calculus, Algebra, Geometry and etc.</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.chegg.com/"><img src="applications/chegg.png" alt="Chegg" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Chegg</h3>
                    <p>Provides digital and physical textbook rentals, online tutoring, and other student services.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row-padding">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://photomath.com/en/"><img src="applications/photomath.png" alt="Photomath" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Photomath</h3>
                    <p>App which uses a mobile phone’s camera for solving math problems</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.desmos.com/"><img src="applications/desmos.png" alt="Desmos" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Desmos</h3>
                    <p>App used for graphing mathematical equations</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://quizlet.com/"><img src="applications/quizlet.png" alt="Quizlet" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Quizlet</h3>
                    <p>App that could be used for reviewing by making flashcards</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row-padding">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.schedninja.com/"><img src="applications/schedninja.jpg" alt="SchedNinja" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>SchedNinja</h3>
                    <p>An application used to organize and make class schedules</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://classup.plokia.com/"><img src="applications/classup.jpg" alt="ClassUp" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>ClassUp</h3>
                    <p>App for managing schedules and tracking academic tasks</p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://www.notebloc.com/"><img src="applications/notebloc.png" alt="Notebloc" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Notebloc</h3>
                    <p>A useful application for scanning documents by just using your phone</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w3-row-padding">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-transparent w3-center">
                <a href="https://calendar.google.com/calendar/u/0/r"><img src="applications/googlecalendar.png" alt="Google Calendar" style="width:25%" ></a>
                <div class="w3-container">
                    <h3>Google Calendar</h3>
                    <p>App for more-detailed monthly and daily schedules</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Email Perks -->
    <div class="w3-container" id="perks" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>DLSU Email Perks</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>Throughout your stay in DLSU, we are pretty sure you'll need some softwares to do your school works, projects and other endeavors.
            What if we tell you that your <b>DLSU Email</b> has perks? Say no more! You can use your DLSU Email for some products to get free
            licenses, softwares and discounts! You may not need Spotify to create your projects technically, but for sure you'll need music without
            ads in between to do your projects!
        </p>

    </div>

    <!-- Spotify -->
    <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <ul class="w3-ul w3-light-grey w3-center">
                <li class="w3-green w3-xlarge w3-padding-32"><i class="fa fa-spotify"></i> Spotify</li>
                <li class="w3-padding-16"> 50% Spotify Premium discount for .edu emails</li>
                <li class="w3-padding-16">
                    <h2>₱65</h2>
                    <span class="w3-opacity">per month</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.spotify.com/ph-en/student/"><button class="w3-button w3-green w3-padding-large w3-hover-black">Get it now!</button></a>
                </li>
            </ul>
        </div>
        <!-- Google Drive -->
        <div class="w3-half">
            <ul class="w3-ul w3-light-grey w3-center">
                <li class="w3-blue w3-xlarge w3-padding-32"><i class="fab fa-google-drive"></i> Google Drive</li>
                <li class="w3-padding-16">Unlimited Drive & Gmail Storage</li>
                <li class="w3-padding-16">
                    <h2>Original Quality Images</h2>
                    <span class="w3-opacity">in Google Photos</span>
                </li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://drive.google.com/drive/u/0/my-drive"><button class="w3-button w3-blue w3-padding-large w3-hover-black">Get it now!</button></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Apple -->
    <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <ul class="w3-ul w3-light-grey w3-center">

                <li class="w3-black w3-xlarge w3-padding-32"><i class="fa fa-apple" ></i> Apple</li>
                <li class="w3-padding-16">Discounted prices through Apple Online Store</li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.apple.com/ph/education/college-students/"><button class="w3-button w3-black w3-padding-large w3-hover-white">Get it now!</button></a>
                </li>
            </ul>
        </div>

        <!-- Microsoft Office 365 Pro Plus -->
        <div class="w3-half">
            <ul class="w3-ul w3-light-grey w3-center">
                <li class="w3-red w3-xlarge w3-padding-32">Microsoft Office 365 Pro Plus</li>
                <li class="w3-padding-16">Includes Unlimited OneDrive Storage</li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.microsoft.com/en-ph/education/products/office"><button class="w3-button w3-red w3-padding-large w3-hover-black">Get it now!</button></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Github -->
    <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <ul class="w3-ul w3-light-grey w3-center">

                <li class="w3-black w3-xlarge w3-padding-32"><i class="fab fa-github"></i> GitHub Student Developer Pack</li>
                <li class="w3-padding-16">$1000 worth of digital tools</li>
                <li class="w3-padding-16">Unlimited Private Repositories</li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://education.github.com/pack"><button class="w3-button w3-black w3-padding-large w3-hover-white">Get it now!</button></a>
                </li>
            </ul>
        </div>

        <!-- AutoDesk Softwares -->
        <div class="w3-half">
            <ul class="w3-ul w3-light-grey w3-center">
                <li class="w3-black w3-opacity w3-xlarge w3-padding-32"></i> AutoDesk Softwares</li>
                <li class="w3-padding-16">Free AutoCad, Fusion360, and etc.</li>
                <li class="w3-padding-16">1-year Educational License</li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.autodesk.com/education/edu-software/overview?sorting=featured&filters=individual"><button class="w3-button w3-black w3-opacity w3-padding-large w3-hover-white">Get it now!</button></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Adobe Creative Cloud -->
    <div class="w3-row-padding">
        <div class="w3-half w3-margin-bottom">
            <ul class="w3-ul w3-light-grey w3-center">

                <li class="w3-red w3-xlarge w3-padding-32">Adobe Creative Cloud</li>
                <li class="w3-padding-16">60% discount for all .edu emails</li>
                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.adobe.com/sea/creativecloud/buy/students.html"><button class="w3-button w3-red w3-padding-large w3-hover-black">Get it now!</button></a>
                </li>
            </ul>
        </div>

        <!-- Softmaker -->
        <div class="w3-half">
            <ul class="w3-ul w3-light-grey w3-center">
                <li class="w3-green w3-xlarge w3-padding-32">Softmaker Office</li>
                <li class="w3-padding-16">Full Softmaker Office 2018 Suite Free for Students & Teachers</li>

                <li class="w3-light-grey w3-padding-24">
                    <a href="https://www.softmaker.com/en/education"><button class="w3-button w3-green w3-padding-large w3-hover-black">Get it now!</button></a>
                </li>
            </ul>
        </div>
    </div>


    <!-- Offices -->
    <div class="w3-container" id="offices" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Offices and Faculty</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>In case you need to know about the different offices and faculty, here is the list!
            You can also search for the location of these offices or faculty, just type in the search
            bar provided.<br><br></p>

        <div class="rows">
            <div class="column">
                <h1 class="w3-xlarge w3-text-black"><b>Offices</b></h1>
                <p> GCOE Dean and Vice Dean's Office <br><br>
                    GCOE Department Offices <br><br>
                    Enrollment Services Hub <br><br>
                    Office of the University Registrar (OUR) <br><br>
                    NSTP and Formation Office <br><br>
                    Student Discipline and Formation Office (SDFO)  <br><br>
                    Health Services Office <br><br>
                    Office of Career and Counseling Services (OCCS) <br><br>
                </p>
            </div>


            <div class="column">
                <h1 class="w3-xlarge w3-text-black"><b>Faculty</b></h1>
                <p> College of Liberal Arts (CLA) <br><br>
                    Br. Andrew Gonzales College of Education (BAGCED) <br><br>
                    College of Computer Studies (CCS) <br><br>
                    College of Science (COS) <br><br>
                    Ramon V. del Rosario College of Business (COB) <br><br>
                    School of Economics (SOE) <br><br>
                </p>
            </div>

        </div>


        <form action="index.php#offices" method="post">
            <div class="w3-section">
                <label>Office/Faculty</label><br>
                <input class="custom-search-bar" type="text" name="location" required>   <span><button type="submit" name="locate" class="custom-locate-button">Locate</button></span>
            </div>

        </form>

        <?php

        if(isset($_POST["locate"])){
            $location = $_POST["location"];
            $findLocation = "SELECT * FROM Office where office='$location'";
            $query = mysqli_query($sqlConnect, $findLocation);
            if (!$query) {
                die("Failed to connect: " . mysqli_error());
            }

            $databaseLocation = "";
            while ($SR = mysqli_fetch_array($query)){
                $databaseLocation =  $SR['location'];
            }
            if($databaseLocation != "") echo '<label>It is located at: <b>' .$databaseLocation .'</b></label>';
            else echo '<label>We cannot find the location, please enter a valid office/faculty.</label>';
        }



        ?>


    </div>


    <!-- Study Areas -->
    <div class="w3-container" id="study" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Study Areas</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p> As a LaSallian, we would want to find areas where we can study for our exams, subjects or even do our backlogs.
            And for that, we also listed the study areas where LaSallians can do these stuff peacefully! In this section
            you can also reserve a conference room.<br><br>
            Henry Sy Library <br>
            Andrew Lobby (open for 24 hours) <br>
            Gazebo (near William and SJ) <br>
            Medrano Hall <br>
            5th Floor Henry <br>
            Eng Walk <br>
        </p>
        <?php
        $username= test_input($_SESSION['currentUser']);
        $checkIfUserExists = "SELECT * FROM Conference WHERE username='$username'";

        $count = '';
        $query = mysqli_query($sqlConnect, $checkIfUserExists);
        if (!$query) {
            die("Failed to connect: " . mysqli_error());
        }

        while ($SR = mysqli_fetch_array($query)){
            $count =  $SR['username'];
        }


        if($count == ''){

            echo '<form action="index.php#study" method="post">
                    <div class="w3-section">
                    <label>Reserve a conference room!</label><br>
                    <input class="custom-search-bar" type="text" name="room" required>   <span><button type="submit" name="reserve" class="custom-locate-button">Reserve</button></span>
                    </div>
                    </form>';


        }

        else if($count != '') {

            echo '<form action="index.php#study" method="post">
                <label>You are currently reserved to a room. Please click "Done" if you are finished with the room.   </label>
                <span>     <button type="submit" class="custom-locate-button" name="done">Done</button></span>
                </form>';

        }

        $updateRoom = "UPDATE Conference SET username='', status='Vacant' WHERE username='$username'";

        if(isset($_POST["done"])){
            $query = mysqli_query($sqlConnect, $updateRoom);
            if (!$query) {
                die("Failed to connect: " . mysqli_error());
            }
            echo "<meta http-equiv='refresh' content='0'>";

        }

        else if(isset($_POST["reserve"])) {

            if(filter_var($_POST["room"], FILTER_VALIDATE_INT)){
                $room_no = (int) $_POST["room"];
                if($room_no >= 1 && $room_no <= 20){
                    $checkIfReserved = "SELECT * FROM Conference WHERE room_id='$room_no' AND status ='Vacant'";
                    $queryLine = mysqli_query($sqlConnect, $checkIfReserved);
                    $status = "";
                    while($SR = mysqli_fetch_array($queryLine)) $status = $SR['status'];
                    if($status != ""){
                        $updateRoom = "UPDATE Conference 
                                       SET username='$username', status='Occupied' 
                                       WHERE room_id=$room_no";
                        $query = mysqli_query($sqlConnect, $updateRoom);
                        echo "<meta http-equiv='refresh' content='0'>";
                    } else echo '<label>Room has been reserved by another person. Please try again.</label>';

                } else echo '<label>Room not found. Please try again.</label>';

            } else echo '<label>Please enter an integer number only!</label>';
        }
        ?>
        <br><br>
        <table class="table-style" style="align-content: center">
            <tr>
                <th>Room Number</th>
                <th>Status</th>
                <th>Occupied by</th>
            </tr>
            <?php
            $getTable = "SELECT * FROM Conference";
            $query = mysqli_query($sqlConnect, $getTable);
            while ($SR = mysqli_fetch_array($query)){
                $databaseRoom = $SR['room_id'];
                $databaseStatus = $SR['status'];
                $databaseUsername = $SR['username'];
                echo '<tr class="row"> 
                      <td>'.$databaseRoom.'</td> 
                      <td>'.$databaseStatus.'</td> 
                      <td>'.$databaseUsername.'</td> 
                     </tr>';
            }
            ?>
        </table>
    </div>

    <!-- Food -->
    <div class="w3-container" id="food" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Food Establishments</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>Of course, food establishments will always be part of the tips! If you are hungry and looking for spots
        to fill that stomach, but you are limited to a certain budget, then these are the places are you for you!
        Everything is arranged accordingly!</p>
        <table class="table-style">
            <tr>
                <th>Low-Cost (Below PHP 100 per person)</th>
                <th>Regular (PHP 100-150 per person)</th>
                <th>High-Cost (Above PHP 150 per person)</th>
            </tr>
            <tr class="row">
                <td>Erics's</td>
                <td> Jollibee</td>
                <td>Zark's</td>
            </tr>
            <tr class="row">
                <td>Ged and Bart</td>
                <td>Mcdonald's</td>
                <td>Buffalo's Wings N' Things</td>
            </tr>

            <tr class="row">
                <td>Sinangag Express</td>
                <td>Chowking</td>
                <td>Army navy</td>
            </tr>
            <tr class="row">
                <td>Agno</td>
                <td>Burger King</td>
                <td>Chomp Chomp</td>
            </tr>

            <tr class="row">
                <td></td>
                <td>BonChon</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>KFC</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Mang Inasal</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Tokyo Tokyo</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Jus & Jerry's</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Yi Fang</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Gong Cha</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Starbucks</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Coffee Bean</td>
                <td></td>
            </tr>

            <tr class="row">
                <td></td>
                <td>Black Scoop</td>
                <td></td>
            </tr>
        </table>
    </div>

    <!-- Organizations -->
    <div class="w3-container" id="organizations" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Organizations</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p>Do you have what it takes to balance your academics and extra curricular activities? Or do you want to join
        organizations where you can relate the stuff or hobbies you have? We also have prepared the list of organizations
        that you can join within the Engineering Department!
        </p>
    </div>

    <div class="w3-row-padding ">
        <!-- ACCESS-->
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/access.png" alt="ACCESS" style="width:100%">
                <div class="w3-container">
                    <h3>Association of Computer Engineering Students (ACCESS)</h3>
                    <p class="w3-opacity">
                        Access your potentials.<br>Access your skills.<br>
                        Access your excellence.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/AccessDLSU/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/access_cares"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a><br>
                    </p>
                </div>
            </div>
        </div>

        <!-- CHEN-->
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/chen.png" alt="CHEN" style="width:100%">
                <div class="w3-container">
                    <h3>Chemical Engineering Society<br>
                        (ChEn)
                    </h3>
                    <p class="w3-opacity"><br>
                        ChEn is the professional organization of students taking
                        up BS Chemical Engineering in De La Salle University.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/ChEnDLSU/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/ChEn_DLSU"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- CES -->
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/ces.jpg" alt="CES" style="width:100%">
                <div class="w3-container">
                    <h3>Civil Engineering Society<br>
                        (CES)
                    </h3>
                    <p class="w3-opacity"><br>
                        Civil Engineering Society is a
                        professional organization for Civil
                        Engineering students of De La Salle University.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/CESDLSU/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/CES_DLSU"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2ND ROW-->
    <div class="w3-row-padding ">
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/eces.jpg" alt="ECES" style="width:100%">
                <div class="w3-container">
                    <h3>Electronic and Communications Engineering Society (ECES)</h3>
                    <p class="w3-opacity">
                        Electronics and Communications Engineering Society is a
                        premiere organization in De La Salle University, that serves
                        its members and the community through various activities to nurture them.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/ECES.dlsu/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/dlsueces"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/imes.png" alt="IMES" style="width:100%">
                <div class="w3-container">
                    <h3>Industrial Management Engineering Society (IMES)</h3>
                    <p class="w3-opacity">
                        Industrial Management Engineering Society is a
                        professional organization in De La Salle University, for students
                        taking up BS Industrial Management Engineering.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/dlsuimes/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://www.imes-dlsu.com/home"><i class="fas fa-external-link-square-alt"></i></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/mes.png" alt="MES" style="width:100%">
                <div class="w3-container">
                    <h3>Mechanical Engineering Society (MES)</h3>
                    <p class="w3-opacity">
                        Mechanical Engineering Society, is a professional organization
                        for Mechanical Engineering students. It aims to aid the academic
                        needs of its members and at the same time become the official
                        venue for the them.
                    </p>
                    <p>
                        Visit:
                        <a href="https://www.facebook.com/dlsu.mes/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/MESDLSU"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a>
                    </p>
                </div>
            </div>
        </div>

        <div class="w3-col m4 w3-margin-bottom">
            <div class="w3-light-grey">
                <img src="orgs/sme.png" alt="SME" style="width:100%">
                <div class="w3-container">
                    <h3>Society of Manufacturing Engineering (SME)</h3>
                    <p class="w3-opacity">SME-DLSU is a student chapter of SME USA. It is
                        the professional organization of the Manufacturing Engineering
                        and Management program of De La Salle University.
                        They major in either Mechatronics and Robotics Engineering or
                        Biomedical Engineering.
                    </p>

                    <p>
                        Visit:
                        <a href="https://www.facebook.com/SmeDlsuChapter/"><i class="fab fa-facebook" style="color:#4267B2"></i></a>
                        <a href="https://twitter.com/SME_DLSU"><i class="fab fa-twitter" style="color:#1DA1F2"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <!-- Recreational Establishments -->
    <div class="w3-container" id="recreation" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Recreational Establishments</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <p> Of course, while we are studying hard for our subject courses, we also need to take some breather and chill!
            Here are some recommended relaxing places that you can do recreational activities!<br><br>
            Karaoke (Providence at Burgundy) <br><br>
            RMZ Billiards (3F Reyes Bldg., above Tapa King) <br><br>
            TableTaft <br><br>
            Cranium <br><br>
            Mancave <br><br>
            Computer shops around the campus (U-Mall, Mineski, Nostract, Techtite, and so much more!) <br><br>
            Gold's Gym at Razon
        </p>

    </div>

    <!-- Contact & Extras -->
    <div class="w3-container" id="contact" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b>Contacts and Extras</b></h1>
        <hr style="width:50px;border:5px solid green" class="w3-round">
        <div class="rows">
            <div class="column">
                <h1 class="w3-xlarge w3-text-black"><b>DLSU Contacts</b></h1>
                <p> ITS Help Desk <br>
                    Direct: 8 526 4242 Local: 316 or 406 <br><br>
                    DLSU Trunkline <br>
                    Direct: 8 524 4611 Local: 124 <br><br>
                    Office of Counseling and Career Services <br>
                    Direct: 8 536 0226 Local: 419, 416, or 389 <br><br>
                    Security and Safety Office <br>
                    Direct: 8 525 7159 Local: 480-482 <br><br>
                    Health Services Office <br>
                    Direct: 8 524 4611 Local: 221 or 334 <br><br>
                    Student Discipline Formation Office <br>
                    Direct: 8 536 0269 Local: 611, 414, or 290 <br><br>
                    Engineering Departments<br>
                    Chemical Engineering: 218<br>
                    Civil Engineering: 226<br>
                    Electronics and Communications Engineering: 224<br>
                    Industrial Engineering: 220<br>
                    Manufacturing Engineering and Management: 244<br>
                    Mechanical Engineering: 299, 308<br>

                </p>
            </div>


            <div class="column">
                <h1 class="w3-xlarge w3-text-black"><b>Websites</b></h1>
                <p> <a href="https://animo.sys.dlsu.edu.ph">AnimoSys</a> <br><br>
                    <a href="https://my.dlsu.edu.ph">My.LaSalle</a> <br><br>
                    <a href="https://dlsu.instructure.com">AnimoSpace</a> <br><br>
                    <a href="https://schedninja.com">SchedNinja</a> <br><br>
                    <a href="https://dlsu.edu.ph">De La Salle University</a> <br><br>
                    <a href="https://thelasallian.com">The LaSallian</a> <br><br>
                </p>
            </div>
        </div>

    </div>


    <div class="w3-container" id="contact" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-green"><b></b></h1>



    </div>


    <!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></p></div>

<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }

    function logout() {
        session_destroy()
    }
</script>

</body>


</html>


