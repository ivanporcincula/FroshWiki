

<!DOCTYPE html>


<html>

<style>
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
</style>
<body>


<form action="test.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <label for="fileToUpload" class="file-upload">Upload Image</label>

    <input type="file" name="fileToUpload" id="fileToUpload">
    <p><input class="edit-button" type="submit" name="savePP" value="Save" style="width: 47.5%" >
        <button class="edit-button" type="submit" name="cancelPP" style="width: 47.5%">Cancel</button>
    </p>
</form>

<?php

if(isset($_POST["savePP"])){

    $target_dir = "profile-picture/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check != false) {
        echo "<label>Successfully changed profile picture!</label>";
        echo "<meta http-equiv='refresh' content='0'>";
        $uploadOk = 1;
    } else {
        echo "<label>Your file is not an image.</label>l";
        $uploadOk = 0;
    }


// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<label>Sorry, your file is too large.</label>";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "<label>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</label>";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<label>Sorry, your file was not uploaded.</label>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "<label>Sorry, there was an error uploading your file.</label>";
        }
    }

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

</body>
</html>




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
}