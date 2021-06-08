<?php
require_once "config.php";
if (isset($_POST['upload']) && !empty($_FILES["uploadFile"]["name"])) {

    $filename = $_FILES["uploadFile"]["name"];
    $tempName = $_FILES["uploadFile"]["tmp_name"];
    $folder = "gallery/" . $filename;
    $title = $_POST['description'];
    $data = date('Y-m-d H:i:s');
    $username = $_SESSION["username"];
    $galleyType = $_POST['gallerySelector'];
    $sql = "SELECT id_ FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['id_'];
        }
    }
    
    $sql = "INSERT INTO gallery (id_user,name,data_time,picture_name, gallery_name) VALUES ($user_id,'$title','$data','$filename', $galleyType)";
    $result = mysqli_query($link, $sql);
    move_uploaded_file($tempName, $folder);
    if (($result)) {
        header("Location: gallery.php");
        echo "Image uploaded successfully";
    } else {
        echo "Failed to upload image! Try change filename";
    }

    
}


